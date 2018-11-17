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
arr.data()|返回数组指针
arr.fill(n)|以元素n填充arr数组
arr1.swap(arr2)|arr1与arr2交换


```cpp
array<int,5> arr = {1,2,3,4};
cout<<"arr.front():"<<arr.front()<<endl; //1
cout<<"arr.back():"<<arr.back()<<endl; //0
cout<<"arr.at(5):"<<arr.at(2)<<endl; //3
cout<<"arr.size():"<<arr.size()<<endl; //5
cout<<"arr.empty():"<<arr.empty()<<endl; //0
cout<<"arr.data():"<<arr.data()<<endl; //0x7fff223829b0
```

<br>

### 三.源码分析

>1.成员函数

```cpp
//获取元素，直接返回
reference operator[](size_type __n) noexcept { return _AT_Type::_S_ref(_M_elems, __n); }

//获取元素，安全返回
reference at(size_type __n){
    if (__n >= _Nm)
	std::__throw_out_of_range_fmt(__N("array::at: __n (which is %zu) "
			">= _Nm (which is %zu)"), __n, _Nm);
	return _AT_Type::_S_ref(_M_elems, __n);
}
```