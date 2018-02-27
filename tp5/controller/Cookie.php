<?php
#Cookie

//设置Cookie 有效期为 3600秒
Cookie::set('name','value',3600); //cookie('name', 'value', 3600);
//设置cookie 前缀为think_
Cookie::set('name','value',['prefix'=>'think_','expire'=>3600]);
//支持数组
Cookie::set('name',[1,2,3]);

//判断指定cookie值是否存在
Cookie::has('name');
//判断指定前缀的cookie值是否存在
Cookie::has('name','think_');

//获取指定的cookie值
Cookie::get('name');   //cookie('name');
//获取指定前缀的cookie值
Cookie::get('name','think_');

//删除指定的cookie
Cookie::delete('name');  //cookie('name', null);
//删除指定前缀的cookie
Cookie::delete('name','think_');
//清空所有cookie
Cookie::clear();
//清空指定前缀的cookie
Cookie::clear('think_'); //cookie(null, 'think_');