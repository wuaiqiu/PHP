# Model

#### 一.简介

>1.yii\base\Model被用于普通模型类的父类与数据表无关。


>2.yii\db\ActiveRecord与数据表有关联(继承自yii\base\Model)。

<br>

#### 二.普通模型

>1.定义普通模型

```
namespace app\models;

use yii\base\Model;

class ContactForm extends Model
{

    //定义属性
    public $name;
    public $email;
    public $subject;
    public $body;

    //自定义属性标签
    public function attributeLabels()
    {
        return [
            'name' => 'Your name',
            'email' => 'Your email address',
            'subject' => 'Subject',
            'body' => 'Content'
        ];
    }

    //自定义属性规则
    public function rules()
    {
        return [
            //name，email属性必须有值
            [['name','email'], 'required'],
            //email属性必须是一个有效的电子邮箱地址
            ['email', 'email']
        ];
    }

}
```

>2.获取模型属性，属性标签

```
//以对象方式获取属性
$model = new ContactForm;
$model->name = 'example';
echo $model->name;

//以数组方式获取属性
$model = new ContactForm;
$model['name'] = 'example';
echo $model['name'];

//获取属性标签
$model = new ContactForm;
echo $model->getAttributeLabel('name');
```

>3.块赋值与验证属性

```
//块赋值(当Model中有属性未赋值，则取null)
$model = new ContactForm;
$model->attributes =Yii::$app->request->post('FormArray');

//验证属性
if ($model->validate()) {
    //所有输入数据都有效
} else {
    //验证失败：$errors 是一个包含错误信息的数组
    $errors = $model->errors;
}
```

<br>

#### 三.ActiveRecord模型

```
namespace app\models;

use yii\db\ActiveRecord;

class Customer extends ActiveRecord
{
    //关联的数据表名称
    public static function tableName()
    {
        return '{{customer}}';
    }
    //数据转换
    public function getBirthdayText()
    {
        return date('Y/m/d', $this->birthday);
    }

    public function setBirthdayText($value)
    {
        $this->birthday = strtotime($value);
    }
}
```
