<?php
/*
 * 模块配置(三级配置文件)
 * 
 * */

return array(
    
    #加载扩展配置文件本目录下的user.php与db.php（多个文件用逗号分割）
    'LOAD_EXT_CONFIG' => 'user,db',
    
    #设置默认的模型层名称为Model
    'DEFAULT_M_LAYER'       =>  'Model',
    
    #默认的视图层名称更改为View
    'DEFAULT_V_LAYER'       =>  'View',
    
    #默认的控制器层名称改为Controller
    'DEFAULT_C_LAYER'       =>  'Controller'
);