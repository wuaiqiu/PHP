<?php
//laravel的Facade实现原理

class Person {
   
    public function run($name){
        return "$name is running";
    }
}

class Facade{
    
    public static function getInstance($classname){
        return new $classname();
    }
    
    public static function __callstatic($method,$arg){
        $instance=static::getInstance(static::getFacadeAccessor());
        #调用一个对象的回调函数，并把一个数组参数作为回调函数的参数
        return call_user_func_array(array($instance,$method),$arg);
    }
    
    public static function getFacadeAccessor(){
       
    }
}

class PersonFacade extends Facade{
    
    public static function getFacadeAccessor(){
        return 'Person';
    }
}

echo PersonFacade::run('zhangsan');