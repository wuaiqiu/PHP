<?php
/*
 * COOKIE
 *      (1)Cookie设置
 *          cookie('name','value');  //设置cookie
 *          cookie('name','value',array('expire'=>3600,'prefix'=>'think_'))	//数组型参数
 *          cookie('name','value','expire=3600&prefix=think_')	//字符型参
 *      
 *      (2)Cookie获取
 *           $value = cookie('name');
 *      
 *      (3)Cookie删除
 *              cookie('name',null);
 *              cookie(null); // 清空当前设定前缀的所有cookie值
 * 
 * */