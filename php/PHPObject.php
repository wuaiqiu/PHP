<?php
//--------------------------类----------------------------------------//

	  //1.定义Person类
        	class Person{
            		public $name;       //属性
            		public $age;
            		public $sex;
            
            		function move(){    //方法
                		echo "<br/>{$this->name}可以移动";
            		}
            
        	}
        
        
        
        
        //2.实例化
        $obj = new Person();
        $obj->name="张三";    
        $obj->age="12";
        $obj->sex="男";
        
        var_dump($obj);
        
        
        
        /* 
        object(Person)#1 (3) { 
            ["name"]=> string(6) "张三" 
            ["age"]=> string(2) "12" 
            ["sex"]=> string(3) "男" 
        }
        
        1.在php对象中只能看见该对象的属性值，不能看到方法
        2.#1表示对象序号（由系统内部维护,不同对象的序号不同），
          每个序号分别指向一个对象的数据空间，每个变量指向一个对象序号
                $obj ----> #1 -----> object(Person){"name"=>"张三","age"=>"12","sex"=>"男"};
           因此,当$obj1=$obj;值传递只是复制一份 "#1"
                当$obj1=&$obj;引用传递只是共同指向 "#1"
	 */

//------------------------------------属性----------------------------------------------------//
/*
 * a.局部变量
 * b.成员变量
 * c.类变量(静态变量)
 * d.类常量
 *	1)使用 const 关键字来修饰常量，非类常量可以用define()
 * e.没有final属性
 */


    //定义Person类
     class Person{
         public $name;       //全局(实例)变量
         static $count;      //类变量(静态变量)
	 const CON="p";	    //类常量必须赋值
     }
        
     
     
    //使用普通属性  $对象名 -> 属性名
    $obj = new Person();
    $obj->name="张三"; 
    
    //使用静态属性  类名 :: $静态属性名
    echo "<br/>Person静态变量count值: ".Person::$count;
    
   //使用类常量  类名::常量名
    echo "<br/>Person类的类常量CON==>". Person::CON;


//---------------------------------------方法---------------------------------------------//

