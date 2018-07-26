# Variant

>Variant类型相当于ZendVM的zval结构，是对PHP变量的封装。

1.赋值

```
Variant a = 1234;
Variant b = 1234.56;
Variant c = false;
Variant d = "hello world";
```

2.类型判断

```
#整型
var.isInt();
#浮点型
var.isFloat();
#字符串
var.isString();
#布尔型
var.isBool();
#对象
var.isObject();
#数组
var.isArray();
#NULL类型
var.isNull();
#资源类型
var.isResource();
```

3.类型转换

```
#转为整型
long value = var.toInt();
#转为浮点型
double value = var.toFloat();
#转为布尔型
bool value = var.toBool();
#转为字符串
string value = var.toString();
String str(var);
#转为数组
Array arr(var);
#转为对象
Object obj(var);
#转为资源
CppObject *ptr = var.toResource<CppObject>();
```

4.高级接口

```
#判断相等(支持严格模式，传入第二个参数bool)
Variant a = 1234;
Variant b = "1234";
bool ret = a.equals(b,true);

#直接判断(不支持严格模式)
if (a == b)
{
    echo("a==b\n");
}
```

```
#导出内存(栈到堆)
ret = var.dup(&var);
```
