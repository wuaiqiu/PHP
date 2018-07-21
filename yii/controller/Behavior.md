# Behavior


#### 一.定义行为

```
namespace app\components;

use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public  $prop1;
    private $_prop2;

    public function getProp2()
    {
        return $this->_prop2;
    }

    public function setProp2($value)
    {
        $this->_prop2 = $value;
    }

    public function foo()
    {
      echo "foo";
    }

    public function events()
    {
       return [
           ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
       ];
   }

   public function beforeValidate($event)
   {
       //处理器方法逻辑
   }
}
```

<br>

#### 二.使用行为

>1.mixin类

```
namespace app\models;

use yii\db\ActiveRecord;
use app\components\MyBehavior;

class User extends ActiveRecord
{
    public function behaviors()
    {
        return [
            //a.匿名行为，只有行为类名
            MyBehavior::className(),
            //b.匿名行为，配置数组
            [
                'class' => MyBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
            ],

            //c.命名行为，只有行为类名
            'myBehavior2' => MyBehavior::className(),
            //d.命名行为，配置数组
            'myBehavior4' => [
                'class' => MyBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
            ]
        ];
    }
}
```

>2.使用行为

```
$component = new User;

//使用行为类属性与方法
$component->prop1 = $value;
$component->foo();
//移除行为
$component->detachBehavior('myBehavior1');
//移除全部行为
$component->detachBehaviors();
```
