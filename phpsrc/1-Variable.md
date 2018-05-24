# 变量

**1.变量结构**

```
typedef struct _zval_struct     zval;

typedef union _zend_value {
    zend_long         lval;    //int整形
    double            dval;    //浮点型
    zend_string      *str;     //string字符串
    zend_array       *arr;     //array数组
    zend_object      *obj;     //object对象
    zend_resource    *res;     //resource资源类型
    zend_reference   *ref;     //引用类型，通过&$var_name定义的
} zend_value;

struct _zval_struct {
    zend_value        value; //变量实际的value
    union {
        struct {
            ZEND_ENDIAN_LOHI_4( 
                zend_uchar    type,         //变量类型
                zend_uchar    type_flags,  //类型掩码，不同的类型会有不同的几种属性，内存管理会用到
                zend_uchar    const_flags,
                zend_uchar    reserved)
        } v;
        uint32_t type_info; //上面4个值的组合值，可以直接根据type_info取到4个对应位置的值
    } u1;
    union {
        uint32_t     var_flags;
        uint32_t     next;  //哈希表中解决哈希冲突时用到   
        uint32_t     cache_slot;   
        uint32_t     lineno;    
        uint32_t     num_args;    
        uint32_t     fe_pos;  
        uint32_t     fe_iter_idx;
    } u2;
};
```

<br>

**2.变量类型**

```
#define IS_UNDEF                    0
#define IS_NULL                     1
#define IS_FALSE                    2
#define IS_TRUE                     3
#define IS_LONG                     4
#define IS_DOUBLE                   5
#define IS_STRING                   6
#define IS_ARRAY                    7
#define IS_OBJECT                   8
#define IS_RESOURCE                 9
#define IS_REFERENCE                10
```

>其中undef、true、false、null没有value，直接根据type区分，而long、double的值则直接存在value中，其他类型为指针

<br>

**3.字符串**

```
typedef struct _zend_string   zend_string;

struct _zend_string {
    zend_refcounted_h gc;  //变量引用信息，比如当前value的引用数
    size_t            len;  //字符串长度，通过这个值保证二进制安全
    char              val[1]; //字符串内容，变长struct，分配时按len长度申请内存
};
```

<br>

**4.数组**

```
typedef struct _zend_array HashTable;
typedef struct _zend_array zend_array;

typedef struct _Bucket {
    zval              val; //存储的具体value，这里嵌入了一个zval，而不是一个指针
    zend_ulong        h;   //哈希值
    zend_string      *key; //key值
} Bucket;

struct _zend_array {
    zend_refcounted_h gc; //引用计数信息
    uint32_t          nTableMask;  //计算bucket索引时的掩码，用于散列表的计算nIndex
    Bucket           *arData;     //bucket数组
    uint32_t          nNumUsed;   //已用bucket数
    uint32_t          nNumOfElements; //已有元素数，nNumOfElements <= nNumUsed，因为删除的并不是直接从arData中移除
    uint32_t          nTableSize; //数组的大小，为2^n,默认为8
    uint32_t          nInternalPointer; //数值索引,用于HashTable遍历
    zend_long         nNextFreeElement;//下一个空闲可用位置的数字索引
    dtor_func_t       pDestructor;//析构函数,销毁时调用的函数指针
};
```

>HashTable主要依赖arData实现元素的存储、索引。插入一个元素时先将元素按先后顺序插入Bucket数组，位置是idx，再根据key的哈希值映射到散列表中的某个位置nIndex，将idx存入这个位置；查找时先在散列表中映射到nIndex，得到value在Bucket数组的位置idx，再从Bucket数组中取出元素。

```
$arr["a"] = 1;
$arr["b"] = 2;
$arr["c"] = 3;
$arr["d"] = 4;

unset($arr["c"]);
```

![](./img/7.png)

>哈希碰撞:当出现冲突时将原value的位置保存到新value的zval.u2.next中，然后将新value代替原value位置


>扩容:PHP散列表的大小为2^n，插入时如果容量不够则首先检查已删除元素所占比例，如果达到阈值，则将已删除元素移除，重建索引，如果未到阈值则进行扩容操作，扩大为当前大小的2倍，将当前Bucket数组复制到新的空间，然后重建索引。


>重建散列表:当删除元素达到一定数量或扩容后都需要重建散列表，因为value在Bucket位置移动了或哈希数组nTableSize变化了导致key与value的映射关系改变，重建过程实际就是遍历Bucket数组中的value，然后重新计算映射值更新到散列表，移除已删除的value，将后面未删除的value依次前移

<br>

**5.引用**

>引用是PHP中比较特殊的一种类型，它实际是指向另外一个PHP变量，对它的修改会直接改动实际指向的zval，可以简单的理解为C中的指针，在PHP中通过&操作符产生一个引用变量，也就是说不管以前的类型是什么，&首先会创建一个zend_reference结构，其内嵌了一个zval，这个zval的value指向原来zval的value(如果是布尔、整形、浮点则直接复制原来的值)，然后将原zval的类型修改为IS_REFERENCE，原zval的value指向新创建的zend_reference结构。

```
typedef struct _zend_reference  zend_reference;

struct _zend_reference {
    zend_refcounted_h gc;
    zval              val;
};
```

<br>

**6.引用计数**

```
typedef struct _zend_refcounted_h {
    uint32_t         refcount;         
    union {
        struct {
            ZEND_ENDIAN_LOHI_3(
                zend_uchar    type,
                zend_uchar    flags,   
                uint16_t      gc_info)  
        } v;
        uint32_t type_info;
    } u;
} zend_refcounted_h;
```

```
$a = "time:" . time();   //$a       ->  zend_string_1(refcount=1)
$b = $a;                 //$a,$b    ->  zend_string_1(refcount=2)
$c = $b;                 //$a,$b,$c ->  zend_string_1(refcount=3)

unset($b);               //$b = IS_UNDEF  $a,$c ->  zend_string_1(refcount=2)
```

>并不是所有的数据类型都会用到引用计数，long、double直接都是硬拷贝，只有value是指针的那几种类型(除interned string，immutable array)才能用到引用计数。可由zval.u1.type_flag判断

<br>

**7.写时复制**

```
$a = array(1,2);
$b = &$a;
$c = $a;

//发生分离
$b[] = 3;
```

![](./img/8.png)

>事实上只有string、array两种支持,

<br>

**8.垃圾回收**

>PHP变量的回收主要有两种：主动销毁、自动销毁。主动销毁指的就是 unset ，而自动销毁就是PHP的自动管理机制，在return时减掉局部变量的refcount，即使没有显式的return，PHP也会自动给加上这个操作，另外一个就是写时复制时会断开原来value的指向，这时候也会检查断开后旧value的refcount。

```
$a = [1];
$a[] = &$a;

unset($a);
```

unset($a)之前引用关系：

![](./img/9.png)

unset($a)之后：

![](./img/10.png)

>可以看到，unset($a)之后由于数组中有子元素指向$a，所以refcount > 0，无法通过简单的gc机制回收，这种变量就是垃圾，垃圾回收器要处理的就是这种情况，目前垃圾只会出现在array、object两种类型中，所以只会针对这两种情况作特殊处理：当销毁一个变量时，如果发现减掉refcount后仍然大于0，且类型是IS_ARRAY、IS_OBJECT则将此value放入gc可能垃圾双向链表中，等这个链表达到一定数量后启动检查程序将所有变量检查一遍，如果确定是垃圾则销毁释放。


>目前只有object、array两种类型会使用这种机制