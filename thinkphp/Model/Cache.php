<?php
/*
 *  #全局配置
 *  'DATA_CACHE_TYPE'=>'redis'  #缓存类型Apachenote、Apc、Db、Eaccelerator、File、Memcache、Redis、Shmop、Sqlite、Wincache和Xcache
 *  'DATA_CACHE_PREFIX'=>''   #缓存数据前缀
 *  'DATA_CACHE_TIME'=>120    #缓存有效时间（时间为秒）
 *
 * 一.数据缓存(使用S方法)
 *
 * 
 * 二.查询缓存
 *
 *      第一次查询结果会被缓存，第二次查询相同的数据的时候就会直接返回缓存中的内容，而不需要再次进行
 *      数据库查询操作。
 *      $Model = M('User');
 *      $result = $Model->cache('key')->find();
 *      $data = S('key');
 *
 *
 * 三.静态缓存
 *
 *      #全局配置
 *      'HTML_CACHE_ON'=>true,   #开启静态缓存
 *      'HTML_CACHE_TIME'=>60,     #全局静态缓存有效期（秒）
 *      'HTML_FILE_SUFFIX'=>'.html', #设置静态缓存文件后缀
 *
 *      #定义静态缓存规则
 *      'HTML_CACHE_RULES'=>array(
 *              #控制器:方法名
 *              'User:index'=>array('{:module}/{:controller}/{:action}/{id}'),
 *
 *              #控制器:
 *              'User:'=>array('User/{:action}/{id}'),
 *
 *              #*
 *              '*'=>array('{$_SERVER.REQUEST_URI|md5}'),
 *      )
 *
 *
 * 四.字段缓存,有利于io速度，只用于生产模式（Runtime/Data/_fields）
 *         a.在配置文件中指明关闭缓存
 *         'db_fields_cache'=>false;
 *
 *         b.手动设置字段
 *          protected $fields = array('id', 'username', 'email', 'age');
 *          protected $pk     = 'id';#设置主键
 *          protected $fields = array('id', 'username', 'email', 'age',
 *                  '_type'=>array('id'=>'bigint','username'=>'varchar','email'=>'varchar','age'=>'int'));
 *
 *
 * */
