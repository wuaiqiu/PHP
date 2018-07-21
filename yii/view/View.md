# View

#### 一.渲染视图

>a.控制器中渲染

```
//渲染一个view视图并使用布局
return $this->render("view.php",["a"=>$a]);

//渲染一个view视图不使用布局
return $this->renderPartial("view.php",["a"=>$a]);
```

>b.视图中渲染

```
//加载当前目录下的overview.php
<?=$this->render('overview')?>
```

>c.其他地方渲染

```
//显示视图文件 "@app/views/site/license.php"
echo Yii::$app->view->renderFile('@app/views/site/license.php');
```

<br>

#### 二.创建视图

```
//直接取值
<?= $a ?>

//安全取值
<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<?= Html::encode($a) ?>
<?= HtmlPurifier::process($a) ?>
```

<br>

#### 三.布局

>1.应用布局默认存储在@app/views/layouts目录下

>2.模块布局默认存储在module/views/layouts目录下

```
namespace app\controllers;

use yii\web\Controller;

class PostController extends Controller
{
    //指定布局文件(默认为main),若模块未指定使用应用布局
    public $layout = 'post';
}
```

>3.布局结构

```
布局文件

<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <header>My Company</header>
    <?= $content ?>
    <footer>&copy; 2014 by My Company</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
```

```
视图文件

<?php
    use yii\web\View;
    #指定title
    $this->title='Hello';
    #往head中注册meta标签
    $this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php']);
    #往head中注Link标签
    $this->registerLinkTag([
        'rel' => 'stylesheet',
        'href' => 'css/style.css'
    ]);
    #往beginPage添加
    \Yii::$app->view->on(View::EVENT_BEGIN_PAGE,function (){
       echo "<h1>EVENT_BEGIN_PAGE</h1>";
    });
    #往beginBody添加
    \Yii::$app->view->on(View::EVENT_BEGIN_BODY,function (){
       echo "<h1>EVENT_BEGIN_BODY</h1>";
    });
    #往endBody添加
    \Yii::$app->view->on(View::EVENT_END_BODY, function () {
        echo "<h1>EVENT_END_BODY</h1>";
    });
    #往endPage添加
    \Yii::$app->view->on(View::EVENT_END_PAGE,function (){
        echo "<h1>EVENT_END_PAGE</h1>";
    })
?>
```

>4.使用数据块

```
布局文件

<?php if (isset($this->blocks['block'])): ?>
    <?= $this->blocks['block'] ?>
<?php else: ?>
    ... default content for block ...
<?php endif; ?>
```

```
视图文件

<?php $this->beginBlock('block'); ?>
    ...content of block...
<?php $this->endBlock(); ?>
```
