<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>数据类型</title>
	</head>
<body>
	<?php
    /*
     * 1.基本数据类型：
     * 整型(int,integer)
     * 浮点型(float,double)
     * 布尔型(bool,boolean)
     * 字符串型(string)
     * 
     * 2.符合类型
     * 数值类型(array)
     * 对象类型(object)
     * 
     * 3.特殊类型
     * 空类型(null)
     * 资源类型(resource)
     * 
     * 
     * */
	
	
	
	//一.整型定义
	$s1=12;    //十进制定义(dec)
	$s2=012;   //八进制定义(oct);其实php底下已转换成了十进制
	$s3=0x12;  //十六进制定义(hex);其实php底下已转换成了十进制
	
	//整型进制转换函数，注意只有两种进制转换函数
	//1.10进制转换其他进制；参数为整型
	   echo "<br/>12的二进制".decbin(12);  #12的二进制1100
	   echo "<br/>12的八进制".decoct(12);  #12的八进制14
	   echo "<br/>12的十六进制".dechex(12);#12的十六进制c
	   
	  //2.其他进制转换10进制；参数为字符串；
	   echo "<br/>101（二进制）的十进制".bindec("101"); #101（二进制）的十进制5
	   echo "<br/>101（八进制）的十进制".octdec("101"); #101（八进制）的十进制65
	   echo "<br/>101（十六进制）的十进制".hexdec("101");#101（十六进制）的十进制257
	   //当字符串有其他非数值字符，只取符合指定类型的数值
	   echo "<br/>101（二进制）的十进制".bindec("a1a0a1a");#101（二进制）的十进制5
	   
	   
	   
	   
	 //二.浮点型定义;
	 $s4=1.23;     #一般表示方法
	 $s5=1.23E3;   #科学计数法
	 
	 //当一个整型超过PHP_INT_MAX范围时，会变成浮点类型
	 $s6=PHP_INT_MAX+1;    
	 echo "<br/>s6的类型".gettype($s6);       #s6的类型double
	 
	 
	 
	 
	 //三.字符串类型定义
	 //1.双引号定义:可以识别 \" , \\ , \n , \t , \r , \$ 转义符；可以识别变量
	 $str1="abc";      #abc
	 $str11="a\"bc";   #a"bc
	 $str12="a\$bc";   #a$bc
	 $str13="a\bc";    #当"\"在字符中间时可以不转义；a\bc

	 
	 //2.单引号定义:可以识别 \' , \\ 转义符;不能识别变量
	 $str2='abc';      #abc
	 $str21='a\'bc';   #a'bc
	 $str22='a\bc';    #当"\"在字符中间时可以不转义；a\bc
	 $str23='a$bc';    #a$bc
	 
	 
	 //3.双引号定界符定义:STR3为标识符，最后标识符必须独占一行
	 //可以识别 \\ , \n , \t , \r , \$ 转义符
$str3=<<<"STR3"
	    abc ab\\c a"bc a'bc a\$bc
STR3;
#abc ab\c a"bc a'bc a$bc
    
  
    //4.单引号定界符定义:没有转义符,全不需要转义
$str4=<<<'STR4'
        abc a\bc a'bc a"bc a$bc
STR4;
#abc ab\c a'bc a"bc
	 
   
	 
	 
	 

	 //四.gettype($var):获取该变量的类型
	 echo "<br/>s1的类型".gettype($s1);       #s1的类型integer
	 echo "<br/>s4的类型".gettype($s4);       #s4的类型double
	 echo "<br/>str1的类型".gettype($str1);   #str1的类型string
	 
	
    ?>
</body>
</html>
