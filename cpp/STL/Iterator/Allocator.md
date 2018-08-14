# Allocator


### 一.定义

函数|详情
--|--
allocator<int\> alloc|默认构造
allocator<int\> alloc1(alloc)|拷贝构造
allocator<int\> alloc1 = alloc|赋值拷贝

<br>

### 二.操作

函数|详情
--|--
alloc.allocate(1)|分配一个int空间,返回指针
alloc.deallocate(p,1)|销毁一个int空间

<br>

### 三.源码分析

>1.__malloc_alloc_template(第一级配置器,只是对系统的malloc,realloc,free函数的一个简单封装,并考虑到了分配失败后的异常处理)

```
template <int __inst> 
class __malloc_alloc_template {

};
```

>2.__default_alloc_template(第二级配置器,考虑了内存碎片的问题,维护一个自由链表利用内存池管理,链表每个节点大小为8字节)

```
template <bool threads, int inst> 
class __default_alloc_template {
    typedef __malloc_alloc_template malloc_alloc;

public:
    //分配内存
    static void* allocate(size_t __n){
        void* __ret = 0;
        //1.内存大于128时,采用第一级配置器处理
        if (__n > (size_t) _MAX_BYTES) {
            __ret = malloc_alloc::allocate(__n);
        } else {
        //2.内存小于等于128时,采用第二级配置器处理
            _Obj* __STL_VOLATILE* __my_free_list =  _S_free_list + _S_freelist_index(__n);
            _Obj* __RESTRICT __result = *__my_free_list;
            if (__result == 0) {
                __ret = _S_refill(_S_round_up(__n));
            } else {
                *__my_free_list = __result -> _M_free_list_link;
                __ret = __result;
            }
        }
        return __ret;
    }
    //释放内存
    static void deallocate(void* __p, size_t __n){
        //1.内存大于128时,采用第一级配置器处理
        if (__n > (size_t) _MAX_BYTES) {
            malloc_alloc::deallocate(__p, __n);
        } else {
        //2.内存小于等于128时,采用第二级配置器处理
            _Obj* __STL_VOLATILE*  __my_free_list = _S_free_list + _S_freelist_index(__n);
            _Obj* __q = (_Obj*)__p;
             __q -> _M_free_list_link = *__my_free_list;
            *__my_free_list = __q;
        }
    }
};
```

>3.内存池管理策略

```
1.内存池剩余空间完全满足20个区块的需求量,则直接获取对应大小的空间
2.内存池剩余空间不能完全满足20个区块的需求量,但是足够供应一个及以上的区块,则获取满足条件的区块个数的空间
3.内存池剩余空间不能满足一个区块的大小,则:
 a).首先判断内存池中是否有残余零头内存空间,如果有则进行回收,将其编入free_list
 b).然后向heap申请空间,补充内存池
 c).heap有足够的空间,空间分配成功
 d).heap空间不足,即malloc()调用失败.则
    查找free_list中尚有未用区块,调整以进行释放,将其编入内存池
    搜寻free_list释放空间也未能解决问题,这时候调用第一级配置器,利用out-of-memory机制尝试解决内存不足问题
```

>4.allocator(内存分配器)

```
template <class _Tp>
class allocator {
    typedef __default_alloc_template _Alloc;

public:
    //分配内存
    _Tp* allocate(size_type __n, const void* = 0){ 
        return __n != 0 ? static_cast<_Tp*>(_Alloc::allocate(__n * sizeof(_Tp))) : 0;
    }
    //释放内存
    void deallocate(pointer __p, size_type __n){ 
        _Alloc::deallocate(__p, __n * sizeof(_Tp)); 
    }
};
```
