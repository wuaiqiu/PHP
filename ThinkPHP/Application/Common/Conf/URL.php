<?php 
/*
 * URL模式
 * (1)普通模式(0)
 *  
 *      http://localhost/index.php?m=Admin&c=User&a=user&name=wu
 *      m参数表示模块，c参数表示控制器，a参数表示操作
 * 
 * (2)PATHINFO模式，默认(1)
 * 
 *      http://localhost/index.php/模块/控制器/操作
 *      http://localhost/index.php/Admin/User/user/name/wu
 *      
 * (3)REWRITE模式（去除index.php入口文件）(2)
 *      需要开始httpd.conf的.htacess
 *      加载mod_rewrite.so
 *      
 *      http://localhost/Admin/User/user/name/wu
 *      
 *      
 * 设置伪静态;默认为html,空则为任意后缀
 *  
 *  'URL_HTML_SUFFIX'=>'shtml|html|xml'
 *   ==> http://localhost/index.php/Admin/User/user/name/wu.shtml
 *   
 *  'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg'  #URL禁止访问的后缀设置;URL_DENY_SUFFIX的优先级比URL_HTML_SUFFIX要高
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

            #URL地址不区分大小写
            'URL_CASE_INSENSITIVE'  =>  true         
);
?>