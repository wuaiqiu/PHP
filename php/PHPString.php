<?php
//一.字符串类型定义
//1.双引号定义:可以识别 \" , \\ , \n , \t , \r , \$ 转义符；可以识别变量
$str1="abc";      #abc
$str11="a\"bc";   #a"bc
$str12="a\$bc";   #a$bc
$str13="a\bc";    #当"\"在字符中间时可以不转义；a\bc


//2.单引号定义:可以识别 \' , \\ 转义符;不能识别变量
$str2='abc';      #abc
$str21='a\'bc';   #a'bc
$str22='a\bc';    #当"\"在字符中间时可以不转义；a\bc
$str23='a$bc';    #a$bc


//3.双引号定界符定义:STR3为标识符，最后标识符必须独占一行
//可以识别 \\ , \n , \t , \r , \$ 转义符
$str3=<<<"STR3"
	    abc ab\\c a"bc a'bc a\$bc
STR3;
#abc ab\c a"bc a'bc a$bc


//4.单引号定界符定义:没有转义符,全不需要转义
$str4=<<<'STR4'
        abc a\bc a'bc a"bc a$bc
STR4;
#abc ab\c a'bc a"bc


/*二.String函数
 * 
 *  trim($str):移除字符串两侧的空格
 *  str_pad($str,num,$str):用$str从左填充字符串$arr至长度为num
 *  join/implode("字符分割符",$arr):将数组元素组合成的字符串。
 *  explode("字符分隔符",$str):把字符串打散为数组
 *  strlen(string):函数返回字符串的长度
 *  substr(string,start,length):函数返回字符串的一部分
 *  str_split(string,length):把字符串分割到数组中
 *  sha1(string):计算字符串的 SHA-1 散列
 *  md5(string):计算字符串的 MD5 散列
 *  
 * */

$arr = array('Hello','World!','I','love','Shanghai!');
echo "<br/>".implode(" ",$arr);

$str = "Hello world. I love Shanghai!";
print_r (explode(" ",$str));

/*
 Hello World! I love Shanghai!
 
 Array ( [0] => Hello [1] => world. [2] => I [3] => love [4] => Shanghai! )
 */
  