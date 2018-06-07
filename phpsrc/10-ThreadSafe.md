# 线程安全(ZTS)

**1.线程安全资源管理器**

>PHP中专门为解决线程安全的问题抽象出了一个线程安全资源管理器(Thread Safe Resource Mananger, TSRM)，实现原理比较简单：既然共用资源这么困难那么就干脆不共用，各线程不再共享同一份全局变量，而是各复制一份，使用数据时各线程各取自己的副本，互不干扰。

```
typedef struct {
    size_t size; //资源的大小
    ts_allocate_ctor ctor; //构造函数
    ts_allocate_dtor dtor; //析构函数
    int done;
} tsrm_resource_type;

struct _tsrm_tls_entry {
    void **storage;//资源数组
    int count;    //storage数组大小
    THREAD_T thread_id; //线程id
    tsrm_tls_entry *next;
};
```

(1).TSRM初始化

```
TSRM_API int tsrm_startup(int expected_threads, int expected_resources, int debug_level, char *debug_filename){
    pthread_key_create( &tls_key, 0 );
    //1.分配tsrm_tls_table(用于保存tsrm_tls_entry大小为预设值)
    tsrm_tls_table_size = expected_threads;
    tsrm_tls_table = (tsrm_tls_entry **) calloc(tsrm_tls_table_size, sizeof(tsrm_tls_entry *));
    ...
    //2.初始化资源的递增id，注册资源时就是用的这个值
    id_count=0;
    //3.分配资源类型数组resource_types_table(大小为预设值)
    resource_types_table_size = expected_resources;
    resource_types_table = (tsrm_resource_type *) calloc(resource_types_table_size, sizeof(tsrm_resource_type));
    ...
    //3.创建互斥锁
    tsmm_mutex = tsrm_mutex_alloc();
}
```

(2).注册资源

```
//rsrc_id:资源ID，size:资源大小，ctor:构造函数，dtor:析构函数
TSRM_API ts_rsrc_id ts_allocate_id(ts_rsrc_id *rsrc_id, size_t size, ts_allocate_ctor ctor, ts_allocate_dtor dtor){
    //1.加锁，保证各线程串行调用此函数
    tsrm_mutex_lock(tsmm_mutex);
    //2.分配id，即id_count当前值，然后把id_count加1
    *rsrc_id = TSRM_SHUFFLE_RSRC_ID(id_count++);
    //3.检查resource_types_table数组当前大小是否已满
    if (resource_types_table_size < id_count) {
        //3.1需要对resource_types_table扩容
        resource_types_table = (tsrm_resource_type *) realloc(resource_types_table, sizeof(tsrm_resource_type)*id_count);
        ...
        //把数组大小修改新的大小
        resource_types_table_size = id_count;
    }
    //4.将新注册的资源插入resource_types_table数组，下标就是分配的资源id
    resource_types_table[TSRM_UNSHUFFLE_RSRC_ID(*rsrc_id)].size = size;
    resource_types_table[TSRM_UNSHUFFLE_RSRC_ID(*rsrc_id)].ctor = ctor;
    resource_types_table[TSRM_UNSHUFFLE_RSRC_ID(*rsrc_id)].dtor = dtor;
    resource_types_table[TSRM_UNSHUFFLE_RSRC_ID(*rsrc_id)].done = 0;
    //5.将新注册的资源空间分配给此时tsrm_tls_table中的各个线程storage
    for (i=0; i<tsrm_tls_table_size; i++) {
          tsrm_tls_entry *p = tsrm_tls_table[i];
          while (p) {
            if (p->count < id_count) {
                int j;
                p->storage = (void *) realloc(p->storage, sizeof(void *)*id_count);
                for (j=p->count; j<id_count; j++) {
                  p->storage[j] = (void *) malloc(resource_types_table[j].size);
                  if (resource_types_table[j].ctor) {
                    resource_types_table[j].ctor(p->storage[j]);
                  }
                }
                p->count = id_count;
            }
            p = p->next;
        }
    }
    //6.释放锁
    tsrm_mutex_unlock(tsmm_mutex);
    return *rsrc_id;
}
```

(3).获取资源

```
#define ts_resource(id)			ts_resource_ex(id, NULL)

TSRM_API void *ts_resource_ex(ts_rsrc_id id, THREAD_T *th_id){
    THREAD_T thread_id;
    int hash_value;
    tsrm_tls_entry *thread_resources;
    //1.获取线程ID
    if (!th_id) {
        //1.1.通过TLS(Thread Local Storage)获取当前线程tsrm_tls_entry
        thread_resources = tsrm_tls_get();
        if(thread_resources){
            //找到线程的tsrm_tls_entry直接返回对应的资源
            TSRM_SAFE_RETURN_RSRC(thread_resources->storage, id, thread_resources->count);
        }
        //1.2.通过pthread_self()获取当前线程ID
        thread_id = tsrm_thread_id();
    }else{
        thread_id = *th_id;
    }
    //2.加锁
    tsrm_mutex_lock(tsmm_mutex);
    //3.计算线程ID哈希(thread_id % tsrm_tls_table_size)
    hash_value = THREAD_HASH_OF(thread_id, tsrm_tls_table_size);
    //4.找到对应的链表头部
    thread_resources = tsrm_tls_table[hash_value];
    if (!thread_resources) {
        //4.1.当前线程第一次使用资源还未分配：先分配tsrm_tls_entry，再次调用ts_resource_ex()
        allocate_new_resource(&tsrm_tls_table[hash_value], thread_id);
        return ts_resource_ex(id, &thread_id);
    }else{
        //4.2.遍历查找当前线程的tsrm_tls_entry
        do {
            if (thread_resources->thread_id == thread_id) {
                break;
            }
            if (thread_resources->next) {
                thread_resources = thread_resources->next;
            } else {
                allocate_new_resource(&thread_resources->next, thread_id);
                return ts_resource_ex(id, &thread_id);
            }
        } while (thread_resources);
    }
    //5.解锁
    tsrm_mutex_unlock(tsmm_mutex);
    //6.返回资源
    TSRM_SAFE_RETURN_RSRC(thread_resources->storage, id, thread_resources->count);
}


static void allocate_new_resource(tsrm_tls_entry **thread_resources_ptr, THREAD_T thread_id){
    //1.分配新线程tsrm_tls_entry
    (*thread_resources_ptr) = (tsrm_tls_entry *) malloc(sizeof(tsrm_tls_entry));
    (*thread_resources_ptr)->storage = NULL;
    //2.根据已注册资源数分配storage数组大小
    if (id_count > 0) {
        (*thread_resources_ptr)->storage = (void **) malloc(sizeof(void *)*id_count);
    }
    (*thread_resources_ptr)->count = id_count;
    (*thread_resources_ptr)->thread_id = thread_id;
    //3.将当前线程的tsrm_tls_entry保存到TLS(Thread Local Storage)
    tsrm_tls_set(*thread_resources_ptr);
    //4.为全部资源分配空间
    for (i=0; i<id_count; i++) {
        ...
        (*thread_resources_ptr)->storage[i] = (void *) malloc(resource_types_table[i].size);
        ...
    }
    ...
}
```
