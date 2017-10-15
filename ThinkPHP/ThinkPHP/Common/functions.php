<?php
/*
 * 全局函数
 * 
 * (1)A函数（实例化控制器）
 *      A('User')：当前模块的Controller目录控制器UserController
 *      A('Admin/Blog')：Admin模块的Controller目录控制器BlogController
 *      A('User','Event')：当前模块的Event目录控制器UserEvent
 *      A('Admin/Blog','Event'):Admin模块的Event目录控制器BlogEvent
 *      
 *      
 * (2)C函数(读取配置参数)
 *      C('configName')：读取当前的配置参数
 *      C('configName','value'):设置配置参数
 *      C('config',null,'value'):读取的时候（不存在）设置默认值
 *      C('configName.subConfigName'):读取二维配置
 *      
 * 
 * (3)I函数（读取参数）
 *      a.I('变量类型.变量名',['默认值'])  
 *          
 *          变量类型
 *              get	       获取GET参数
 *              post	   获取POST参数
 *              param	   自动判断请求类型获取GET、POST或者PUT参数
 *              request	   获取REQUEST 参数
 *              put	       获取PUT 参数
 *              session	   获取 $_SESSION 参数
 *              cookie	   获取 $_COOKIE 参数
 *              server	   获取 $_SERVER 参数
 *              globals	   获取 $GLOBALS参数
 *              path	   获取 PATHINFO模式的URL参数
 *              data	   获取 其他类型的参数，需要配合额外数据源参数 
 *          
 *      I('get.id')     #$_GET['id']
 *      I('get.')       #获取所有get参数
 *      I('get.id',0)   #如果不存在$_GET['id'] 则返回0
 *      I('id')         #等同于 I('param.id')     
 *      
 *      b.I('变量类型.变量名/修饰符')     
 *          修饰符	作用
 *          s	强制转换为字符串类型
 *          d	强制转换为整型类型
 *          b	强制转换为布尔类型
 *          a	强制转换为数组类型
 *          f	强制转换为浮点类型
 *      
 *       I('get.id/d')      #强制变量转换为整型
 *       I('post.name/s')   #强制转换变量为字符串类型
 *       I('post.ids/a')    #强制变量转换为数组类型
 *         
 * 
 * (4)U函数（操作URL）
 *      U('地址表达式',参数)
 *          地址表达式：[模块/控制器/操作#锚点@域名]?参数1=值1&...
 *          
 *      U()	#获取当前url
 *      ==>/index.php/Home/User/index
 *      U('User/user')  #获取当前模块UserController控制器中的user操作方法
 *      ==>/index.php/Home/User/user
 *      U('User/user?id=5')   #获取当前模块UserController控制器中的user操作方法并传参id,不可以用User/user/id/5
 *      ==>/index.php/Home/User/user/id/5
 *      U('Blog/cate',array('cate_id'=>1,'status'=>1)):
 *      ==>/index.php/Home/Blog/cate/cate_id/1/status/1
 *      
 * */

