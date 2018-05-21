# Class内存模型

#### 一.简单类模式

源代码:

```
class Base
{
    int a;
    int b;
public:
    void CommonFunction();
};
```

内存分配:

地址|成员
--|--
0|a
4|b

>成员变量依据声明的顺序进行排列(类内偏移为0开始),成员函数不占内存空间

<br>

#### 二.单继承

源代码:

```
class DerivedClass: public Base
{
    int c;
public:
    void DerivedCommonFunction();
};
```

内存分配:

地址|成员
--|--
0|a
4|b
8|c

>子类继承了父类的成员变量，在内存排布上，先是排布了父类的成员变量，接着排布子类的成员变量，同样，成员函数不占字节。

<br>

#### 三.多态

基类源代码:

```
class Base
{
    int a;
    int b;
public:
    void virtual VirtualFunction();
};
```

基类内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b

$vftable

地址|成员
--|--
0|Base@VirtualFunction

>这个内存结构图分成了两个部分，上面是内存分布，下面是虚表，虚表指针放在了内存的开始处（0地址偏移），然后再是成员变量；下面生成了虚表，0表示virtualFunction的内存地址

子类源代码:

```
class DerivedClass: public Base
{
    int c;
public:
    void virtual VirtualFunction();
    void virtual VirtualFunction2();
};
```

子类内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b
12|c

$vftable

地址|成员
--|--
0|DerivedClass@VirtualFunction
1|DerivedClass@VirtualFunction2

>上半部是内存分布，可以看到，虚表指针被继承了，且仍位于内存排布的起始处，下面是父类的成员变量a和b，最后是子类的成员变量c，注意虚表指针只有一个，子类并没有再生成虚表指针了；但虚函数的VirtualFunction已经换成子类的

<br>

#### 四.多继承

继承源代码:

```
class Base
{
    int a;
    int b;
public:
    void virtual VirtualFunction();
};


class DerivedClass1: public Base
{
    int c;
public:
    void virtual VirtualFunction();
};

class DerivedClass2 : public Base
{
    int d;
public:
    void virtual VirtualFunction();
};

class DerivedDerivedClass : public DerivedClass1, public DerivedClass2
{
    int e;
public:
    void virtual VirtualFunction();
};
```

Base内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b

$vftable

地址|成员
--|--
0|Base@VirtualFunction

DerivedClass1内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b
12|c

$vftable

地址|成员
--|--
0|DerivedClass1@VirtualFunction

DerivedClass2内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b
12|d

$vftable

地址|成员
--|--
0|DerivedClass2@VirtualFunction

DerivedDerivedClass内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b
12|c
16|{vftable}
20|a
24|b
28|d
32|e

$vftable

地址|成员
--|--
0|DerivedDerivedClass@VirtualFunction

$vftable

地址|成员
--|--
0|DerivedDerivedClass@VirtualFunction

>它并列地排布着继承而来的两个父类DerivedClass1与DerivedClass2，还有自身的成员变量e,这里有两份虚表了，分别针对DerivedClass1与DerivedClass2,两分base成员变量

<br>

#### 五.虚继承

虚继承源代码:

```
class Base
{
    int a;
    int b;
public:
    void virtual VirtualFunction();
};

class DerivedClass1: virtual public Base
{
    int c;
public:
    void virtual VirtualFunction();
};

class DerivedClass2 : virtual public Base
{
    int d;
public:
    void virtual VirtualFunction();
};

class DerivedDerivedClass :  public DerivedClass1, public DerivedClass2
{
    int e;
public:
    void virtual VirtualFunction();
};
```

Base内存分配:

地址|成员
--|--
0|{vftable}
4|a
8|b

$vftable

地址|成员
--|--
0|Base@VirtualFunction

DerivedClass1内存分配:

地址|成员
--|--
0|{vbtable}
4|c
8|{vftable}
12|a
16|b

$vbatable

地址|成员
--|--
0|8($vftable:0)

$vftable

地址|成员
--|--
0|DerivedClass1@VirtualFunction

DerivedClass2内存分配:

地址|成员
--|--
0|{vbtable}
4|d
8|{vftable}
12|a
16|b

$vbatable

地址|成员
--|--
0|8($vftable:0)

$vftable

地址|成员
--|--
0|DerivedClass2@VirtualFunction

DerivedDerivedClass内存分配:

地址|成员
--|--
0|{vbtable}
4|c
8|{vbtable}
12|d
16|e
20|{vftable}
24|a
28|b

$vbatable

地址|成员
--|--
0|20($vftable:0)

$vbatable

地址|成员
--|--
0|16($vftable:0)

$vftable

地址|成员
--|--
0|DerivedDerivedClass@VirtualFunction

>虚继承的作用是减少了对基类的重复，代价是增加了虚表指针的负担（更多的虚表指针）
