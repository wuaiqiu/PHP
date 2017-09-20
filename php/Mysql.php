<?php


//-------------------------------mysqli（面向过程）---------------------------//        
    
   //1.链接数据库
   $link = mysqli_connect("localhost","root","123456","students");
    
    /*
     * 打开非持久的 MySQL 连接
     * msyqli_connect("ip","user","password","dbname"):
     * 如果成功，则返回一个 MySQL 连接标识，
     *          失败则返回 FALSE。
     * */
    
    
    //2.检测连接
    if (!$link) {
    	die("Connection failed: " . mysqli_connect_error());
    }
   
    
    //3.建立查询mysqli_query(connection,query,resultmode);
    //resultmode	MYSQLI_USE_RESULT（如果需要检索大量数据，请使用这个）
   //			MYSQLI_STORE_RESULT（默认）
    $result = mysqli_query($link,"select * from users");
   
    /*
     * mysqli_query("sql语句");
     *
     * 1.执行没有数据返回的语句(insert , update , delete , create tables等)
     *      返回true，表示执行成功
     *      返回false，表示执行失败
     *
     * 2.执行有数据返回的语句(select , show tables , show databases等)
     *      返回false，表示执行失败
     *      如果成功，返回一个“结果集”
     * */
    
    
    
    
    //4.解析结果集
    //mysqli_error(connection) 函数返回最近调用函数的最后一个错误描述。

    if(!$result){
            echo "语句执行失败,原因如下:<br/>".mysqli_error($link);
    }else{
        while( $rec = mysqli_fetch_array($result) ){
            echo "<br/>".var_dump($rec);
        }
    }
    
    
    //5.关闭链接
    mysqli_close($link);
    /* 
    脚本一结束，到服务器的连接就被关闭，除非之前已经明确调用 mysqli_close() 关闭了。
    msyqli_close()只能关闭非持久链接
     */
    
    
    
  /*   
    array(6) {  [0]=> string(1) "1" 
                ["id"]=> string(1) "1" 
                [1]=> string(8) "zhangsan" 
                ["name"]=> string(8) "zhangsan" 
                [2]=> string(3) "103" 
                ["class"]=> string(3) "103" } 
    
    array(6) {  [0]=> string(1) "3" 
                ["id"]=> string(1) "3" 
                [1]=> string(4) "lisi" 
                ["name"]=> string(4) "lisi" 
                [2]=> string(3) "102" 
                ["class"]=> string(3) "102" } 
    
    array(6) { [0]=> string(1) "8" 
                ["id"]=> string(1) "8"
                [1]=> string(6) "wangwu" 
                ["name"]=> string(6) "wangwu" 
                [2]=> string(3) "102" 
                ["class"]=> string(3) "102" } 
     */
    
   

        /*
         * 解析结果集的函数
         * 
         * 1.mysqli_fetch_assoc($result):
         *      array( "id"=>"1" , "name"=>"zhangsan" , "class"=>"103" );
         *    
         * 2.mysqli_fetch_row($result):
         *      array( "1" , "zhangsan" , "103" );
         *      
         * 3.mysqli_fetch_array($result):     
         *      array( "1" , "id"=>"1" ,
         *             "zhangsan" , "name"=>"zhangsan" ,
         *             "103" , "class"=>"103" );
         * */
    
    
    
    
    
        /*
         * 其他函数
         * 
         * mysqli_num_rows($result):返回结果集的数据行数
         * 
         * mysqli_num_fields($result):返回结果集的数据列数
         * 
         * */

//---------------------------mysqli(面对对象)--------------------------------//

	//1.创建连接
	$link = new mysqli("localhost", "root", "123456", "students");
	
	//2.检查连接
	if ($link->connect_error) {
	    die("连接失败: " . $link->connect_error);
	}

	//3.建立查询
	$result = $link->query("SELECT * FROM users");

	//4.解析结果集
	if ($result) {
    		while($rec = mysqli_fetch_array($result)) {
        		echo "<br/>".var_dump($rec);
    	}
	} else {
	    echo "语句执行失败,原因如下:<br/>".$link->error;
	}
	
	//5.关闭连接
	$link->close();
	

