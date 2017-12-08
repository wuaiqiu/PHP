<?php
//初始化
$mem=new Memcache();
$mem->connect('localhost',11211,1);


/*
 * 存储命令
 * $flag：是否用MEMCACHE_COMPRESSED来压缩存储的值，true表示压缩，false表示不压缩
 * */
$mem->add('key1','value1',false,0);
$mem->replace('key1','value11',false,0);
$mem->set('key2','value2',false,0);


/*
 * 查找命令
 * */
$mem->get('key1');
$mem->delete('key2');
$mem->decrement('key1',2);
$mem->increment('key1',2);


/*
 * 统计命令
 * */
$mem->getStats();
$mem->flush();

//关闭连接
$mem->close();



