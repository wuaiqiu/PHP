<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>函数</title>
</head>
	<body>
   
   	<?php  
   	/*
   	 * 1.函数定义
   	 *      function 函数名(参数, ...){
   	 *          函数体
   	 *      }
   	 *      
   	 *      
   	 * 2.函数的参数
   	 * a.默认参数【注意设置默认值的参数尽量往右移】
   	 *      function 函数名(参数=默认值,...){
   	 *            函数体
   	 *      }
   	 *      
   	 * 
   	 *      
   	 * b.参数个数【不定义形参，但又可以传不定个数的参数，var_dump($s1,$s2..)】
   	 *      $arr=func_get_args(); 返回一个参数数组
   	 *      $value=func_get_arg(n);获取第几个值（从0开始）
   	 *      $num=func_num_args();返回参数个数
   	 *      
   	 *      
   	 * 3.可变函数（与可变变量类似）
   	 *      一个函数的名称为一个变量名
   	 *      
   	 *      
   	 * 4.匿名函数
   	 * a.将一个匿名函数赋值给一个变量
   	 *      $var=function(参数列表){
   	 *          函数体
   	 *      };
   	 * 
   	 * b.将一个匿名函数当做一个实参
   	 *      fun(1,function(参数列表){
   	 *            匿名函数体
   	 *      });
   	 * */
   	   
   	
   	
   	   //普通函数
   	   function fun1($s1,$s2){
   	       echo "<br/>$s1+$s2=".($s1+$s2);
   	   }
   	    
   	   fun1(1,2);           #1+2=3
   	   
   	   
   	   
   	   
   	   
   	   
   	   //带默认参数的函数
   	   function fun2($s1,$s2=3){
   	       echo "<br/>$s1+$s2=".($s1+$s2);
   	   }
   	   
   	   fun2(1);             #1+3=4
   	   fun2(1,2);           #1+2=3
   	   
   	   
   	   
   	   
   	   
   	   //不定参数个数的函数
   	   function fun3(){
   	       $arr=func_get_args();
           $num=func_num_args();   	      
   	       echo "<br/>共有{$num}个参数".var_dump($arr);
   	   }
   	   
   	   fun3();          #array(0) { }共有0个参数
   	   fun3(1,2);       #array(2) { [0]=> int(1) [1]=> int(2) }共有2个参数
   	   fun3(1,2,3);     #array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) }共有3个参数
   	   
   	   
   	   
   	   
   	   
   	   
   	   //可变函数
   	   function fun4(){
   	       echo "<br/>这是一个可变函数";
   	   }
   	   
   	   $v="fun4";
   	   $v();        #这是一个可变函数
   	   
   	   
   	   
   	   //匿名函数（一）
   	   $v1=function($s1,$s2){
   	       echo "<br/>$s1+$s2=".($s1+$s2);
   	   };
   	   
   	   $v1(1,2); #1+2=3
   	   
   	   
   	   //匿名函数（二）
   	   function fun5($s1,$s2){
   	       echo "<br/>s1=$s1";
   	       $s2(2,3);
   	   }
   	   
   	   fun5(1,function($v1,$v2){
   	       echo "<br/>v1=$v1";
   	       echo "<br/>v2=$v2";
   	   });
   	   
   	        /*s1=1
   	         *v1=2
   	         *v2=3
   	         */
   	   
   	   
	?>
   

    </body>
</html>