<?php
/*
 *  项目Application入口文件（一个项目对应一个入口）
 * 
 * */

#(1)自定义项目目录(必须以/结尾)
define('APP_PATH','./Application/');

#(2)加载框架入口文件（必须加载核心文件）
require './ThinkPHP/ThinkPHP.php';

#(3)禁止安全文件自动生成（Application中的index.html）
define('BUILD_DIR_SECURE', false);

#(4)设置安全目录文件名
define('DIR_SECURE_FILENAME', 'default.html');

#(5)设置公共模块的位置
define('COMMON_PATH','./Application/Common/');

#(6)绑定Home模块到当前入口文件
define('BIND_MODULE','Home');

#(7)绑定Index控制器到当前入口文件
define('BIND_CONTROLLER','Index');

#(8)绑定index操作到当前入口文件
define('BIND_ACTION',"index");

#(9)自动生成三个指定的控制器类(IndexController,UserController,MenuController)
define('BUILD_CONTROLLER_LIST','Index,User,Menu');

#(10)自动生成二个模型类(UserModel,MenuModel)
define('BUILD_MODEL_LIST','User,Menu');

#(11)自动生成二个视图类(UserView,MenuView)
define('BUILD_VIEW_LIST','User,Menu');
