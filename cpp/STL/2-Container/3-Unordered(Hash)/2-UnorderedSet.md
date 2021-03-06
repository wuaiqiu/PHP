# UnorderedSet(UnorderedMultiset)

1.无序集合，底层HashTable<br>
2.有查找和删除，添加的优点<br>
3.unordered_set每个元素只能出现一次,unordered_multiset每个元素可以出现多次<br>
4.无法使用迭代器改变unordered_set/multiset改变元素值

![](../../img/17.png)

### 一.定义

函数|详情
--|--
unordered_set<int\> c1|默认构造
unordered_set<int\> c2(c1)|拷贝构造
unordered_set<int\> c2 = c1|赋值构造
unordered_set<int\> c2 = {{1,2},{3,4}}|初始化

<br>

### 二.操作

函数|详情
--|--
c1.insert(1)|插入
c1.emplace(10)|构造并插入
c1.erase(1)|删除
c1.clear()|清空
c1.size()|获取元素个数
c1.empty()|判断容器是否为空
c1.count(1)|返回给定元素的个数
c1.swap(c2)|c1与c2交换
c1.find(2)|返回元素为2的迭代器


```cpp
unordered_set<int> set = {2,1,3,4};
cout<<"set.count(1):"<<set.count(1)<<endl; //1
cout<<"set.empty():"<<set.empty()<<endl; //0
cout<<"set.find(2):"<<*(set.find(2))<<endl; //2
```

<br>

### 三.源码分析

>1.unordered_set结构

```cpp
template<class _Value,
	class _Hash = hash<_Value>,
	class _Pred = std::equal_to<_Value>,
	class _Alloc = std::allocator<_Value> >
class unordered_set{
  //底层是基于hash table的
  typedef hashtable<_Value,_Value, _Hash, _Identity<_Value>, _Pred, _Alloc>  _Hashtable;
  _Hashtable _M_ht;

public:
  //指针/引用迭代器全为只读
  typedef typename _Hashtable::const_pointer		pointer;
  typedef typename _Hashtable::const_pointer	const_pointer;
  typedef typename _Hashtable::const_reference		reference;
  typedef typename _Hashtable::const_reference	const_reference;
  typedef typename _Hashtable::iterator		iterator;
  typedef typename _Hashtable::const_iterator	const_iterator;
};     
```

>2.unordered_set成员函数

```cpp
//返回元素个数
size_type size() const { return _M_ht.size(); }

//判读是否为空
bool empty() const { return _M_ht.empty(); }

//不允许有重复的键值,返回pair第二个参数second若为true则插入成功
pair<iterator, bool> insert(const value_type& __obj){
   pair<typename _Ht::iterator, bool> __p = _M_ht.insert_unique(__obj);
   return pair<iterator,bool>(__p.first, __p.second);
}
    
//返回键值为key的节点元素个数
size_type count(const key_type& __key) const { return _M_ht.count(__key); }
  
//擦除指定键值的元素
size_type erase(const key_type& __key) {return _M_ht.erase(__key); }
```

>3.unordered_multiset成员函数

```cpp
//插入元素
iterator insert(const value_type& __obj){ return _M_ht.insert_equal(__obj); }
```
