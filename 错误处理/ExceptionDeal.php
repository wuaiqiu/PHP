<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>异常处理</title>
</head>


    	
    <?php
    
        //1.抛出异常
        function checkNum($number)
        {
            if($number>1)
            {
                throw new Exception("Value must be 1 or below");
            }
            return true;
        }
        
        
        //2.捕获异常
        try
        {
           checkNum(2);
        }
        catch(Exception $e)
        {
            echo 'Message: ' .$e->getMessage();
        }
  
        
	?>
    </body>
</html>
