<?php
require 'init.php';

/*
 *函数(可以直接用php函数)
 * 
 * 一.在php中注册插件
 *  registerPlugin("类型", "模板使用的函数名", "php中函数名")
 *  
 *  1.变量调节器
 *     在模板中对变量输出前的处理
 *   
 *     用法
 *     <{$var|fun}>                         #一个函数与一个参数
 *     <{$var|fun:arg2:arg3..}>             #一个函数与多个参数
 *     <{$var|fun1:arg2:arg3..|fun2..}>     #多个函数与多个参数
 *  
 *  2.函数
 *      用法
 *          <{fun2 arg1="value1" arg2="value2"}>
 *  3.块函数
 *      用法
 *          <{fun3 arg1="value1" arg2="value2"}> 块内容 <{/fun}>
 * */

$smarty->registerPlugin("modifier", "fun1", "fun1");
function fun1($var,$arg2=""){
    return strtoupper($var);
}

$smarty->registerPlugin("function", "fun2", "fun2");
function fun2($args,$smarty){
        return "<p>arg1:$agrs[1]</p><p>arg2$agrs[2]</p>";
}

$smarty->registerPlugin("block", "fun3", "fun3");
function fun3($args,$content,$smarty){
    return "<p>arg1:$agrs[1]</p><p>arg2$agrs[2]</p><p>content:$content</p>";
}

/*
 * 二.编写插件
 *  $smarty->addPluginsDir(path):添加插件库
 *  1.变量调节器(modifier.fun1.php)
 *      function smarty_modifier_fun1($var,$arg2=""){
 *           return strtoupper($var);
 *      }
 *      
 *  2.函数(function.fun2.php)
 *      function smarty_function_fun2($args,$smarty){
 *         return "<p>arg1:$agrs[1]</p><p>arg2$agrs[2]</p>";
 *      }
 *      
 *  3.块函数(block.fun3.php);repeat参数表示当读到</>时为false，这样可以让块内容只读一次
 *     function smarty_block_fun3($args,$content,$smarty,&$repeat){
 *         if(!repeat)
 *          return "<p>arg1:$agrs[1]</p><p>arg2$agrs[2]</p><p>content:$content</p>";
 *     } 
 * */

$smarty->display("function.html");



