# Algorithm

### 一.算法基本结构

```
template<typename Iterator>
Algorithm(Iterator itr,Iterator itr2)
{
    ....
}
```

```
template<typename Iterator,typename Cmp>
Algorithm(Iterator itr,Iterator itr2,Cmp comp)
{
    ....
}
```

<br>

### 二.源码分析

>1.accumulate:累加,将指定区域内的value累加起来

```
//默认累加算法
template<typename _InputIterator, typename _Tp>
inline _Tp  accumulate(_InputIterator __first, _InputIterator __last, _Tp __init)
{
    for (; __first != __last; ++__first)
        __init = __init + *__first;
    return __init;
}

//自定义累加算法
template<typename _InputIterator, typename _Tp, typename _BinaryOperation>
inline _Tp  accumulate(_InputIterator __first, _InputIterator __last, _Tp __init,
           _BinaryOperation __binary_op)
{
      for (; __first != __last; ++__first)
          __init = __binary_op(__init, *__first);
      return __init;
}
```

>2.for_each:遍历

```
template <class Inputerator, class Function>
Function for_each(Inputerator first, Inputerator last, Function f)
{
    for( ; first != last; ++first)
    {
        f(*first);
    }
    return f;
}
```

>3.replace:替换函数

```
//范围内所有等于old_value者都一new_value取代
template <class ForwardIterator, class T>
void replace(Inputerator first, Inputerator last, const T & old_value, const T& new_value)
{
    for( ; first != last; ++first)
    {
        if(*first == old_value)
            *first = new_value;
    }
}

//范围内所有满足pred()为true之元素都以new_value取代
template <class Inputerator, class Inputerator, class T>
void replace_if(ForwardIterator first, ForwardIterator last, Predicate pred, const T& new_value)
{
    for( ; first != last; ++first)
    {
        if(pred(*first))
            *first = new_value;
    }
}

//范围内所有等于old_value者都以new_value放置新区域
template <class Inputerator, class Outputerator, class T>
Outputerator replace_copy(ForwardIterator first, ForwardIterator last, Outputerator result, const T & old_value, const T& new_value)
{
    for( ; first != last; ++first, ++result)
    {
        *result = *first == old_value ? new_value : *first;
    }
}
```

>4.count:计数(map/set,unordered_set/map由于是关联式容器,有自己的count函数)

```
//满足要求值累计+1
template <class Inputerator, class Outputerator, class T>
typename iterator_traits<Inputerator>::difference_type;
count(Inputerator first, Inputerator last, const T& value)
{
    typename iterator_traits<Inputerator>::difference_type;
    for( ; first != last; ++first)
        if(*first == value)
            ++n;
    return n;
}

//满足指定要求条件累计+1
template <class Inputerator, class Outputerator, class Predicate>
typename iterator_traits<Inputerator>::difference_type;
count_if(Inputerator first, Inputerator last, Predicate pred)
{
    typename iterator_traits<Inputerator>::difference_type;
    for( ; first != last; ++first)
        if(pred(*first))
            ++n;
    return n;
}
```

>5.find:查找(map/set,unordered_set/map由于是关联式容器,有自己的find函数)

```
//指定值查询
template <class Inputerator, class T>
Inputerator find_if(Inputerator first, Inputerator last,  const T& value)
{
    while(first != last && *first != value)
        ++first;
    return first;
}

//条件查询
template <class Inputerator, class Predicate>
Inputerator find_if(Inputerator first, Inputerator last, Predicate pred)
{
    while(first != last && !pred(*first))
        ++first;
    return first;
}
```

>6.binary_search:查看元素是否在指定区间内

```
template <class Inputerator, class T>
bool binary_search(Inputerator first, Inputerator last, const T& val)
{
    first = std::lower_bound(first,last,val);
    return (first != last && !(val < *first));
}
```

>7.sort:排序(list和forward_list有成员sort函数,set/map自动排序)

```
//自然排序
template<typename _RandomAccessIterator>
inline void sort(_RandomAccessIterator __first, _RandomAccessIterator __last)
{
    std::__sort(__first, __last, __gnu_cxx::__ops::__iter_less_iter());
}

//条件排序
template<typename _RandomAccessIterator, typename _Compare>
inline void sort(_RandomAccessIterator __first, _RandomAccessIterator __last,_Compare __comp)
{
    std::__sort(__first, __last, __gnu_cxx::__ops::__iter_comp_iter(__comp));
}
```
