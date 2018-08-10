# UnorderedMap(UnorderedMultimap)

1.无序集合，底层HashTable<br>
2.有查找和删除，添加的优点<br>
3.unordered_map每个元素key只能出现一次,unordered_multimap每个元素key可以出现多次<br>
4.空白格是map中的key与value的数据包

![](../../img/17.png)

### 一.定义

函数|详情
--|--
unordered_map<int,int\> c1|默认构造
unordered_map<int,int\> c2(c1)|拷贝构造
unordered_map<int,int\> c2 = c1|赋值构造
unordered_map<int,int\> c2 = {{1,2},{3,4}}|初始化

<br>

### 二.操作

函数|详情
--|--
c1.insert({6,15})|插入
c1.erase(6)|删除
c1.clear()|清空
c1.size()|获取元素个数
c1.empty()|判断容器是否为空
c1[6] 或 c1.at(6)|返回指定位置元素
c1.count(1)|元素key出现个数

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
