<?php


//-------------------------------php操作mysql的基本流程---------------------------//        
    
   //1.链接数据库
   $link = mysql_connect("localhost","root","123456");
    
    /*
     * 打开非持久的 MySQL 连接
     * msyql_connect("ip","user","password"):
     * 如果成功，则返回一个 MySQL 连接标识，
     *          失败则返回 FALSE。
     * */
    
    
    
    //2.设置编码
    mysql_set_charset("utf8");
    
    
    
    //3.选定数据库
    mysql_select_db("students");
    
    
    
    //4.建立查询
    $result = mysql_query("select * from users");
   
    /*
     * mysql_query("sql语句");
     *
     * 1.执行没有数据返回的语句(insert , update , delete , create tables等)
     *      返回true，表示执行成功
     *      返回false，表示执行失败
     *
     * 2.执行有数据返回的语句(select , show tables , show databases等)
     *      返回false，表示执行失败
     *      如果成功，返回一个“结果集”
     * */
    
    
    
    
    //5.解析结果集
    if(!$result){
        
            echo "语句执行失败,原因如下:<br/>".mysql_error();
   
    }else{
        while( $rec = mysql_fetch_array($result) ){
            
            echo "<br/>".var_dump($rec);
            
        }
            
    }
    
    
    //7.关闭链接
    mysql_close($link);
    /* 
    脚本一结束，到服务器的连接就被关闭，除非之前已经明确调用 mysql_close() 关闭了。
    msyql_close()只能关闭非持久链接
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
         * 1.mysql_fetch_assoc($result):
         *      array( "id"=>"1" , "name"=>"zhangsan" , "class"=>"103" );
         *    
         * 2.mysql_fetch_row($result):
         *      array( "1" , "zhangsan" , "103" );
         *      
         * 3.mysql_fetch_array($result):     
         *      array( "1" , "id"=>"1" ,
         *             "zhangsan" , "name"=>"zhangsan" ,
         *             "103" , "class"=>"103" );
         * */
    
    
    
    
    
        /*
         * 其他函数
         * 
         * mysql_num_rows($result):返回结果集的数据行数
         * 
         * mysql_num_fields($result):返回结果集的数据列数
         * 
         * mysql_field_name($result,n):返回结果集第n(0~)个列名
         * 
         * */
//-----------------------------------PDO-------------------------------------//
	
	/*
         * PDO  --数据库操作工具类
         *  需要在php.ini中打开extension=php_pdo_mysql.so
         * */
   	
   	
   	
   	    /*
   	     * 1.链接数据库
   	     * */
            $dsn="mysql:host=localhost;port=3306;dbname=students";
   	    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=>"set names utf8");
   	    $pdo=new PDO($dsn , "root", "123456", $options);
   	    
   	    
   	    
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