<?php

//-------------------------------------读取文件--------------------------------//
 	
	/*
         * 1.打开文件
         *  fopen("fileName","mode")
         *      
         *           模式	描述
         *           r	只读。在文件的开头开始。
         *           r+	读/写。在文件的开头开始。
         *           w	只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
         *           w+	读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。
         *           a	追加。打开并向文件末尾进行写操作，如果文件不存在，则创建新文件。
         *           a+	读/追加。通过向文件末尾写内容，来保持文件内容。
         */
    
                $file=fopen("welcome.txt","r");
    
                
                
          /*
           * 2.读取文件
           *        feof($file):当读完文件返回true
           *        fgets($file):逐行读取
           *        fgetc($file)：逐个字符读取
           * */
            if($file){
                
                while(!feof($file)){
                    echo fgets($file). "<br>";
                }
                
            }else{
                echo "文件打开失败";
            }
            
            
            
            
            /*
             * 3.关闭文件
             *     fclose($file)
             * */
            fclose($file);

//------------------------------------写入文件--------------------------------//

	 /*
         * 1.打开文件
         */
    
         $file=fopen("welcome.txt","a");
    
         
         /*
          * 2.写入文件
          *     fwrite("$file","string");    
          * */
         if($file){
              $string="this is file";
             fwrite($file, $string);
         }else{
             echo "文件打开失败";
         }
        
            
            /*
             * 3.关闭文件
             * */
         fclose($file);

//-----------------------------上传文件----------------------------------------//
	
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：" . $_FILES["file"]["error"] . "<br>";//由文件上传导致的错误代码
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";//上传文件的名称
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";//上传文件的类型
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";//上传文件的大小，以字节计
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];//存储在服务器的文件的临时位置
        
       
           
        if (file_exists("./" . $_FILES["file"]["name"]))   //判断文件是否存在
        {
            echo "<br/>".$_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 不存在该文件则将文件上传
            move_uploaded_file($_FILES["file"]["tmp_name"], "./" . $_FILES["file"]["name"]);
            echo "<br/>文件存储在: " . "./" . $_FILES["file"]["name"];
        }
    }


//-----------------------------加载文件----------------------------------------//
	
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

?>