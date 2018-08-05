# UnorderedMap(UnorderedMultimap)

1.无序集合，底层HashTable
2.有查找和删除，添加的优点
3.unordered_map每个元素key只能出现一次,unordered_multimap每个元素key可以出现多次
4.空白格是map中的key与value的数据包

![](../../img/17.png)

### 一.定义

函数|详情
--|--
unordered_map<int,int\> c1|默认构造
unordered_map<int,int\> c2 = c1|赋值构造

<br>

### 二.操作

函数|详情
--|--
c1.insert(pair<int, int>(6, 15))|插入函数
c1.emplace(pair<int, int>(6, 15))|如果不存在元素则插入,如果存在则什么也不做
c1.erase(6)|删除
c1.clear()|清空
c1.empty()|判断是否为空
c1.size()|获取元素个数
c1.max_size()|获取最大存储量
c1.find(6)|通过给定key查找元素,返回迭代器
c1.count(1)|返回匹配给定key元素的个数
c1.bucket_count()|返回槽数
c1.max_bucket_count()|返回最大槽数
c1.bucket_size(3)|返回指定槽大小
c1.bucket(pair<int, int>(6, 15))|返回元素所在槽的序号

<br>

### 三.源码分析

```
template<typename _Key, typename _Tp,typename _Hash = hash<_Key>,typename _Pred = equal_to<_Key>,typename _Alloc = allocator<std::pair<const _Key, _Tp>>>
class unordered_map{
      private:
        typedef __umap_hashtable<_Key, _Tp, _Hash, _Pred, _Alloc>  _Hashtable;
        //哈希表(key值,key和value的数据包,获取hashcode的函数,判断key大小函数,分配器)
        _Hashtable _M_h;
      public:
        //读写迭代器
        typedef typename _Hashtable::iterator		iterator;
        //unordered_map插入数据
        std::pair<iterator, bool> insert(const value_type& __x){
            return _M_h.insert(__x);
        }
        //unordered_multimap插入数据
        iterator insert(const value_type& __x){
            return _M_h.insert(__x);
        }
}
```
