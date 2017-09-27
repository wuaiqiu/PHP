<?php 
/*
 *  控制反转（IoC ,  Inversion of Control）:它为相互依赖的组件提供抽象，将依赖（低层模块）对
 * 象的获得交给第三方（系统）来控制。
 *  依赖注入(DI , Dependency Injection）：控制反转（IoC）一种重要的方式，就是将依赖对象的创建
 * 和绑定转移到被依赖对象类的外部来实现。
 * 
 * */

//---------------------------------构造函数-------------------------------------//

//依赖对象
interface Person{

    function eat();

}

//低层对象A
class APerson implements Person{
    
    function eat(){
        echo "APerson...";
    }
}

//低层对象B
class BPerson implements Person{
    
    function eat(){
        echo "BPerson...";
    }   
}

//高层对象
class Human{
    
    private $Person;
    
   function __construct($P){
        $this->Person=$P;
    }
    
   function eat(){
        $this->Person->eat();
    }
}


$P=new BPerson();
$h=new Human($P);
$h->eat();

//--------------------------------------属性注入----------------------------------//
class Human{
        
    private $Person;
    
    function setPerson($P){
        $this->Person=$P;
    }
    
    function eat(){
        $this->Person->eat();
    }
    
}



$P=new APerson();
$h=new Human();
$h->setPerson($P);
$h->eat();

//--------------------------------接口注入---------------------------------//
interface IDependent{
    
    function setID($P);

}

class Human implements IDependent{
    
    private $Person;
    
    function setID($P){
        $this->Person=$P;
    }
    
    function eat(){
        $this->Person->eat();
    }
}

$P=new BPerson();
$h=new Human();
$h->setID($P);
$h->eat();

//--------------------依赖注入容器 (dependency injection container)------------//
//IoC容器类：负责实例化，注入依赖，处理依赖关系等工作。当依赖关系较为复杂时使用
class Container{
        
    private $s=array();
    
    function __set($k, $c){
        $this->s[$k] = $c;
    }
    
    function __get($k){
        return $this->s[$k]($this);
    } 
    
}

class Human{
    
    private $Person;
    
    function __construct($P){
        $this->Person=$P;
    }
    
    function eat(){
        $this->Person->eat();
    }
}

$con=new Container();
//注册对象
$con->Person=function(){
    return new BPerson();
};
$con->Human=function($con){
    return new Human($con->Person);
};
//获取对象
$h=$con->Human;
$h->eat();

?>