<?php
require './libs/Smarty.class.php';

/*
 * 初始化
 *      setTemplateDir(path):设置模板目录
 *      setCompileDir(path):设置合成目录
 *      setConfigDir(path):设置变量配置目录
 *      addPluginsDir(path):添加插件目录
 *      setCacheDir(path):设置缓存目录
 *      left_delimiter:设置左标记
 *      rigth_delimiter:设置右标记
 *      caching：是否开启缓存
 *      cache_lifetime:缓存存活时间
 * */
$smarty=new Smarty();
$smarty->setTemplateDir("./tpl/")
        ->setCompileDir("./compose/")
        ->setConfigDir("./config/")
        ->addPluginsDir("./plugin/");
$smarty->caching=true;
$smarty->setCacheDir("./cache/");
$smarty->cache_lifetime=30;
$smarty->left_delimiter="<{";
$smarty->right_delimiter="}>";