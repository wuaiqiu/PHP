# Array

1.固定数组，随机访问<br>
2.元素排列顺序与插入顺序有关

### 一.定义

函数|详情
--|--
array<int,3\> arr|默认构造
array<int,3\> arr1(arr)|拷贝构造
array<int,3\> arr1 = arr|赋值拷贝
array<int,3\> arr = {1,2}|初始化

<br>

### 二.操作

函数|详情
--|--
arr.front()|返回头元素
arr.back()|返回尾元素
arr[3] 或 arr.at(3)|返回指定位置元素
arr.size()|返回容器个数
arr.empty()|判断容器是否为空

<br>

### 三.源码分析

>1.[]与at区别

```
template<typename _Tp, size_t _Nm>
struct __array_traits{
    typedef _Tp _Type[_Nm];

    static constexpr _Tp& _S_ref(const _Type& __t, size_t __n) noexcept
    { return const_cast<_Tp&>(__t[__n]); }
}

typedef __array_traits<_Tp, _Nm> _AT_Type;

//直接返回
reference operator[](size_type __n) noexcept
{ return _AT_Type::_S_ref(_M_elems, __n); }

//先检查，在返回
reference at(size_type __n){
	if (__n >= _Nm)
	  __throw_out_of_range_fmt(__N("array::at: __n (which is %zu) >= _Nm (which is %zu)"),__n, _Nm);
	return _AT_Type::_S_ref(_M_elems, __n);
}
```
