<?php
/*
 * 字段缓存,有利于io速度，只用于生产模式（Runtime/Data/_fields）
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
 * 查询缓存
 * 
 * #全局配置
 * 'DATA_CACHE_TYPE'=>'redis'	#缓存类型Apachenote、Apc、Db、Eaccelerator、File、Memcache、Redis、Shmop、Sqlite、Wincache和Xcache
 * 'DATA_CACHE_PREFIX'=>''		#缓存数据前缀
 * 'DATA_CACHE_TIME'=>120		#缓存有效时间（时间为秒）
 * 
 * 第一次查询结果会被缓存，第二次查询相同的数据的时候就会直接返回缓存中的内容，而不需要再次进行数据库查询操作。
 * $Model = M('User');
 * $result = $Model->cache('key')->find();
 * $data = S('key');
 * */
