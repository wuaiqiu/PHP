<?php
/*
 * 静态缓存
 *  (1)开启缓存
 *      $smarty->caching=true;
 *      $smarty->setCacheDir('./cache/');
 *  
 *  (2)设置缓存存活时间，单位s
 *      $smarty->cache_lifetime=30;
 *    
 *  (3)为模板设置缓存
 *      display("模板文件名","cache_id");
 *      isCached("模板文件名","cache_id"):检查模板是否已经缓存
 *  
 *  (4)清除缓存
 *     clearCache("模板文件名","cache_id"）:清除单个缓存文件
 *     clearAllCache():清除全部缓存    
 * */

require 'init.php';

if(!$smarty->isCached('cache.html',$_SERVER['REQUEST_URI'])){
    
        //需要缓存的内容
}
//不需要缓存的内容;在模板需要用<{nocache}>{$time}<{/nocache}>
$smarty->assign("time",date("H:i:s"));
$smarty->display('cache.html',$_SERVER['REQUEST_URI']);