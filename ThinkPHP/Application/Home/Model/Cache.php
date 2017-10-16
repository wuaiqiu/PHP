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
 * */