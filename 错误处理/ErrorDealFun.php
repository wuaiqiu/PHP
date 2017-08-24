<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>自定义错误处理器</title>
</head>
	<body>
   
   	<?php  
   	     
   	     /*
   	      *自定义错误处理器
   	      *     让系统不要去处理错误，而完全由我们（开发者）来对错误进行处理;不能处理error级错误
   	      * */
   	     
   	     //1.设定由于处理错误的函数名
   	        set_error_handler("fun");
   	        
   	     //2.定义处理错误函数
   	     /*变量顺序自动由系统赋值
   	      * errCode:错误代码
   	      * errMsg:错误信息
   	      * errFile:发生错误的文件
   	      * errLine：发生错误的行号
   	      * */
   	        function fun($errCode,$errMsg,$errFile,$errLine){
   	                echo "<br/>errCode:$errCode";
   	                echo "<br/>errMsg:$errMsg";
   	                echo "<br/>errFile:$errFile";
   	                echo "<br/>errLine:$errLine";
   	        }
   	        
   	        echo "$var";
   	        
   	        /*
   	         *  errCode:8
             *  errMsg:Undefined variable: var
             *  errFile:/home/wu/workspace/day3/ErrorDealFun.php
             *  errLine:32
   	         * */
	?>
   

    </body>
</html>