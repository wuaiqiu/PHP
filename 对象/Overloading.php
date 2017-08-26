<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>重载</title>
</head>

    <body>
     <?php
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
     
     
    ?>
    </body>
</html>