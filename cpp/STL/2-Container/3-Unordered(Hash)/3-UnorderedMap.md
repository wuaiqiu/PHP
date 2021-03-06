# UnorderedMap(UnorderedMultimap)

1.无序集合，底层HashTable<br>
2.有查找和删除，添加的优点<br>
3.unordered_map每个元素key只能出现一次,unordered_multimap每个元素key可以出现多次<br>
4.无法使用迭代器改变unordered_set/multiset改变key值

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
c1.erase(6)|删除key
c1.clear()|清空
c1.size()|获取元素个数
c1.empty()|判断容器是否为空
c1[6] 或 c1.at(6)|返回指定key元素
c1.count(1)|元素key出现个数
c1.swap(c2)|c1与c2交换
c1.find(2)|返回key为2的迭代器


```cpp
unordered_map<int,char> map = {{1,'a'},{2,'b'},{3,'c'}};
cout<<"map.count(1):"<<map.count(1)<<endl; //1
cout<<"map.empty():"<<map.empty()<<endl; //0
cout<<"map.find(2):"<<map.find(2)->second<<endl; //b
```

<br>

### 三.源码分析

>1.unordered_map结构

```cpp
template<class _Key, class _Tp,
	   class _Hash = hash<_Key>,
	   class _Pred = std::equal_to<_Key>,
	   class _Alloc = std::allocator<std::pair<const _Key, _Tp> > >
class unordered_map{
      typedef hashtable<pair<const _Key,_Tp>, _Key, _Hash,
      	   _Select1st<pair<const _Key,_Tp>>,_Pred, _Alloc>  _Hashtable;
      _Hashtable _M_ht;

    public:
      //指针/引用迭代器保持原样
      typedef typename _Hashtable::pointer		pointer;
      typedef typename _Hashtable::const_pointer	const_pointer;
      typedef typename _Hashtable::reference		reference;
      typedef typename _Hashtable::const_reference	const_reference;
      typedef typename _Hashtable::iterator		iterator;
      typedef typename _Hashtable::const_iterator	const_iterator;
};
```

>2.ordered_map成员函数

```cpp
//返回 hash_map 容器中元素的个数.
size_type size() const { return _M_ht.size(); }
  
//不允许有重复的键值,返回pair第二个参数second若为true则插入成功
pair<iterator,bool> insert(const value_type& __obj){ return _M_ht.insert_unique(__obj); }
    
//由于不存在重复的键值,所以返回的个数最多为1个
size_type count(const key_type& __key) const { return _M_ht.count(__key); }

//因为键值唯一,则该键值的元素最多为1个
size_type erase(const key_type& __key) {return _M_ht.erase(__key); }  
```

>3.ordered_multimap成员函数

```cpp
//插入元素
iterator insert(const value_type& __obj) { return _M_ht.insert_equal(__obj); }
```
