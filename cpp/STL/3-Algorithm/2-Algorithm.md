# Algorithm

## 一.算法基本结构

```cpp
template<typename Iterator>
Algorithm(Iterator itr,Iterator itr2)
{
    ....
}
```

```cpp
template<typename Iterator,typename Cmp>
Algorithm(Iterator itr,Iterator itr2,Cmp comp)
{
    ....
}
```

<br>

## 二.操作

### a.非修改序列操作

函数|详情
--|--
all_of(it.begin(),it.end(),functor)|如果序列中所有元素均满足给定的条件，则返回true
any_of(it.begin(),it.end(),functor)|如果序列中存在元素满足给定的条件，则返回true
none_of(it.begin(),it.end(),functor)|如果序列中所有元素均不满足给定的条件，则返回true
for_each(it.begin(),it.end(),functor)|将指定函数应用于范围内的每一个元素
find(it.begin(),it.end(),value)|在序列中返回满足第一个等于给定值的元素迭代器
find_if(it.begin(),it.end(),functor)|在序列中返回满足给定的条件的第一个元素迭代器
find_if_not(it.begin(),it.end(),functor)|在序列中返回不满足给定的条件的第一个元素迭代器
count(it.begin(),it.end(),value)|返回序列中等于给定值元素的个数
count_if(it.begin(),it.end(),functor)|返回序列中满足给定条件的元素的个数
equal(it.begin(),it.end(),it2.begin())|比较两个序列的对应元素是否相等
search(it1.begin(),it1.end(),it2.begin(),it2.end())|在序列A中，搜索B首次出现的位置的迭代器
search_n(it.begin(),it.end(),n,value)|在给定序列中，搜索给定值连续出现n次的位置迭代器


>1.for_each遍历函数

```cpp
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

```cpp
template <typename T>
struct functor : public unary_function<T,void>
{
	void operator()(const T &a) const{
		 cout<<a<<endl
	}
};

vector<int> arr = {1,2,3};
for_each(arr.begin(),arr.end(),functor<int>());
```

>2.count计数函数(map/set,unordered_set/map由于是关联式容器,有自己的count函数)

```cpp
//满足要求值累计+1
template <class Inputerator,class T>
typename iterator_traits<InputIterator>::difference_type 
count(Inputerator first, Inputerator last, const T& value)
{
    typename iterator_traits<InputIterator>::difference_type n = 0;
    for( ; first != last; ++first)
        if(*first == value)
            ++n;
    return n;
}

//满足指定要求条件累计+1
template <class Inputerator,  class Predicate>
typename iterator_traits<InputIterator>::difference_type
count_if(Inputerator first, Inputerator last, Predicate pred)
{
   typename iterator_traits<InputIterator>::difference_type n = 0;
    for( ; first != last; ++first)
        if(pred(*first))
            ++n;
    return n;
}
```

```cpp
template <typename T>
struct functor : public unary_function<T,bool>
{
   bool operator()(const T &a) const{
   if( a == 2 )
       return true;
    else
       return false;
   }
};

vector<int> arr = {1,2,3,2};
count(arr.begin(),arr.end(),2);
count_if(arr.begin(),arr.end(),functor<int>());
```

>3.find查找函数

```cpp
//返回第一个值为val的迭代器
template<class InputIterator, class T>
InputIterator find (InputIterator first, InputIterator last, const T& val){
  while (first!=last) {
    if (*first==val) return first;
    ++first;
  }
  return last;
}

//返回第一个值满足pred仿函数的迭代器
template<class InputIterator, class UnaryPredicate>
InputIterator find_if (InputIterator first, InputIterator last, UnaryPredicate pred){
  while (first!=last) {
    if (pred(*first)) return first;
    ++first;
  }
  return last;
}
```

```cpp
template <class T>
struct functor : public unary_function <T,bool>{
    bool operator()(const T& a){
      if(a == 2)
	return true;
      else 
	return false;
      }
};

