<?php
#路由配置

//1.路由模式
#1).普通模式(完全使用默认的PATH_INFO)
    'url_route_on'  =>  false

#2).混合模式(使用路由定义+默认PATH_INFO)
    'url_route_on'  =>  true,
    'url_route_must'=>  false

#3).强制模式(必须定义路由)
    'url_route_on'  =>  true,
    'url_route_must' =>  true


//2.定义路由(route.php)
#注册路由到index模块的News控制器的read操作,变量用[ ]包含起来后就表示该变量是路由匹配的可选变量
Route::rule('new/:id','index/News/read');
#指定请求类型，默认为任何请求类型(GET,POST,PUT,DELETE,*)
Route::rule('new/:id','index/News/read','POST');
Route::get('new/:id','index/News/read'); // 定义GET请求路由规则
Route::post('new/:id','index/News/read'); // 定义POST请求路由规则
Route::put('new/:id','index/News/read'); // 定义PUT请求路由规则
Route::delete('new/:id','index/News/read'); // 定义DELETE请求路由规则
Route::any('new/:id','index/News/read'); // 所有请求都支持的路由规则
#批量注册路由规则
Route::rule(['new/:id'=>'index/News/read','blog/:name'=>'index/Blog/detail'],"","GET");
Route::get(['new/:id'=>'index/News/read','blog/:name'=>'index/Blog/detail']);
#额外参数(隐藏参数)
Route::rule('blog/:id','index/Blog/read?status=1&app_id=5');
#完全匹配
Route::rule('new/:id$', 'index/News/read');
#支持多级控制器 index/controller/group/Blog
Route::rule('blog/:id','index/group.Blog/read');


//3.路由参数
#检测路由规则仅GET请求有效
Route::any('new/:id','index/News/read',['method'=>'get']);
#检测路由规则仅GET和POST请求有效
Route::any('new/:id','index/News/read',['method'=>'get|post']);
#设置URL后缀为html的时候有效
Route::get('new/:id','index/News/read',['ext'=>'html']);
#匹配多个后缀
Route::get('new/:id','index/News/read',['ext'=>'shtml|html']);
#设置禁止URL后缀为png、jpg和gif的访问
Route::get('new/:id','index/News/read',['deny_ext'=>'jpg|png|gif']);
#完整域名检测 只在news.thinkphp.cn访问时路由有效
Route::get('new/:id','index/News/read',['domain'=>'news.thinkphp.cn']);
#前置行为检测(UserCheck中的run函数)
Route::get('user/:id','index/User/read',['before_behavior'=>'\app\index\behavior\UserCheck']);
#回调检查
Route::get('new/:id','index/News/read',['callback'=>'my_check_fun']);


//4.变量规则
#设置全局name变量规则（采用正则定义）
Route::pattern('name','\w+');
#支持全局批量添加
Route::pattern([
    'name'  =>  '\w+',
    'id'    =>  '\d+',
]);
#设置局部name变量规则
Route::get('new/:name','index/News/read',[],['name'=>'\w+']);
Route::rule('new/:id','index/News/read',[],['id'=>'\d+']);


//5.资源路由（RESTful）
Route::resource('blog','index/Blog');
/*
 * Route::get('blog','index/Blog/index')
 * Route::get('blog/:id','index/Blog/read')
 * Route::post('blog','index/Blog/save')
 * Route::put('blog/:id','index/Blog/update')
 * Route::delete('blog/:id','index/Blog/delete')
 * */
#只允许index read save update 四个操作
Route::resource('blog','index/Blog',['only'=>['index','read','save','update']]);
#排除index和delete操作
Route::resource('blog','index/Blog',['except'=>['index','delete']]);


//5.路由分组
#使用闭包方式注册路由分组
Route::group('blog',function(){
    Route::any(':id','index/Blog/read',[],['id'=>'\d+']);
    Route::any(':name','index/Blog/read',[],['name'=>'\w+']);
},['method'=>'get','ext'=>'html']);
#设置一些公共的路由参数
Route::group(['method'=>'get','ext'=>'html'],function(){
    Route::any('blog/:id','index/Blog/read',[],['id'=>'\d+']);
    Route::any('blog/:name','index/Blog/read',[],['name'=>'\w+']);
});


//6.MISS路由(当没有匹配到所有的路由规则后，会路由到miss路由地址。)
Route::miss('index/Blog/index');