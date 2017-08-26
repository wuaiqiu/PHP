<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>与类有关的方法</title>
</head>
	<body>
   
   	<?php  
        /*
         * class_exists("类名") :判断一个类是否存在
         * interface_exists("接口名") :判断一个接口是否存在
         * get_class($obj) : 获取$obj的类名
         * get_parent_class($obj) :获取$obj的父类名
         * get_class_methods("类名") : 返回一个类的所有方法名(数组类型)
         * get_class_vars("类名") : 返回一个类的所有属性名与属性值(数组类型)
         * $obj instanceof 类名 :判断$obj是否为"类名"的类
         * */
   	
   	    class A{
   	        public $name="lisi";
   	        public $age="12";
   	        function fun1(){}
   	        function fun2(){}
   	    }
   	    
   	    $obj = new A();
   	    echo "<pre>";
   	    var_dump(class_exists("A"));
   	    var_dump(get_class($obj));
   	    var_dump(get_class_methods("A"));
   	    var_dump(get_class_vars("A"));
   	    var_dump($obj instanceof A); 
   	    echo "</pre>";
   	    
   	    /* 
   	    bool(true)
   	    string(1) "A"
   	    array(2) {
   	        [0]=>
   	        string(4) "fun1"
   	        [1]=>
   	        string(4) "fun2"
   	    }
   	    array(2) {
   	        ["name"]=>
   	        string(4) "lisi"
   	        ["age"]=>
   	        string(2) "12"
   	    }
   	    bool(true)
   	     */
	?>
   
   

    </body>
 </html>

