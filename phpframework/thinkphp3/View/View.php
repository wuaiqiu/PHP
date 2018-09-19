<?php
/*
 * 视图(用于存放模板文件)
 *    (1)ThinkPHP对模板文件进行目录划分，默认的模板文件定义规则是：
 *          视图目录/[模板主题/]控制器名/操作名+模板后缀
 *
 *    (2)设置主题
 *         #在config中设置默认主题
 *         'DEFAULT_THEME' => 'default'
 *
 *         #在Controller中更改主题
 *         $this->theme('主题名')->display();
 *
 *
 *   (3)渲染模板输出
 *       #自动定位当前操作的模板文件
 *       $this->display();
 *
 *       #表示调用当前控制器下面的edit模板
 *       $this->display('edit');
 *
 *       #表示调用Member控制器下面的read模板
 *       $this->display('Member:read');
 *
 *       #表示调用blue主题下面的User控制器的edit模板
 *       $this->theme('blue')->display('User:edit');
 *
 *       #如果blue主题下面不存在edit模板的话，就会自动定位到默认主题中的edit模板
 *       'TMPL_LOAD_DEFAULTTHEME'=>true
 *       $this->theme('blue')->display('User:edit');
 *
 *       #绝对路径（以入口文件为原点，获取模板地址可用T函数)
 *       $this->display('./Application/Home/View/default/User/index.html');
 *
 *   (4)渲染内容输出【display=fetch+show】
 *      $con=$this->fetch();  #获取源代码
 *      $this->show($con,'utf-8');	 #将源代码展现
 *
 *
 * */
