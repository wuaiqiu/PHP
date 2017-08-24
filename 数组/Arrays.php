<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>数组</title>
</head>
	<body>
   
   	<?php  
   	   //1.数组定义
   	   $arr1=array(3,11,2,5,7); //索引数组，常规定义，下标从0开始
   	   $arr2=array("a"=>3,"dd"=>11,"acd"=>2);//关联数组，下标为字符串
   	   $arr3=array(1=>3,5=>11,88=>2);//下标可以自定义的索引数组
   	   $arr4=array(1=>3,"dd"=>11,88=>2);//索引与关联可以混合的混合数组
   	   $arr5=array(1=>3,"dd"=>11,2);//含有"自动下标"的数组，
   	                                //"自动下标"为前面最大数字下标+1
   	                                 //1=>3,"dd"=>11,2=>2
   	    
   	   echo "<br/>".var_dump($arr1);
   	   echo "<br/>".var_dump($arr2);
   	   echo "<br/>".var_dump($arr3);
   	   echo "<br/>".var_dump($arr4);
   	   echo "<br/>".var_dump($arr5);
   	   
   	  /*  
   	   array(5) { [0]=> int(3) [1]=> int(11) [2]=> int(2) [3]=> int(5) [4]=> int(7) }
   	   array(3) { ["a"]=> int(3) ["dd"]=> int(11) ["acd"]=> int(2) }
   	   array(3) { [1]=> int(3) [5]=> int(11) [88]=> int(2) }
   	   array(3) { [1]=> int(3) ["dd"]=> int(11) [88]=> int(2) }
   	   array(3) { [1]=> int(3) ["dd"]=> int(11) [2]=> int(2) } 
   	 */
   	   
   	   
   	   
   	   
   	   
   	   //2.二维数组
   	   $arr6=array(
   	        array(1,2,3),
   	       array(4,5,6,7)
   	   );
   	   
   	   echo "<br/>".var_dump($arr6);
   	 
   	   /* 
   	   array(2) { 
   	       [0]=> array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) } 
   	       [1]=> array(4) { [0]=> int(4) [1]=> int(5) [2]=> int(6) [3]=> int(7) } 
   	   } 
   	    */
   	   
   	   
   	   
   	   
   	   //3.
   	   
   	   
	?>
   

    </body>
