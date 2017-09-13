<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Session</title>
</head>


    	
    <?php
        /*
         * 1.开始 PHP Session
         * 
         *      session_start():必须位于 <html> 标签之前     
         * */
  
    
    
        //2.存储 session 数据
        if(isset($_SESSION['views']))
        {
            $_SESSION['views']=$_SESSION['views']+1;
        }
        else
        {
            $_SESSION['views']=1;
        }
           
        
        
        //3.读取session数据
        echo "浏览量：". $_SESSION['views'];
            
      
        
        
         /*
          * 4.销毁session
          * 
          *         session_destroy()：彻底销毁 session：
          *         unset($_SESSION['views']):局部销毁
          * 
          * */
	?>
    </body>
</html>
