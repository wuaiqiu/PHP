<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>常量</title>
	</head>
<body>
	<?php
    /*1.常量无需"$"
     *2.常量一旦定义就不可以改变和销毁
     *3.常量只能存储基本类型数据(整型，浮点型，布尔型，字符串)
     *4.常量具有超全局范围
     *5.在php中，使用一个未定义的变量时，会报错；使用一个未定义的常量时，也会报错，但会将常量名
     *作为常量值赋值给未定义的常量
     * */
	
	
	
	//常量定义方法一: define("常量名",常量值)函数定义
	define("PI",3.14 );
	define("SCHOOL","ncu");
	
	echo "<br/>常量PI的值为".PI;   //注意不能写在引号里面，与变量解析不同
	echo "<br/>常量SCHOOL的值为".SCHOOL;
	
	
	
	
	//常量定义方法二: const 常量名 = 常量值; 关键字定义
	const CC1 = 3.14;
	const CC2 = "php";
	
	echo "<br/>常量CC1的值为".CC1;
	echo "<br/>常量CC2的值为".CC2;
	
	
	
	
	//使用常量的另一种方法:  constant("常量名")函数取值
	$s1=constant("PI");
	echo "s1=$s1";
	
	
	
	
	//defined("常量名"): 判断常量是否存在
    var_dump(defined("PI")); //true
    var_dump(defined($s1)); //false
    
    
    
    
    //未定义变量与常量的区别
    echo "s2=$s2";             //报错;s2=
    echo "S2=".S2;              //报错;S2=S2
    
    
    
    //预定义常量
    echo "<br/>M_PI=".M_PI;         //圆周率；M_PI=3.1415926535898
    echo "<br/>PHP_OS=".PHP_OS;     //操作系统；PHP_OS=Linux
    echo "<br/>PHP_VERSION=".PHP_VERSION; //PHP版本号；PHP_VERSION=5.3.29
    echo "<br/>PHP_INT_MAX=".PHP_INT_MAX; //PHP整型最大值；PHP_INT_MAX=9223372036854775807
    
    
    
    //魔术常量(会因环境不同而发生改变)
    echo __FILE__;          //当前页面的绝对路径；/home/wu/workspace/day1/Constant.php
    echo __DIR__;           //当前页面的父目录；/home/wu/workspace/day1
    echo __LINE__;          //当前代码行；69
    
    
    ?>
  
</body>
</html>