vector<int> arr = {1,2,3};
auto a=find(arr.begin(),arr.end(),2);
auto b=find_if(arr.begin(),arr.end(),functor<int>());
cout<<*a<<"  "<<*b<<endl;
```

<br>

### b.修改序列操作

函数|详情
--|--
copy(it1.begin(),it1.end(),it2.begin())|将一个序列中的元素拷贝到新的位置
copy_n(it1.begin(),n,it2.begin())|将一个序列中的前n个元素拷贝到新的位置
copy_if(it1.begin(),it1.end(),it2.begin(),functor)|将一个序列中满足给定条件的元素拷贝到新的位置
copy_backward(it1.begin(),it1.end(),it2.begin())|把一个序列复制到另一个序列，按照由尾到头顺序依次复制元素
move(it1.begin(),it1.end(),it2.begin())|把输入序列中的逐个元素移动到结果序列
move_backward(it1.begin(),it1.end(),it2.begin())|把输入序列中的逐个元素自尾到头移动到结果序列
swap(obj1,obj2)|交换两个对象，优先使用移动语义
swap_ranges(it1.begin(),it1.end(),it2.begin())|交换两个对象，优先使用移动语义
iter_swap(it1,it2)|交换两个迭代器指向的元素
replace(it.begin(),it.end(),oldValue,newValue)|把序列中等于给定值的元素替换为新值
replace_if(it.begin(),it.end(),functor,newValue)|把序列中满足给定条件的元素替换为新值
replace_copy(it1.begin(),it1.end(),it2.begin(),oldValue,newValue)|拷贝序列，对于等于老值的元素复制时使用新值
replace_copy_if(it1.begin(),it1.end(),it2.begin(),functor,newValue)|拷贝序列，对于满足给定条件的元素复制时使用新值
fill(it.begin(),it.end(),value)|用给定值填充序列中的每个元素
fill_n(it.begin(),n,value)|用给定值填充序列中的n个元素
generate(it.begin(),it.end(),functor)|对序列中的每个元素，用依次调用函数gen的返回值赋值
generate_n(it.begin(),n,functor)|对序列中的n个元素，用依次调用指定函数gen的返回值赋值
remove(it.begin(),it.end(),value)|删除序列中等于给定值的所有元素
remove_if(it.begin(),it.end(),functor)|删除序列中满足给定条件的元素
remove_copy(it1.begin(),it1.end(),it2.begin(),value)|把一个序列中不等于给定值的元素复制到另一个序列中
remove_copy_if(it1.begin(),it1.end(),it2.begin(),functor)|把一个序列中不满足给定条件的元素复制到另一个序列中
unique(it.begin(),it.end())|去重
unique_copy(it1.begin(),it1.end(),it2.begin())|把一个序列中的元素拷贝到另一个序列并去重
reverse(it.begin(),it.end())|把序列中的元素逆序
reverse_copy(it1.begin(),it1.end(),it2.begin())|拷贝序列的逆序到另一个序列中
random_shuffle(it.begin(),it.end())|随机打乱指定范围中的元素的位置
merge(it1.begin(),it1.end(),it2.begin(),it2.end(),it3.begin())|合并已排序的序列


>1.replace替换函数

```cpp
//范围内所有等于old_value者都一new_value取代
template <class ForwardIterator, class T>
void replace(ForwardIterator first, ForwardIterator last, const T & old_value, const T& new_value)
{
    for( ; first != last; ++first)
    {
        if(*first == old_value)
            *first = new_value;
    }
}

//范围内所有满足pred()为true之元素都以new_value取代
template <class Inputerator, class Predicate, class T>
void replace_if(Inputerator first, Inputerator last, Predicate pred, const T& new_value)
{
    for( ; first != last; ++first)
    {
        if(pred(*first))
            *first = new_value;
    }
}
```

```cpp
template <typename T>
struct functor : public unary_function<T,bool>
{
    bool operator()(const T &a) const{
    if( a == 2 )
       return true;
    else
       return false;
    }
};

vector<int> arr = {1,2,3};
replace(arr.begin(),arr.end(),2,4);
replace_if(arr.begin(),arr.end(),functor<int>(),4);
```

>2.copy复制函数

```cpp
//将first与last之间的数据复制到result
template<class InputIterator, class OutputIterator>
OutputIterator copy (InputIterator first, InputIterator last, OutputIterator result)
{
  while (first!=last) {
    *result = *first;
    ++result; ++first;
  }
  return result;
}

//将first与last之间满足result条件的数据复制到result
template <class InputIterator, class OutputIterator, class UnaryPredicate>
OutputIterator copy_if (InputIterator first, InputIterator last,OutputIterator result, UnaryPredicate pred)
{
  while (first!=last) {
    if (pred(*first)) {
      *result = *first;
      ++result;
    }
    ++first;
  }
  return result;
}
```

```cpp
template <class T>
struct functor : public unary_function <T,bool>{
    bool operator()(const T& a){
	if(a % 2)
	    return true;
	else 
	    return false;
    }
};

vector<int> arr = {1,2,3,4};
vector<int> ret1(4);
vector<int> ret2(4);
copy(arr.begin(),arr.end(),ret1.begin());
copy_if(arr.begin(),arr.end(),ret2.begin(),functor<int>());
```

>3.remove移除函数

```cpp
//将值为val的元素移除(利用移动)
template <class ForwardIterator, class T>
ForwardIterator remove (ForwardIterator first, ForwardIterator last, const T& val){
  ForwardIterator result = first;
  while (first!=last) {
    if (!(*first == val)) {
      *result = *first;
      ++result;
    }
    ++first;
  }
  return result;
}

//将值val满足pred条件的元素移除(利用移动)
template <class ForwardIterator, class UnaryPredicate>
ForwardIterator remove_if (ForwardIterator first, ForwardIterator last,UnaryPredicate pred){
  ForwardIterator result = first;
  while (first!=last) {
    if (!pred(*first)) {
      *result = *first;
      ++result;
    }
    ++first;
  }
  return result;
}
```

```cpp
template <class T>
struct functor : public unary_function <T,bool>{
    bool operator()(const T& a){
	if(a == 2)
	    return true;
	 else 
	    return false;
    }
};
	
