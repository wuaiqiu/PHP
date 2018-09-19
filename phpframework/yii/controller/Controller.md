# Controller

#### 一.简介

###### 控制器

>1.控制器ID总是被以小写处理。


>2.如果一个控制器ID由多个单词组成，单词之间将由连字符连接(如 create-comment)。如控制器ID create-comment相当于控制器CreateCommentController。


>3.非模块路由格式是ControllerID/ActionID 。模块下路由格式是ModuleID/ControllerID/ActionID。


>4.如果模块与控制器同路由，以模块为准。

###### 动作

>1.Yii使用action前缀区分普通方法和操作。


>2.操作ID总是被以小写处理


>3.如果一个操作ID由多个单词组成，单词之间将由连字符连接(如 create-comment)。如操作ID create-comment相当于操作actionCreateComment。


```
namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{

  //设置默认操作,默认值为index
  public $defaultAction = 'home';

  public function actionView($id, $version = null)
  {
      //带参数的动作
  }

  public function actionHome()
  {
     //不带参数的动作
  }

}
```

<br>

#### 二.请求

```
$request = Yii::$app->request;

#等价于: $get = $_GET;
$get = $request->get();
$post = $request->post();
#等价于: $id = isset($_GET['id']) ? $_GET['id'] : null;
$id = $request->get('id');
$name = $request->post('name');
#等价于: $id = isset($_GET['id']) ? $_GET['id'] : 1;
$id = $request->get('id', 1);
$name = $request->post('name', 'wu');

#返回所有参数
$params = $request->bodyParams;
$param = $request->getBodyParam('id');

#请求方法,返回boolean
$request->isAjax
$request->isGet
$request->isPost
$request->isPut

#请求URLs(http://example.com/admin/index.php/product?id=100)
$request->url   返回/admin/index.php/product?id=100
$request->absoluteUrl 返回http://example.com/admin/index.php/product?id=100
$request->hostInfo 返回http://example.com
$request->pathInfo 返回/product
$request->queryString 返回id=100
$request->baseUrl 返回/admin
$request->scriptUrl 返回/admin/index.php
$request->serverName 返回example.com
$request->serverPort 返回80

#客户端信息
$userHost = Yii::$app->request->userHost;
$userIP = Yii::$app->request->userIP;
```

<br>

#### 三.响应

```
$headers = Yii::$app->response->headers;

#增加一个Pragma头,已存在的Pragma头不会被覆盖
$headers->add('Pragma', 'no-cache');

#设置一个Pragma头,任何已存在的Pragma头都会被丢弃
$headers->set('Pragma', 'no-cache');

#删除Pragma头并返回删除的Pragma头的值到数组
$values = $headers->remove('Pragma');

#格式化响应主体(XML,JSONP)
Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
return [
    'message' => 'hello world',
    'code' => 100,
];

#浏览器跳转
$this->redirect('http://example.com/new');
```

<br>

#### 四.别名

```
#设置别名
Yii::setAlias('@foo', '/path/to/foo');
#获取别名
Yii::getAlias('@foo');


@yii ==> 框架安装目录
@app ==> 当前运行的应用根路径
@runtime ==> 当前运行的应用的运行环境(runtime)路径
@webroot ==> 当前运行的Web应用程序的Web根目录
@web ==> 当前运行的Web应用程序的base URL
@vendor ==> Composer vendor目录
@bower ==> 包含bower包的根目录。默认为@vendor/bower
@npm ==> 包含npm包的根目录。默认为@vendor/npm
```
