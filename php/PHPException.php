<?php

//-------------------------------------触发错误------------------------------------//
	
		 /*
	         * 一.错误分级（常量）
	         * 
	         * 1.系统错误
	         * 	E_ERROR：致命错误
	         * 	E_WARNING：警告错误
	         * 	E_NOTICE：提示错误
	         * 
	         * 2.用户自定义错误
	         * 	E_USER_ERROR：自定义致命错误
	         * 	E_USER_WARNING：自定义警告错误
	         *	E_NOTICE：自定义提示错误
	         * 
	         * 3.其他
	         * 	E_STRICT：严谨语法检查错误
	         * 	E_ALL：全部错误
	         * 
	         * */   
   	

   	    
   	    	/*
   	     	 * 二.触发错误;trigger_error("message",type)；仅触发E_USER_*类错误
  		 */
   	    	
   	   	 $age=200;
   	    	if($age<0 || $age>120){
   	        	trigger_error("age值错误",E_USER_WARNING);
   	    	}
   	    
   	   	 #Warning: age值错误 in /home/wu/workspace/day3/Error.php on line 46
   	    

	     /*
   	      *三.自定义错误处理器
   	      *     让系统不要去处理错误，而完全由我们（开发者）来对错误进行处理; 不能处理E_ERROR
   	      * */
   	     
   	     //1.设定由于处理错误的函数名
   	        set_error_handler("fun");
   	        
   	     //2.定义处理错误函数
   	     /*变量顺序自动由系统赋值
   	      * 	errCode:错误代码
   	      * 	errMsg:错误信息
   	      * 	errFile:发生错误的文件
   	      * 	errLine：发生错误的行号
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

//---------------------------错误处理------------------------------------------------------//

	 //1.抛出异常
        function checkNum($number){
            if($number>1){
                throw new Exception("Value must be 1 or below");
            }
            return true;
        }
        
        
        //2.捕获异常
        try{
           checkNum(2);
        }
        catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }

	

//--------------------------------自定义Exception--------------------------------------------------//

    //1.自定义Exception类
    class customException extends Exception{
        public function errorMessage(){
            // 错误信息
            $errorMsg = '错误行号:'.$this->getLine().'<br/>错误文件:'.$this->getFile()
            .'<br/>错误信息：'.$this->getMessage();
            return $errorMsg;
        }
    }
    
    //2.抛出异常
    function checkNum($number){
        if($number>1){
            throw new customException("Value must be 1 or below");
        }
        return true;
    }
    
    
   
    //3.捕获异常
    try{
        checkNum(2);
    }
    catch(customException $e)
    {
        echo 'Message: ' .$e->errorMessage();
    }

?>