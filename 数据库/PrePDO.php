<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PDO预处理</title>
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
   
   

    </body>
 </html>

