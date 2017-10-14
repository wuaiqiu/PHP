<?php
/*
 * Resource
 *      资源是一种特殊的变量类型，保存了到外部资源的一个引用：如打开文件、数据库连接、图形画布
 *区域等。
 *      3为资源ID，stream为资源名，真正的资源存在HashTable中，key为资源ID
 * */

$a=fopen("a.txt", "r");
echo "<pre>";
var_dump($a);
$b=mysql_connect("localhost","root","123456","students");
var_dump($b);
echo "</pre>";


/*
 * resource(3) of type (stream)
 * resource(5) of type (mysql link)
 * */
?>