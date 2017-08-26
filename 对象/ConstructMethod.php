<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>构造方法与析构方法</title>
</head>

    <body>
     <?php
     /*
      * 构造方法（析构方法）调用问题
      * 1.父类有构造方法（析构方法）
      *     a.子类没有，实例化调用父类的构造方法（析构方法）
      *     b.子类有，实例化调用子类的构造方法（析构方法）
      *   
      * 2.父类没有构造方法（析构方法）
      *     调用子类的默认构造方法或子类的构造方法（析构方法）
      * */
     
    
     class A{
         function __construct(){
             echo "<br/> 这是父类的构造方法";
         }  
     }
     
     class B extends A{
         function __construct(){
             echo "<br/> 这是子类的构造方法";
         }
     }
     
     class C extends A{
     }
      
        $obj1=new B();
        $obj2=new C();
      
        echo "<pre>";
        var_dump($obj1);
        var_dump($obj2);
        echo "</pre>";
        
        /* 
        这是子类的构造方法
        这是父类的构造方法
        object(B)#1 (0) {
        }
        object(C)#2 (0) {
        }
       */
        
        
        
        
        
        
        
      /*
       * 手动调用构造方法（析构方法）
       * 当子类与父类都有构造方法（析构方法）时，默认自动调用子类的构造方法（析构方法），
       * 这是需要手动调用父类构造方法（析构方法）
       *    parent :: 构造方法名（析构方法）
       * */
        
        class P{
            function __construct() {
               echo "<br/>这是父类构造方法";
            }
        }
        
        class S extends P{
            
            function __construct() {
                parent::__construct();
                echo "<br/>这是子类构造方法";
            }
        }
        
        $o1=new S();
       
        /* 
        这是父类构造方法
        这是子类构造方法
         */
        
     
    
    ?>
    </body>
</html>