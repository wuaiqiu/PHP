# Filter

#### 一.注册过滤器

```
public function behaviors()
{
  return [
      [
         //过滤器类
        'class' => 'app\filters\ActionTimeFilter',
        //只对index与view动作起作用
        'only' => ['index', 'view']
      ],
  ];
}
```

<br>

#### 二.定义过滤器

```
namespace app\components;

use Yii;
use yii\base\ActionFilter;

class ActionTimeFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        Yii::debug("Action $action is beforeAction");
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        Yii::debug("Action $action is afterAction with $result");
        return parent::afterAction($action, $result);
    }
}
```