vector<int> arr = {1,2,3,4};
remove(arr.begin(),arr.end(),2);
remove_if(arr.begin(),arr.end(),functor<int>());
```

<br>

### c.最大/最小值

函数|详情
--|--
min(value1,value2)|返回两个值中的最小值
max(value1,value2)|返回两个值中的最大值
min_element(it.begin(),it.end())|返回序列中的最小值迭代器
max_element(it.begin(),it.end())|返回序列中的最大值迭代器


```cpp
vector<int> arr={5,1,6,9,4,3};
cout<<"min_element:"<<*min_element(arr.begin(),arr.end())<<endl; //min_element:1
cout<<"max_element:"<<*max_element(arr.begin(),arr.end())<<endl; //max_element:9
cout<<"min:"<<min(1,2)<<endl; //min:1
cout<<"max:"<<max(1,2)<<endl; //max:2
```

<br>

### d.分区

函数|详情
--|--
is_partitioned(it.begin(),it.end(),functor)|判断序列是否按指定条件划分过
partition(it.begin(),it.end(),functor)|对序列重排，使得满足条件的元素位于最前
stable_partition(it.begin(),it.end(),functor)|对序列稳定重排，使得满足条件的元素位于最前
partition_copy(it1.begin(),it1.end(),it2.begin(),it3.begin(),functor)|输入序列中，满足条件的元素复制到result_true，其它元素复制到result_false
partition_point(it.begin(),it.end(),functor)|输入序列已经是partition，折半查找到分界点迭代器


```cpp
vector<int> arr={5,1,6,9,4,3};
auto pos = partition(arr.begin(),arr.end(),[](int i){return (i%2)==1;});
for(auto it=arr.begin();it!=pos;it++)
    cout<<*it<<" "; //5 1 3 9 
cout<<endl;
for(auto it=pos;it!=arr.end();it++)
    cout<<*it<<" "; //4 6
```

<br>

### e.排序

函数|详情
--|--
sort(it.begin(),it.end())|对序列进行排序
stable_sort(it.begin(),it.end())|对序列进行稳定排序
is_sorted(it.begin(),it.end())|判断序列是否为升序


```cpp
vector<int> arr={5,1,6,9,4,3};
sort(arr.begin(),arr.end());
for(auto i:arr)cout<<i<<" "; //1 3 4 5 6 9
cout<<endl;
random_shuffle(arr.begin(),arr.end());
for(auto i:arr)cout<<i<<" "; //6 5 3 4 1 9
cout<<endl;
stable_sort(arr.begin(),arr.end());
for(auto i:arr)cout<<i<<" "; //1 3 4 5 6 9
```

<br>

### f.二分查找

函数|详情
--|--
lower_bound(it.begin(),it.end(),value)|在升序的序列中，查找第一个不小于给定值的元素
upper_bound(it.begin(),it.end(),value)|在已排序的序列中，查找第一个大于给定值的元素
binary_search(it.begin(),it.end(),value)|对一个升序序列做二分搜索，判断序列中是否有与给定值相等的元素


```cpp
vector<int> arr={5,1,6,9,4,3};
sort(arr.begin(),arr.end());
auto low=lower_bound(arr.begin(),arr.end(),4);
auto up =upper_bound(arr.begin(),arr.end(),4);
auto binary=binary_search(arr.begin(),arr.end(),4);
cout<<"low="<<*low<<endl; //low=4
cout<<"up="<<*up<<endl; //up=5
cout<<"binary="<<binary<<endl; //binary=1
```

<br>

### g.堆操作(大顶堆)

函数|详情
--|--
is_heap(it.begin(),it.end())|判断序列是否为二叉堆
make_heap(it.begin(),it.end())|对于一个序列，构造一个二叉堆
pop_heap(it.begin(),it.end())|堆的根节点被移除(根元素在最后)
push_heap(it.begin(),it.end())|向堆中增加新元素(新元素在最后)
sort_heap(it.begin(),it.end())|堆排序，升序(排序后数组则非堆)


```cpp
vector<int> arr={5,1,6,9,4,3};
make_heap(arr.begin(),arr.end());
for(auto i:arr)cout<<i<<" "; //9 5 6 1 4 3
cout<<endl;
pop_heap(arr.begin(),arr.end());
arr.pop_back();
for(auto i:arr)cout<<i<<" "; //6 5 3 1 4
cout<<endl;
arr.push_back(8);
push_heap (arr.begin(),arr.end());
for(auto i:arr)cout<<i<<" "; //8 5 6 1 4 3
cout<<endl;
sort_heap (arr.begin(),arr.end());
for(auto i:arr)cout<<i<<" "; //1 3 4 5 6 8
```