# 辅助函数

**一.数组函数**

array_add():如果给定键不存在的话，函数添加给定键值对到数组

```
$array = array_add(['name' => 'Desk'], 'price', 100);
// ['name' => 'Desk', 'price' => 100]
```

array_collapse():将多个数组合并成一个

```
$array = array_collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
// [1, 2, 3, 4, 5, 6, 7, 8, 9]
```

array_except():从数组中移除给定键值对

```
$array = ['name' => 'Desk', 'price' => 100];
$array = array_except($array, ['price']);
// ['name' => 'Desk']
```

array_first():返回通过测试数组的第一个元素

```
$array = [100, 200, 300];
$value = array_first($array, function ($value, $key) {
    return $value >= 150;
    });
// 200
#默认值可以作为第三个参数传递给该方法，如果没有值通过测试的话返回默认值：
$value = array_first($array, $callback, $default);
```

array_last():返回通过过滤数组的最后一个元素

```
$array = [100, 200, 300, 110];
$value = array_last($array, function ($value, $key) {
    return $value >= 150;
});
// 300
```

array_set():设置值

```
$array = ['products' => ['desk' => ['price' => 100]]];
array_set($array, 'products.desk.price', 200);
// ['products' => ['desk' => ['price' => 200]]]
```

array_get():获取值

```
$array = ['products' => ['desk' => ['price' => 100]]];
$value = array_get($array, 'products.desk');
// ['price' => 100]
#array_get 函数还接收一个默认值，如果指定键不存在的话则返回该默认值
value = array_get($array, 'names.john', 'default');
```

array_has():判断键是否在数组中存在

```
$array = ['product' => ['name' => 'desk', 'price' => 100]];
$hasItem = array_has($array, 'product.name');
// true
```

array_prepend():将数据项推入数组开头

```
$array = ['one', 'two', 'three', 'four'];
$array = array_prepend($array, 'zero');
// $array: ['zero', 'one', 'two', 'three', 'four']
```

array_pull():从数组中返回并移除键值对

```
$array = ['name' => 'Desk', 'price' => 100];
$name = array_pull($array, 'name');
// $name: Desk
// $array: ['price' => 100]
```

head():只是简单返回给定数组的第一个元素

```
$array = [100, 200, 300];
$first = head($array);
// 100
```

last():返回给定数组的最后一个元素

```
$array = [100, 200, 300];
$last = last($array);
// 300
```

<br/>

**二.路径函数**

app_path():app_path 函数返回 app 目录的绝对路径

```
$path = app_path();
$path = app_path('Http/Controllers/Controller.php');
```

base_path():返回项目根目录的绝对路径

```
$path = base_path();
$path = base_path('vendor/bin');
```

config_path():返回应用配置目录的绝对路径

```
$path = config_path();
database_path()
```

public_path():返回 public 目录的绝对路径

```
$path = public_path();
```

resource_path():返回 resources 目录的绝对路径

```
$path = resource_path();
$path = resource_path('assets/sass/app.scss');
```

storage_path():返回 storage 目录的绝对路径

```
$path = storage_path();
$path = storage_path('app/file.txt');
```

<br/>

**三.字符串函数**

e():在给定字符串上运行 htmlentities

```
echo e('<html>foo</html>');
// &lt;html&gt;foo&lt;/html&gt;
```

starts_with():判断给定字符串是否以给定值开头

```
$value = starts_with('This is my name', 'This');
// true
```

ends_with():判断给定字符串是否以给定值结尾

```
$value = ends_with('This is my name', 'name');
// true
```

str_limit():限制输出字符串的数目

```
$value = str_limit('The PHP framework for web artisans.', 7);
// The PHP...
```

str_contains():判断给定字符串是否包含给定值

```
$value = str_contains('This is my name', 'my');
// true
#你还可以传递数组来判断给定字符串是否包含数组中的值：
$value = str_contains('This is my name', ['my', 'foo']);
// true
```

str_finish():添加字符到字符串结尾

```
$string = str_finish('this/string', '/');
// this/string/
```

<br/>

**四.URL函数**

action():为给定控制器动作生成URL

```
$url = action('HomeController@getIndex');
#如果该方法接收路由参数，你可以将其作为第二个参数传递进来：
$url = action('UserController@profile', ['id' => 1]);
```

route():为给定命名路由生成一个URL

```
$url = route('routeName');
#如果该路由接收参数，你可以将其作为第二个参数传递进来：
$url = route('routeName', ['id' => 1]);
```

url():为给定路径生成完整URL

```
echo url('user/profile');
echo url('user/profile', [1]);
#如果没有提供路径，将会返回 Illuminate\Routing\UrlGenerator 实例：
echo url()->current();
echo url()->full();
echo url()->previous();
```

asset():使用当前请求的 scheme（HTTP或HTTPS）为前端资源生成一个URL

```
$url = asset('img/photo.jpg');
#http://localhost/public/img/photo.jpp
```

<br/>

**五.其他函数**

abort():调用resource/views/errors下的视图

```
abort('403');
#调用403.blade.php视图
```