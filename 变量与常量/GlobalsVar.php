<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>globals变量</title>
	</head>
<body>
	<?php
    
	   //globals变量:存储了全局变量
    $v1=12;
    $v2="ab";
   echo "<pre>";
	print_r($GLOBALS);       
   echo "</pre>";
     
   /*
    *[_POST] => Array()
    *[_GET]=>Array()
    *[_COOKIE]=>Array()
    *[_FILE]=>Array()
    *[v1]=12
    *[v2]=ab
    * */
    ?>
  
</body>
</html>