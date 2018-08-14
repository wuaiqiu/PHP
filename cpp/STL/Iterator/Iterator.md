# Iterator

### 一.迭代器的种类

1.单向迭代器:只能以累加操作符向前迭代(forward_list,unordered_set/map,unordered_multiset/map)<br>
2.双向迭代器:可以以累加或累减操作符向前或向后迭代(list,set,map,multiset,multimap)<br>
3.随机访问迭代器:不但具有双向迭代器的所有属性，还允许迭代器算术运算(vector,deque,array)<br>
4.输入型迭代器:write-read迭代器<br>
5.输出型迭代器:read-only迭代器

![](../img/7.png)

```
struct input_iterator_tag{};
struct output_iterator_tag{};
struct forward_iterator_tag : public input_iterator_tag{};
struct bidirectional_iterator_tag : public forward_iterator_tag{};
struct random_access_iterator_tag : public bidirectional_iterator_tag{};

/*以下是五种迭代器类型数据类型*/
template <class _Tp, class _Distance> 
struct input_iterator {
  typedef input_iterator_tag iterator_category;
  typedef _Tp                value_type;
  typedef _Distance          difference_type;
  typedef _Tp*               pointer;
  typedef _Tp&               reference;
};

struct output_iterator {
  typedef output_iterator_tag iterator_category;
  typedef void                value_type;
  typedef void                difference_type;
  typedef void                pointer;
  typedef void                reference;
};

template <class _Tp, class _Distance> 
struct forward_iterator {
  typedef forward_iterator_tag iterator_category;
  typedef _Tp                  value_type;
  typedef _Distance            difference_type;
  typedef _Tp*                 pointer;
  typedef _Tp&                 reference;
};

template <class _Tp, class _Distance> 
struct bidirectional_iterator {
  typedef bidirectional_iterator_tag iterator_category;
  typedef _Tp                        value_type;
  typedef _Distance                  difference_type;
  typedef _Tp*                       pointer;
  typedef _Tp&                       reference;
};

template <class _Tp, class _Distance> 
struct random_access_iterator {
  typedef random_access_iterator_tag iterator_category;
  typedef _Tp                        value_type;
  typedef _Distance                  difference_type;
  typedef _Tp*                       pointer;
  typedef _Tp&                       reference;
};
```

<br>

### 二.操作

函数|详情
--|--
c.begin()|指向第一个元素的读写迭代器
c.end()|指向最后一个元素的下一个位置的读写迭代器
c.rbegin()|反向的第一个元素的读写迭代器
c.rend()|反向的第一个元素的上一个位置读写迭代器
c.cbegin()|指向第一个元素的只读迭代器
c.cend()|指向最后一个元素的下一个位置的只读迭代器
c.crbegin()|反向的第一个元素的只读迭代器
c.crend()|反向的第一个元素的上一个位置只读迭代器

<br>

### 三.源码分析

>1.迭代器萃取机

```
/*Traits技术，萃取出类型的相关信息*/
template<typename _Iterator>
struct iterator_traits {
      typedef typename _Iterator::iterator_category iterator_category;
      typedef typename _Iterator::value_type        value_type;
      typedef typename _Iterator::difference_type   difference_type;
      typedef typename _Iterator::pointer           pointer;
      typedef typename _Iterator::reference         reference;
};

/*针对原生指针Tp*生成的Traits偏特化版本*/
template<typename _Tp>
struct iterator_traits<_Tp*>{
      typedef random_access_iterator_tag iterator_category;
      typedef _Tp                         value_type;
      typedef ptrdiff_t                   difference_type;
      typedef _Tp*                        pointer;
      typedef _Tp&                        reference;
};

/*针对原生指针const Tp*生成的Traits偏特化版本*/
template<typename _Tp>
struct iterator_traits<const _Tp*>{
      typedef random_access_iterator_tag iterator_category;
      typedef _Tp                         value_type;
      typedef ptrdiff_t                   difference_type;
      typedef const _Tp*                  pointer;
      typedef const _Tp&                  reference;
};
```

>2.其他方法

```
/*求出迭代器的类型*/
template <class _Iter>
inline typename iterator_traits<_Iter>::iterator_category
__iterator_category(const _Iter&)
{
  typedef typename iterator_traits<_Iter>::iterator_category _Category;
  return _Category();
}

/*求出迭代器的distance_type*/
template <class _Iter>
inline typename iterator_traits<_Iter>::difference_type*
__distance_type(const _Iter&)
{
  return static_cast<typename iterator_traits<_Iter>::difference_type*>(0);
}

/*求出迭代器的value_type*/
template <class _Iter>
inline typename iterator_traits<_Iter>::value_type*
__value_type(const _Iter&)
{
  return static_cast<typename iterator_traits<_Iter>::value_type*>(0);
}

/*根据迭代器的类型标签求出迭代器类型*/
template <class _Iter>
inline typename iterator_traits<_Iter>::iterator_category
iterator_category(const _Iter& __i) { return __iterator_category(__i); }

template <class _Iter>
inline typename iterator_traits<_Iter>::difference_type*
distance_type(const _Iter& __i) { return __distance_type(__i); }

template <class _Iter>
inline typename iterator_traits<_Iter>::value_type*
value_type(const _Iter& __i) { return __value_type(__i); }
```

>4.distance实现(两迭代器的距离)

```
/*迭代器为input_iterator_tag的distance()函数版本*/
template <class _InputIterator, class _Distance>
inline void __distance(_InputIterator __first, _InputIterator __last,
                       _Distance& __n, input_iterator_tag)
{
  while (__first != __last) { ++__first; ++__n; }
}

/*迭代器为random_access_iterator_tag的distance()函数版本*/
template <class _RandomAccessIterator, class _Distance>
inline void __distance(_RandomAccessIterator __first, 
                       _RandomAccessIterator __last, 
                       _Distance& __n, random_access_iterator_tag)
{
  __STL_REQUIRES(_RandomAccessIterator, _RandomAccessIterator);
  __n += __last - __first;
}

/*对外接口的distance()函数*/
template <class _InputIterator, class _Distance>
inline void distance(_InputIterator __first, 
                     _InputIterator __last, _Distance& __n)
{
  __STL_REQUIRES(_InputIterator, _InputIterator);
  __distance(__first, __last, __n, iterator_category(__first));
}
```
