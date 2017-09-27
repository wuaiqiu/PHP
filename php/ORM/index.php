<?php 
header("Content-type: text/html; charset=utf-8"); 
require 'ORM.php';
$orm=new ORM();

/* 
//查询
$result=$orm->table("website")->select();
echo "<pre>";
var_dump($result);
echo "</pre>";
 */

/* 
//插入
$orm->table("website")->add(array(11,"zhangsan","http://www.biadu.com",3,'CN'));
 */

/*
//更新
$orm->table("website")->where("id=1")->update(array("name"=>"G","alexa"=>11));
 */

/* 
//删除
$orm->table("website")->where("id=11")->delete();
 */

?>