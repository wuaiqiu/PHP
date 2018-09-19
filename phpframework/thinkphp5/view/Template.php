<?php
#模板

//1.系统变量
#输出$_GET['pageNumber']变量
{$Think.get.pageNumber}
#输出$_POST['pageNumber']变量
{$Think.post.pageNumber}
#输出$_REQUEST['pageNumber']变量
{$Think.request.pageNumber}
#输出$_SESSION['user_id']变量
{$Think.session.user_id}
#输出$_COOKIE['name']变量
{$Think.cookie.name}
#输出$_SERVER['SCRIPT_NAME']变量
{$Think.server.script_name}
#输出$_ENV['pageNumber']变量
{$Think.env.pageNumber}
#常量输出
{$Think.APP_PATH}
#配置输出
{$Think.config.default_module}


//2.请求参数
#调用Request对象的get方法 传入参数为id
{$Request.get.id}
#调用Request对象的param方法 传入参数为name
{$Request.param.name}
#调用Request对象的path方法
{$Request.path}
#调用Request对象的module方法
{$Request.module}
#调用Request对象的controller方法
{$Request.controller}
#调用Request对象的action方法
{$Request.action}
#调用Request对象的ext方法
{$Request.ext}
#调用Request对象的host方法
{$Request.host}
#调用Request对象的ip方法
{$Request.ip}
#调用Request对象的header方法
{$Request.header.accept-encoding}


//3.使用函数
{$data.name|md5}
{$data.name|substr=###,0,3}
{:substr(strtoupper(md5($name)),0,3)}


//4.使用默认值
{$user|default="这家伙很懒，什么也没留下"}


//5.运算符（在使用运算符的时候，不再支持常规函数用法）
{$user.score+10}    //正确的
{$user['score']+10} //正确的
{$user['score']*$user['level']} //正确的
{$user['score']|myFun*10}   //错误的
{$user['score']+myFun($user['level'])}  //正确的


//6.模板注释
#多行注释
{/* 注释内容 */ }
#单行注释
{// 注释内容 }