/*
 *1.构造方法
 *2.成员方法
 *3.类方法
 *4.析构方法
 *5.final方法（最终方法）
 *6.final类(最终类)：即不可以被继承的类
 **/	
	//定义一个类
       class Person{
           
           /*
            * 1.构造方法
            * 	a.方法名固定不变 __construct
            * 	b.该方法会在实例化对象时自动调用
            * 	c.主要用于对象的初始化工作
            * 	d.在如下情况中，对象会被销毁
            *     1)如果程序执行完成了，所有对象都会被销毁
            *     2)如果一个对象没有任何一个变量指向时，他会被销毁
            * */
           function  __construct(){
               echo "<br/>这是一个构造方法";
           } 
           
         
           /*
            * 2.成员方法
            * 	a.可以在该类实例化出的对象上使用（不同对象的普通方法不同）
            * */
           function fun1(){
               echo "<br/>这是一个普通方法";
           }
           
  
           /*
            * 3.静态方法
            * 	a.它只属于类，但所有在该类实例化出的对象上共享(不同对象的静态方法相同)
            * 	b.静态方法中一般使用静态属性,不能使用普通属性，因为调用静态方法的是类
            **/
          static function fun2(){
               echo "<br/>这是一个静态方法";
           }
           
  
           /*
            * 4.析构方法
            * 	a.方法名固定不变 __destruct
            * 	b.该方法会在对象销毁前自动调用
            * 	c.该方法没有参数，当可以用$this表示当前对象
            * */
           function  __destruct(){
               echo "<br/>这是一个析构方法";
           }

		
	  /*
           * 5.最终方法：即不可以被继承的方法
      	   *      final function 方法名{
      	   *
      	   *      }
           * */
           
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



//-------------------------------构造方法-------------------------------------//
     
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



//---------------------------------魔术方法---------------------------------------//

    /*
     * __toString()方法
     *  将一个对象以字符串输出
     *  
     *  __invoke()方法
     *   当将对象以函数调用时会触发此方法
     * */    
   	
   	class Person{
   	    public $name="zhangsan";
   	    public $age="12";
   	    function __toString(){
   	        return "<br/>name => $this->name<br/>age => $this->age";
   	    }
   	    function __invoke(){
   	        echo "<br/>这是一个对象，不要当做函数用...";
   	    }
   	    
   	}
   	
   	$obj = new Person();
   	echo $obj;
   	
   	/* 
   	name => zhangsan
   	age => 12
   	 */
   	
   	$obj();
   	
   	/* 
   	这是一个对象，不要当做函数用...
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



//------------------------------对象克隆--------------------------------------------------//

	    /*
   	     * 对象克隆
   	     * 将一个已有对象复制一份（新对象），但数据空间与原有的对象数据空间相同
   	     *  $newObj=clone $oldObj;
   	     * */
   	
   	    function __autoload($className){
   	         require_once "./{$className}.php";
   	    }
   	    
   	    $obj = new LoadClass();
   	    $obj->name="lisi";
   	    
   	    //原对象
   	    echo "<pre>","原对象";
   	    var_dump($obj);
   	    echo "</pre>","<hr/>";
   	    
   	    //值传递
   	    $obj1 = $obj;
   	    echo "<pre>","值传递";
   	    var_dump($obj1);
   	    echo "</pre>","<hr/>";
   	    
            //引用传递
   	    $obj2 = &$obj;
   	    echo "<pre>","引用传递";
   	    var_dump($obj2);
   	    echo "</pre>","<hr/>";
   	    
   	    //对象克隆
   	    $obj3 = clone $obj;
   	    echo "<pre>","对象克隆";
   	    var_dump($obj3);
   	    echo "</pre>","<hr/>";
   
   	    
/*    	    
   	    原对象object(LoadClass)#1 (1) {
   	    ["name"]=>
   	      string(4) "lisi"
            }
        
           值传递object(LoadClass)#1 (1) {
           ["name"]=>
             string(4) "lisi"
           }
        
          引用传递object(LoadClass)#1 (1) {
            ["name"]=>
             string(4) "lisi"
          }
        
          对象克隆object(LoadClass)#2 (1) {
           ["name"]=>
            string(4) "lisi"
          }
 */



//-----------------------------对象属性遍历------------------------------------------//

	/*
   	 * 对象属性遍历
   	 * 
   	 * 1.只能遍历普通属性
   	 * 2.需要考虑访问控制符的限制
   	 * 3.形式
   	 *      foreach ( $obj as $propName=>$vlaue){
   	 *              //遍历
   	 *      }
   	 * */
   	
   		function __autoload($className){
        		require_once "./{$className}.php";
   		}
   	
   		$obj = new LoadClass();
   	
   		foreach ($obj as $name=>$value){
   	    		echo "<br/>$name => $value";
   		}
   	
   	
	   	/* 
	   	name => zhangsan
	   	school => 信息学院
   	 	*/



//-----------------------------------this_self_parent的区别---------------------------//

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
         /*
          *this
          *	表示调用该方法的对象 
          * */
             
         echo "<br/>他的年龄为(静态变量):".self::$age;
         /*
          * self
          * 表示本类，即Person
          * */
             
          echo "<br/>他说了一句话:".parent::$C;
           /*
            * parent
            * 表示该类的父类，即Biology
            * 通常调用静态方法与静态属性
            * */
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
      * 3.方法重载
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

//------------------------------------标准内置类----------------------------//
	
	 /*
   	     * 标准内置类 class stdClass{}
   	     * */
  
   	    $obj1 = new stdClass();
   	    echo "<pre>","内置标准类<br/>";
   	    var_dump($obj1);
   	    echo "</pre>";
   	    
   	    /* 
   	    内置标准类
   	    object(stdClass)#1 (0) {
             }   
   	     */
   	    
   	    //1.用于存放临时属性
   	    $obj1->name="zhangsan";
   	    $obj1->age="12";
   	    
   	    echo "<pre>","内置标准类<br/>";
   	    var_dump($obj1);
   	    echo "</pre>";
   	
   	    /* 
   	    内置标准类
   	    object(stdClass)#1 (2) {
   	    ["name"]=>
   	    string(8) "zhangsan"
   	    ["age"]=>
   	    string(2) "12"
            }
   	     */


   	     /*
   	      * 2.类型转换
   	      *     array => object
   	      *     基本数据类型 => object('scalar')
   	      * */
   	    
   	    $arr=array("name"=>"lisi","age"=>"12","sex"=>"男");
   	    $obj2 = (object)$arr;
   	    
   	    echo "<pre>","array => object<br/>";
   	    var_dump($obj2);
   	    echo "</pre>";
   	   
   	    /* 
   	    array => object
   	    object(stdClass)#2 (3) {
   	    ["name"]=>
   	    string(4) "lisi"
   	    ["age"]=>
   	    string(2) "12"
   	    ["sex"]=>
   	    string(3) "男"
           }
   	     */
   	    
   	    
   	    
   	    $v1=1;
   	    $v2="abc";
   	    $v3=false;
   	    $v4=1.2;
   	    
   	    $obj3 = (object)$v1;
   	    $obj4 = (object)$v2;
   	    $obj5 = (object)$v3;
   	    $obj6 = (object)$v4;
   	   
   	    
   	    echo "<pre>","基本类型 => object<br/>";
   	    var_dump($obj3,$obj4,$obj5,$obj6);
   	    echo "</pre>";
   	    
   	    
   	    /* 
   	    基本类型 => object
   	    object(stdClass)#3 (1) {
   	    ["scalar"]=>
   	    int(1)
            }
            object(stdClass)#4 (1) {
            ["scalar"]=>
            string(3) "abc"
            }
           object(stdClass)#5 (1) {
           ["scalar"]=>
           bool(false)
           }
           object(stdClass)#6 (1) {
           ["scalar"]=>
           float(1.2)
           }
   	        
 */

//---------------------------对象序列化与反序列化----------------------------//
	
	//1..对象的序列化,会自动调用类中的__sleep()【若存在】：必须返回需要序列化的属性
   	//      function __sleep(){
        //             return array('name','age');
       //  }
   	    require_once "LoadClass.php";
   	    $obj = new LoadClass();
   	    $obj->name="lisi";
   	    $obj->school="建筑学院";
   	    $str1=serialize($obj);
   	    file_put_contents("obj.txt", $str1);
	
	
	//2.对象的反序列化,另外会调用类中__wakeup()【若存在】
   	//      function __wakeup(){
        //}
   	    require_once "LoadClass.php";
   	    $str1 = file_get_contents("obj.txt");
   	    $obj = unserialize($str1);
   	    echo "<pre>";
   	    var_dump($obj);
   	    echo "</pre>";

//------------------------------操作类与对象-------------------------------------//
	
	/*一.操作类
         * class_exists("类名") :判断一个类是否存在
         * interface_exists("接口名") :判断一个接口是否存在
         * get_class($obj) : 获取$obj的类名
         * get_parent_class($obj) :获取$obj的父类名
         * get_class_methods("类名") : 返回一个类的所有方法名(数组类型)
         * get_class_vars("类名") : 返回一个类的所有属性名与属性值(数组类型)
         * $obj instanceof 类名 :判断$obj是否为"类名"的类
         * */

	/*二.操作方法
         * is_object($obj) : 判断某个变量是否为对象
         * get_object_vars($obj) : 返回该对象的所有属性名与属性值(数组类型)
         * */


?>