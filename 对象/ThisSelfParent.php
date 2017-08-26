<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>this_self_parent的区别</title>
</head>

    <body>
     <?php
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
              *表示调用该方法的对象 
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
     
     
    
    ?>
    </body>
</html>