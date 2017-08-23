<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>get变量</title>
	</head>
<body>
	<?php
      /*
       * 1.预定义变量:$_GET，$_POST，$_REQUEST，$_SERVER，$GLOBALS
       * 2.预定义变量均为数组
       * 3.预定义变量具有超全局作用域
       * */ 
	
	//接受get传值
	if(!empty($_GET)){
	    $date1=$_GET['date1'];
	    $date2=$_GET['date2'];
	    echo "date1=$date1<br/>";      #date1=AA
	    echo "date2=$date2<br/>";      #date2=BB
	    print_r($_GET);               #Array ( [date1] => AA [date2] => BB )
	  
	}
	
    ?>
    
<!--     方式一 -->

	<form action="" method="get">
    date1:<input type="text" name="date1"><br/>
    date2:<input type="text" name="date2"><br/>
    <button type="submit">提交</button>
    </form>
    
<!--    		方式二 -->
	
	<a href="?date1=AA&date2=BB">点击提交</a>
    
</body>
</html>