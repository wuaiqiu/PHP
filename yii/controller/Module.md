# Module

#### 一.模块结构

```
forum/
    config.php                   模块配置
    Module.php                   模块类文件
    controllers/                 包含控制器类文件
        DefaultController.php    default 控制器类文件
    models/                      包含模型类文件
    views/                       包含控制器视图文件和布局文件
        layouts/                 包含布局文件
        default/                 包含DefaultController控制器视图文件
            index.php            index视图文件
```

<br>

#### 二.模块实例

>Module.php

```
namespace app\forum;

class Module extends \yii\base\Module
{
    //定义controlller命名空间
    public $controllerNamespace = 'app\configmanage\controllers';
    //默认路由
    public $defaultRoute='config/test';
    //初始化模块
    public function init()
    {
        parent::init();
        \Yii::configure($this, require 'config.php');
    }
}
```

>config.php

```
<?php
return [
    'layoutPath' => __DIR__.'/views/layouts',
    'layout' => 'main'
];
```

<br>

#### 三.注册模块(web.php)

```
'modules' => [
  'forum' => [
      'class' => 'app\modules\forum\Module'
  ]
]
```
