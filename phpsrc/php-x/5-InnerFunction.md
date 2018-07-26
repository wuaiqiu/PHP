# InnerFunction


1.echo(类似printf格式化输出)

```
echo("a=%d, b=%f, c=%s.\n", a, b, c);
```

2.var_dump(调试打印)

```
var_dump(a);
```

3.include(加载php文件)

```
include("/data/php/library/Autoloader.php");
```

4.error(打印错误,E_ERROR或E_WARNING)

```
error(E_ERROR, "error: a=%s.\n", str);
```

5.constant(获取常量值,define与const)

```
auto a = constant("PHP_VERSION");
auto b = constant("PDO::VERSION");
```

6.global(获取全局变量的值)

```
//相当于 $_GET
auto a = global("_GET");
//相当于 global $config
auto b = global("config");
```