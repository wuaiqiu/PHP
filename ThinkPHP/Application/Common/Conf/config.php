<?php
/*
 * 应用配置文件（对Application下的模块都起作用;二级配置文件）
 *   ---惯例配置（系统默认配置;一级配置文件,/ThinkPHP/Conf/convention.php）
 * */

return array(
    #加载扩展配置文件本目录下的user.php与db.php（多个文件用逗号分割）
    'LOAD_EXT_CONFIG' => 'user,db',
    
    #禁止模块访问(默认配置中是禁止访问Common模块和Runtime模块)
    'MODULE_DENY_LIST' => array('Common','Runtime'),
    
    #允许模块访问
    'MODULE_ALLOW_LIST'=>array('Home'),
    
    #定义模板文件位置
    'VIEW_PATH'=>'./Theme/',
    
    #关闭多模块访问;一旦关闭多模块访问后，就只能访问默认模块（这里设置的是Home）
    'MULTI_MODULE' =>  false,
    'DEFAULT_MODULE'=>  'Home',
    
);