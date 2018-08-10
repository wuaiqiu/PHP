# Forward List

1.单向链表，顺序访问<br>
2.只能从头部插入元素<br>
3.元素排列顺序与插入顺序有关<br>
4.比Deque所需空间小

![](../../img/11.png)

### 一.定义

函数|详情
--|--
forward_list<int> l|默认构造
forward_list<int> l1(l)|拷贝构造
forward_list<int> l1 = l|赋值拷贝
forward_list<int> l(5,2)|指定大小与默认值
forward_list<int> l = {1,2,3}|初始化

<br>

### 二.操作

函数|详情
--|--
l.push_front(0)|向头插入
l.insert_after(l.begin(), 0)|其他位置插入(只能++)
l.pop_front()|头弹出
l.erase_after(l.begin())|移除其他位置元素
l.clear()|清空
l.front()|返回头元素
l.empty()|判断容器是否为空
l.unique()|去重
l.reverse()|反转
l.sort()|排序

<br>

### 三.源码分析

![](../../img/12.png)

```
struct _Fwd_list_node_base{
    _Fwd_list_node_base* _M_next = nullptr; //指向下一个节点
}

template<typename _Tp, typename _Alloc>
struct _Fwd_list_base{
    protected:
      struct _Fwd_list_impl : public _Node_alloc_type {
	       _Fwd_list_node_base _M_head; //指向头结点(蓝色元素)
      }
}
```

![](../../img/13.png)
