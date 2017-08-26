<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>类</title>
</head>

    <body>
     <?php
           /*
            * php面向对象
            * 
            * */
     
     
     
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
       
        
        
        ?>
    </body>
</html>