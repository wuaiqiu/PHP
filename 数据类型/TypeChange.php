<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>数据类型转换</title>
	</head>
<body>
	<?php
  
    //1.自动类型转换:
    //"+"在php只做算术运算符
    $s1=1+2;            #3
    $s2="1"+2;          #3
    $s3="1"+"2";        #3
    $s4=1+"2abc";       #3
    $s5=1+"a2bc";       #3
    $s6="a1"+"b2";      #3
    
    
    
    
	//2.强制类型转换:
    $v1=12;
    $v2=(float)$v1;
    $v3=(string)$v1;
    echo gettype($v1);   #integer
    echo gettype($v2);   #double
    echo gettype($v3);   #string
	
    ?>
</body>
</html>
