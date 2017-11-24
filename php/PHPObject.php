<?php
//------------------------------------属性(必须有修饰符)----------------------------------------------------//
/*
 * a.局部变量
 * b.成员变量
 * c.类变量(静态变量)
 * d.类常量:必须使用 const 关键字来修饰常量；类常量必须赋值
 * e.没有final属性
 */

     class Person{
         public $name;       //全局(实例)变量
         static $count;      //类变量(静态变量)
         const CON="p";	    //类常量
     }
        

     
    //使用普通属性  $对象名 -> 属性名
    $obj = new Person();
    $obj->name="张三"; 
    
    //使用静态属性  类名 :: $静态属性名
    echo "<br/>Person静态变量count值: ".Person::$count;
    
   //使用类常量  类名::常量名
    echo "<br/>Person类的类常量CON==>". Person::CON;


//---------------------------------------方法（默认修饰符为public）---------------------------------------------//
/*
 *1.构造方法:方法名固定不变 __construct
 *2.成员方法
 *3.类方法:静态方法中一般使用静态属性,不能使用普通属性，因为调用静态方法的是类
 *4.析构方法:方法名固定不变 __destruct;该方法会在对象销毁前自动调用;该方法没有参数，当可以用$this表示当前对象
 *5.final方法（最终方法）:即不可以被继承的方法
 *6.final类(最终类)：即不可以被继承的类
 **/	

       class Person{           
           function  __construct(){
               echo "<br/>这是一个构造方法";
           } 

           function fun1(){
               echo "<br/>这是一个普通方法";
           }
          
          static function fun2(){
               echo "<br/>这是一个静态方法";
           }
           
           function  __destruct(){
               echo "<br/>这是一个析构方法";
           }
           
       }

       //调用普通方法 $对象名 -> 方法名()
       $obj1 = new Person();
       $obj1->fun1();

       //调用静态方法 类名 :: 静态方法名()
       Person::fun2();
    
        /*
       这是一个构造方法
       这是一个普通方法
       这是一个静态方法
       这是一个析构方法
       */


//-----------------------------------访问控制符-----------------------------------------//

     /*
      * 访问控制符
      * 
      *     [访问控制符] [属性/方法]
      *     
      * public : 该类的外部，该类的内部，该类的子类
      * protected : 该类的内部，该类的子类
      * private : 该类的内部
      * */
   
     class Person{
         public $name="张三";
         private $age="12";
         protected $sex="男";
         
         function fun(){
             echo "<br/>name => $this->name"; #name => 张三
             echo "<br/>age => $this->age";  #age => 12
             echo "<br/>sex => $this->sex";  #sex => 男
         }
     }
     
     
     class Student extends Person{
         
         function fun(){
             echo "<br/>name => $this->name"; #name => 张三
             echo "<br/>age => $this->age";  #Notice: Undefined property
             echo "<br/>sex => $this->sex";  #sex => 男
         }
     }
     
     
     
     $obj=new Person();
     echo "<br/>name => $obj->name";  #name => 张三
     echo "<br/>age => $obj->age";  #Fatal error
     echo "<br/>sex => $obj->sex";  #Fatal error

     
//-----------------------------------this_self_parent的区别---------------------------//
/*
 * this:表示调用该方法的对象
 * self:表示本类，即Person 
 * parent:表示该类的父类，即Biology;通常调用静态方法与静态属性
 * */
    
    //定义Biology类
     class Biology{     
        static $C="this is a variable";
     }
     
     
     //定义子类Person类
     class Person extends Biology{
         public $name;
         static $age = 12;
         function fun(){             
            echo "<br/>{$this->name}是一个人,普通对象";
            echo "<br/>他的年龄为(静态变量):".self::$age;
            echo "<br/>他说了一句话:".parent::$C;
         }   
     }
     
     
     //实例化
     $obj = new Person();
     $obj->name="张三";
     $obj->fun();
     
     /*
     张三是一个人,普通对象
     他的年龄为(静态变量):12
     他说了一句话:this is a variable
     */



