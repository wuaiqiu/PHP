# Deque

1.动态数组,随机访问,且每次扩张的原来的二倍,两边扩充<br>
2.可向头部与尾部添加或移除元素<br>
3.元素排列顺序与插入顺序有关

![](../../img/1.png)

### 一.定义

函数|详情
--|--
deque<int\> c|默认构造
deque<int\> c1(c)|拷贝构造
deque<int\> c1 = c|赋值拷贝
deque<int\> c (5,6)|指定元素个数与默认值
deque<int\> c = {1,2,3}|初始化

<br>

### 二.操作

函数|详情
--|--
c.push_front(0)|向头插入
c.push_back(6)|向尾插入
c.insert(c.begin()+3, 10)|其他位置插入
c.pop_front()|头弹出
c.pop_back()|尾弹出
c.erase(c.begin()+3)|移除其他位置元素
c.clear()|清空
c.front()|返回头元素
c.back()|返回尾元素
c.at(1) 或 c[1]|返回指定位置元素
c.size()|返回元素个数
c.empty()|判断容器是否为空

<br>

### 三.源码分析

>1.deque基本结构

![](../../img/3.png)

```
template<typename _Tp, typename _Ref, typename _Ptr>
struct _Deque_iterator{
    typedef random_access_iterator_tag iterator_category;
    typedef _Deque_iterator _Self;
    typedef _Tp value_type;
    typedef _Ptr pointer;
    typedef _Ref reference;
    typedef size_t size_type;
    typedef ptrdiff_t difference_type;
    typedef _Tp**_Map_pointer;
    
    _Tp* _M_cur; //指向当前元素
    _Tp* _M_first; //指向当前buffer内的第一个元素
    _Tp* _M_last; //指向当前buffer的最后一个元素
    _Tp** _M_node; //指向当前buffer的指针
    
    reference operator*() const  { return *_M_cur;}
    pointer operator->() const {return _M_cur;}
    //前缀自增++操作符重载
    _Self& operator++() {
       ++_M_cur;		//普通自增操作，移至下一个元素
       if (_M_cur == _M_last) {   //若已达到缓冲区的尾部
         _M_set_node(_M_node + 1);//切换至下一缓冲区(节点)
         _M_cur = _M_first;	  //下一缓冲区的第一个元素
       }
       return *this;
    }
   //后缀自增++操作符重载,返回当前迭代器的一个副本
   _Self operator++(int)  {
      _Self __tmp = *this;//定义当前迭代器的一个副本
       ++*this;//上一步骤已经重载过的前缀++
       return __tmp;
    }
    //前缀自减--操作符重载
    _Self& operator--() {
      if (_M_cur == _M_first) {  //若是当前缓冲区的第一个元素
        _M_set_node(_M_node - 1);//切换到上一个缓冲区
        _M_cur = _M_last;	//上一个缓冲区的尾部
       }
       --_M_cur;//普通的自减操作，移至前一个元素
       return *this;
    }
    //后缀自减--操作符重载
    _Self operator--(int) {
       _Self __tmp = *this;//定义一个副本
       --*this;		 //迭代器自减操作
       return __tmp;
    }
    //切换到正确的元素位置
   void _M_set_node(_Map_pointer __new_node) {
     _M_node = __new_node;//指向新的节点
     _M_first = *__new_node;//指向新节点的头部
     _M_last = _M_first + difference_type(_S_buffer_size());//指向新节点的尾部
  }
}

template<typename _Tp, typename _Alloc>
class _Deque_base{
protected:
    _Tp** _M_map; //表示内存的指针的连续内存
    size_t _M_map_size; //表示_M_map的内存大小
    iterator _M_start;//表示_M_map指向内存起始点的迭代器
    iterator _M_finish;//表示_M_map指向内存结束点的迭代器
}

//deque容器的定义,配置器默认为第二级配置器
template <class _Tp, class _Alloc = __STL_DEFAULT_ALLOCATOR(_Tp) >
class deque : protected _Deque_base<_Tp, _Alloc> {
public:            
  typedef typename _Base::iterator       iterator;
  typedef typename _Base::const_iterator const_iterator;

protected:
  using _Base::_M_map;//指向中控器map
  using _Base::_M_map_size;//map内指针的个数
  using _Base::_M_start;//指向第一个节点
  using _Base::_M_finish;//指向最后一个节点
};
```

>2.成员函数

```
//在容器尾部加数据
void push_back(const value_type& __t) {
   //若当前缓冲区存在可用空间
   if (_M_finish._M_cur != _M_finish._M_last - 1) {
      construct(_M_finish._M_cur, __t);//直接构造对象
      ++_M_finish._M_cur;//调整指针所指位置
    }
    else//若当前缓冲区不存在可用空间,需分配一段新的连续空间
      _M_push_back_aux(__t);
}

//在容器首部加数据
void push_front(const value_type& __t) {
    if (_M_start._M_cur != _M_start._M_first) {
      construct(_M_start._M_cur - 1, __t);
      --_M_start._M_cur;
    }
    else
      _M_push_front_aux(__t);
}

//尾部弹出 
void pop_back() {
    if (_M_finish._M_cur != _M_finish._M_first) {
      --_M_finish._M_cur;
      destroy(_M_finish._M_cur);
    }
    else
      _M_pop_back_aux();
}

//首部弹出
void pop_front() {
    if (_M_start._M_cur != _M_start._M_last - 1) {
      destroy(_M_start._M_cur);
      ++_M_start._M_cur;
    }
    else 
      _M_pop_front_aux();
}

//指定位置插入
iterator insert(iterator position, const value_type& __x) {
    if (position._M_cur == _M_start._M_cur) {//若当前位置为deque.begin()
      push_front(__x);//则在容器头部插入数据
      return _M_start;
    }
    else if (position._M_cur == _M_finish._M_cur) {//若当前位置为deque.end()
      push_back(__x);
      iterator __tmp = _M_finish;
      --__tmp;
      return __tmp;
    }
    else {//否则在容器直接插入数据
      return _M_insert_aux(position, __x);
    }
}

//指定位置删除 
iterator erase(iterator __pos) {
    iterator __next = __pos;
    ++__next;
    difference_type __index = __pos - _M_start;//擦除点之前元素个数
    if (size_type(__index) < (this->size() >> 1)) {//若擦除点之前的元素个数较少
      copy_backward(_M_start, __pos, __next);//向后移动擦除点之前的元素
      pop_front();
    }
    else {
      copy(__next, _M_finish, __pos);//否则，向前移动擦除点之后的元素
      pop_back();
    }
    return _M_start + __index;
}
```
