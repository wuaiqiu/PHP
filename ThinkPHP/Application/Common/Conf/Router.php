<?php
/*
 * 路由配置（用于简化URL，用于pathinfo）
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
