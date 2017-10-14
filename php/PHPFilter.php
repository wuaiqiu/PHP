<?php

//-------------------------------------过滤函数-----------------------------------//

/*
 * 过滤器函数
 *  filter_var(variable, filter,options) 函数通过指定的过滤器过滤一个变量。
 *  filter_var_array(array, args) 函数获取多个变量，并进行过滤。
 *  
 *  
 * 常用过滤器
 *     (1)FILTER_VALIDATE_INT:整数验证         options【min_range - 规定最小整数值
 *                                                     max_range - 规定最大整数值】
 *     (2)FILTER_VALIDATE_FLOAT:小数验证
 *     (3)FILTER_VALIDATE_IP:IP验证           flags【FILTER_FLAG_IPV4 - 要求值是合法的IPv4
 *                                                   FILTER_FLAG_IPV6 - 要求值是合法的 IPv6】
 *     (4)FILTER_VALIDATE_EMAIL:Email验证  
 *     (5)FILTER_VALIDATE_URL：URL验证        
 *     (6)FILTER_VALIDATE_REGEXP：正则验证      options【regexp - 验证所依据的正则表达式】
 *    
 *     
 *     (7)FILTER_UNSAFE_RAW:去除或编码特殊字符   flags【FILTER_FLAG_STRIP_LOW - 去除 ASCII 值在 32 以下的字符
 *                                                   FILTER_FLAG_STRIP_HIGH - 去除 ASCII 值在 32 以上的字符
 *                                                   FILTER_FLAG_ENCODE_LOW - 编码 ASCII 值在 32 以下的字符
 *                                                   FILTER_FLAG_ENCODE_HIGH - 编码 ASCII 值在 32 以上的字符
 *                                                   FILTER_FLAG_ENCODE_AMP - 把 & 字符编码为 &amp;】
 *     (8)FILTER_SANITIZE_MAGIC_QUOTES:预定义的字符串前面设置反斜杠('  "  \)
 *     (9)FILTER_SANITIZE_NUMBER_FLOAT:删除浮点数中所有非法的字符    flags【FILTER_FLAG_ALLOW_FRACTION - 允许小数分隔符 （比如 .）
 *                                                                       FILTER_FLAG_ALLOW_THOUSAND - 允许千分隔符 （比如 ,）
 *                                                                       FILTER_FLAG_ALLOW_SCIENTIFIC - 允许科学技术法 （比如 e 和 E）】
 *     (10)FILTER_SANITIZE_NUMBER_INT:删除数字中所有非法的字符  
 *     (11)FILTER_SANITIZE_URL:删除字符串中所有非法的 URL 字符
 *     (12)FILTER_SANITIZE_EMAIL:删除字符串中所有非法的 e-mail 字符
 *     (13)FILTER_SANITIZE_SPECIAL_CHARS:对特殊字符进行 HTML 转义    flags【FILTER_FLAG_STRIP_LOW - 去除 ASCII 值在 32 以下的字符
 *                                                                        FILTER_FLAG_STRIP_HIGH - 去除 ASCII 值在 32 以上的字符
 *                                                                        FILTER_FLAG_ENCODE_HIGH - 编码 ASCII 值在 32 以上的字符】
 *     (14)FILTER_SANITIZE_ENCODED:去除或 URL 编码不需要的字符。      flags【FILTER_FLAG_STRIP_LOW - 去除 ASCII 值在 32 以下的字符
 *                                                                        FILTER_FLAG_STRIP_HIGH - 去除 ASCII 值在 32 以上的字符
 *                                                                        FILTER_FLAG_ENCODE_LOW - 编码 ASCII 值在 32 以下的字符
 *                                                                        FILTER_FLAG_ENCODE_HIGH - 编码 ASCII 值在 32 以上的字符】
 *                                                                   
 *      (15)FILTER_SANITIZE_STRING:去除或编码不需要的字符。           flags【FILTER_FLAG_NO_ENCODE_QUOTES - 该标志不编码引号
 *                                                                        FILTER_FLAG_STRIP_LOW - 去除 ASCII 值在 32 以下的字符
 *                                                                        FILTER_FLAG_STRIP_HIGH - 去除 ASCII 值在 32 以上的字符
 *                                                                        FILTER_FLAG_ENCODE_LOW - 编码 ASCII 值在 32 以下的字符
 *                                                                        FILTER_FLAG_ENCODE_HIGH - 编码 ASCII 值在 32 以上的字符
 *                                                                        FILTER_FLAG_ENCODE_AMP - 把 & 字符编码为 &amp;】
 * */



//1.filter_var
$int = 123;
if(!filter_var($int, FILTER_VALIDATE_INT)){
    echo("不是一个合法的整数");
}else{
    echo("是个合法的整数");
}

#是个合法的整数



//2.filter_var的options附加选项(包含标志【flags】常量/选项【options】数组)
$options=array("options"=>array("min_range"=>0,"max_range"=>100));
if(!filter_var($int, FILTER_VALIDATE_INT,$options)){
    echo("不是一个合法的整数");
}else{
    echo("是个合法的整数");
}

#不是一个合法的整数



//3.filter_var_array的参数array为规定带有字符串键的数组，包含要过滤的数据，args为规定过滤器参数数组
$arr = array("email" => "peter@example.com","age" => "41",);
$filters = array(
    "age" => array(
        "filter"=>FILTER_VALIDATE_INT,
        "options"=>array("min_range"=>0,"max_range"=>100)
    ),
    "email"=>array("filter"=>FILTER_VALIDATE_EMAIL)
);
print_r(filter_var_array($arr, $filters));

#Array ( [age] => 41 [email] => peter@example.com )



//--------------------------------------自定义过滤函数-------------------------------------//

/*
 * 自定义过滤器
 *  FILTER_CALLBACK：调用用户自定义函数来过滤数据
 * */

//定义过滤函数
function convertSpace($string){
    return str_replace("_", ".", $string);
}
$string = "www_runoob_com!";
echo filter_var($string, FILTER_CALLBACK,array("options"=>"convertSpace"));
?>