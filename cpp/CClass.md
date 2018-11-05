# Class内存模型


### 一.普通继承(非虚函数)

>a.单继承:成员变量依据声明的顺序进行排列(类内偏移为0开始),成员函数不占内存空间

```cpp
class Base {
public:
    int a;
};

class DerivedClass : public Base {
public:
    int b;
};
```

地址|成员
--|--
0|a
4|b

>b.多继承

```cpp
class Base1 {
public:
    int a;
};

class Base2 {
public:
    int b;
};

class DerivedClass : public Base1, public Base2 {
public:
    int c;
};
```

地址|成员
--|--
0|a
4|b
8|c

>c.菱形继承:菱形继承存在二义性，需要通过类名作用域指定调用基类同名成员数据。

```cpp
class Base {
public:
    int a;
};

class Base1 : public Base {
public:
    int b;
};

class Base2 : public Base {
public:
    int c;
};

class DerivedClass : public Base1, public Base2 {
public:
    int d;
};
```

地址|成员
--|--
0|a
4|b
8|a
12|c
16|d

<br>

### 二.普通继承(虚函数)

>a.单继承:这个内存结构图分成了两个部分，上面是内存分布，下面是虚表，虚表指针vptr放在了内存的开始处，然后再是成员变量；下面生成了虚表，0表示fun的内存地址,4表示fun1的内存地址

```cpp
class Base {
public:
    int a;
    virtual void fun() {}
};

class DerivedClass : public Base {
public:
    int b;
    virtual void fun() {}
    virtual void fun1() {}
};
```

地址|成员
--|--
0|Base@vptr
4|a
8|b

<br>

地址|成员(Base@vptr)
--|--
0|DerivedClass@fun
4|DerivedClass@fun1

>b.多继承:派生类中新增的虚函数，追加到第一个基类的虚函数表的后面

```cpp
class Base1 {
public:
    int a;
    virtual void fun1() {}
};

class Base2 {
public:
    int b;
    virtual void fun2() {}
};

class DerivedClass : public Base1, public Base2 {
public:
    int c;
    virtual void fun1() {}
    virtual void fun2() {}
    virtual void fun3() {}
};
```

地址|成员
--|--
0|Base1@vptr
4|a
8|Base2@vptr
12|b
16|c

<br>

地址|成员(Base1@vptr)|成员(Base2@vptr)
--|--|--
0|DerivedClass@fun1|DerivedClass@fun2
4|DerivedClass@fun3|

>c.菱形继承

```cpp
class Base {
public:
    int a;
    virtual void fun() {}
};

class Base1 {
public:
    int b;
    virtual void fun1() {}
};

class Base2 {
public:
    int c;
    virtual void fun2() {}
};

class DerivedClass : public Base1, public Base2 {
public:
    int d;
    virtual void fun1() {}
    virtual void fun2() {}
    virtual void fun3() {}
};
```

地址|成员
--|--
0|Base@vptr1
4|a
8|b
12|Base@vptr2
16|a
20|c
24|d

<br>

地址|成员(Base@vptr1)|成员(Base@vptr2)
--|--|--
0|Base@fun|Base@fun
4|DerivedClass@fun1|DerivedClass@fun2
8|DerivedClass@fun3|

<br>

### 三.虚继承(非虚函数)

>a.单继承:新增vbptr(指向类入口)指针，存储的是距类入口的偏移量

```cpp
class Base {
public:
    int a;
};

class DerivedClass : virtual public Base {
public:
    int b;
};
```

地址|成员
--|--
0|DerivedClass@vbptr
4|b
8|a

<br>

地址|成员(DerivedClass@vbptr)
--|--
0|0
4|+8

>b.多继承

```cpp
class Base1 {
public:
    int a;
};

class Base2 {
public:
    int b;
};

class DerivedClass : virtual public Base1, virtual public Base2 {
public:
    int c;
};
```

地址|成员
--|--
0|DerivedClass@vbptr
4|c
8|a
12|b

<br>

地址|成员(DerivedClass@vbptr)
--|--
0|0
4|+8
8|+12

>c.菱形继承:虚继承将基类置于内存末尾，但是置于末尾的顺序也有一定的次序。首先Base先放到末尾，然后Base1放到末尾，最后Base2放到末尾。

```cpp
class Base {
public:
    int a;
};

class Base1 : virtual public Base {
public:
    int b;
};

class Base2 : virtual public Base {
public:
    int c;
};

class DerivedClass : virtual public Base1, virtual public Base2 {
public:
    int d;
};
```

地址|成员
--|--
0|DerivedClass@vbptr
4|d
8|a
12|Base1@vbptr
16|b
20|Base2@vbptr
24|c

<br>

地址|成员(DerivedClass@vbptr)|成员(Base1@vbptr)|成员(Base2@vbptr)
--|--|--|--
0|0|0|0
4|+8|-4|-12
8|+12||
12|+16||

<br>

### 四.虚继承(虚函数)

>a.单继承:新增vbptr(指向vptr)指针，存储的是距vptr的偏移量，与普通继承(虚函数)的单继承相比，派生类拥有自己的vbptr以及vptr，而不是与基类共用一个vptr

```cpp
class Base {
public:
    int a;
    virtual void fun1() {}
};

class DerivedClass : virtual public Base {
public:
    int b;
    virtual void fun2() {}
};
```

地址|成员
--|--
0|DerivedClass@vptr
4|DerivedClass@vbptr
8|b
12|Base@vptr
16|a

<br>

地址|成员(DerivedClass@vbptr)
--|--
0|-4
4|+8

<br>

地址|成员(DerivedClass@vptr)|成员(Base@vptr)
--|--|--
0|DerivedClass@fun2|Base@fun1

>b.多继承

```cpp
class Base1 {
public:
    int a;
    virtual void fun1() {}
};

class Base2 {
public:
    int b;
    virtual void fun2() {}
};

class DerivedClass : virtual public Base1, virtual public Base2 {
public:
    int c;
    virtual void fun3() {}
};
```

地址|成员
--|--
0|DerivedClass@vptr
4|DerivedClass@vbptr
8|c
12|Base1@vptr
16|a
20|Base2@vptr
24|b

<br>

地址|成员(DerivedClass@vbptr)
--|--
0|-4
4|+8
8|+16

<br>

地址|成员(DerivedClass@vptr)|成员(Base1@vptr)|成员(Base2@vptr)
--|--|--|--
0|DerivedClass@fun3|Base1@fun1|Base2@fun2

>c.菱形继承

```cpp
class Base {
public:
    int a;
    virtual void fun1() {}
};

class Base1 : virtual public Base {
public:
    int b;
    virtual void fun2() {}
};

class Base2 : virtual  public  Base{
public:
    int c;
    virtual void fun3() {}
};

class DerivedClass : virtual public Base1, virtual public Base2 {
public:
    int d;
    virtual void fun4() {}
};
```

地址|成员
--|--
0|DerivedClass@vptr
4|DerivedClass@vbptr
8|d
12|Base@vptr
16|a
20|Base1@vptr
24|Base1@vbptr
28|b
32|Base2@vptr
36|Base2@vbptr
40|c

<br>

地址|成员(DerivedClass@vbptr)|成员(Base1@vbptr)|成员(Base2@vbptr)
--|--|--|--
0|-4|-4|-4
4|+8|-12|-24
8|+16||
12|+28||

<br>

地址|成员(DerivedClass@vptr)|成员(Base@vptr)|成员(Base1@vptr)|成员(Base2@vptr)
--|--|--|--|--
0|DerivedClass@fun4|Base@fun1|Base1@fun2|Base2@fun3