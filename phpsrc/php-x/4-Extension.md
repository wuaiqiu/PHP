# Extension

1.定义扩展

```
PHPX_EXTENSION()
{
    Extension *ext = new Extension("name", version");

    return ext;
}
```

2.定义回调函数

```
MINIT = onStart  扩展初始化时调用
RINIT = onBeforeRequest 扩展销毁时调用
MSHUTDOWN = onShutdown 请求到来前调用
RSHUTDOWN = onAfterRequest 请求结束后调用

ext->onStart = [ext] () {
    //onStart执行的代码
};
```

3.注册函数(必须在Extension对象创建时注册函数)

```
//实现函数(args参数数组,retval返回值)
PHPX_FUNCTION(cpp_test)
{
    long n = args[1].toInt();
    Array _array(retval);
    
    for(int i = 0; i < n; i++)
    {
        _array.append(args[0]);
    }
}

//注册函数
PHPX_EXTENSION()
{
    Extension *ext = new Extension("test", "0.0.1");
    ext->registerFunction(PHPX_FN(cpp_test));
    return ext;
}
```

4.注册类(必须在在onStart中注册)

```
//实现方法(args参数数组,retval返回值,_this实例对象)
PHPX_METHOD(CppClass, test1)
{
    //获取实例属性
    auto name = _this.get("name");
    //获取类属性
    auto version=constant("CppClass::VERSION");
}

//注册类
PHPX_EXTENSION()
{
    Extension *ext = new Extension("test", "0.0.1");
    ext->onStart = [ext]
    {
        Class c = new Class("CppClass");
        //普通方法
        c->addMethod(PHPX_ME(CppClass, test1));
        //静态方法(PUBLIC、PROTECTED、PRIVATE、STATIC、CONSTRUCT、DESTRUCT,可以使用"|"分割)
        c->addMethod(PHPX_ME(CppClass, test2), STATIC);
        //添加默认属性
        c->addProperty("name", 1234);
        //添加常量
        c->addConstant("VERSION", "1.9.0");
        //注册到ZendVM中
        PHP::registerClass(c);
    }
    return ext;
}
```

5.依赖关系

```
#加载其他扩展
ext->require("swoole");
ext->require("sockets");

#引入头文件
extern "C" {
    #include "ext/swoole/php_swoole.h"
}
```