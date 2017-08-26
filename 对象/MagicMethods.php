<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>魔术方法</title>
</head>
	<body>
   
   	<?php  
    /*
     * __toString()方法
     *  将一个对象以字符串输出
     *  
     *  __invoke()方法
     *   当将对象以函数调用时会触发此方法
     * */    
   	
   	class Person{
   	    public $name="zhangsan";
   	    public $age="12";
   	    function __toString(){
   	        return "<br/>name => $this->name<br/>age => $this->age";
   	    }
   	    function __invoke(){
   	        echo "<br/>这是一个对象，不要当做函数用...";
   	    }
   	    
   	}
   	
   	$obj = new Person();
   	echo $obj;
   	
   	/* 
   	name => zhangsan
   	age => 12
   	 */
   	
   	$obj();
   	
   	/* 
   	这是一个对象，不要当做函数用...
   	 */
   	
   	
   	   
   	    
   	    
	?>
   
   

    </body>
 </html>

