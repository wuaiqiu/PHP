<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>request变量</title>
	</head>
<body>
	<?php
    
	//接受get与post传值,request先接受get变量后接受post变量,所有当变量同名时。post变量覆盖get变量
     if(!empty($_REQUEST)){
         $date1=$_REQUEST['date1'];
         $date2=$_REQUEST['date2'];
         $date3=$_REQUEST['date3'];
         echo "date1=$date1<br/>";      #date1=AA
         echo "date2=$date2<br/>";      #date2=BB
         echo "date3=$date3<br/>";      #date3=CC
         print_r($_REQUEST);            #Array ([date3]=>CC [date1] => AA [date2] => BB)
     }
	
    ?>
    <form action="?date3=CC" method="post">
    date1:<input type="text" name="date1"><br/>
    date2:<input type="text" name="date2"><br/>
    <button type="submit">提交</button>
    </form>
</body>
</html>