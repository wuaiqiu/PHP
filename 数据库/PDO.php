<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PDO</title>
</head>
	<body>
   
   	<?php  
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
   	    
   	    
   	    
   	    
	?>
   
   

    </body>
 </html>

