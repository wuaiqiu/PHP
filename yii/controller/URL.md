# URL

#### 一.创建URLs

```
use yii\helpers\Url;

//创建一个普通的URL /index.php?r=post%2Findex
echo Url::to(['post/index']);

//创建一个带参数的URL /index.php?r=post%2Fview&id=100
echo Url::to(['post/view', 'id' => 100]);

//创建一个带锚定的URL /index.php?r=post%2Fview&id=100#content
echo Url::to(['post/view', 'id' => 100, '#' => 'content']);

//创建一个绝对路径URL http://www.example.com/index.php?r=post%2Findex
echo Url::to(['post/index'], true);

//创建一个带https协议的绝对路径URL https://www.example.com/index.php?r=post%2Findex
echo Url::to(['post/index'], 'https');

//别名URL /index.php?r=post%2Findex
echo Url::to(['@posts']);

//主页URL /index.php
echo Url::home();

//根URL /
echo Url::base();

//记住当前请求的URL并在以后获取
Url::remember();
echo Url::previous();
```

<br>

#### 二.美化URL

```
'components' => [
      'urlManager' => [
          //启用美化URL格式
          'enablePrettyUrl' => true,
          //是否包含入口脚本名称
          'showScriptName' => false,
          //是否开启严格的请求解析,true则规则必须在rules中，false则可以不在rules中
          'enableStrictParsing' => false,
          //添加后缀
          'suffix' => '.html',
          //规则列表，用来规定如何解析和创建URL
          'rules' => [
              #posts 映射 post/index
              'posts' => 'post/index',  
              #post/5 映射 post/view
              'post/<id:\d+>' => 'post/view',
              #参数化url
              '<controller:(post|comment)>/<action:(update|delete)>' => '<controller>/<action>',
              #url配置数组
              [
                'pattern' => 'posts/<page:\d+>/<tag>',
                'route' => 'post/index',
                'defaults' => ['page' => 1, 'tag' => ''], //设置默认参数
              ]
            ]
        ]
]
```
