<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>标准内置类</title>
</head>
	<body>
   
   	<?php  
    
   	    /*
   	     * 标准内置类 class stdClass{}
   	     * 
   	     * 
   	     * */
  
   	    $obj1 = new stdClass();
   	    echo "<pre>","内置标准类<br/>";
   	    var_dump($obj1);
   	    echo "</pre>";
   	    
   	    /* 
   	    内置标准类
   	    object(stdClass)#1 (0) {
        }   
   	     */
   	    
   	    //1.用于存放临时属性
   	    $obj1->name="zhangsan";
   	    $obj1->age="12";
   	    
   	    echo "<pre>","内置标准类<br/>";
   	    var_dump($obj1);
   	    echo "</pre>";
   	
   	    /* 
   	    内置标准类
   	    object(stdClass)#1 (2) {
   	    ["name"]=>
   	    string(8) "zhangsan"
   	    ["age"]=>
   	    string(2) "12"
        }
   	     */


   	     /*
   	      * 2.类型转换
   	      *     array => object
   	      *     基本数据类型 => object('scalar')
   	      * */
   	    
   	    $arr=array("name"=>"lisi","age"=>"12","sex"=>"男");
   	    $obj2 = (object)$arr;
   	    
   	    echo "<pre>","array => object<br/>";
   	    var_dump($obj2);
   	    echo "</pre>";
   	   
   	    /* 
   	    array => object
   	    object(stdClass)#2 (3) {
   	    ["name"]=>
   	    string(4) "lisi"
   	    ["age"]=>
   	    string(2) "12"
   	    ["sex"]=>
   	    string(3) "男"
        }
   	     */
   	    
   	    
   	    
   	    $v1=1;
   	    $v2="abc";
   	    $v3=false;
   	    $v4=1.2;
   	    
   	    $obj3 = (object)$v1;
   	    $obj4 = (object)$v2;
   	    $obj5 = (object)$v3;
   	    $obj6 = (object)$v4;
   	   
   	    
   	    echo "<pre>","基本类型 => object<br/>";
   	    var_dump($obj3,$obj4,$obj5,$obj6);
   	    echo "</pre>";
   	    
   	    
   	    /* 
   	    基本类型 => object
   	    object(stdClass)#3 (1) {
   	    ["scalar"]=>
   	    int(1)
        }
        object(stdClass)#4 (1) {
        ["scalar"]=>
        string(3) "abc"
        }
        object(stdClass)#5 (1) {
        ["scalar"]=>
        bool(false)
        }
        object(stdClass)#6 (1) {
        ["scalar"]=>
        float(1.2)
        }
   	        
 */
   	    
	?>
   
   

    </body>
 </html>

