<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>局部范围获取全局变量</title>
</head>
	<body>
   
   	<?php  
   	 
   	    /*
   	     * 1.global关键字
   	     * 使用global声明一个与全局变量名相同的局部变量，
   	     * 该局部变量与全局变量共同指向一个数据区(引用关系)
   	     * */
   	
   	    $s1=12;
   	    function fun(){
   	        global  $s1;
   	        echo "<br/>a.局部变量s1=$s1";
   	        $s1++;
   	        echo "<br/>b.局部变量s1=$s1";
   	    }
   	    echo "<br/>a.全局变量s1=$s1";
   	    fun();
   	    echo "<br/>b.全局变量s1=$s1";
   	    
   	 /*    
   	    a.全局变量s1=12
   	    a.局部变量s1=12
   	    b.局部变量s1=13
   	    b.全局变量s1=13
   	      */
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 2.使用预定义变量$GLOBALS
   	     *  $GLOBALS['var']获取的就是这个全局变量本身
   	     * */
   	    $s2=12;
   	    function fun2(){
   	        echo "<br/>a.局部范围内s2=".$GLOBALS['s2'];
   	        $GLOBALS['s2']++;
   	        echo "<br/>b.局部范围内s2=".$GLOBALS['s2'];
   	        unset($GLOBALS['s2']);
   	    }
   	    echo "<br/>a.全局变量s2=$s1";
   	    fun2();
   	    var_dump(isset($s2));
   	    
   	    /* 
   	    a.全局变量s2=13
   	    a.局部范围内s2=12
   	    b.局部范围内s2=13
   	    bool(false)
   	     */
   	    
	?>
   

    </body>
</html>