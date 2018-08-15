# Vector

1.动态数组，随机访问,且每次扩张的原来的二倍<br>
2.尾部添加或移除元素快，其他位置插入或移除元素慢<br>
3.元素排列顺序与插入顺序有关

![](../../img/8.png)

<br>

### 一.定义

函数|详情
--|--
vector<int\> v|默认构造
vector<int\> v1(v)|拷贝构造
vector<int\> v1 = v|赋值拷贝
vector<int\> v(5,10)|指定元素个数及默认值
vector<int\> v = {1,2,3}|初始化

<br>

### 二.操作

函数|详情
--|--
v.push_back(1)|向尾插入
v.insert(v.begin(),3)|其他位置插入
v.pop_back()|尾弹出
v.erase(v.begin()+1)|移除其他位置元素
v.clear()|清空
v.front()|返回头元素
v.back()|返回尾元素
v[1] 或 v.at(1)|返回指定位置元素
v.size()|返回元素个数
v.empty()|判断容器是否为空

<br>

### 三.源码分析

>1.vector结构

![](../../img/10.png)

```
//Alloc是STL的空间配置器,默认是第二级配置器
template <class _Tp, class _Alloc = __STL_DEFAULT_ALLOCATOR(_Tp)>
class vector : protected _Vector_base<_Tp, _Alloc> 
{
protected:
  _Tp* _M_start;//表示目前使用空间的头
  _Tp* _M_finish;//表示目前使用空间的尾
  _Tp* _M_end_of_storage;//表示目前可用空间的尾  
 
public:
  typedef _Tp value_type;
  typedef value_type* pointer;
  typedef const value_type* const_pointer;
  typedef value_type* iterator;//vector容器的迭代器是普通指针
  typedef const value_type* const_iterator;
  
  //指向已使用空间头的迭代器
  iterator begin() { return _M_start; }
  const_iterator begin() const { return _M_start; }
  //指向已使用空间尾的迭代器
  iterator end() { return _M_finish; }
  const_iterator end() const { return _M_finish; }
};
```

>2.成员函数

```
//已使用空间大小
size_type size() const { return size_type(end() - begin());}

//判断容器是否为空
bool empty() const { return begin() == end(); }

//返回指定位置的元素
reference operator[](size_type __n) { return *(begin() + __n); }
const_reference operator[](size_type __n) const { return *(begin() + __n); }

//访问指定元素，并且进行越界检查
reference at(size_type __n){ _M_range_check(__n); return (*this)[__n]; }
const_reference at(size_type __n) const{ _M_range_check(__n); return (*this)[__n]; }
void _M_range_check(size_type __n) const {
    if (__n >= this->size())
      __stl_throw_range_error("vector");
}

//返回第一个元素
reference front() { return *begin(); }
const_reference front() const { return *begin(); }

//返回容器最后一个元素
reference back() { return *(end() - 1); }
const_reference back() const { return *(end() - 1); }

//在最尾端插入元素
void push_back(const _Tp& __x) {
    if (_M_finish != _M_end_of_storage) {//若有可用的内存空间
      construct(_M_finish, __x);//构造对象
      ++_M_finish;
    }
    else//若没有可用的内存空间,调用以下函数，把x插入到指定位置
      _M_insert_aux(end(), __x);
}

//取出最尾端元素
void pop_back() {
   --_M_finish;
   destroy(_M_finish);//析构对象
}

//清空容器
void clear() { erase(begin(), end()); }

//擦除两个迭代器区间的元素
iterator erase(iterator __first, iterator __last) {
    iterator __i = copy(__last, _M_finish, __first);//将__last与_M_finish之间的数据移至__first
    destroy(__i, _M_finish);//析构对象
    _M_finish = _M_finish - (__last - __first);//调整finish的所指的位置
    return __first;
}
```
