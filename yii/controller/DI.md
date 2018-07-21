# DI

#### 一.注册依赖关系

```
$container = new \yii\di\Container;

//注册一个同类名的依赖关系，这个可以不写，DI自动注册
$container->set('yii\db\Connection');

//注册一个接口，并将相应的类作为依赖对象
$container->set('yii\mail\MailInterface', 'yii\swiftmailer\Mailer');

//注册一个别名依赖关系
$container->set('foo', 'yii\db\Connection');

//通过配置注册一个类
$container->set('yii\db\Connection', [
    'dsn' => 'mysql:host=127.0.0.1;dbname=demo',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
]);

//注册一个PHP回调依赖关系
$container->set('db', function ($container, $params, $config) {
    return new \yii\db\Connection($config);
});

//单例模式依赖注册
$container->setSingleton('yii\db\Connection', [
    'dsn' => 'mysql:host=127.0.0.1;dbname=demo',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
]);
```

<br>

#### 二.注入

>a.构造方法注入(自动注入Connection对象)

```
class Foo
{
    public function __construct(yii\db\Connection $connect)
    {
    }
}

$foo = $container->get('Foo');
```

>b.方法注入(自动注入Dependency对象)

```
class MyClass extends \yii\base\Component
{
    public function doSomething($param1, \my\heavy\Dependency $something)
    {
    }
}

$obj = new MyClass();
Yii::$container->invoke([$obj, 'doSomething'], ['param1' => 42]);
```

>c.setter和属性注入

```
class Foo
{
    public $bar;
    private $_qux;

    public function getQux()
    {
        return $this->_qux;
    }

    public function setQux(Qux $qux)
    {
        $this->_qux = $qux;
    }
}

$container->get('Foo', [], [
    'bar' => $container->get('Bar'),
    'qux' => $container->get('Qux'),
]);
```

>d.回调注入

```
$container->set('Foo', function () {
    $foo = new Foo(new Bar);
    // ... 其他初始化 ...
    return $foo;
});

$foo = $container->get('Foo');
```
