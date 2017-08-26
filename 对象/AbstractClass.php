<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>抽象类与抽象方法</title>
</head>

    <body>
     <?php
     
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

     
    ?>
    </body>
</html>