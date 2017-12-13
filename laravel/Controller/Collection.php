<?php
/*
 *集合
 * */

#1.创建集合
$collection=collect(['a','b','c']);

#2.增加（修改）数据项
$collection = collect(['product_id' => 1, 'name' => 'Desk']);
$collection->put('price', 100);

#3.移除数据项
$collection = collect(['name' => 'taylor', 'framework' => 'laravel']);
$collection->forget('name');

#4.过滤数据项
$collection = collect([1, 2, 3, 4]);
$filtered = $collection->filter(function ($value, $key) {
    return $value > 2;
});

#5.获取数据项，如果不存在，返回null
$collection = collect(['name' => 'taylor', 'framework' => 'laravel']);
$value = $collection->get('name');

#6.迭代集合中的数据项
$collection = $collection->each(function ($item, $key) {});