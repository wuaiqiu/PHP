<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>类方法</title>
</head>

    <body>
     <?php
       //定义一个类
       class Person{
           
        
           /*
            * 1.构造方法
            * a.方法名固定不变 __construct
            * b.该方法会在实例化对象时自动调用
            * c.主要用于对象的初始化工作
            * d.在如下情况中，对象会被销毁
            *   1)如果程序执行完成了，所有对象都会被销毁
            *   2)如果一个对象没有任何一个变量指向时，他会被销毁
            * */
           function  __construct(){
               echo "<br/>这是一个构造方法";
           }
           
           
           
           
         
           /*
            * 2.普通方法
            * a.可以在该类实例化出的对象上使用（不同对象的普通方法不同）
            * */
           function fun1(){
               echo "<br/>这是一个普通方法";
           }
           
           
           
           
           /*
            * 3.静态方法
            * a.它只属于类，但所有在该类实例化出的对象上共享(不同对象的静态方法相同)
            * b.静态方法中一般使用静态属性,不能使用普通属性，因为调用静态方法的是类
            **/
          static function fun2(){
               echo "<br/>这是一个静态方法";
           }
           
          
           
           
           /*
            * 4.析构方法
            * a.方法名固定不变 __destruct
            * b.该方法会在对象销毁前自动调用
            * c.该方法没有参数，当可以用$this表示当前对象
            * */
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
    ?>
    </body>
</html>