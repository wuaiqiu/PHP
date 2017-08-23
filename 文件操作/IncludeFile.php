<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>加载文件</title>
</head>
	<body>
   
   	<?php
        /*
         * 加载文件:
         * 1.include , require , include_once , require_once
         * 2.使用方式: 
         *          include "文件路径";
         *          include("文件路径");
         * 3.require与include的区别:
         *      require:加载文件失败时,报错并停止执行后面的代码
         *      include:加载文件失败时,报错并继续执行后面的代码
         *      
         * 4.include与include_once
         *       include_once:在include的基础上进行载入文件重复性检查
         * */    
   	
   	    
   	    //加载文件的流程
   	    echo "<br/>主文件开始加载...";
   	    include "include.php";
   	    echo "<br/>主文件结束加载...";
   	    
   	    
   	    
   	   
   	    //=======================================================
   	  
   	    
   	    
   	    
   	    //1.当遇到载入文件操作时,结束php代码，进入html
   	    echo "<br/>主文件开始加载...";
   	    ?>
   	    
<!--    2.将被载入文件的内容写入当前html位置 -->
   	    <br/>载入文件...
   		<?php
   	    echo "<br/>被加载文件开始执行...";  
	   ?>
		<br/>载入完成...
		
<!--    3.被加载文件执行后,进入主文件的php代码 -->
		<?php
		echo "<br/>主文件结束加载...";
	   ?>
   

    </body>
</html>