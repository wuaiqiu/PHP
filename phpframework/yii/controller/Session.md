# Session与Cookie

#### 一.Session

```
$session = Yii::$app->session;

//检查session是否开启
$session->isActive
//开启session
$session->open();
//关闭session
$session->close();
//销毁session中所有已注册的数据
$session->destroy();

//获取session中的变量值
$language = $session->get('language');
$language = $session['language'];
//设置一个session变量
$session->set('language', 'en-US');
$session['language'] = 'en-US';
//删除一个session变量
$session->remove('language');
unset($session['language']);
//检查session变量是否已存在
$session->has('language')
isset($session['language'])

//遍历所有session变量
foreach ($session as $name => $value)
```

<br>

#### 二.Cookie

```
$cookies = Yii::$app->request->cookies;
//获取名为"language"的值，如果不存在，返回默认值"en"
$language = $cookies->getValue('language', 'en');
//判断是否存在名为"language"
$cookies->has('language')


$cookies = Yii::$app->response->cookies;
//在要发送的响应中添加一个新的 cookie
$cookies->add(new \yii\web\Cookie([
    'name' => 'language',
    'value' => 'zh-CN',
]));
//删除一个 cookie
$cookies->remove('language');
```
