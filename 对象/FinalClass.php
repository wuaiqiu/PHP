<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>最终类与最终方法</title>
</head>

    <body>
     <?php
     
        /*
         * 1.最终类：即不可以被继承的类
         *      final class 类名{
         *      
         *      }
         * */
     
     final class A{
         public $name="zhangsan";
     }
     
     
     
     
     /*
      * 2.最终方法：即不可以被继承的方法
      *      final function 方法名{
      *
      *      }
      *      
      *    注意:没有最终属性
      * */
    
     class B{
         final function fun(){
             echo "<br/>这是最终方法";
         }
         
     }
     
    ?>
    </body>
</html>