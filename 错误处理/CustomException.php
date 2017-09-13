<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>自定义Exception</title>
</head>


    	
    <?php
    //1.自定义Exception类
    class customException extends Exception
    {
        public function errorMessage()
        {
            // 错误信息
            $errorMsg = '错误行号:'.$this->getLine().'<br/>错误文件:'.$this->getFile()
            .'<br/>错误信息：'.$this->getMessage();
            return $errorMsg;
        }
    }
    
    //2.抛出异常
    function checkNum($number)
    {
        if($number>1)
        {
            throw new customException("Value must be 1 or below");
        }
        return true;
    }
    
    
   
    //3.捕获异常
    try
    {
        checkNum(2);
    }
    catch(customException $e)
    {
        echo 'Message: ' .$e->errorMessage();
    }
 
      
        
	?>
    </body>
</html>