//---------------------------------抽象类-----------------------------------------------//

     /*
      * 1.抽象类：不能被实例化
      *     abstract class 类名{
      *           属性;
      *           方法;
      *           抽象方法;
      *     
      *     }
      *  
      * 2.抽象方法：
      *         若继承类是普通，类必须被重写
      *         抽象方法必须在抽象类与接口中
      *        
      *        abstract function 方法名();
      * */
      
     
     
     abstract class Person{
            public $name="zhangsan";
            function  fun1(){
                echo "<br/>这是普通方法";
            }
            
            //抽象方法
            abstract function  fun2();
         
     }
     
     
     
     class Student extends Person{
         
            function fun2(){
                echo "<br/>重写Person类的抽象方法";
            }         
     }


//-------------------------------------接口-------------------------------------------//

	/*
      * 接口：只有接口抽象方法与接口常量
      *     interface 接口名{
      *         接口常量;
      *         接口抽象方法;
      *     }
      *     
      * 1.接口常量访问 
      *       接口名 :: 接口常量
      *   
      *  2.接口抽象方法不需要abstract修饰，不需要访问控制符的修饰
      * */
     interface Player{
         function stop();
         function start();
     }
     
     interface USBset{
         const width=2;
         const height=3;
         function datein();
     }
     
     
     class MP3 implements Player,USBset{
         function stop(){
             echo "<br/>重写stop方法";
         }
         
         function start() {
             echo "<br/>重写start方法";
         }
         
         function datein() {
             echo "<br/>width => ".USBset::width;
             echo "<br/>height => ".USBset::height;
             echo "<br/>重写datein方法";
         }
         
         
     }
     
     $obj = new MP3();
     $obj->start();    
     $obj->datein();
     $obj->stop();
     
     /* 
     重写start方法
     width => 2
     height => 3
     重写datein方法
     重写stop方法
      */



//-------------------------------------重载------------------------------------------------//

	/*
      * php重载
      * 1.与其他语言的重载意义不同，它是指当一个对象或类使用未定义的属性与方法时的一些处理机制
      * 
      * 2.属性重载
      * 
      * 取值 __get($prop)
      *    当一个对象访问不存在的属性时，会自动调用
      *   
      * 赋值 __set($prop,$value)
      *    当一个对象给不存在的属性赋值时，会自动调用
      *     
      * 判断 __isset($prop)
      *    当一个对象判断不存在的属性时，会自动调用
      *    
      *  销毁 __unset($prop)
      *    当一个对象销毁不存在的属性时，会自动调用
      *    
      *    
      * 3.方法重载(模拟其他语言的重载)
      *  调用普通方法 __call($methodName,$argsArray)
      *     当一个对象调用不存在的普通方法时，会自动调用
      *     利用它也可以实现其他语言的重载功能
      * 
      *  调用静态方法 __callstatic($methodName,$argsArray)
      *     当一个对象调用不存在的静态方法时，会自动调用
      *     
      * */
     class Person{
        
         public  $name="zhangsan";
         
         function  __get($prop){
             echo "<br/>$prop不能取值";
         }
        
         function __set($prop,$value){
             echo "<br/>$prop=>$value不能赋值";
         }
         
         function  __isset($prop){
             echo "<br/>$prop不能判断";
         }
         
         function  __unset($prop){
             echo "<br/>$prop不能销毁";
         }
         
         function  fun(){
             echo "<br/>这是fun方法";
         }
         
         function __call($method,$args){
             echo "<br/>$method方法不存在";
             echo "<br/>";
         }
         
     }
     
     
        $obj = new Person();
       echo  $obj->name;       #zhangsan
       echo  $obj->age;         #Notice: Undefined variable: prop不能取值
       $obj->sex="男";      #Undefined variable: value不能赋值
       isset($obj->age);    #Notice: Undefined variable: prop不能判断 
       unset($obj->sex);   # Undefined variable: prop不能销毁 
        
       $obj->fun();    #这是fun方法 
       $obj->fun1();   # Undefined variable: method方法不存在