//-----------------------------------PDO-------------------------------------//
	
	/*
         * PDO  --数据库操作工具类
         *  需要在php.ini中打开extension=php_pdo_mysql.so
         * */
   	
   	
   	
   	    /*
   	     * 1.链接数据库
   	     * */
            $dsn="mysql:host=localhost;port=3306;dbname=students";
   	    $pdo=new PDO($dsn , "root", "123456");
   	    
   	    
   	    
   	    /*
   	     * 2.执行sql语句
   	     *  query():有数据返回，成功返回pdo结果对象，失败返回false
   	     *  exec()：无数据返回，成功返回true，失败返回false
   	     * */
   	    $sql1="select * from users";
   	    $result=$pdo->query($sql1);
   	    
   	    
   	    
   	    /*
   	     * 3.解析result结果集对象
   	     *  $result->rowCount():结果集的行数
   	     *  $result->columnCount():结果集的列数
   	     *  $result->fetch("类型"):取一行数据
   	     *      PDO::FETCH_ASSOC：关联数组
   	     *      PDO::FETCH_NUM:索引数组
   	     *      PDO::FETCH_BOTH:表示两者都有
   	     *      PDO::FETCH_OBJ：表示对象
   	     *  
   	     * */
   	    if($result){
   	        
   	        while($rec = $result->fetch()){
   	            echo "<pre>";
   	            var_dump($rec);
   	            echo "</pre>";
   	        }
   	       
   	    }else{
   	        
   	        echo "<br/>错误代码: ".$pdo->errorCode();
   	        echo "<br/>错误信息: ".$pdo->errorInfo();
   	    
   	    } 	    
   	    
   	    /*
   	     * 4.关闭
   	     * $result->closeCursor()：关闭结果集
   	     * $pdo=null:关闭对象
   	     * */
   	    $result->closeCursor();
   	    $pdo=null;


//----------------------------PrePDO---------------------------------------//

	    /*
   	     * 1.链接数据库
   	     * */
            $dsn="mysql:host=localhost;port=3306;dbname=students";
   	    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=>"set names utf8");
   	    $pdo=new PDO($dsn , "root", "123456", $options);
   	    
   	    
   	    
   	    /*
   	     * 2.预处理sql语句
   	     *  a.  select * from users where id=?      #? 占位符
   	     *  b.  select * from users where id=:v1    #:v1 命名参数
   	     *  
   	     *  $pdo->prepare("sql语句");
   	     * */
   	    $sql1="select * from users where id=?";
   	    $sql2="select * from users where id=:v1";
   	    
   	    
   	    $result1=$pdo->prepare($sql1);
   	    $result2=$pdo->prepare($sql2);
   	    
   	    
   	    
   	    /*
   	     * 3.绑定数据并执行
   	     *  $result->bindValue(占位符的位置数,"value");  从1开始
   	     *  $result->bindValue(命名参数,"value");
   	     *  $result->execute()
   	     * */
   	    $result1->bindValue(1, 1);
   	    $result2->bindValue(":v1", 3);
   	    
   	    $result1->execute();
   	    $result2->execute();
   	    
   	    
   	    /*
   	     * 3.解析result结果集对象
   	     * */
   	    if(  $result1 && $result2 ){
   	        
   	        while($rec = $result1->fetch()){
   	            echo "<pre>";
   	            var_dump($rec);
   	            echo "</pre>";
   	        }
   	        while($rec = $result2->fetch()){
   	            echo "<pre>";
   	            var_dump($rec);
   	            echo "</pre>";
   	        }
   	        
   	       
   	    }else{
   	        
   	        echo "<br/>错误代码: ".$pdo->errorCode();
   	        echo "<br/>错误信息: ".$pdo->errorInfo();
   	    
   	    }
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 4.关闭
   	     * $result->closeCursor()：关闭结果集
   	     * $pdo=null:关闭对象
   	     * */
   	    $result1->closeCursor();
   	    $result2->closeCursor();
   	    $pdo=null;
	
?>