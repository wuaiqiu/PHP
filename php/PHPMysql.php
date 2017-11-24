<?php
//-------------------------------mysqli---------------------------//        
    
    /*
     * 1.链接数据库
     *      msyqli_connect("ip","user","password","dbname"):打开非持久的MySQL连接,如果成功，则返回一个mysqli对象
     *      mysqli_connect_error():返回上一次连接错误的错误描述
     *      
     * 2.建立查询
     *      mysqli_query(connection,query)：返回result对象
     *      
     * 3.解析结果集
     *      mysqli_fetch_assoc($result): array( "id"=>"1" , "name"=>"zhangsan" , "class"=>"103" );
     *      mysqli_fetch_row($result): array( "1" , "zhangsan" , "103" );
     *      mysqli_fetch_array($result): array( "1" , "id"=>"1" ,"zhangsan" , "name"=>"zhangsan" ,"103" , "class"=>"103" );      
     *      mysqli_error(connection) 函数返回最近调用函数的最后一个错误描述
     *      mysqli_num_rows($result):返回结果集的数据行数
     *      mysqli_num_fields($result):返回结果集的数据列数
     *  
     *  4.关闭链接
     *      msyqli_close()：只能关闭非持久链接
     * */

    $link = mysqli_connect("localhost","root","123456","students");
 
    if (!$link) {
    	die("Connection failed: " . mysqli_connect_error());
    }

    $result = mysqli_query($link,"select * from users");

    if(!$result){
            echo "语句执行失败,原因如下:<br/>".mysqli_error($link);
    }else{
        while( $rec = mysqli_fetch_array($result) ){
            echo "<br/>".var_dump($rec);
        }
    }

    mysqli_close($link);
    
    
    
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
    

//-----------------------------------PDO-------------------------------------//
	
        /*
         * 1.链接数据库
         *  new PDO($dsn,user,pass):初始化一个PDO对象
         *  $pdo->errorInfo(): 返回最后一次操作数据库的错误信息(数组类型)
         *  
         * 2.执行sql语句
         *  $pdo->query(sql):有数据返回，成功返回PDOStatement，失败返回false
         *  $pdo->exec(sql)：无数据返回，成功返回true，失败返回false
         *  
         * 3.解析result结果集对象
   	     *  $result->rowCount():结果集的行数
   	     *  $result->columnCount():结果集的列数
   	     *  $result->fetch("类型"):取一行数据
   	     *      PDO::FETCH_ASSOC：关联数组
   	     *      PDO::FETCH_NUM:索引数组
   	     *      PDO::FETCH_BOTH:表示两者都有
   	     *      PDO::FETCH_OBJ：表示对象
   	     *      
   	     * 4.关闭
   	     *  $result->closeCursor()：关闭结果集
   	     *  $pdo=null:关闭对象
         * */
   
            $dsn="mysql:host=localhost;port=3306;dbname=students";
   	        $pdo=new PDO($dsn , "root", "123456");
            $sql1="select * from users";
            $result=$pdo->query($sql1);
   	        if($result){
   	            while($rec = $result->fetch()){
   	                echo "<pre>";
   	                var_dump($rec);
   	                echo "</pre>";
   	            }
                $result->closeCursor();
   	        }else{
   	           var_dump($pdo->errorInfo());
            } 	    
   	        $pdo=null;


//----------------------------PDO预处理---------------------------------------//

   	      /*
   	       * 1.预处理sql语句
   	       *    a.  select * from users where id=?      #? 占位符
   	       *    b.  select * from users where id=:v1    #:v1 命名参数
   	       *    
   	       *    $pdo->prepare("sql语句")：返回PDOStatement对象
   	       * 
   	       * 2.绑定数据并执行
   	       *    $result->bindValue(占位符的位置数,"value"): 从1开始
   	       *    $result->bindValue(命名参数,"value")
   	       *    $result->execute():执行
   	       * */
   	        
       	    $dsn="mysql:host=localhost;port=3306;dbname=students";
       	    $pdo=new PDO($dsn , "root", "123456");
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       	   try{
                $sql1="select * from users where id=?";
       	       $sql2="select * from users where id=:v1";
       	       $result1=$pdo->prepare($sql1);
       	       $result2=$pdo->prepare($sql2);
   	           $result1->bindValue(1, 1);
   	           $result2->bindValue(":v1", 3);
   	           $result1->execute();
   	           $result2->execute();
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
              $result1->closeCursor();
              $result2->closeCursor();
   	          $pdo=null;
          }catch(PDOException $err){
            var_dump($err->getMessage());
          }
   	        
 //----------------------PDO事务-------------------------------------------//
	      
   	       /*
   	        * 事务处理
	        *  $pdo->beginTransaction():开启事务
	        *  $pdo->commit():提交事务
	        *  $pdo->rollBack():回滚事务
	        * */
   	        $dsn="mysql:host=localhost;port=3306;dbname=users";
            $pdo = new PDO($dsn, 'root', '123456');
            $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                $pdo->beginTransaction();
                $pdo->exec("insert into student values(13,'aa',102)");
                $pdo->exec("insert into student values(12,'bb',102)");
                $pdo->commit();
          }catch (PDOException $err){
              $pdo->rollBack();
              var_dump($err->getMessage());
        }
     
?>