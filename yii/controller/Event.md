# Event

#### 一.实例事件处理器

```
事件源

namespace app\components;

use yii\base\Component;
use yii\base\Event;

class Foo extends Component
{
    const EVENT_HELLO = 'hello';

    public function bar()
    {
        $this->trigger(self::EVENT_HELLO);
    }
}
```

```
监听事件

$foo = new Foo;
//处理器是全局函数
$foo->on(Foo::EVENT_HELLO, 'function_name');
//处理器是对象方法
$foo->on(Foo::EVENT_HELLO, [$object, 'methodName']);
//处理器是静态类方法
$foo->on(Foo::EVENT_HELLO, ['app\components\Bar', 'methodName']);
//处理器是匿名函数
$foo->on(Foo::EVENT_HELLO, function ($event) {

});
//处理器是匿名函数，并传递参数
$foo->on(Foo::EVENT_HELLO, 'function_name', 'abc');
function function_name($event) {
    echo $event->data;
}
//处理器是匿名函数，并停止之后的处理器
$foo->on(Foo::EVENT_HELLO, function ($event) {
    $event->handled = true;
});
```

```
解绑事件

$foo = new Foo;
//处理器是全局函数
$foo->off(Foo::EVENT_HELLO, 'function_name');
//处理器是对象方法
$foo->off(Foo::EVENT_HELLO, [$object, 'methodName']);
//处理器是静态类方法
$foo->off(Foo::EVENT_HELLO, ['app\components\Bar', 'methodName']);
//处理器是匿名函数
$foo->off(Foo::EVENT_HELLO, $anonymousFunction);
//移除事件的全部处理器
$foo->off(Foo::EVENT_HELLO);
```

<br>

#### 二.类事件处理器(当对象触发事件时，它首先调用实例事件处理器，然后才会调用类事件处理器)

```
事件源

namespace app\components;

use yii\base\Component;
use yii\base\Event;

class Foo extends Component
{
    const EVENT_HELLO = 'hello';

    public function bar()
    {
        $this->trigger(self::EVENT_HELLO);
    }
}
```

```
监听事件

Event::on(Foo::className(), Foo::EVENT_HELLO, function ($event) {
    Yii::debug(get_class($event->sender)); //$event->sender为具体实例对象
});
```

```
解绑事件

//移除$handler
Event::off(Foo::className(), Foo::EVENT_HELLO, $handler);
//移除全部处理器
Event::off(Foo::className(), Foo::EVENT_HELLO);
```

<br>

#### 三.接口事件

```
事件源

namespace app\interfaces;

interface DanceEventInterface
{
    const EVENT_DANCE = 'dance';
}


class Dog extends Component implements DanceEventInterface
{
    public function meetBuddy()
    {
        echo "Woof!";
        $this->trigger(DanceEventInterface::EVENT_DANCE);
    }
}

class Developer extends Component implements DanceEventInterface
{
    public function testsPassed()
    {
        echo "Yay!";
        $this->trigger(DanceEventInterface::EVENT_DANCE);
    }
}
```

```
监听事件

Event::on('app\interfaces\DanceEventInterface', DanceEventInterface::EVENT_DANCE, function ($event) {
    Yii::trace(get_class($event->sender));
});
```

```
//移除$handler
Event::off('app\interfaces\DanceEventInterface', DanceEventInterface::EVENT_DANCE, $handler);
//移除所有的处理器
Event::off('app\interfaces\DanceEventInterface', DanceEventInterface::EVENT_DANCE);
```
