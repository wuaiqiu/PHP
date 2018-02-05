<?php

#(1)加载框架入口文件（必须加载核心文件）
require './ThinkPHP/ThinkPHP.php';

#初始化
#(1)禁止安全文件自动生成
define('BUILD_DIR_SECURE', false);

#(2)设置安全目录文件名
define('DIR_SECURE_FILENAME', 'default.html');

#(3)自动生成三个指定的控制器类(IndexController,UserController,MenuController)
define('BUILD_CONTROLLER_LIST','Index,User,Menu');

#(4)自动生成二个模型类(UserModel,MenuModel)
define('BUILD_MODEL_LIST','User,Menu');

#设置
#(1)自定义项目目录(必须以/结尾)
define('APP_PATH','./Application/');

#(2)绑定Home模块到当前入口文件
define('BIND_MODULE','Home');

#(3)绑定Controller目录下的Index控制器到当前入口文件
define('BIND_CONTROLLER','Index');

#(4)绑定index操作到当前入口文件
define('BIND_ACTION',"index");