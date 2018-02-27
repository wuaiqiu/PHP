<?php
#1.定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

#2.绑定当前访问到index模块   http://localhost/index.php/控制器/操作
define('BIND_MODULE','index');

#3.绑定当前访问到index模块的index控制器  http://localhost/index.php/操作
define('BIND_MODULE','index/index');

#4.定义应用类库的命名空间
define('APP_NAMESPACE','app');

#5.定义配置文件目录和应用目录同级
define('CONF_PATH', __DIR__.'/../config/');

#6.设置环境变量前缀(.env文件)
define('ENV_PREFIX','PHP_');

#7.加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';