<?php
#1.匿名函数
$greet = function($name) {
    printf("Hello %s\r\n", $name);
};
$greet('World');

#2.从父作用域继承变量（直接传值）
$message = 'hello';
$example = function () use ($message) {
    var_dump($message);
};
$message = 'world';
$example(); //'hello',继承的变量为函数定义之前

#3.从父作用域继承变量（引用传值）
$message = 'hello';
$example = function () use (&$message) {
    var_dump($message);
};
$message = 'world';
$example(); //'world'

#4.自动绑定$this
class Test{
    public function testing(){
        return function() {
            var_dump($this);
        };
    }
}

$obj = new Test();
$function = $obj->testing();
$function();

#5.取消自动绑定$this（静态匿名函数）
class Test{
    public function testing(){
        return static function() {
            var_dump($this);
        };
    }
}

$obj = new Test();
$function = $obj->testing();
$function();