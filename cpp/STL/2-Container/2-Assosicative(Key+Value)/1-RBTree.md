# RB-Tree


>1.RB-Tree结构

```cpp
typedef bool _Rb_tree_Color_type;//节点颜色类型，非红即黑
const _Rb_tree_Color_type _S_rb_tree_red = false;//红色为0
const _Rb_tree_Color_type _S_rb_tree_black = true;//黑色为1

//RB-Tree节点基本结构
struct _Rb_tree_node_base
{
  typedef _Rb_tree_Color_type _Color_type;//节点颜色类型
  typedef _Rb_tree_node_base* _Base_ptr;//基本节点指针

  _Color_type _M_color; //节点颜色
  _Base_ptr _M_parent;//指向父节点
  _Base_ptr _M_left;//指向左孩子节点
  _Base_ptr _M_right;//指向右孩子节点
};

//RB-Tree节点结构
template <class _Value>
struct _Rb_tree_node : public _Rb_tree_node_base
{
  typedef _Rb_tree_node<_Value>* _Link_type;//节点指针
  _Value _M_value_field;//节点数据域
};

//RB-Tree的迭代器iterator基本结构
struct _Rb_tree_base_iterator
{
  typedef _Rb_tree_node_base::_Base_ptr _Base_ptr;//节点指针
  typedef bidirectional_iterator_tag iterator_category;//迭代器类型
  typedef ptrdiff_t difference_type;
  _Base_ptr _M_node;//节点指针
};

//RB-Tree的迭代器iterator结构
template <class _Value, class _Ref, class _Ptr>
struct _Rb_tree_iterator : public _Rb_tree_base_iterator
{
  //迭代器的内嵌类型
  typedef _Value value_type;
  typedef _Ref reference;
  typedef _Ptr pointer;
  typedef _Rb_tree_iterator<_Value, _Value&, _Value*>    iterator;
  typedef _Rb_tree_iterator<_Value, const _Value&, const _Value*> const_iterator;
  typedef _Rb_tree_iterator<_Value, _Ref, _Ptr>      _Self;
  typedef _Rb_tree_node<_Value>* _Link_type;//节点指针
};

//RB-Tree基本结构
template <class _Tp, class _Alloc>
struct _Rb_tree_base
{
protected:
  _Rb_tree_node<_Tp>* _M_header;//定义头指针节点，指向根节点
};


//RB-Tree类的定义
/* 
 *Key:节点的键值类型 
 *Value:节点的实值类型  
 *KeyOfValue:从节点中取出键值的方法(函数或仿函数) 
 *Compare:判断键值是否相同的方法(函数或仿函数) 
 *Alloc:空间配置器
 **/ 
template <class _Key, class _Value, class _KeyOfValue, class _Compare,
          class _Alloc = __STL_DEFAULT_ALLOCATOR(_Value) >
class _Rb_tree : protected _Rb_tree_base<_Value, _Alloc> {
  typedef _Rb_tree_base<_Value, _Alloc> _Base;
protected:
  typedef _Rb_tree_node_base* _Base_ptr;
  typedef _Rb_tree_node<_Value> _Rb_tree_node;
  typedef _Rb_tree_Color_type _Color_type;
  size_type _M_node_count; //节点数目
  _Compare _M_key_compare;	//节点键值比较准则
public:
  typedef _Key key_type;
  typedef _Value value_type;
  typedef value_type* pointer;
  typedef const value_type* const_pointer;
  typedef value_type& reference;
  typedef const value_type& const_reference;
  typedef _Rb_tree_node* _Link_type;
  typedef size_t size_type;
  typedef ptrdiff_t difference_type;
};
```

>2.成员函数

```cpp
//RB-Tree是否为空
bool empty() const { return _M_node_count == 0; }

//RB-Tree节点数
size_type size() const { return _M_node_count; }

//插值,节点键值不允许重复,若重复则安插无效
pair<iterator, bool> insert_unique(const _Value& __v)
{
   _Link_type __y = _M_header;
  _Link_type __x = _M_root();//从根节点开始
  bool __comp = true;
  while (__x != 0) {//从根节点开始,往下寻找合适插入点
    __y = __x;
	//判断新插入节点值与当前节点x值的大小,以便判断往x的左边走还是往右边走
    __comp = _M_key_compare(_KeyOfValue()(__v), _S_key(__x));
    __x = __comp ? _S_left(__x) : _S_right(__x);
  }
  //离开while循环之后，y所指即为安插点的父节点，x必为叶子节点
  iterator __j = iterator(__y);//令迭代器j指向插入节点之父节点y   
  if (__comp)//若为真
    if (__j == begin())//若插入点之父节点为最左节点     
      return pair<iterator,bool>(_M_insert(__x, __y, __v), true);
    else//否则(插入点之父节点不在最左节点)
      --__j;//调整j
   // 小于新值（表示遇「小」，将安插于右侧）  
  if (_M_key_compare(_S_key(__j._M_node), _KeyOfValue()(__v)))
    return pair<iterator,bool>(_M_insert(__x, __y, __v), true);
  //若运行到这里，表示键值有重复，不应该插入 
  return pair<iterator,bool>(__j, false);
}

//插入节点,节点值可以与当前RB-Tree节点值相等
iterator insert_equal(const _Value& __v)
{
  _Link_type __y = _M_header;
  _Link_type __x = _M_root();//从根节点开始
  while (__x != 0) {//从根节点开始,往下寻找合适插入点
    __y = __x;
	//判断新插入节点值与当前节点x值的大小,以便判断往x的左边走还是往右边走
    __x = _M_key_compare(_KeyOfValue()(__v), _S_key(__x)) ? 
            _S_left(__x) : _S_right(__x);
  }
  return _M_insert(__x, __y, __v);
}
```
