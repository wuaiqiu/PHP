# Functor

1.仿函数只为算法服务
2.声明一个类,重载它的operator()
3.只有继承自binary_function(两个参数)或者unary_function(一个参数),声明的仿函数才可以融入STL

### 一.仿函数类别

>1.算数类

```
template<typename _Tp>
struct plus : public binary_function<_Tp, _Tp, _Tp>
{
  _Tp operator()(const _Tp& __x, const _Tp& __y) const
  {
    return __x + __y;
  }
};
```

>2.逻辑运算类

```
template<typename _Tp>
struct logical_and : public binary_function<_Tp, _Tp, bool>
{
  bool  operator()(const _Tp& __x, const _Tp& __y) const
  {
    return __x && __y;
  }
};
```

>3.相对关系类

```
template<typename _Tp>
struct equal_to : public binary_function<_Tp, _Tp, bool>
{
  bool  operator()(const _Tp& __x, const _Tp& __y) const
  {
    return __x == __y;
  }
};
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
