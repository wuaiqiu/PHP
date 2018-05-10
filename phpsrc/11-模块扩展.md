# 模块扩展

**1. 编译工具**

(a).ext_skel:这个脚本主要生成了编译需要的配置以及扩展的基本结构

(b).php-config:这个脚本主要是获取PHP的安装信息

(c).phpize:用于生成configure文件

<br>

**2.编写扩展的基本步骤**

>a.通过ext目录下ext_skel脚本生成扩展的基本框架；

```
./ext_skel --extname=wu
```

>b.修改config.m4配置：设置编译配置参数、设置扩展的源文件、依赖库/函数检查等等；

```
PHP_ARG_WITH(arg_name,check message,help info): 定义一个--with-feature[=arg]这样的编译参数，参数分别为
参数名、执行./configure是展示信息、执行--help时展示信息

$PHP_参数名:获取对应的参数值
```

```
PHP_ARG_ENABLE(arg_name,check message,help info): 定义一个--enable-feature[=arg]或--disable-feature参
数，--disable-feature等价于--enable-feature=no，这个宏与PHP_ARG_WITH类似，通常情况下如果配置的参数需
要额外的arg值会使用PHP_ARG_WITH，而如果不需要arg值，只用于开关配置则会使用PHP_ARG_ENABLE。
```

```
./configure时输出结果，其中error将会中断configure执行

AC_MSG_CHECKING(message)
AC_MSG_RESULT(message)
AC_MSG_ERROR(message)
```

```
PHP_CHECK_LIBRARY(library, function [, action-found [, action-not-found ]]): 检查依赖的库中是否存在需要
的function，action-found为存在时执行的动作，action-not-found为不存在时执行的动作
```

>c.编写扩展要实现的功能：按照PHP扩展的格式以及PHP提供的API编写功能；

```
#1.注册全局变量
//php_wu.h
#define MYTEST_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(mytest, v)

//定义全局变量
ZEND_BEGIN_MODULE_GLOBALS(mytest)
	zend_long   open_cache;
	HashTable   class_table;
ZEND_END_MODULE_GLOBALS(mytest)

//wu.c
ZEND_DECLARE_MODULE_GLOBALS(mytest) 
```

```
#2.钩子函数
PHP_MINIT_FUNCTION(mytest){
	这个阶段可以进行内部类的注册，如果你的扩展提供
    了类就可以在此函数中完成注册；除了类还可以在此
    函数中注册扩展定义的常量
}

PHP_RINIT_FUNCTION(mytest){
	如果你的扩展需要针对每一个请求进行处理则可以设
    置这个函数，如：对请求进行filter
}

PHP_RSHUTDOWN_FUNCTION(mytest){
	此函数在请求结束时被调用
}

PHP_MSHUTDOWN_FUNCTION(mytest){
    模块关闭阶段回调的函数，与module_startup_func对应，
    此阶段主要可以进行一些资源的清理
}
```

