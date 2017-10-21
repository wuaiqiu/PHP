<?php
require 'init.php';

/*
 * 一.PHP分配的变量
 * 
 * 读取方式
 *      <{$var1}>
 *      <{$var2['a']}> 
 *      <{$var3->name}>   
 * */

//普通变量
$smarty->assign("var1","ABC");

//数组
$smarty->assign("var2",array('a'=>'A','b'=>'B'));

//对象
class Person{
    public $name="zhangsan";
    public $age=12;
}
$smarty->assign("var3",new Person());


/*
 * 二.读取配置文件的变量(config/config.conf)
 *  
 *      #全局变量
 *      var4=zhangsan
 *      var5=lisi
 *      #index局部变量
 *      [index]
 *      var6=wangwu
 *      
 *读取方式
 *      <{#var4#}>
 *      <{$smarty.config.var5}>
 *    
 *模板文件
 *      <{config_load file="config.conf"}>调用全局配置变量
 *      <{config_load file="config.conf" section="index"}>调用局部配置变量
 * */



/*
 * 三.Smarty保留变量
 *  (1)页面请求变量 如$_GET, $_POST, $_COOKIE, $_SERVER, $_ENV 和 $_SESSION
 *    {$smarty.get.id}
 *    {$smarty.post.id}
 *    {$smarty.cookies.username}
 *    {$smarty.server.SERVER_NAME}
 *    {$smarty.env.PATH}
 *    {$smarty.session.id}
 *    
 *  (2)直接访问PHP的常量 
 *    {$smarty.const.PI} 
 *  
 *  (3)获取时间戳 
 *    {$smarty.now}
 * */
$smarty->assign("smarty",$smarty);

$smarty->display('varible.html');



