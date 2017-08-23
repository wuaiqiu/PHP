<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>php变量</title>
	</head>
<body>


	<?php
       /*
        *1.变量的名称和值的关系可以称为“引用”
        *2.变量名必须以"$"开头
        *3.定义一个变量后必须进行赋值
        * */
	
	   //isset($var):判断变量是否存在，如果存在返回true，否则返回false
	   $v1=isset($s1);     #返回false
	   $s2=2;
	   $v2=isset($s2);     #返回true
	   $s3=false;
	   $v3=isset($s3);     #返回true
	   $s4="";
	   $v4=isset($s4);     #返回true
	   $s5=null;
	   $v5=isset($s5);     #返回false
	   
	 /*    echo var_dump($v1);
	       echo var_dump($v2);
	       echo var_dump($v3);
	       echo var_dump($v4);
	       echo var_dump($v5); */
	   
	   
	   
	   
	   
	   
	   //unset($var)：删除变量
	   $s6=23;
	   $v61=isset($s6);    #返回true
	   unset($s6);
	   $v62=isset($s6);    #返回false
	   
	 /*   echo var_dump($v61);
	   echo var_dump($v62); */
	   
	   
	   
	   
	   
	   
	   //变量传值方式(1.值传递，2.引用传递)
	   //1.值传递，两个变量各自拥有各自的数据空间，互不影响
	   $s7=7;
	   $v7=$s7;
	   
	   //2.引用传递，两个变量共有一个数据空间
	   $s8=8;
	   $v8=&$s8;
	   
	   
	   
	   
	   
	   
	   //可变变量，php变量的特殊
	   $s9="abc";
	   $abc=1;
	   echo $$s9;  #输出1
	   
	   
	   
	   
	   
	   //empty($var):检查一个变量是否为空,若变量不存在,或者变量存在且其值为""、0、"0"、null、
	   //false、array();则返回 TURE
	   $v10=empty($s10);       #返回true
	   $s11="";
	   $v11=empty($s11);       #返回true
	   $s12=0;
	   $v12=empty($s12);       #返回true
	   $s13="0";
	   $v13=empty($s13);       #返回true
	   $s14=null;
	   $v14=empty($s14);       #返回true
	   $s15=false;
	   $v15=empty($s15);       #返回true
	   
	 /*   echo var_dump($v10);
	   echo var_dump($v11);
	   echo var_dump($v12);
	   echo var_dump($v13);
	   echo var_dump($v14);
	   echo var_dump($v15); */
	   
	
    ?>

</body>
</html>