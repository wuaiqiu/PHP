<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>JSON</title>
</head>
    <body>
  
  
   <?php
   
   
        /*
         *  json_encode($var)
         *      用于对变量进行 JSON 编码，该函数如果执行成功返回 JSON 数据，否则返回 FALSE 。
         * */
   
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        echo json_encode($arr); #{"a":1,"b":2,"c":3,"d":4,"e":5}
        
        
        
        /*
         *  json_decode($json,$assoc=false)
         *          用于对 JSON 格式的字符串进行解码，并转换为 PHP 变量。
         *          assoc: 当该参数为 TRUE 时，将返回数组，FALSE 时返回对象。
         * 
         * */
        
        $json = '{"a":1,"b":2}';
        
        echo "<br/><pre>";
        var_dump(json_decode($json));
        echo "<br/>";
        var_dump(json_decode($json, true));
        echo "</pre>";
        
        /*
         object(stdClass)#1 (2) {
                 ["a"]=>int(1)
                 ["b"]=>int(2)
          }

        array(2) {
                ["a"]=>int(1)
                ["b"]=>int(2)
          }
         */
        
	?>
    </body>
</html>