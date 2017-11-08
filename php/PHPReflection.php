<?php
/*
 * 反射
 * 
 * ReflectionClass:
 * $class->getConstructor():取得该类的构造函数
 * $class->getMethod(string name):取得该类的某个特定的方法数组
 * $class->getMethods():取得该类的所有的方法数组
 * $class->getProperty(string name):取得某个特定的属性
 * $class->getProperties()：取得该类的所有属性数组
 * $class->getConstant(string name):取得该类特定常量信息
 * $class->getConstants():取得该类所有常量数组
 * 
 * ReflectionMethod:
 * $method->invoke(object,param1,param2):传多参数,传单个参数
 * $method->invokeArgs(object, array()):调用方法,传多参数
 * 
 * ReflectionParameter:
 * $param->getName():取得参数名
 * 
 * 
 * 
 * */

class Person{
    public $name="zhangsan";
    protected $age=12;
    private $sex="男";
    
    public function info1($name,$age){
        echo "This is info1".$name."--".$age;
    }
    protected function info2(){
        echo "This is info2";
    }
    private function info3(){
        echo "This is info3";
    } 
   
}

$class = new ReflectionClass('Person');//建立 Person这个类的反射类
$instance  = $class->newInstanceArgs();//实例化Person 类 

#1.获取属性(所用访问控制的属性)
$properties = $class->getProperties();
foreach($properties as $property) {
    echo $property->getName()."<br/>";
}  

#2.获取方法(所用访问控制的方法)
$methods=$class->getMethods();
foreach ($methods as $method){
    echo $method->getName().'<br/>';
}

#3.执行方法
$method=$class->getmethod('info1'); 
$method->invokeArgs($instance,['zhangsan',12]); 
