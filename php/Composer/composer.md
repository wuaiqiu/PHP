# composer


**一.基本命令**

```
#初始化
composer init

#安装(先根据composer.lock,在composer.json)
composer install

#更新依赖(根据composer.json)
composer update
composer update monolog/monolog

#增加新的依赖包
composer require monolog/monolog
composer require vendor/package:2.*
composer require monolog/monolog --dev

#搜索
composer search mongolog

#查看包信息
composer show monolog/monolog

#创建项目
composer create-project topthink/thinkphp mythink 2.2.*
```

<br>

**二.自定义加载**

```
{
   //Acme为命名空间,src与vendor同级
   "autoload": {
        "psr-4": {"Acme\\": "src/"},
        "psr-0": {"Acme\\": ["src/","demo/"]},
        "classmap": ["src/"]
    }
}

#重新生成autoload.php
composer dump-autoload
```

<br>

**三.配置文件**

```
{
    "name": "wuaiqiu/comp",
    "description": "afasdf",
    "type": "library",
    "require": {
        "monolog/monolog": "^1.23"
    },
    "require-dev": {
        "psr/log": "^1.0"
    },
    "license": "MIT",
    "authors": [
        {
            "name": "wuaiqiu",
            "email": "209115576@qq.com"
        }
    ]
}
```
