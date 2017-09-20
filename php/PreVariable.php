<?php

//------------------------------------$_GET--------------------------------------------//

 	/*
       * 1.预定义变量:$_GET，$_POST，$_REQUEST，$_SERVER，$GLOBALS
       * 2.预定义变量均为数组
       * 3.预定义变量具有超全局作用域
       * */ 
	
	//接受get传值
	if(!empty($_GET)){
	    $date1=$_GET['date1'];
	    $date2=$_GET['date2'];
	    echo "date1=$date1<br/>";      #date1=AA
	    echo "date2=$date2<br/>";      #date2=BB
	    print_r($_GET);               #Array ( [date1] => AA [date2] => BB )
	  
	}


//----------------------------------$_POST------------------------------------------//

	 //接受post传值
     	if(!empty($_POST)){
         	$date1=$_POST['date1'];
         	$date2=$_POST['date2'];
         	echo "date1=$date1<br/>";      #date1=AA
         	echo "date2=$date2<br/>";      #date2=BB
         	print_r($_POST);               #Array ( [date1] => AA [date2] => BB )
     	}


//------------------------------------$_REQUEST------------------------------------//

	//接受get与post传值,request先接受get变量后接受post变量,所有当变量同名时。post变量覆盖get变量
     	if(!empty($_REQUEST)){
         	$date1=$_REQUEST['date1'];
         	$date2=$_REQUEST['date2'];
         	$date3=$_REQUEST['date3'];
         	echo "date1=$date1<br/>";      #date1=AA
         	echo "date2=$date2<br/>";      #date2=BB
         	echo "date3=$date3<br/>";      #date3=CC
         	print_r($_REQUEST);            #Array ([date3]=>CC [date1] => AA [date2] => BB)
     	}


//----------------------------------$GLOBALS----------------------------------------//

	 //globals变量:存储了全局变量
    	$v1=12;
    	$v2="ab";
   	echo "<pre>";
		print_r($GLOBALS);       
   	echo "</pre>";

//-----------------------------------$_SERVER-----------------------------------------//

	//servers变量:携带浏览器与服务器的一些信息
       print_r($_SERVER);       
	
     /*
      * [HTTP_USER_AGENT] => Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36 
      * [HTTP_REFERER] => http://localhost/day1/ 
      * [HTTP_COOKIE] => _gat=1; hibext_instdsigdip=1; _ga=GA1.1.1865895448.1499836846; _gid=GA1.1.518164521.1503292854 
      * [PATH] => /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin 
      * [SERVER_SIGNATURE] => [SERVER_SOFTWARE] => Apache/2.4.27 (Unix) PHP/5.3.29 with Suhosin-Patch 
      * [SERVER_NAME] => localhost 
      * [SERVER_ADDR] => ::1 
      * [SERVER_PORT] => 80 
      * [REMOTE_ADDR] => ::1 [
      * [DOCUMENT_ROOT] => /home/wu/workspace
      * [SCRIPT_FILENAME] => /home/wu/workspace/day1/ServersVar.php 
      * [REQUEST_METHOD] => GET
      * */

//------------------------------$_COOKIE-------------------------------------------------//

    /*
     * 1.创建cookie
     * 
     *      setcookie(name, value, expire, path, domain);
     *  
     *  2.取回cookie
     *          
     *       $_COOKIE['name'] 变量用于取回 cookie 的值
     *       
     *  3.删除cookie
     *  
     *        setcookie("name", "", time()-3600);
     * */
        
    if(isset($_COOKIE["user"])){
        echo "welcome!!!".$_COOKIE['user'];
    }else{
        setcookie("user","zhangsan",time()+3600);
    } 

//-------------------------------$_SESSION--------------------------------------------//

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