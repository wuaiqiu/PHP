<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>与对象有关的方法</title>
</head>
	<body>
   
   	<?php  
        /*
         * is_object($obj) : 判断某个变量是否为对象
         * get_object_vars($obj) : 返回该对象的所有属性名与属性值(数组类型)
         * */
   	
   	class B{
   	    public $name="lisi";
   	    public $age="12";
   	    function fun1(){}
   	    function fun2(){}
   	}
   	
   	
   	$obj = new B();
   	echo "<pre>";
   	var_dump(is_object($obj));
   	var_dump(get_object_vars($obj));
   	echo "</pre>";
   	
   	/* 
   	bool(true)
   	array(2) {
   	    ["name"]=>
   	    string(4) "lisi"
   	    ["age"]=>
   	    string(2) "12"
   	}
   	 */
   	    
	?>
   
   

    </body>
 </html>

