<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>对象克隆</title>
</head>
	<body>
   
   	<?php  
   	    /*
   	     * 对象克隆
   	     * 将一个已有对象复制一份（新对象），但数据空间与原有的对象数据空间相同
   	     *  $newObj=clone $oldObj;
   	     * */
   	
   	    function __autoload($className){
   	         require_once "./{$className}.php";
   	    }
   	    
   	    $obj = new LoadClass();
   	    $obj->name="lisi";
   	    
   	    //原对象
   	    echo "<pre>","原对象";
   	    var_dump($obj);
   	    echo "</pre>","<hr/>";
   	    
   	    //值传递
   	    $obj1 = $obj;
   	    echo "<pre>","值传递";
   	    var_dump($obj1);
   	    echo "</pre>","<hr/>";
   	    
        //引用传递
   	    $obj2 = &$obj;
   	    echo "<pre>","引用传递";
   	    var_dump($obj2);
   	    echo "</pre>","<hr/>";
   	    
   	    //对象克隆
   	    $obj3 = clone $obj;
   	    echo "<pre>","对象克隆";
   	    var_dump($obj3);
   	    echo "</pre>","<hr/>";
   
   	    
/*    	    
   	    原对象object(LoadClass)#1 (1) {
   	    ["name"]=>
   	    string(4) "lisi"
        }
        
        值传递object(LoadClass)#1 (1) {
        ["name"]=>
        string(4) "lisi"
        }
        
        引用传递object(LoadClass)#1 (1) {
        ["name"]=>
        string(4) "lisi"
        }
        
        对象克隆object(LoadClass)#2 (1) {
        ["name"]=>
        string(4) "lisi"
        }
 */
   	    
   	    
	?>
   

    </body>
 </html>

