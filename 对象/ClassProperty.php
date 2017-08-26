<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>类属性</title>
</head>

    <body>
     <?php
        
     //定义Person类
     class Person{
         public $name;       //普通(实例)属性:可以在该类实例化出的对象上使用（不同对象的普通属性不同）
         static $count;         //静态属性:它只属于类，但所有在该类实例化出的对象上共享(不同对象的静态属性相同)
     }
        
     
     
    //使用普通属性  $对象名 -> 属性名
    $obj = new Person();
    $obj->name="张三";
    echo "<br/>obj的name属性值: ".$obj->name;
    
    /* 
        obj的name属性值: 张三
     */
    
    
    
    
    
    //使用静态属性  类名 :: $静态属性名
    $obj1 = new Person();
    $obj1->name="张三";
    Person::$count++;
    
    $obj1 = new Person();
    $obj1->name="张三";
    Person::$count++;
    
    echo "<br/>Person静态变量count值: ".Person::$count;
    
    /* 
      Person静态变量count值: 2
       */  
    ?>
    </body>
</html>