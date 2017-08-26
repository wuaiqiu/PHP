<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>继承</title>
</head>

    <body>
     <?php
     
       /*
        * 继承相关概念
        * => B继承A
        * => A派生B
        * => A为父类（基类）
        * => B为子类(派生类)
        * */
     
     class A{
         public $a="这是a属性";
         function fa(){
             echo "<br/>这是a方法";
         }
     }
     
     
     class B extends A{
         public $b="这是b属性";
         function fb(){
             echo "<br/>这是b方法";
         }
     }
     
     $obj = new B();
     echo "<br>obj的属性: a = {$obj->a} , b = {$obj->b}";
     $obj->fa();
     $obj->fb();
     echo "<pre>";
     var_dump($obj);
     echo "</pre>";
     
     
     /* 
     obj的属性: a = 这是a属性 , b = 这是b属性
     这是a方法
     这是b方法
     object(B)#1 (2) {
     ["b"]=>string(13) "这是b属性"
     ["a"]=>string(13) "这是a属性"
     }
     */
    ?>
    </body>
</html>