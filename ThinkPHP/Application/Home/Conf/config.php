<?php
/*
 * 具体某个应用模块的配置
 * 
 * */

return array(
    
    #加载扩展配置文件本目录下的user.config与db.config（多个文件用逗号分割）
    'LOAD_EXT_CONFIG' => 'user,db',
    
    #设置默认的模型层名称为Model
    'DEFAULT_M_LAYER'       =>  'Model',
    
    #默认的视图层名称更改为View
    'DEFAULT_V_LAYER'       =>  'View',
    
    #默认的控制器层名称改为Controller
    'DEFAULT_C_LAYER'       =>  'Controller'
);