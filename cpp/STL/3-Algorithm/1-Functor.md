# Functor

1.仿函数只为算法服务<br>
2.声明一个类,重载它的operator()<br>
3.只有继承自binary_function(两个参数)或者unary_function(一个参数),声明的仿函数才可以融入STL<br>

### 一.仿函数类别

>1.算数类

```
//加法操作
template <class _Tp>
struct plus : public binary_function<_Tp,_Tp,_Tp> {
  _Tp operator()(const _Tp& __x, const _Tp& __y) const { return __x + __y; }
};

//减法操作
template <class _Tp>
struct minus : public binary_function<_Tp,_Tp,_Tp> {
  _Tp operator()(const _Tp& __x, const _Tp& __y) const { return __x - __y; }
};

//乘法操作
template <class _Tp>
struct multiplies : public binary_function<_Tp,_Tp,_Tp> {
  _Tp operator()(const _Tp& __x, const _Tp& __y) const { return __x * __y; }
};

//除法操作
template <class _Tp>
struct divides : public binary_function<_Tp,_Tp,_Tp> {
  _Tp operator()(const _Tp& __x, const _Tp& __y) const { return __x / __y; }
};

//取模运算
template <class _Tp>
struct modulus : public binary_function<_Tp,_Tp,_Tp>
{
  _Tp operator()(const _Tp& __x, const _Tp& __y) const { return __x % __y; }
};
```

>2.逻辑运算类

```
//与
template <class _Tp>
struct logical_and : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x && __y; }
};

//或
template <class _Tp>
struct logical_or : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x || __y; }
};

//非
template <class _Tp>
struct logical_not : public unary_function<_Tp,bool>
{
  bool operator()(const _Tp& __x) const { return !__x; }
};
```

>3.相对关系类

```
//等于
template <class _Tp>
struct equal_to : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x == __y; }
};

//不等于
template <class _Tp>
struct not_equal_to : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x != __y; }
};

//大于
template <class _Tp>
struct greater : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x > __y; }
};

//小于
template <class _Tp>
struct less : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x < __y; }
};

//大于等于
template <class _Tp>
struct greater_equal : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x >= __y; }
};

//小于等于
template <class _Tp>
struct less_equal : public binary_function<_Tp,_Tp,bool>
{
  bool operator()(const _Tp& __x, const _Tp& __y) const { return __x <= __y; }
};
```

>4.其他

```
//证同函数
template <class _Tp>
struct _Identity : public unary_function<_Tp,_Tp> {
  const _Tp& operator()(const _Tp& __x) const { return __x; }
};
template <class _Tp> struct identity : public _Identity<_Tp> {};

//1.选择函数:选择pair元素的第一个参数，忽略第二个参数
template <class _Pair>
struct _Select1st : public unary_function<_Pair, typename _Pair::first_type> {
  const typename _Pair::first_type& operator()(const _Pair& __x) const {
    return __x.first;
  }
};
template <class _Pair> struct select1st : public _Select1st<_Pair> {};
//2.选择函数:选择pair元素的第二个参数，忽略第一个参数
template <class _Pair>
struct _Select2nd : public unary_function<_Pair, typename _Pair::second_type>
{
  const typename _Pair::second_type& operator()(const _Pair& __x) const {
    return __x.second;
  }
};
template <class _Pair> struct select2nd : public _Select2nd<_Pair> {};

//1.投射函数:投射出第一个参数，忽略第二个参数
template <class _Arg1, class _Arg2>
struct _Project1st : public binary_function<_Arg1, _Arg2, _Arg1> {
  _Arg1 operator()(const _Arg1& __x, const _Arg2&) const { return __x; }
};
template <class _Arg1, class _Arg2> struct project1st : public _Project1st<_Arg1, _Arg2> {};
//2.投射函数:投射出第二个参数，忽略第一个参数
template <class _Arg1, class _Arg2>
struct _Project2nd : public binary_function<_Arg1, _Arg2, _Arg2> {
  _Arg2 operator()(const _Arg1&, const _Arg2& __y) const { return __y; }
};
template <class _Arg1, class _Arg2> struct project2nd : public _Project2nd<_Arg1, _Arg2> {};
```

<br>

### 二.源码分析

>这两个父类可能在某些算法中的仿函数适配器会用到，所以需要继承这两个类

```
template<typename _Arg1, typename _Arg2, typename _Result>
struct binary_function
{
    typedef _Arg1     first_argument_type;
    typedef _Arg2     second_argument_type;
    typedef _Result     result_type;
};

template<typename _Arg, typename _Result>
struct unary_function
{
     typedef _Arg     argument_type;
     typedef _Result     result_type;  
};
```
