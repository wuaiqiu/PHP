<?php
/*内置函数*/

#读取环境变量;第二个参数是默认值，如果环境变量没有被配置将会是个该默认值
env('APP_DEBUG', false);

#全局配置（app文件下的timezone配置）
$value = config('app.timezone');
config(['app.timezone' => 'America/Chicago']);

#生成 URL
route('命名路由');
route('命名路由',['id'=>1]);

#使用视图
view(url);//url相对于resource的views目录
view(url,[key=>value]);//传值

#storage目录
storage_path(url)//相对于storage目录