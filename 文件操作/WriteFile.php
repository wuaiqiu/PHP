<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>写入文件</title>
</head>

    <body>
    
    	
    <?php
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
            
            
            
	?>
    </body>
</html>