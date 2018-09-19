<?php
#请求

//1.请求信息
#获取当前域名
Request::instance()->domain();  //==>  http://tp5.com
#获取当前URL地址
Request::instance()->url();  //==> /index/index/hello.html?name=thinkphp
#获取当前URL地址 不含QUERY_STRING
Request::instance()->baseUrl();  //==>  /index/index/hello.html
#获取URL地址中的后缀信息
Request::instance()->ext(); //==>  html

#当前模块名称
Request::instance()->module();
#当前控制器名称
Request::instance()->controller();
#当前操作名称
Request::instance()->action();

#请求方法
Request::instance()->method();
#是否为 GET 请求(POST PUT DELETE AJax)
Request::instance()->isGet();
#访问ip地址
Request::instance()->ip();
#是否为手机访问
Request::instance()->isMobile();
#获取user-agent
Request::instance()->header('user-agent');


//2.输入变量
#获取GET变量
Request::instance()->get('name'); //input('get.name')
Request::instance()->get('name','default'); //input('get.name','default')
Request::instance()->get(); //input('get.')
#获取POST变量
Request::instance()->post('name'); //input('post.name')
Request::instance()->post('name','default'); //input('post.name','default')
Request::instance()->post(); //input('post.')
#获取PUT变量
Request::instance()->put('name'); //input('put.name')
Request::instance()->put('name','default'); //input('put.name','default')
Request::instance()->put(); //input('put.')
#获取DELETE变量
Request::instance()->delete('name'); //input('delete.name')
Request::instance()->delete('name','default'); //input('delete.name','default')
Request::instance()->delete(); //input('delete.')
#获取PARAM变量(GET POST PUT DELETE PATHINFO)
Request::instance()->param('name');  //input('name')
Request::instance()->param('name','default'); //input('name','default')
Request::instance()->param();  //input('')
#获取SERVER变量
Request::instance()->server('PHP_SELF'); //input('server.PHP_SELF')
Request::instance()->server(); //input('server.')
#获取SESSION变量
Request::instance()->session('user_id'); //input('cookie.user_id');
Request::instance()->session(); //input('cookie.');

#检测变量是否设置
Request::instance()->has('id','get');  //input('?get.id')

#只获取当前请求的id和name变量(Param)
Request::instance()->only(['id','name']);
#只获取GET请求的id和name变量
Request::instance()->only(['id','name'],'get');
#排除id和name变量(Param)
Request::instance()->except(['id','name']);
#排除GET请求的id和name变量
Request::instance()->except(['id','name'],'get');

#获取param变量 并依次调用strip_tags、strtolower函数过滤
Request::instance()->param('username','','strip_tags,strtolower');
#获取get变量 并且不进行任何过滤 即使设置了全局过滤（'default_filter' => 'htmlspecialchars'）
Request::instance()->get('name','',null);

#强制转换(s=>string  d=>decimal  b=>boolean  a=>array  f=>float)
Request::instance()->get('id/d'); //input('get.id/d');