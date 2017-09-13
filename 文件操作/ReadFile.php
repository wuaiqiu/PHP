<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>读取文件</title>
</head>

    <body>
    
    	
    <?php
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
            
            
            
	?>
    </body>
</html>