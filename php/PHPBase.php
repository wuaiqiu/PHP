<?php
//-------------------------------------注释-----------------------------//
     
        #单行注释
       
       //单行注释
        
        /*
         * 多行注释
         * */

//---------------------------------http报头---------------------------------//

	header("Expires: 0");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header("Content-type: text/html; charset=utf-8"); 

//------------------------------输出------------------------------------//
#echo;能够输出一个以上的字符串
echo "a","v";

#print;只能输出一个字符串，并始终返回 1
print "a";

#print_r;调试信息
print_r(array(1));

#var_dump;详细调试信息
var_dump(array(1));
?>