<?php
#视图

//1.模板赋值
$this->assign('key1','value1');
$this->assign([
    'key1'  => 'value2',
    'key2' => 'value2'
]);


//2.模板输出
$this->fetch('index');
$this->fetch('admin@member/edit');
$this->fetch('./template/public/menu.html'); //Public目录为根目录


//3.模板带值输出
$this->fetch('index', [
    'key1'  => 'value1',
    'key2' => 'value2'
]);


//4.内容输出
$content = '{$key1}==>{$key2}';
return $this->display($content, [
    'key1'  => 'value1',
    'key2' => 'value2'
]);


//5.替换输出
$this->fetch('index',[],['__PUBLIC__'=>'/public/']);

/*
 * config中配置
 * 'view_replace_str'  =>  [
 *       '__ROOT__'=>'/public',
 *       '__STATIC__'=>'/public/static',
 *       '__JS__'=>'/public/static/js',
 *       '__CSS__'=>'/public/static/css'
 * ]
 *
 * */