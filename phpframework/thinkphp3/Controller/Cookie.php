<?php
/*
 * 
 * 一.SESSION
 *     
 *     (1)session赋值
 *          session('name','value');
 *          
 *     (2)session取值
 *          $value = session('name');
 *     
 *     (3)session删除
 *          session('name',null);
 *          session(null); #全部删除
 *      
 *     (4)session判断
 *          session('?name');
 *
 *
 * 二.COOKIE
 *      (1)Cookie设置
 *          cookie('name','value');  //设置cookie
 *          cookie('name','value',array('expire'=>3600,'prefix'=>'think_'))	//数组型参数
 *          cookie('name','value','expire=3600&prefix=think_')	//字符型参
 *
 *      (2)Cookie获取
 *           $value = cookie('name');
 *       	$value = cookie();//获取所有的cookie
 *      (3)Cookie删除
 *              cookie('name',null);
 *              cookie(null); // 清空当前设定前缀的所有cookie值
 *
 * */