<?php
#配置函数

//1.普通配置
#加载其它配置文件
Config::load(APP_PATH.'config/config.php');
#读取指定配置参数
Config::get('app_debug'); //config('app_debug')
#读取二级配置
Config::get('template.think');  //config('template.think');
#读取所有的配置参数
Config::get();   //config()
#判断是否存在某个设置参数
Config::has('app_debug');   //config('?app_debug')
#设置配置参数
Config::set('app_debug',false); //config('app_debug',false)
#批量设置
Config::set(['app_debug'=>false]); //config(['app_debug'=>false]);

//2.配置域
#导入my_config.php中的配置参数，并纳入user作用域
Config::load('my_config.php','','user');
#设置user_type参数，并纳入user作用域
Config::set('user_type',1,'user');
#读取user作用域的user_type配置参数
Config::get('user_type','user');
#读取user作用域下面的所有配置参数
Config::get('','user');
#判断在test作用域下面是否存在user_type参数
Config::has('user_type','test');
#切换当前配置文件的作用域
Config::range('test');


//3.环境配置(操作.env文件)
#获取环境变量的值
Env::get('database.username'); //Env::get('database_username')
#获取环境变量 如果不存在则使用默认值root
Env::get('database.username','root');