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
alloc.allocate(2)|分配一个int空间,返回指针
alloc.construct(p,1)|初始化int对象
alloc.destory(p)|销毁int对象
alloc.deallocate(p,2)|销毁一个int空间


```cpp
allocator<int> allocator;
int* p=allocator.allocate(2);
allocator.construct(p,1);
allocator.construct(p+1,2);
cout<<"1+2="<<(*p+*(p+1))<<endl; //1+2=3
allocator.destroy(p);
allocator.destroy(p+1);
allocator.deallocate(p,2);
p=nullptr;
```

<br>

### 三.源码分析

>1.__malloc_alloc_template(第一级配置器,只是对系统的malloc,realloc,free函数的一个简单封装,并考虑到了分配失败后的异常处理)

```cpp
template <int __inst> 
class __malloc_alloc_template {

};
```

>2.__default_alloc_template(第二级配置器,allocator默认配置器,考虑了内存碎片的问题,维护一个自由链表(含有16个节点,每个节点大小为8byte,每个节点下默认含有20个相同大小的区块),链表每个节点下的区块大小分别为8byte，16byte...128byte，自由链表中所有的区块存于预分配的内存池中。

```cpp
template <bool threads, int inst> 
class __default_alloc_template {
    typedef __malloc_alloc_template malloc_alloc;

public:
    //分配内存
    static void* allocate(size_t __n){
        void* __ret = 0;
        //1.内存大于128byte时,采用第一级配置器处理
        if (__n > (size_t) _MAX_BYTES) {
            __ret = malloc_alloc::allocate(__n);
        } else {
        //2.内存小于等于128byte时,采用第二级配置器处理
            if (__result == 0) {
                //2.1若自由链表下的节点区块用完时，向内存池中获取
                __ret = _S_refill(_S_round_up(__n));
            } else {
                //2.2若自由链表下的节点区块未用完时，返回区块节点
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
        }
    }
};
```

>3.内存池管理策略(_S_refill的实现)

```
1.内存池剩余空间完全满足20个区块的需求量,则直接获取对应大小的空间，链接到相应的自由链表中,结束分配
2.内存池剩余空间不能完全满足20个区块的需求量,但是足够供应一个及以上的区块,则获取满足条件的区块个数，链接到相应的自由链表中，结束分配
3.内存池剩余空间不能满足一个区块的大小,则:
 a).判断内存池中是否有残余零头区块,如果有则进行回收，转向1
 b).向系统内存申请空间且成功,补充内存池，转向1
 d).查找自由链表中尚有未用区块,调整以进行释放,将其编入内存池，转向1
 e).报错
```