<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>类常量</title>
</head>

    <body>
     <?php
        
     //定义Person类
     class Person{
         const CON ="类常量";  //类常量:在类中定义的常量,不能改变
                               //不能用define()定义;
                               //类常量必须赋值
         
     }
        
     //使用类常量  类名::常量名
    echo "<br/>Person类的类常量CON==>". Person::CON;
        
    
    /* 
         Person类的类常量CON==>类常量
     */
    ?>
    </body>
</html>