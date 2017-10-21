<?php
/*
 * 模板继承
 *     (1)实现模板之间的继承
 *      <{extends file="base.html"}>:在子模板中必须要为程序的第一行
 *     
 *     (2)在子模板覆盖父模板的block内容；子模板继承父模板只能重写block区域，子模板其他区域则会被忽略
 *      <{block name="title"}> 需要覆盖的内容 <{/block}>:在父模板中
 *      <{block name="title"}> 新内容 <{/block}>:在子模板中
 *    
 *     (3)在子模板覆盖父模板的部分block内容
 *      <{block name="title" append}> 新内容 <{/block}>:在子模板中向后追加
 *      <{block name="title" prepend}> 新内容 <{/block}>:在子模板中向前追加
 *      <{block name="title"}> 需要覆<{$smarty.block.child}>盖的内容 <{/block}>:在父模板中指定覆盖区域
 *      <{block name="title"}> 新<{$smarty.block.parent}>内容 <{/block}>:在子模板中指定父模板内容的位置
 * */
require 'init.php';

