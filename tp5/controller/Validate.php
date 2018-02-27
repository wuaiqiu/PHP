<?php
#验证

//1.独立验证
$validate = new Validate([
    'name'  => 'require|max:25',
    'email' => 'email'
],[
    'name.require' => '名称必须',
    'name.max'     => '名称最多不能超过25个字符',
    'email.email'  => '邮箱格式错误'
]);
$data = [
    'name'  => 'thinkphp',
    'email' => 'thinkphp@qq.com'
];
if (!$validate->check($data)) {
    dump($validate->getError());
}


//2.验证器(application/index/validate)
class User extends Validate{
    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'email'
    ];
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'email.email'  => '邮箱格式错误'
    ];
}
$data = [
    'name'=>'thinkphp',
    'email'=>'thinkphp@qq.com'
];
$validate = Loader::validate('User');
if(!$validate->check($data)){
    dump($validate->getError());
}


//3.内置规则
require             验证某个字段必须
number或者integer    验证某个字段的值是否为数字
email                验证某个字段的值是否为email地址
accepted             验证某个字段是否为为 yes, on, 或是 1
date                 验证值是否为有效的日期
alpha                验证某个字段的值是否为字母
alphaNum             验证某个字段的值是否为字母和数字
alphaDash            验证某个字段的值是否为字母和数字，下划线_及破折号-
url                  验证某个字段的值是否为有效的URL地址
ip                   验证某个字段的值是否为有效的IP地址
in                   验证某个字段的值是否在某个范围'num'=>'in:1,2,3'
between              验证某个字段的值是否在某个区间'num'=>'between:1,10'
length:num1,num2     验证某个字段的值的长度是否在某个范围'name'=>'length:4,25'
max:number           验证某个字段的值的最大长度'name'=>'max:25'
confirm              验证某个字段是否和另外一个字段的值一致'repassword'=>'require|confirm:password'
different            验证某个字段是否和另外一个字段的值不一致'name'=>'require|different:account'
eq或者=或者same       验证是否等于某个值'score'=>'eq:100'