<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Date函数</title>
</head>
	<body>
   
   	<?php  
   	    /*
   	     * date("Y-m-d  H:i:s"):格式化本地日期和时间，并返回已格式化的日期字符串
   	     * date_default_timezone_set("Asia/Shanghai"):局部,设置脚本中所有日期/时间函数使用的默认时区
   	     * date_default_timezone_get():局部,获取脚本中所有日期/时间函数使用的默认时区
   	     * */
   	
   	
   	    echo "<br/>当前时间为:".date("Y-m-d H:i:s");
   	    echo "<br/>时区为:".date_default_timezone_get();
   	    date_default_timezone_set("Europe/Paris");
   	    echo "<br/>当前时间为:".date("Y-m-d H:i:s");
   	    echo "<br/>时区为:".date_default_timezone_get();
   	
   	    /* 
   	    当前时间为:2017-08-24 11:03:54
   	    时区为:Asia/Shanghai
   	    当前时间为:2017-08-24 05:03:54
   	    时区为:Europe/Paris
   	 */
   	
	?>
   

    </body>
</html>