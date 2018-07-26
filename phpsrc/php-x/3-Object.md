# Object

>Object类是对zend_object的封装

1.属性操作

```
#读取属性
Object object(var);
object.get("name");

#设置属性
Object object(var);
object.set("name", 1234);
```

2.调用方法

```
Object redis = newObject("redis");
Variant ret = redis.exec("connect", "127.0.0.1", 9501);
```

3.操作静态属性

```
#获取类静态属性
Class::get(className, propertyName);
#设置类静态属性
Class::set(className, propertyName, value);
```