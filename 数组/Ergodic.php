<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>数组遍历</title>
</head>
	<body>
   
   	<?php  
   	
   	
   	  /*
   	   * 1.foreach遍历
   	   *    foreach($array as $key=>$value){
   	   *    
   	   *    }
   	   * */
   	
   	$arr1=array(1=>3,"dd"=>11,88=>2);
   	foreach($arr1 as $key=>$value){
        echo "<br/>{$key}=>{$value}";
   	}
   	/* 
   	1=>3
   	dd=>11
   	88=>2
   	 */
   	
   	
   	
   	
   	
   	/*
   	 * 2.for-next遍历
   	 * */
   	$arr2=array(1=>3,"dd"=>11,88=>2);
   	$len=count($arr2);
   	for($i=0;$i<$len;$i++){
   	    $key=key($arr2);
   	    $value=current($arr2);
   	    echo "<br/>{$key}=>{$value}";
   	    next($arr2);
   	}
   	/* 
   	1=>3
   	dd=>11
   	88=>2
   	 */
   	
   	
   	
   	
   	
   	/*
   	 * 3.while-each-list遍历
   	 *  foreach的内部实现方式
   	 * */
   	
   	$arr3=array(1=>3,"dd"=>11,88=>2);
   	while(  list($key,$value)=each($arr3) ){
   	    echo "<br/>{$key}=>{$value}";
   	}
   	/* 
   	1=>3
   	dd=>11
   	88=>2
   	 */
   	
   	
   	
   	
   	
   	/*
   	 * 4.遍历的一些细节
   	 * a.数组遍历默认为值传递，也可以为引用传递
   	 *  foreach($arr as $key=>&$value){}
   	 * b.foreach默认在原数组上遍历
   	 * */
   	
   	
   	//引用传递
   	$arr4=array(1,2,3);
   	foreach ($arr4 as $k=>&$v){
   	    $v*=2;
   	}
   	
   	var_dump($arr4);
   	/* 
   	array(3) { [0]=> int(2) [1]=> int(4) [2]=> &int(6) }
   	 */
   	
   	
   	
   	//foreach默认在原数组上遍历
   	$arr5=array(1=>3,"dd"=>11,88=>2);
   	foreach($arr5 as $k=>$v){
   	    echo "<br/>{$k}=>{$v}";
   	    if($k=="dd"){
   	        break;
   	    }
   	}
   	$v1=current($arr5);
   	$k1=key($arr5);
   	echo "<br/>当前指针所指向的键值对:\t$k1=>$v1";
   /* 	
   	1=>3
   	dd=>11
   	当前指针所指向的键值对:	88=>2
   	 */
   	
   	
	?>
   
   	
   

    </body>
