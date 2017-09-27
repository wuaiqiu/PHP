<?php
//index.php入口文件

//controller参数获取调用那个Controller文件
$controller=(isset($_GET['c'])&&!empty($_GET['c']))?$_GET['c'].'Controller':'UserController';

//action参数获取调用那个Method处理方法
$action=(isset($_GET['a'])&&!empty($_GET['a']))?$_GET['a']:'index';

//param参数获取传入方法的参数
$param=(isset($_GET['p'])&&!empty($_GET['p']))?$_GET['p']:'t';

//加载Controller文件并进行实例化与调用Method
require 'Controller/'.$controller.'.php';
$Con=new $controller();
$Con->$action($param);