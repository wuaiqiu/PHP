# List

1.双向链表，顺序访问
2.任何位置插入或移除元素快
3.元素排列顺序与插入顺序有关

![](../../img/4.png)

### 一.定义

函数|详情
--|--
list<int\> l|默认构造
list<int\> l1(l)|拷贝构造
list<int\> l1 = l|拷贝赋值
list<int\> l3(5,2)|指定元素个数及与默认值
list<int\> l4(l1.begin(),l1.end())|指定赋值区域

<br>

### 二.操作

函数|详情
--|--
l.push_front(1)|在起始端增加元素
l.push_back(1)|在末尾增加一个元素
l.insert(l.begin(),2)|在指定位置插入元素
l.insert(l.begin(),5,1)|在指定位置插入5个1
l.insert(l.begin(),l.begin(),l.end())|在指定位置插入区间
l.pop_front()|删除第一个元素
l.pop_back()|删除末尾的元素
l.erase(l.begin())|删除指定下标位置的元素
l.clear()|清空list
l.front()|返回第一个元素
l.back()返回最后一个元素
l.empty()|判断是否为空
l.size()|返回元素个数
l.max_size()|返回list最大容量
l.unique()|去重
l.reverse()|反转链表
l.sort()|将链表排序，默认升序

<br>

### 三.源码分析

>1.list结构

![](../../img/6.png)

```
struct _List_node_base{
    _List_node_base* _M_next; //指向下一个节点
    _List_node_base* _M_prev; //指向前一个节点
}

struct _List_node : public _List_node_base{
    _Tp _M_data; //节点数据
    _Tp* _M_valptr() {
      return std::__addressof(_M_data);
    }
    _Tp const* _M_valptr() const {
      return std::__addressof(_M_data);
    }
};
```

![](../../img/5.png)

```
//空白节点为头节点
iterator begin() _GLIBCXX_NOEXCEPT {
  return iterator(this->_M_impl._M_node._M_next);
}

iterator end() _GLIBCXX_NOEXCEPT {
  return iterator(this->_M_impl._M_node);
}

//其他操作
reference operator*() const {
    return (*node).data;
}

pointer operator->() const {
    return &(operator*());
}

_Self& operator++() {
    node = (link_type)((*node).next);
	  return *this;
}

_Self operator++(int) {
	self __tmp = *this;
	++*this;
	return __tmp;
}
```
