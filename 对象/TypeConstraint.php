<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>类型约束</title>
</head>
	<body>
   
   	<?php  
    /*
     * 类型约束
     * 1.php属于"弱类型"语言,不支持类型约束
     * 2.php只支持函数/方法的形参类型约束
     * 3.支持的类型约束由:
     *      function fun([array] $p1 , [class名] $p2 , [interface名] $p3){
     *              $p1必须为数组类型
     *              $p2必须为class的实例
     *              $p3必须实现interface
     *      }
     * */
   	
   	class Type{}
   	$arr=array();
   	function fun(array $v1 , Type $v2){
   	    echo "<br/>调用成功";
   	}
    $obj = new Type();
    
    fun($arr,$obj);  #调用成功
   	
	?>
   
   

    </body>
 </html>

