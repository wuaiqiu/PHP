<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>错误处理</title>
</head>
	<body>
   
   	<?php
        /*
         * 一.错误分级（常量）
         * 
         * 1.系统错误
         * E_ERROR：致命错误
         * E_WARNING：警告错误
         * E_NOTICE：提示错误
         * 
         * 2.用户自定义错误
         * E_USER_ERROR：自定义致命错误
         * E_USER_WARNING：自定义警告错误
         * E_NOTICE：自定义提示错误
         * 
         * 3.其他
         * E_STRICT：严谨语法检查错误
         * E_ALL：全部错误
         * 
         * */   
   	
   	
   	
   	
   	
   	    
   	    /*
   	     * 二.触发错误
   	     * 1.系统触发错误
   	     * E_ERROR：导致程序无法向后执行（调用一个不存在的方法）
   	     * E_WARNING：大多数程序向后执行，require不会（加载不存在的文件）
   	     * E_NOTICE：程序向后执行（使用不存在的变量与常量）
   	     * 
   	     * 2.触发用户自定义错误
   	     * trigger_error("message",错误代码)
   	     * */
   	
   	    //自定义错误
   	    $age=200;
   	    if($age<0 || $age>120){
   	        trigger_error("age值错误",E_USER_WARNING);
   	    }
   	    
   	    #Warning: age值错误 in /home/wu/workspace/day3/Error.php on line 46
   	    
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 三.错误报告显示及保存
   	     * 1.错误显示
   	     * （1）在php.ini中修改(全局)
   	     *      display_errors=On
   	     * （2）在网页中使用函数设置(局部)
   	     *      ini_set("display_errors",1)
   	     * 
   	     * 
   	     * 2.显示那些级别错误报告
   	     * (1)在php.ini中修改（全局）
   	     *      error_reporting: E_ALL & ～E_NOTICE
   	     * (2)在网页中使用函数设置（局部）
   	     *      ini_set("error_reporting","E_ALL & ～E_NOTICE")
   	     *      
   	     * 3.保存错误报告
   	     * (1)在php.ini中修改(全局)
   	     *      log_errors=On
   	     * (2)在网页中使用函数设置（局部）
   	     *      ini_set("log_errors","On")
   	     *      
   	     * 4.报告保存位置
   	     * (1)建立一个错误文件日志
   	     *      ini_set("error_log","/path/report.txt");
   	     * (2)使用系统日志
   	     *      ini_set("error_log","syslog");
   	     * */
   	    
   	    
        //显示错误
        ini_set("display_errors", "On");
   	    //显示错误级别
   	    ini_set("error_reporting","E_NOTICE");
   	    // fun1();     
   	    
   	     
   	     //ini_get("配置项名")：获取配置值
   	     echo "<br/>".ini_get("log_errors");
   	     echo "<br/>".ini_get("error_log");
   	     

	?>



	 /*
     	  * 四.die函数
     	  *      die("message");
     	  * */
  
    	if(!file_exists("welcome.txt"))
    	{
        	die("文件不存在");
    	}
    	else
    	{
        	$file=fopen("welcome.txt","r");
	}
   

    </body>
</html>