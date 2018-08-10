# Array

1.固定数组，随机访问<br>
2.元素排列顺序与插入顺序有关

### 一.定义

函数|详情
--|--
array<int,3\> arr|默认构造
array<int,3\> arr = {1,2}|局部初始化
array<int,3\> arr = {1,2,3}|完全初始化
array<int,3\> arr1 = arr|赋值拷贝

<br>

### 二.操作

函数|详情
--|--
arr.size() 或 arr.max_size()|返回容器最大元素个数
arr.empty()|容器是否为空
arr[3] 或 arr.at(3)|返回下标为3的元素
arr.front()|返回第一个元素
arr.back()|返回最后一个元素

<br>

### 三.源码分析

>1.[]与at区别

```
//直接返回
reference operator[](size_type _n) noexecpt{
   return _AT_Type::S_ref(_M_elems,_n);
}

//先检查，在返回
reference at(size_type _n){
   if(_n >= _Nm)
      std::_throw_out_of_range_fmt(...);
    return _AT_Type::S_ref(_M_elems,_n);   
}
```
