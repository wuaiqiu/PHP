# think


**一.自动生成**

build.php

```
return [
    // 生成应用公共文件
    '__file__' => ['hello.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    'demo'     => [
        '__file__'   => ['common.php'],//一定会生成 config.php 文件
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Index'],
        'model'      => ['User'],
        'view'       => ['index/index'],
    ]
];
```

>php think build --config build.php

<br>

**二.指令操作**

```
#生成test模块
php think build --module test

#生成index模块的Blog资源控制器
php think make:controller index/Blog

#生成index模块的Blog模型
php think make:model index/Blog

#生成类库映射文件(runtime/classmap.php)
php think optimize:autoload

#生成路由缓存(runtime/route.php)
php think optimize:route

#生成配置缓存(runtime/init.php)
php think optimize:config

#清除缓存文件(runtime)
php think clear
```