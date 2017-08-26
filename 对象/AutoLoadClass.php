<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>自动加载类</title>
</head>
	<body>
   
   	<?php  
   	 
   	/*
   	 * 自动加载类 __autoload($className)
   	 *  当某行代码需要某个类的时候，php会自动按需加载某个类
   	 *  注意需要加载的类文件名与类名相同
   	 * */
   	
   	function __autoload($className){
   	    require_once "./{$className}.php";
   	}
   	
   	//当new出一个对象时,会自动加载相应的类
   	$obj = new LoadClass();
   	echo $obj->name;
   	$obj->move();
   	
   	
   	/* 
   	zhangsan
   	这是LoadClass的move方法
   	 */
	?>
   

    </body>
 </html>

