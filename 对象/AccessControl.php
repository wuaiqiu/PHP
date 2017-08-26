<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>访问控制符合</title>
</head>

    <body>
     <?php
     
     /*
      * 访问控制符
      * 
      *     [访问控制符] [属性/方法]
      *     
      * public : 该类的外部，该类的内部，该类的子类
      * protected : 该类的内部，该类的子类
      * private : 该类的内部
      * */
   
     class Person{
         public $name="张三";
         private $age="12";
         protected $sex="男";
         
         function fun(){
             echo "<br/>name => $this->name"; #name => 张三
             echo "<br/>age => $this->age";  #age => 12
             echo "<br/>sex => $this->sex";  #sex => 男
         }
     }
     
     
     class Student extends Person{
         
         function fun(){
             echo "<br/>name => $this->name"; #name => 张三
             echo "<br/>age => $this->age";  #Notice: Undefined property
             echo "<br/>sex => $this->sex";  #sex => 男
         }
     }
     
     
     
     $obj=new Person();
     echo "<br/>name => $obj->name";  #name => 张三
     //echo "<br/>age => $obj->age";  #Fatal error
     //echo "<br/>sex => $obj->sex";  #Fatal error
     
    
     
     $obj->fun();
     
     
     
     
     $obj1=new Student();
     $obj1->fun();
     
    ?>
    </body>
</html>