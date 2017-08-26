<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>创建对象</title>
</head>

    <body>
     <?php
        
        //定义Person类
        class Person{
            public $name;       //属性
            public $age;
            public $sex;
            
            function move(){    //方法
                echo "<br/>{$this->name}可以移动";
            }
            
        }
        
        
        
        //1.new 类名()
          $obj =  new Person();
          
       //2.new 对象名()：创建出一个该对象的所属类的新对象
          $obj2 = new $obj();
          
        //3.new 变量名():变量的值为一个类名(可变对象)
           $v1 = "Person";
           $obj3 = new $v1();
           
         echo "<br/>",var_dump($obj),"<br/>",var_dump($obj2),"<br/>",var_dump($obj3);
        
         /* 
         object(Person)#1 (3) { ["name"]=> NULL ["age"]=> NULL ["sex"]=> NULL }
         object(Person)#2 (3) { ["name"]=> NULL ["age"]=> NULL ["sex"]=> NULL }
         object(Person)#3 (3) { ["name"]=> NULL ["age"]=> NULL ["sex"]=> NULL }
        */
        
        ?>
    </body>
</html>