```
#3.自定义函数
PHP_FUNCTION(my_func_1){
   自定义内部函数1
}

PHP_FUNCTION(my_func_1){
   自定义内部函数2(带参)
   zval        *arr;
   //l(L)整型，L当数据溢出不报错
   //(b)布尔型，(d)浮点型
   //s(S)字符串型,其中"s"将参数解析到char*，且需要额外提供一个size_t类型的变量用于获取字符串长度，“S”为zend_string
   //a(A)数组型，o(O)对象型,r资源型，z任意类型
   //|： 表示此后的参数为可选参数，可以不传，比如解析规则为："al|b"，则可以传2个或3个参数
   //+、* ： 用于可变参数，+、*的区别在于 * 表示可以不传可变参数，而 + 表示可变参数至少有一个。需要额外提供一个int类型的变量用于获取具体的数量
   if(zend_parse_parameters(ZEND_NUM_ARGS(), "la", &lval, &arr) == FAILURE){
        RETURN_FALSE;
    }
}

PHP_FUNCTION(my_func_3){
    自定义内部函数3(引用传参)
     zval    *lval; //必须为zval
     zval    *obj;
    //引用参数解析时只能使用"z"解析
    if(zend_parse_parameters(ZEND_NUM_ARGS(), "zo", &lval, &obj) == FAILURE){
        RETURN_FALSE;
    }
}

//参数信息(参数组名,无意义，返回值是否引用，参数个数)
ZEND_BEGIN_ARG_INFO_EX(arg_info_3, 0, 0, 2)
   //pass_by_ref表示是否引用传参，name为参数名称
    ZEND_ARG_INFO(pass_by_ref, name)
    //显式声明此参数的类型为指定类的对象，等价于PHP中这样声明：MyClass $obj
    ZEND_ARG_OBJ_INFO(pass_by_ref, name, classname, allow_null)
    //显式声明此参数类型为数组，等价于：array $arr
    ZEND_ARG_ARRAY_INFO(pass_by_ref, name, allow_null)
    //通用宏，自定义各个字段
    ZEND_ARG_TYPE_INFO(pass_by_ref, name, type_hint, allow_null)
    //声明为可变参数
    ZEND_ARG_VARIADIC_INFO(pass_by_ref, name)
ZEND_END_ARG_INFO()

PHP_FUNCITON(my_func_3){
    自定义内部函数4(返回值) 
    //返回布尔型，b：IS_FALSE、IS_TRUE
    RETURN_BOOL(b) 
    //返回false
    RETURN_FALSE  
    //返回true
    RETURN_TRUE
    //返回NULL
    RETURN_NULL()
    //返回整形,l类型：zend_long    
    RETURN_LONG(l)
    //返回浮点值,d类型：double
    RETURN_DOUBLE(d)
    //返回字符串,内部字符串,s类型为：zend_string *
    RETURN_STR(s)
    //返回char *类型的字符串，s类型为char *
    RETURN_STRING(s）
    //返回空字符串
    RETURN_EMPTY_STRING()
    //返回资源，r类型：zend_resource *
    RETURN_RES(r) 
    //返回数组，r类型：zend_array *
    RETURN_ARR(r)      
    //返回对象，r类型：zend_object *
    RETURN_OBJ(r)    
}

const zend_function_entry mytest_functions[] = {
    PHP_FE(my_func_1,NULL)
    PHP_FE(my_func_2,NULL)
    PHP_FE(my_func_3,arg_info_3)
    PHP_FE(my_func_4,NULL)
    PHP_FE_END //末尾必须加这个
};

zend_module_entry mytest_module_entry = {
    STANDARD_MODULE_HEADER, //宏统一设置
    "mytest", //模块名
    mytest_functions, //自定义函数数组
    PHP_MINIT(mytest), //扩展初始化回调函数
    PHP_MSHUTDOWN(mytest), //扩展关闭时回调函数
    PHP_RINIT(mytest), //请求开始前回调函数
    PHP_RSHUTDOWN(mytest), //请求结束时回调函数
    NULL, //PHP_MINFO(mytest),php_info展示的扩展信息处理函数
    "1.0.0",
    STANDARD_MODULE_PROPERTIES //宏统一设置
};

ZEND_GET_MODULE(mytest) //读取mytest_module_entry结构体
```

