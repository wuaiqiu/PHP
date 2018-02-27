<?php
#请求

//1.请求信息
#获取包含域名的完整URL地址
Request::instance()->url(true); //==> http://tp5.com/index/index/hello.html?name=thinkphp
#获取当前URL地址不含域名
Request::instance()->url();  //==> /index/index/hello.html?name=thinkphp
#获取当前域名
Request::instance()->domain();  //==>  http://tp5.com
#获取当前入口文件
Request::instance()->baseFile();  //==>  /index.php
#获取当前URL地址 不含QUERY_STRING
Request::instance()->baseUrl();  //==>  /index/index/hello.html
#获取URL地址中的PATH_INFO信息
Request::instance()->pathinfo();  //==>  index/index/hello.html
#获取URL地址中的PATH_INFO信息 不含后缀
Request::instance()->path();  //==>  index/index/hello
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
#请求资源类型
Request::instance()->type();
#访问ip地址
Request::instance()->ip();
#是否AJax请求
Request::instance()->isAjax();
#是否为 GET 请求(POST PUT DELETE Patch)
Request::instance()->isGet();
#是否为手机访问
Request::instance()->isMobile();
#获取请求头
Request::instance()->header();
#获取user-agent
Request::instance()->header('user-agent');


//2.输入变量
#检测变量是否设置
Request::instance()->has('id','get');  //input('?get.id')
Request::instance()->has('name','post'); //input('?post.name')
#获取PARAM变量(GET POST PUT PATHINFO)
Request::instance()->param('name');  //input('name)
Request::instance()->param();  //input('')
#获取GET变量
Request::instance()->get('name'); //input('get.name')
Request::instance()->get(); //input('get.')
#获取POST变量
Request::instance()->post('name'); //input('post.name')
Request::instance()->post(); //input('post.')
#获取PUT变量
Request::instance()->put('name'); //input('put.name')
Request::instance()->put(); //input('put.')
#获取REQUEST变量
Request::instance()->request('id'); //input('request.id')
Request::instance()->request(); //input('request.')
#获取SERVER变量
Request::instance()->server('PHP_SELF'); //input('server.PHP_SELF')
Request::instance()->server(); //input('server.')
#获取SESSION变量
Request::instance()->session('user_id'); //input('cookie.user_id');
Request::instance()->session(); //input('cookie.');

#获取param变量 并依次调用strip_tags、strtolower函数过滤
Request::instance()->param('username','Default','strip_tags,strtolower');
#获取get变量 并且不进行任何过滤 即使设置了全局过滤（'default_filter' => 'htmlspecialchars'）
Request::instance()->get('name','Default',null);
#只获取当前请求的id和name变量
Request::instance()->only(['id','name']);
#只获取GET请求的id和name变量
Request::instance()->only(['id','name'],'get');
#排除id和name变量
Request::instance()->except(['id','name']);
#排除GET请求的id和name变量
Request::instance()->except(['id','name'],'get');
#强制转换(s=>string  d=>decimal  b=>boolean  a=>array  f=>float)
Request::instance()->get('id/d'); //input('get.id/d');
#更改GET变量(不能更改param请求)
Request::instance()->get(['id'=>10]);