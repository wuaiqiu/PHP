<?php
#Session

//指定当前作用域
Session::prefix('think');
//赋值（当前作用域）
Session::set('name','thinkphp');  //session('name', 'thinkphp');
//赋值think作用域
Session::set('name','thinkphp','think'); //session('name', 'thinkphp', 'think');

//判断（当前作用域）是否赋值
Session::has('name');  //session('?name');
//判断think作用域下面是否赋值
Session::has('name','think'); //session('?name','think');

//取值（当前作用域）
Session::get('name'); //session('name');
//取值think作用域
Session::get('name','think'); //session('name','think');

//删除（当前作用域）
Session::delete('name');  //session('name', null);
//删除think作用域下面的值
Session::delete('name','think'); //session('name',null,'think');
//取值并删除
Session::pull('name');
//清除session（当前作用域）
Session::clear();  //session(null);
//清除think作用域
Session::clear('think');  //session(null, 'think');
//清除当前请求有效的session
Session::flush();