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

>1.array结构

```
template<typename _Tp, std::size_t _Nm>
struct array
{
   typedef _Tp 	    			      value_type;
   typedef value_type*			      pointer;
   typedef const value_type*                  const_pointer;
   typedef value_type&                        reference;
   typedef const value_type&                  const_reference;
   typedef value_type*          	      iterator; //迭代器为普通指针
   typedef const value_type*		      const_iterator;
   typedef std::size_t                        size_type;
   typedef std::ptrdiff_t                      difference_type;
   typedef std::reverse_iterator<iterator>	      reverse_iterator;
   typedef std::reverse_iterator<const_iterator>   const_reverse_iterator;
};
```

>2.成员函数

```
//数组大小
constexpr size_type size() const noexcept { return _Nm; }

//判断数组是否为空
constexpr bool empty() const noexcept { return size() == 0; }

//获取元素
reference operator[](size_type __n) noexcept { return _AT_Type::_S_ref(_M_elems, __n); }
reference at(size_type __n){
    if (__n >= _Nm)
	std::__throw_out_of_range_fmt(__N("array::at: __n (which is %zu) "
			">= _Nm (which is %zu)"), __n, _Nm);
	return _AT_Type::_S_ref(_M_elems, __n);
}

//返回首部元素
reference front() noexcept { return *begin(); }

//返回尾部元素
reference back() noexcept { return _Nm ? *(end() - 1) : *end(); }
```
