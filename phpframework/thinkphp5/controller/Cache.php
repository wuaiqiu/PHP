<?php
#缓存

//设置缓存（有效期一个小时）
Cache::set('key','value',3600);
//切换到file操作
Cache::store('file')->set('name','value');

//name自增（步进值为1）
Cache::inc('name');
//name自增（步进值为3）
Cache::inc('name',3);
//name自减（步进值为1）
Cache::dec('name');
//name自减（步进值为3）
Cache::dec('name',3);

//获取缓存数据
Cache::get('name');
//支持指定默认值
Cache::get('name','');
//不存在则写入缓存数据后返回
Cache::remember('name',function(){
    return time();
});

//删除缓存
Cache::rm('name');
//获取并删除缓存
Cache::pull('name');
//清空缓存
Cache::clear();