<?php
/*
 * 一.URL模式
 * (1)普通模式
 *
 *      http://localhost/index.php?m=Admin&c=User&a=user&name=wu
 *      m参数表示模块，c参数表示控制器，a参数表示操作
 *
 * (2)PATHINFO模式，默认
 *
 *      http://localhost/index.php/模块/控制器/操作
 *      http://localhost/index.php/Admin/User/user/name/wu
 *
 * (3)REWRITE模式（去除index.php入口文件）
 *      
 *      httpd.conf配置文件中加载了mod_rewrite.so模块
 *      AllowOverride None 将None改为 All
 *      把.htaccess文件放到应用入口文件的同级目录下
 *      http://localhost/Admin/User/user/name/wu
 *
 *
 * (4)设置伪静态;默认为html,空则为任意后缀;__EXT__常量可以查看当前访问路径的伪静态
 *
 *      'URL_HTML_SUFFIX'=>'shtml|html|xml'
 *       ==> http://localhost/index.php/Admin/User/user/name/wu.shtml
 *
 *      #URL禁止访问的后缀设置;URL_DENY_SUFFIX的优先级比URL_HTML_SUFFIX要高
 *      'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg' 
 *
 * */

return array(
    
    #普通模式
    'URL_MODEL'=>0,
    
    #pathinfo模式
    'URL_MODLE'=>1,
    
    #rewrite模式
    'URL_MODLE'=>2,
    
    #设置普通模式的参数名
    'VAR_MODULE'     =>'m',
    'VAR_CONTROLLER' =>'c',
    'VAR_ACTION'     =>'a',
    
    #设置PATHINFO参数分隔符
    'URL_PATHINFO_DEPR'=>'/',
    
    #URL地址不区分大小写,开启debug模式为false
    'URL_CASE_INSENSITIVE'  =>  true
);



/*
 * 二.路由配置（用于简化URL，用于pathinfo）
 *
 *      http://localhost/index.php/Home/User/index/id/3	(pathinfo模式)
 *
 * */
return array(
    
    #开启路由
    'URL_ROUTER_ON'   => true,
    
    #路由规则
    'URL_ROUTE_RULES'=>array(
        /*
         * 规则路由
         *
         *    a.静态路由
         *      'u'=>'Home/User/index'
         *      ===>	http://localhost/index.php/u/id/3
         *
         *    b.静态与动态路由
         *      'u/:id'=>'Home/User/index'
         *      ===>	http://localhost/index.php/u/3
         *
         *    c.静态路由与多个动态路由结合
         *      'u/:id/:name'=>'Home/User/index'
         *      ===>	http://localhost/index.php/u/4/zhangsan
         *
         *    d.数字约束
         *      'u/:id\d'=>'Home/User/index'
         *      ===>	http://localhost/index.php/u/4
         *
         *    e.可选参数
         *      'u/[:id]'=>'Home/User/index'
         *      ===>	http://localhost/index/u
         *
         *    f.参数后面不在有数据
         *      'u/:id$'=>'Home/User/index'
         *      ===>	http://localhost/index.php/u/6
         *
         *    h.重定向
         *       'u/:id'=>'http://www.baidu.com'
         *      ===>  http://localhost/index.php/u/6
         * */
        
    )
);
?>