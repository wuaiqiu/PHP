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

#### a.非修改序列操作

>1.for_each遍历函数

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

```
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

```
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

```
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

```
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

```
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

#### b.修改序列操作

>1.replace替换函数

```
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

```
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

```
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

```
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

```
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

```
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

#### c.最大/最小值

>1.返回区间最大值/最小值

```
//返回first与last之间的最小值
template <class ForwardIterator>
ForwardIterator min_element ( ForwardIterator first, ForwardIterator last ){
  if (first==last) return last;
  ForwardIterator smallest = first;

  while (++first!=last)
    if (*first<*smallest)
      smallest=first;
  return smallest;
}

//返回first与last之间的最大值
template <class ForwardIterator>
ForwardIterator max_element ( ForwardIterator first, ForwardIterator last ){
  if (first==last) return last;
  ForwardIterator largest = first;

  while (++first!=last)
    if (*largest<*first)
      largest=first;
  return largest;
}
```

```
vector<int> arr = {1,2,3};
min_element(arr.beign(),arr.end());
max_element(arr.beign(),arr.end());
```

>2.返回两元素最大值/最小值

```
//返回最大值
template <class T> ]
const T& max (const T& a, const T& b) {
  return (a<b)?b:a;
}

//返回最小值
template <class T> 
const T& min (const T& a, const T& b) {
  return !(b<a)?a:b; 
}
```
