<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>序列化与反序列化</title>
</head>
	<body>
   
   	<?php  
     
   	
   	    //1.数据的反序列化
   	    $str = file_get_contents("v1.txt");
   	    $v1 = unserialize($str);
   	    echo "<br/>v1 => $v1";
   	    
   	    
   	    
   	    
   	    //2.对象的反序列化,另外会调用类中__wakeup()【若存在】
   	    //      function __wakeup(){
        //}
   	    require_once "LoadClass.php";
   	    $str1 = file_get_contents("obj.txt");
   	    $obj = unserialize($str1);
   	    echo "<pre>";
   	    var_dump($obj);
   	    echo "</pre>";
   	    
   	    
   	    
   	    
	?>
   
   

    </body>
 </html>

