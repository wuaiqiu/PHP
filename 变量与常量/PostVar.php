<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>post变量</title>
	</head>
<body>
	<?php
    
	   //接受post传值
     if(!empty($_POST)){
         $date1=$_POST['date1'];
         $date2=$_POST['date2'];
         echo "date1=$date1<br/>";      #date1=AA
         echo "date2=$date2<br/>";      #date2=BB
         print_r($_POST);               #Array ( [date1] => AA [date2] => BB )
     }
	
    ?>
    <form action="" method="post">
    date1:<input type="text" name="date1"><br/>
    date2:<input type="text" name="date2"><br/>
    <button type="submit">提交</button>
    </form>
</body>
</html>