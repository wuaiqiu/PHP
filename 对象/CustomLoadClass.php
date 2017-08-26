<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>自定义加载类</title>
</head>
	<body>
   
   	<?php  
   	 /*
   	  * 自定义加载类
   	  *     自动加载类只能满足个人开发加载文件
   	  *     自定义加载类可以满足团队开发（每个人有自己的加载类）
   	  *     自定义加载类会按顺序依次查找，直到找到
   	  *     
   	  *  定义形式
   	  *     spl_autoload_register("函数1"); //声明"函数1"为加载类
   	  *     spl_autoload_register("函数2"); //声明"函数2"为加载类
   	  *     ....
   	  *     
   	  *     function 函数1($className){
   	  *         //与__autoload($className)作用相同
   	  *     }
   	  *     
   	  *     function 函数2($className){
   	  *         //与__autoload($className)作用相同
   	  *     }
   	  *     
   	  *     ....
   	  * */
   	
   	    spl_autoload_register("loadFun");
   	    spl_autoload_register("loadFun2");
   	    
   	    function loadFun($className){
   	        echo "<br/>准备在loadFun中加载文件";
   	        $file="./class/{$className}.php";
   	        if(file_exists($file)){
   	               require_once $file;
   	        }
   	    }
   	    
   	    function loadFun2($className){
   	        echo "<br/>准备在loadFun2中加载文件";
   	        $file="./{$className}.php";
   	        if(file_exists($file)){
   	            require_once $file;
   	        }
   	    }
   	    
   	    
   	    $obj = new LoadClass();
   	    $obj->move();
   	    
   	    /* 
   	    准备在loadFun中加载文件
   	    准备在loadFun2中加载文件
   	    这是LoadClass的move方法
   	 */
	?>
   

    </body>
 </html>

