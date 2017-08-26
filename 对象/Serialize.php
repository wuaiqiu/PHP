<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>序列化与反序列化</title>
</head>
	<body>
   
   	<?php  
        /*
         * 序列化 serialize($var)
         *  将一个变量的数据空间从内存中保存到硬盘上
         * 反序列化 unserialize($var)
         *  将一个已保存变量从硬盘恢复到内存中
         * */
   	
   	    //1.数据的序列化
   	    $v1=123;
   	    $str=serialize($v1);
   	    file_put_contents("v1.txt", $str); //保存到硬盘上
   	    
   	    
   	    
   	    
   	    //2.对象的序列化,会自动调用类中的__sleep()【若存在】：必须返回需要序列化的属性
   	    //      function __sleep(){
        //             return array('name','age');
         //  }
   	    require_once "LoadClass.php";
   	    $obj = new LoadClass();
   	    $obj->name="lisi";
   	    $obj->school="建筑学院";
   	    $str1=serialize($obj);
   	    file_put_contents("obj.txt", $str1);
	?>
   
   

    </body>
 </html>

