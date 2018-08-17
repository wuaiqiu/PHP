# GFunction

### 1.操作

函数|详情
--|--
uninitialized_copy(a,b,c)|将a与b之间的数据复制到c
uninitialized_fill(a,b,c)|将c填充a与b区间
uninitalized_fiil_n(a,n,c)|将c填充a后面n个区间 


### 2.源码分析

```
//a.将__first与__last之间的数据复制到__result
template <class _InputIter, class _ForwardIter>
inline _ForwardIter uninitialized_copy(_InputIter __first, _InputIter __last,
                     _ForwardIter __result) {
  return __uninitialized_copy(__first, __last, __result,
                              __VALUE_TYPE(__result));
}
//利用__type_traits判断该型别是否为POD型别
template <class _InputIter, class _ForwardIter, class _Tp>
inline _ForwardIter __uninitialized_copy(_InputIter __first, _InputIter __last,
                     _ForwardIter __result, _Tp*) {
  typedef typename __type_traits<_Tp>::is_POD_type _Is_POD;
  return __uninitialized_copy_aux(__first, __last, __result, _Is_POD());
}
//若不是POD型别
template <class _InputIter, class _ForwardIter>
_ForwardIter  __uninitialized_copy_aux(_InputIter __first, _InputIter __last,
                         _ForwardIter __result, __false_type) {
  _ForwardIter __cur = __result;
  //这里加入了异常处理机制
  __STL_TRY {
    for ( ; __first != __last; ++__first, ++__cur)
      _Construct(&*__cur, *__first);//构造对象
    return __cur;
  }
  //析构对象
  __STL_UNWIND(_Destroy(__result, __cur));
}
//若是POD型别(基本数据类型、指针、union、数组)
template <class _InputIter, class _ForwardIter>
inline _ForwardIter __uninitialized_copy_aux(_InputIter __first, _InputIter __last,
                         _ForwardIter __result, __true_type) {
	return copy(__first, __last, __result);
}
//copy算法
template<class InputIterator, class OutputIterator>
OutputIterator copy (InputIterator first, InputIterator last, OutputIterator result) {
  while (first!=last) {
    *result = *first;
    ++result; ++first;
  }
  return result;
}



//b.将__first与__last之间用__x填充
template <class _ForwardIter, class _Tp>
inline void uninitialized_fill(_ForwardIter __first,_ForwardIter __last, 
                               const _Tp& __x) {
  __uninitialized_fill(__first, __last, __x, __VALUE_TYPE(__first));
}
//用__type_traits技术判断该型别是否为POD型别
template <class _ForwardIter, class _Tp, class _Tp1>
inline void __uninitialized_fill(_ForwardIter __first, _ForwardIter __last, 
                                const _Tp& __x, _Tp1*){
  typedef typename __type_traits<_Tp1>::is_POD_type _Is_POD;
  __uninitialized_fill_aux(__first, __last, __x, _Is_POD());               
}
//若不是POD型别
template <class _ForwardIter, class _Tp>
void __uninitialized_fill_aux(_ForwardIter __first, _ForwardIter __last, 
                         const _Tp& __x, __false_type) {
  _ForwardIter __cur = __first;
  __STL_TRY {
    for ( ; __cur != __last; ++__cur)
      _Construct(&*__cur, __x);
  }
  __STL_UNWIND(_Destroy(__first, __cur));
}
//若是POD型别
template <class _ForwardIter, class _Tp>
inline void __uninitialized_fill_aux(_ForwardIter __first, _ForwardIter __last, 
                         const _Tp& __x, __true_type) {
	fill(__first, __last, __x);
}
//fill算法
template <class ForwardIterator, class T>
void fill (ForwardIterator first, ForwardIterator last, const T& val){
  while (first != last) {
    *first = val;
    ++first;
  }
}



//c.将__first后n个空间用__x填充
template <class _ForwardIter, class _Size, class _Tp>
inline _ForwardIter uninitialized_fill_n(_ForwardIter __first, _Size __n, const _Tp& __x) {
	return __uninitialized_fill_n(__first, __n, __x, __VALUE_TYPE(__first));
}
//用__type_traits技术判断该型别是否为POD型别
template <class _ForwardIter, class _Size, class _Tp, class _Tp1>
inline _ForwardIter __uninitialized_fill_n(_ForwardIter __first, _Size __n, const _Tp& __x, _Tp1*) {
  typedef typename __type_traits<_Tp1>::is_POD_type _Is_POD;
  return __uninitialized_fill_n_aux(__first, __n, __x, _Is_POD());
}
//若不是POD型别
template <class _ForwardIter, class _Size, class _Tp>
_ForwardIter __uninitialized_fill_n_aux(_ForwardIter __first, _Size __n,
                            const _Tp& __x, __false_type) {
  _ForwardIter __cur = __first;
  __STL_TRY {
    for ( ; __n > 0; --__n, ++__cur)
      _Construct(&*__cur, __x);
    return __cur;
  }
  __STL_UNWIND(_Destroy(__first, __cur));
}
//若是POD型别
template <class _ForwardIter, class _Size, class _Tp>
inline _ForwardIter __uninitialized_fill_n_aux(_ForwardIter __first, _Size __n,
                           const _Tp& __x, __true_type) {
	return fill_n(__first, __n, __x);
}
//fill_n算法
template <class OutputIterator, class Size, class T>
OutputIterator fill_n (OutputIterator first, Size n, const T& val) {
  while (n>0) {
    *first = val;
    ++first; --n;
  }
  return first;
}
```
