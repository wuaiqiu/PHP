<?php
return array(
    #加载扩展配置文件本目录下的user.php与db.php（多个文件用逗号分割）
    'LOAD_EXT_CONFIG' => 'user,db',
    
    #禁止模块访问(默认配置中是禁止访问Common模块和Runtime模块)
    'MODULE_DENY_LIST' => array('Common','Runtime'),
    
    #允许模块访问
    'MODULE_ALLOW_LIST'=>array('Home'),
    
    #关闭多模块访问;一旦关闭多模块访问后，就只能访问默认模块（这里设置的是Home）
    'MULTI_MODULE' =>  false,
    'DEFAULT_MODULE'=>  'Home',

    #定义模板引擎（默认为Think）
    'TMPL_ENGINE_TYPE' =>'PHP'
    
    #设置默认的模型层名称为Model
    'DEFAULT_M_LAYER'       =>  'Model',
    
    #默认的视图层名称更改为View
    'DEFAULT_V_LAYER'       =>  'View',
    
    #默认的控制器层名称改为Controller
    'DEFAULT_C_LAYER'       =>  'Controller'
);