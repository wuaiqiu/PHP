<?php
/*
 * 项目配置文件（对Application下的模块都起作用）
 * 
 * */

return array(
    #加载扩展配置文件本目录下的user.config与db.config（多个文件用逗号分割）
    'LOAD_EXT_CONFIG' => 'user,db',
    
    #禁止模块访问(默认配置中是禁止访问Common模块和Runtime模块)
    'MODULE_DENY_LIST' => array('Common','Runtime'),
    
    #允许模块访问
    'MODULE_ALLOW_LIST'=>array('Home'),
    
);