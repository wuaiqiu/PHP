<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>对象属性遍历</title>
</head>
	<body>
   
   	<?php  
    
   	/*
   	 * 对象属性遍历
   	 * 
   	 * 1.只能遍历普通属性
   	 * 2.需要考虑访问控制符的限制
   	 * 3.形式
   	 *      foreach ( $obj as $propName=>$vlaue){
   	 *              //遍历
   	 *      }
   	 * */
   	
   	function __autoload($className){
        require_once "./{$className}.php";
   	}
   	
   	$obj = new LoadClass();
   	
   	foreach ($obj as $name=>$value){
   	    echo "<br/>$name => $value";
   	}
   	
   	
   	/* 
   	name => zhangsan
   	school => 信息学院
   	 */
   	
   	$obj->showProps();
   	
   	/* 
   	name => zhangsan
   	age => 12
   	sex => 男
   	school => 信息学院
   	 */
   	
	?>
   
   

    </body>
 </html>