```
#4.zval操作工具类
//创建(这些宏第一个参数z均为要设置的zval的指针，后面为要设置的zend_value)
ZVAL_UNDEF(z): 表示zval被销毁
ZVAL_NULL(z): 设置为NULL
ZVAL_FALSE(z): 设置为false
ZVAL_TRUE(z): 设置为true
ZVAL_BOOL(z, b): 设置为布尔型，b为IS_TRUE、IS_FALSE，与上面两个等价
ZVAL_LONG(z, l): 设置为整形，l类型为zend_long，如：zval z; ZVAL_LONG(&z, 88);
ZVAL_DOUBLE(z, d): 设置为浮点型，d类型为double
ZVAL_STR(z, s): 设置字符串，将z的value设置为s，s类型为zend_string*，不会增加s的refcount
ZVAL_ARR(z, a): 设置为数组，a类型为zend_array*
ZVAL_OBJ(z, o): 设置为对象，o类型为zend_object*
ZVAL_RES(z, r): 设置为资源，r类型为zend_resource*
ZVAL_REF(z, r): 设置为引用，r类型为zend_reference*
ZVAL_NEW_EMPTY_REF(z): 新创建一个空引用，没有设置具体引用的value

//获取值及类型
Z_LVAL(zval)、Z_LVAL_P(zval_p): 返回zend_long
Z_DVAL(zval)、Z_DVAL_P(zval_p): 返回double
Z_STR(zval)、Z_STR_P(zval_p): 返回zend_string*
Z_STRVAL(zval)、Z_STRVAL_P(zval_p): 返回char*，即：zend_string->val
Z_STRLEN(zval)、Z_STRLEN_P(zval_p): 获取字符串长度
Z_STRHASH(zval)、Z_STRHASH_P(zval_p): 获取字符串的哈希值
Z_ARR(zval)、Z_ARR_P(zval_p)、Z_ARRVAL(zval)、Z_ARRVAL_P(zval_p): 返回zend_array*
Z_OBJ(zval)、Z_OBJ_P(zval_p): 返回zend_object*
Z_OBJCE(zval)、Z_OBJCE_P(zval_p): 返回对象的zend_class_entry*
Z_OBJPROP(zval)、Z_OBJPROP_P(zval_p): 获取对象的成员数组
Z_RES(zval)、Z_RES_P(zval_p): 返回zend_resource*
Z_RES_HANDLE(zval)、Z_RES_HANDLE_P(zval_p): 返回资源handle
Z_RES_TYPE(zval)、Z_RES_TYPE_P(zval_p): 返回资源type
Z_RES_VAL(zval)、Z_RES_VAL_P(zval_p): 返回资源ptr
Z_REF(zval)、Z_REF_P(zval_p): 返回zend_reference*
Z_REFVAL(zval)、Z_REFVAL_P(zval_p): 返回引用的zval*

//类型转换
convert_to_long(zval *op);
convert_to_double(zval *op);
convert_to_long_base(zval *op, int base);
convert_to_null(zval *op);
convert_to_boolean(zval *op);
convert_to_array(zval *op);
convert_to_object(zval *op);
zval_get_long(op):获取格式化为long的值，返回值为zend_long
zval_get_double(op):获取格式化为double的值，返回值double
zval_get_string(op):获取格式化为string的值，返回值zend_string *

//字符串操作
zend_string_init(const char *str, size_t len, int persistent);创建zend_string
zend_string_copy(zend_string *s);字符串复制，只增加引用
zend_string_dup(zend_string *s, int persistent);字符串拷贝，硬拷贝
zend_string_realloc(zend_string *s, size_t len, int persistent);将字符串按len大小重新分配，会减少s的refcount，返回新的字符串
zend_string_extend(zend_string *s, size_t len, int persistent);延长字符串，与zend_string_realloc()类似，不同的是len不能小于s的长度
zend_string_refcount(const zend_string *s);获取字符串refcount
zend_string_addref(zend_string *s);增加字符串refcount
zend_string_delref(zend_string *s);减少字符串refcount
zend_string_release(zend_string *s);释放字符串，减少refcount，为0时销毁
zend_string_free(zend_string *s);销毁字符串，不管引用计数是否为0
zend_string_equals(zend_string *s1, zend_string *s2);比较两个字符串是否相等，区分大小写
zend_string_equals_ci(s1, s2)；比较两个字符串是否相等，不区分大小写

//数组操作
ZVAL_NEW_ARR(z): 新分配一个数组，主动分配一个zend_array
zend_hash_init(Z_ARRVAL(array), size, NULL, ZVAL_PTR_DTOR, 0);初始化数组

1) key为zend_string
zend_hash_update(ht, key, pData):插入或更新元素，会增加key的refcount
zend_hash_add(ht, key, pData)：添加元素，与zend_hash_update()类似，不同的地方在于如果元素已经存在则不会更新
2) key为普通字符串：char*
zend_hash_str_update(ht, key, len, pData)
#define zend_hash_str_add(ht, key, len, pData) 
3) key为数值索引
zend_hash_index_update(ht, h, pData)：更新第h个元素
zend_hash_index_add(ht, h, pData)：插入元素，h为数值

zend_hash_find(const HashTable *ht, zend_string *key);根据zend_string key查找数组元素
zend_hash_str_find(const HashTable *ht, const char *key, size_t len);根据普通字符串key查找元素
zend_hash_index_find(const HashTable *ht, zend_ulong h);获取数值索引元素
zend_hash_exists(const HashTable *ht, zend_string *key);判断元素是否存在
zend_hash_str_exists(const HashTable *ht, const char *str, size_t len);判断元素是否存在
zend_hash_index_exists(const HashTable *ht, zend_ulong h);判断元素是否存在
zend_hash_num_elements(ht)：获取数组元素数

zend_hash_del(HashTable *ht, zend_string *key);删除key

//遍历
ZEND_HASH_FOREACH_VAL(ht, val) {
    ...
} ZEND_HASH_FOREACH_END();

ZEND_HASH_FOREACH_NUM_KEY(ht, _h)：遍历获取所有的数值索引
ZEND_HASH_FOREACH_STR_KEY(ht, _key)：遍历获取所有的key
ZEND_HASH_FOREACH_KEY(ht, _h, _key)：上面两个的聚合
ZEND_HASH_FOREACH_NUM_KEY_VAL(ht, _h, _val) ：遍历获取数值索引key及value
ZEND_HASH_FOREACH_STR_KEY_VAL(ht, _key, _val)：遍历获取key及valu
ZEND_HASH_FOREACH_KEY_VAL(ht, _h, _key, _val)：上面两个的聚合

zend_array_destroy(HashTable *ht)：销毁数组
```

```
#5.常量
//注册NULL常量
REGISTER_NULL_CONSTANT(name, flags) 
//注册bool常量
REGISTER_BOOL_CONSTANT(name, bval, flags) 
//注册整形常量
REGISTER_LONG_CONSTANT(name, lval, flags)
//注册浮点型常量
REGISTER_DOUBLE_CONSTANT(name, dval, flags)
//注册字符串常量，str类型为char*
REGISTER_STRING_CONSTANT(name, str, flags) 
//注册字符串常量，截取指定长度，str类型为char*
REGISTER_STRINGL_CONSTANT(name, str, len, flags)
```

>d.生成configure：扩展编写完成后执行phpize脚本生成configure及其它配置文件；

```
phpsize
```

>e.编译&安装：./configure、make、make install，然后将扩展的.so路径添加到php.ini中。

```
./configure
make
make install
```