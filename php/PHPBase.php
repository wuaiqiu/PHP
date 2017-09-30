<?php
//-------------------------------------注释-----------------------------//
     
        #单行注释
       	//单行注释
        
        /*
         * 多行注释
         * */



//---------------------------------http报头---------------------------------//
//采用php设置http报头。
	header(string,replace)
		#string:规定要发送的报头字符串
		#replace指示该报头是否替换之前的报头;默认是 true（替换）。false（允许相同类型的多个报头）。
	
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header("Content-type: text/html; charset=utf-8"); 



//------------------------------输出------------------------------------//
//echo;能够输出一个以上的字符串
echo "a","v";

//print;只能输出一个字符串，并始终返回 1
print "a";

//print_r;调试信息
print_r(array(1));

//var_dump;详细调试信息
var_dump(array(1));
?>