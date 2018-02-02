<?php
/*
 * Cache(config/cache.php)
 * composer require predis/predis
 * 
 * #添加
 * Cache::put('key', 'value', 10):缓存键值对（分）
 * Cache::store('redis')->put('key', 'value', 10)：指定缓存
 * $value = Cache::remember('users', $minutes, function() {
 *      return DB::table('users')->get();
 * }):不存在就添加，在返回value
 * $bool = Cache::add('key', 'value', $minutes):缓存不存在时存储数据
 * $bool = Cache::forever('key', 'value'):永久存储数据
 * 
 * 
 * #获取
 * $value = Cache::get('key')：访问缓存（默认在config/cache.php）
 * $value = Cache::store('file')->get('key')：指定缓存方式访问
 * $value = Cache::get('key', 'default'):不存在则返回default
 * $value = Cache::get('key',function(){}):default可以是闭包
 * $bool=Cache::has('key'):检查缓存项是否存在
 * 
 * 
 * #修改
 * Cache::increment('key')：自加1
 * Cache::increment('key', $amount)：自加amount
 * Cache::decrement('key')：自减1
 * 
 * 
 * #删除
 * $value = Cache::pull('key')：获取后删除
 * Cache::forget('key'):从缓存中移除数据
 * Cache::flush()：清除所有缓存
 * 
 * */