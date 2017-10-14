<?php
   
   
        /*
	 *1.array ==> json(或object ==> json)
         *  	json_encode($var)
         * */
   
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        echo json_encode($arr); 

	#{"a":1,"b":2,"c":3,"d":4,"e":5}
        
        
        
        /*
	 *2.json ==> object(或json ==> object)
         * 	    json_decode($json,$assoc=false)
         *          用于对 JSON 格式的字符串进行解码，并转换为 PHP 变量。
         *          assoc: 当该参数为 TRUE 时，将返回数组，FALSE 时返回对象。
         * 
         * */
        
        $json = '{"a":1,"b":2}';
        var_dump(json_decode($json));
        var_dump(json_decode($json, true));

        
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