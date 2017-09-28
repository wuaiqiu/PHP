<?php

//-----------------------------变量------------------------------------------//
    
   /*
        *1.变量的名称和值的关系可以称为“引用”
        *2.变量名必须以"$"开头
        *3.定义一个变量后必须进行赋值
        * */
	
	   //isset($var):判断变量是否存在，如果存在返回true，否则返回false
	   $v1=isset($s1);     #返回false
	   $s2=2;
	   $v2=isset($s2);     #返回true
	   $s3=false;
	   $v3=isset($s3);     #返回true
	   $s4="";
	   $v4=isset($s4);     #返回true
	   $s5=null;
	   $v5=isset($s5);     #返回false
	      
	   
	   
	   
	   //unset($var)：删除变量
	   $s6=23;
	   $v61=isset($s6);    #返回true
	   unset($s6);
	   $v62=isset($s6);    #返回false
	
	   
	   
	   //变量传值方式(1.值传递，2.引用传递)
	   //1.值传递，两个变量各自拥有各自的数据空间，互不影响
	   $s7=7;
	   $v7=$s7;
	   
	   //2.引用传递，两个变量共有一个数据空间
	   $s8=8;
	   $v8=&$s8;
	   

	   
	   //可变变量，php变量的特殊
	   $s9="abc";
	   $abc=1;
	   echo $$s9;  #输出1
	   
	   
	   
	   
	   
	   //empty($var):检查一个变量是否为空,若变量不存在,或者变量存在且其值为""、0、"0"、null、
	   //false、array();则返回 TURE
	   $v10=empty($s10);       #返回true
	   $s11="";
	   $v11=empty($s11);       #返回true
	   $s12=0;
	   $v12=empty($s12);       #返回true
	   $s13="0";
	   $v13=empty($s13);       #返回true
	   $s14=null;
	   $v14=empty($s14);       #返回true
	   $s15=false;
	   $v15=empty($s15);       #返回true
	   
	   
//----------------------------------常量------------------------------------------------//

	 /*1.常量无需"$"
     	  *2.常量一旦定义就不可以改变和销毁
          *3.常量只能存储基本类型数据(整型，浮点型，布尔型，字符串)
          *4.常量具有超全局范围
          *5.在php中，使用一个未定义的变量时，会报错；使用一个未定义的常量时，也会报错，但会将常量名
          *作为常量值赋值给未定义的常量
          * */
	
	
	
	//常量定义方法一: define("常量名",常量值)函数定义
	define("PI",3.14 );
	define("SCHOOL","ncu");
	
	echo "<br/>常量PI的值为".PI;   //注意不能写在引号里面，与变量解析不同
	echo "<br/>常量SCHOOL的值为".SCHOOL;
	
	
	
	
	//常量定义方法二: const 常量名 = 常量值; 关键字定义
	const CC1 = 3.14;
	const CC2 = "php";
	
	echo "<br/>常量CC1的值为".CC1;
	echo "<br/>常量CC2的值为".CC2;
	
	
	
	
	//使用常量的另一种方法:  constant("常量名")函数取值
	$s1=constant("PI");
	echo "s1=$s1";
	
	
	
	
	//defined("常量名"): 判断常量是否存在
    	var_dump(defined("PI")); //true
    	var_dump(defined($s1)); //false
    
    
    
    
    	//未定义变量与常量的区别
    	echo "s2=$s2";             //报错;s2=
    	echo "S2=".S2;              //报错;S2=S2
    
    
    
   	 //预定义常量
   	echo "<br/>M_PI=".M_PI;         //圆周率；M_PI=3.1415926535898
    	echo "<br/>PHP_OS=".PHP_OS;     //操作系统；PHP_OS=Linux
    	echo "<br/>PHP_VERSION=".PHP_VERSION; //PHP版本号；PHP_VERSION=5.3.29
    	echo "<br/>PHP_INT_MAX=".PHP_INT_MAX; //PHP整型最大值；PHP_INT_MAX=9223372036854775807
    
    
    
    	//魔术常量(会因环境不同而发生改变)
    	echo __FILE__;          //当前页面的绝对路径；/home/wu/workspace/day1/Constant.php
    	echo __DIR__;           //当前页面的父目录；/home/wu/workspace/day1
    	echo __LINE__;          //当前代码行；69


//----------------------------------------变量作用域--------------------------------------------//
	
	   /*
   	     * 1.局部变量
   	     *      就是指在一个函数中的变量
   	     *      注意局部范围不能访问全局范围的变量
   	     *      
   	     * 2.全局变量
   	     *      就是指在函数外的变量；
   	     *      注意全局范围不能访问局部范围的变量
   	     *      
   	     * 3.超全局变量
   	     *       就是所有范围；如预定义变量($_GET，$_POST等)
   	     *       注意局部与全局范围都可以访问超全局变量
   	     * 
   	     * 4.静态变量
   	     *      在全局范围中，没有作用
   	     *      在局部范围中，只赋值一次，并不会随调用函数的结束而销毁
   	     *
   	     * */
   	      
   	
   	
   	     //全局变量
   	       $s1=123;
       	    //静态全局变量
   	       static $s2=456;
   	       echo "<br/>s1=".(--$s1);     
   	       echo "<br/>s2=".(--$s2);
   	       
   	     /*   s1=122
   	          s2=455
   	       
   	          s1=122
   	          s2=455 */
   	     
   	       
   	       
   	       
   	    
   	      function fun1(){
   	          //局部变量
   	          $v1=321;
   	          //局部静态变量
   	          static $v2=654;
   	          echo "<br/>v1=".(--$v1);
   	          echo "<br/>v2=".(--$v2);
   	          
   	      }
   	      
   	      fun1();
   	      fun1();
   	      
   	     /* v1=320
   	        v2=653
   	        
   	        v1=320
   	        v2=652 */

//--------------------------------局部范围获取全局变量--------------------------------------//

	 /*
   	     * 1.global关键字
   	     * 使用global声明一个与全局变量名相同的局部变量，
   	     * 该局部变量与全局变量共同指向一个数据区(引用关系)
   	     * */
   	
   	    $s1=12;
   	    function fun(){
   	        global  $s1;
   	        echo "<br/>a.局部变量s1=$s1";
   	        $s1++;
   	        echo "<br/>b.局部变量s1=$s1";
   	    }
   	    echo "<br/>a.全局变量s1=$s1";
   	    fun();
   	    echo "<br/>b.全局变量s1=$s1";
   	    
   	 /*    
   	    a.全局变量s1=12
   	    a.局部变量s1=12
   	    b.局部变量s1=13
   	    b.全局变量s1=13
   	      */
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 2.使用预定义变量$GLOBALS
   	     *  $GLOBALS['var']获取的就是这个全局变量本身
   	     * */
   	    $s2=12;
   	    function fun2(){
   	        echo "<br/>a.局部范围内s2=".$GLOBALS['s2'];
   	        $GLOBALS['s2']++;
   	        echo "<br/>b.局部范围内s2=".$GLOBALS['s2'];
   	        unset($GLOBALS['s2']);
   	    }
   	    echo "<br/>a.全局变量s2=$s1";
   	    fun2();
   	    var_dump(isset($s2));
   	    
   	    /* 
   	    a.全局变量s2=13
   	    a.局部范围内s2=12
   	    b.局部范围内s2=13
   	    bool(false)
   	     */


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
