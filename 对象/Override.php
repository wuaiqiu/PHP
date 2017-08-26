<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>重写</title>
</head>

    <body>
     <?php
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
    ?>
    </body>
</html>