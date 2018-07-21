# Config

(1).必须属性

#### id
用来区分其他应用的唯一标识ID。

```
'id' => 'basic'
```

#### basePath
指定该应用的根目录。

```
'basePath' => dirname(__DIR__)
```

<br>

(2).重要属性

#### aliases
路径别名，数组的key为别名名称，值为对应的路径。

```
'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
]
```

#### bootstrap
指定启动阶段需要运行的组件或模块。

```
'bootstrap' => [
    'log'
]
```

#### components
注册应用组件。

```
'components' => [
  'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
          [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
          ],
      ],
  ]
]
```

#### modules
注册模块。

```
'modules' => [
    // "booking" 模块以及对应的类
    'booking' => 'app\modules\booking\BookingModule',
    // "comment" 模块以及对应的配置数组
    'comment' => [
        'class' =>'app\modules\comment\CommentModule',
        'db' => 'db',
    ],
]
```

#### catchAll
指定一个要处理所有用户请求的控制器操作。

```
'catchAll' => [
    'offline/notice',
    'param1' => 'value1',
    'param2' => 'value2',
]
```

#### controllerMap
允许你指定控制器ID到控制器类的映射。

```
'controllerMap' => [
    'account' => 'app\controllers\UserController',
    'article' => [
        'class' => 'app\controllers\PostController',
        'enableCsrfValidation' => false
    ]
]
```

#### controllerNamespace
指定控制器类默认的命名空间，默认为app\controllers。

```
'controllerNamespace'=>'app\controllers'
```

#### params
该属性为一个数组，指定可以全局访问的参数。(Yii::$app->params['a'])

```
'params' => [
    'a' => 'A',
    'b' => 'B'
]
```

<br>

(3).实用属性

#### defaultRoute
该属性指定默认的路由规则

```
'defaultRoute'=>'default/test'
```

#### layoutPath
该属性指定查找布局文件的路径，默认值为view/layouts

```
'layoutPath' => 'view/layouts'
```

#### layout
该属性指定默认的渲染视图， 默认值为'main'对应layoutPath下的 main.php文件

```
'layout' => 'main'
```

#### runtimePath
该属性指定临时文件如日志文件、缓存文件等保存路径， 默认值为带别名的 @app/runtime。

```
'runtimePath' => '@app/runtime'
```

#### viewPath
该路径指定视图文件的根目录，默认值为带别名的 @app/views

```
'viewPath' => '@app/views'
```

#### vendorPath
该属性指定Composer管理的供应商路径，默认值为带别名的 @app/vendor 。

```
'vendorPath' => '@app/vendor'
```
