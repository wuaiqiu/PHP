<?php

//路径函数

#app_path 返回app目录的绝对路径
$path = app_path();
$path = app_path('Http/Controllers/Controller.php');


#base_path 返回项目根目录的绝对路径
$path = base_path();
$path = base_path('vendor/bin');


#config_path 返回应用配置目录的绝对路径
$path = config_path();
database_path();


#public_path 返回public目录的绝对路径
$path = public_path();


#resource_path 返回resources目录的绝对路径
$path = resource_path()
$path = resource_path('assets/sass/app.scss');


#storage_path 返回storage目录的绝对路径
$path = storage_path();
$path = storage_path('app/file.txt');


//URL函数

#action 为给定控制器动作生成URL
$url = action('HomeController@getIndex');
#如果该方法接收路由参数，你可以将其作为第二个参数传递进来：
$url = action('UserController@profile', ['id' => 1]);


#route 为给定命名路由生成一个URL
$url = route('routeName');
#如果该路由接收参数，你可以将其作为第二个参数传递进来：
$url = route('routeName', ['id' => 1]);


#url 为给定路径生成完整URL
echo url('user/profile');
echo url('user/profile', [1]);
#如果没有提供路径，将会返回 Illuminate\Routing\UrlGenerator 实例：
echo url()->current();
echo url()->full();
echo url()->previous();


#asset使用当前请求的 scheme（HTTP或HTTPS）为前端资源生成一个URL
$url = asset('img/photo.jpg');
#http://localhost/public/img/photo.jpp


//配置函数

#环境配置(.env)
env('APP_DEBUG', false); //传递到 env 函数的第二个参数是默认值，如果环境变量没有被配置将会是个该默认值。


#访问配置值
$value = config('app.timezone');
config(['app.timezone' => 'America/Chicago']);