//----------------------------------重写-----------------------------------------------------//

     /*
      * 覆盖(重写)
      * 1.含义：子类重写父类的同名属性或方法
      * 2.重写的访问控制符不能低于父类
      * 3.重写的参数列表与父类相同
      * 4.父类的私有属性不能被覆盖，但子类【可以】定义与父类同名的属性
      * 5.父类的私有方法不能被覆盖，但子类【可以】定义与父类同名的方法
      * */
     
     class A{
         public $name="zhangsan";
         private $age="12";
         function fun(){
             echo "<br/>这是a方法";
         }
         private function  fun2(){
             echo "<br/>这是a私有方法";
         }
     }
     
     class B extends A{
         public $name="lisi"; //重写属性
         public $age="13"; //定义与父类私有属性同名的属性
         
         function fun() { //重写方法
             echo "<br/>这是b方法";
         }
         function  fun2(){ //定义与父类私有方法同名的方法
             echo "<br/>这是b2方法";
         }
     }
     
     $obj=new B();
     echo "<br/>name => $obj->name";
     echo "<br/>age => $obj->age";
     $obj->fun();
     $obj->fun2();
      
      /* 
      name => lisi
      age => 13
      这是b方法
      这是b2方法
       */


//---------------------------------多态------------------------------------------//
/*
 *      java声明变量时都要给变量设定类型，所以存在什么父类引用和接口引用。而php则没有这点体现，
 * php声明变量不需要给变量设定类型，一个变量可以指向不同的数据类型。所以，php不具有像java一样
 * 的多态。
 * */

abstract class animal{
    abstract function fun();
}
class cat extends animal{
    function fun(){
        echo "cat say miaomiao...";
    }
}
class dog extends animal{
    function fun(){
        echo "dog say wangwang...";
    }
}
function work($obj){
    if($obj instanceof animal){
        $obj -> fun();
    }else{
        echo "no function";
    }
}
work(new dog());
work(new cat());



//--------------------------------继承--------------------------------------//
 /*
      * 一.构造方法（析构方法）调用问题
      *  1.父类有构造方法（析构方法）
      *     a.子类没有，实例化调用父类的构造方法（析构方法）
      *     b.子类有，实例化调用子类的构造方法（析构方法）
      *   
      *  2.父类没有构造方法（析构方法）
      *     调用子类的默认构造方法或子类的构造方法（析构方法）
      * */
     
    
     class A{
         function __construct(){
             echo "<br/> 这是父类的构造方法";
         }  
     }
     
     class B extends A{
         function __construct(){
             echo "<br/> 这是子类的构造方法";
         }
     }
     
     class C extends A{
     }
      
     $obj1=new B();
     $obj2=new C();
      
     echo "<pre>";
     var_dump($obj1);
     var_dump($obj2);
     echo "</pre>";
        
    /* 
        这是子类的构造方法
        这是父类的构造方法
        object(B)#1 (0) {
        }
        object(C)#2 (0) {
        }
    */
        
      
        
      /*
       * 二.手动调用构造方法（析构方法）
       *    当子类与父类都有构造方法（析构方法）时，默认自动调用子类的构造方法（析构方法），
       * 这是需要手动调用父类构造方法（析构方法）
       *    parent :: 构造方法名（析构方法）
       * */
        
        class P{
            function __construct() {
               echo "<br/>这是父类构造方法";
            }
        }
        
        class S extends P{
            function __construct() {
                parent::__construct();
                echo "<br/>这是子类构造方法";
            }
        }
        
        $o1=new S();
       
        /* 
        这是父类构造方法
        这是子类构造方法
         */
 
?>