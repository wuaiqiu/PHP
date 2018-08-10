# Adapter

### 一.Stack

1.默认底层是Deque<br>
2.运用的就是包含，包装Deque<br>
3.先进后出

```
template<typename _Tp, typename _Sequence = deque<_Tp> >
class stack{
  protected:
    _Sequence c;
  public:
    bool empty() const {
      return c.empty();
    }  
    size_type size() const {
      return c.size();
    }  
    reference top() {
      return c.back();
    }  
    void push(const value_type& x) {
      c.push_back(x);
    }  
    void pop() {
      c.pop_back();
    }
}
```

<br>

### 二.Queue

1.默认底层是Deque<br>
2.运用的就是包含，包装Deque<br>
3.先进先出

```
template<typename _Tp, typename _Sequence = deque<_Tp> >
class queue{
  protected:
    _Sequence c;
　public:
    bool empty() const {
      return c.empty();
    }  
    size_type size() const {
      return c.size();
    }  
    reference front() {
      return c.front();
    }
    reference back() {
      return c.back();
    }   
    void push(const value_type& x) {
      c.push_back(x);
    }  
    void pop() {
      c.pop_front();
    }
}
```

<br>

### 三.注意点

```
1.stack与queue都不允许遍历，也不提供iterator
2.stack和queue都可以选择list或deque作为底层结构
3.stack可以选择vector作为底层结构
4.stack和queue都不可以选择set或map作为底层结构
```
