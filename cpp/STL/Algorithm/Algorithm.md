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

>1.for_each:遍历

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

>2.replace:替换函数

```
//范围内所有等于old_value者都一new_value取代
template <class ForwardIterator, class T>
void replace(Inputerator first, Inputerator last, const T & old_value, const T& new_value)
{
    for( ; first != last; ++first)
    {
        if(*first == old_value)
            *first = new_value;
    }
}

//范围内所有满足pred()为true之元素都以new_value取代
template <class Inputerator, class Inputerator, class T>
void replace_if(ForwardIterator first, ForwardIterator last, Predicate pred, const T& new_value)
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

>3.count:计数(map/set,unordered_set/map由于是关联式容器,有自己的count函数)

```
//满足要求值累计+1
template <class Inputerator, class Outputerator, class T>
typename iterator_traits<Inputerator>::difference_type;
count(Inputerator first, Inputerator last, const T& value)
{
    typename iterator_traits<Inputerator>::difference_type;
    for( ; first != last; ++first)
        if(*first == value)
            ++n;
    return n;
}

//满足指定要求条件累计+1
template <class Inputerator, class Outputerator, class Predicate>
typename iterator_traits<Inputerator>::difference_type;
count_if(Inputerator first, Inputerator last, Predicate pred)
{
    typename iterator_traits<Inputerator>::difference_type;
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
