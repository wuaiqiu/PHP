# HashTable

1.在插入、删除和搜素操作都能达到常数平均时间<br>
2.采用了拉链法来解决冲突问题


>1.hashtable结构

```cpp
//hashtable中链表的节点结构,类似于单链表的节点结构
template <class _Val>
struct _Hashtable_node {
  _Hashtable_node* _M_next;//指向下一节点
  _Val _M_val;//节点元素值
};

//定义28个素数用作hashtable的buckets大小 
enum { __stl_num_primes = 28 };
//28个素数集合
static const unsigned long __stl_prime_list[__stl_num_primes] =
{
  53ul,         97ul,         193ul,       389ul,       769ul,
  1543ul,       3079ul,       6151ul,      12289ul,     24593ul,
  49157ul,      98317ul,      196613ul,    393241ul,    786433ul,
  1572869ul,    3145739ul,    6291469ul,   12582917ul,  25165843ul,
  50331653ul,   100663319ul,  201326611ul, 402653189ul, 805306457ul, 
  1610612741ul, 3221225473ul, 4294967291ul
};
//返回大于n的最小素数
inline unsigned long __stl_next_prime(unsigned long __n)
{
  const unsigned long* __first = __stl_prime_list;
  const unsigned long* __last = __stl_prime_list + (int)__stl_num_primes;
  //返回__frist与__last之间第一个不小于__n的位置
  const unsigned long* pos = lower_bound(__first, __last, __n);
  return pos == __last ? *(__last - 1) : *pos;
}


//hashtable的定义
/* 
 *Value:节点的实值类型 
 *Key:节点的键值类型 
 *HashFcn:hash function的类型 
 *ExtractKey:从节点中取出键值的方法(函数或仿函数) 
 *EqualKey:判断键值是否相同的方法(函数或仿函数，比较为<：true，>=：false) 
 *Alloc:空间配置器
 **/ 
template <class _Val, class _Key, class _HashFcn,
          class _ExtractKey, class _EqualKey, class _Alloc>
class hashtable {
public:
  typedef _Key key_type;
  typedef _Val value_type;
  typedef _HashFcn hasher;
  typedef _EqualKey key_equal;

//以下是hash table的成员变量
private:
  hasher                _M_hash;
  key_equal             _M_equals;
  _ExtractKey           _M_get_key;
  vector<_Node*,_Alloc> _M_buckets;//用vector维护buckets
  size_type             _M_num_elements;//hashtable中节点个数
};
```

>2.hashtable成员函数

```cpp
//返回hashtable元素的个数
size_type size() const { return _M_num_elements; }

//判断是否为空
bool empty() const { return size() == 0; }

//插入元素节点,不允许存在重复元素
pair<iterator, bool> insert_unique(const value_type& __obj)
{
    //判断容量是否够用, 否则就重新配置 
	resize(_M_num_elements + 1);
	//插入元素,不允许存在重复元素
    return insert_unique_noresize(__obj);
}


//插入元素，不需要重新调整内存空间,不允许存在重复元素
pair<iterator, bool>  insert_unique_noresize(const value_type& __obj)
{
  //获取待插入元素在hashtable中的桶子位置
  const size_type __n = _M_bkt_num(__obj);
  _Node* __first = _M_buckets[__n];

  //判断hashtable中是否存在与之相等的键值元素，若存在则不插入
  for (_Node* __cur = __first; __cur; __cur = __cur->_M_next) 
    if (_M_equals(_M_get_key(__cur->_M_val), _M_get_key(__obj)))
      return pair<iterator, bool>(iterator(__cur, this), false);
  //把元素插入到第一个节点位置
  _Node* __tmp = _M_new_node(__obj);
  __tmp->_M_next = __first;
  _M_buckets[__n] = __tmp;
  ++_M_num_elements;
  return pair<iterator, bool>(iterator(__tmp, this), true);
}

//插入元素节点,允许存在重复元素
iterator insert_equal(const value_type& __obj)
{
    //判断容量是否够用, 否则就重新配置
    resize(_M_num_elements + 1);
	//插入元素,允许存在重复元素
    return insert_equal_noresize(__obj);
}

//插入元素,允许重复,不需要分配新的空间
iterator insert_equal_noresize(const value_type& __obj)
{
   //获取待插入元素在hashtable中的桶子位置
   const size_type __n = _M_bkt_num(__obj);
   _Node* __first = _M_buckets[__n];

   for (_Node* __cur = __first; __cur; __cur = __cur->_M_next) 
	  //若存在键值相同的元素，则插在相同元素下一个位置
    if (_M_equals(_M_get_key(__cur->_M_val), _M_get_key(__obj))) {
      _Node* __tmp = _M_new_node(__obj);//创建新节点
      __tmp->_M_next = __cur->_M_next;//将新节点插在当前节点之后
      __cur->_M_next = __tmp;
      ++_M_num_elements;//节点数加1
      return iterator(__tmp, this);//返回指向新增节点迭代器
    }
	//若不存在相同键值的元素,则插在第一个位置
  _Node* __tmp = _M_new_node(__obj);//创建新节点
  __tmp->_M_next = __first;//插入在链表表头
  _M_buckets[__n] = __tmp;
  ++_M_num_elements;//节点数加1
  return iterator(__tmp, this);//返回指向新增节点的迭代器
}

//返回键值为key的元素的个数
size_type count(const key_type& __key) const
{
    //获取key在桶子的位置
    const size_type __n = _M_bkt_num_key(__key);
    size_type __result = 0;
    for (const _Node* __cur = _M_buckets[__n]; __cur; __cur = __cur->_M_next)
      if (_M_equals(_M_get_key(__cur->_M_val), __key))
        ++__result;
    return __result;
}

//删除元素
size_type erase(const key_type& __key)
{
  const size_type __n = _M_bkt_num_key(__key);
  _Node* __first = _M_buckets[__n];
  size_type __erased = 0;

  if (__first) {
    _Node* __cur = __first;
    _Node* __next = __cur->_M_next;
    while (__next) {
      if (_M_equals(_M_get_key(__next->_M_val), __key)) {
        __cur->_M_next = __next->_M_next;
        _M_delete_node(__next);
        __next = __cur->_M_next;
        ++__erased;
        --_M_num_elements;
      }
      else {
        __cur = __next;
        __next = __cur->_M_next;
      }
    }
    if (_M_equals(_M_get_key(__first->_M_val), __key)) {
      _M_buckets[__n] = __first->_M_next;
      _M_delete_node(__first);
      ++__erased;
      --_M_num_elements;
    }
  }
  return __erased;
}
```
