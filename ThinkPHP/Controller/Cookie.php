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
 *     (5)session管理
 *     
 *          #默认情况下，初始化之后系统会自动启动session,关闭后可以手动开启
 *          'SESSION_AUTO_START' =>false;
 *           
 *           session('[操作名]');
 *           
 *           操作名	   含义
 *           start	   启动session
 *           pause	   暂停session写入
 *           destroy   销毁session
 *           regenerate	重新生成session id
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