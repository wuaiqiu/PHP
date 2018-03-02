<?php
require 'vendor/autoload.php';

use EasyWeChat\Factory;

$config = [
    'app_id' => 'wx7cc8670b36cf88da',
    'secret' => '7f1d605b5f112b9c0a6804b1b4fd6cea',
    'log' => [
        'level' => 'debug',
        'file' => __DIR__.'/wechat.log',
    ],
];
$app = Factory::officialAccount($config);
$app->server->push(function ($message){
    if($message['MsgType']=='event'){
        return $message['EventKey'];
    }else{
        return false;
    }
});
$response = $app->server->serve();
$response->send();


/*
 * 菜单管理 ;自定义菜单最多包括3个一级菜单，每个一级菜单最多包含5个二级菜单
 *
 *
 * 读取（查询）已设置菜单
 * $app->menu->list();
 *
 * 获取当前菜单
 * $app->menu->current();
 *
 * 添加普通菜单  [errcode=>0,"errmsg"=>"ok"]
 * $buttons = [
 *  [
 *      "name"       => "菜单",
 *      "sub_button" => [
 *          [
 *              "type" => "view",
 *              "name" => "搜索",
 *               "url"  => "http://www.soso.com/"
 *          ],
 *          [
 *              "type" => "view",
 *              "name" => "视频",
 *              "url"  => "http://v.qq.com/"
 *         ],
 *         [
 *              "type" => "click",
 *              "name" => "赞一下我们",
 *              "key" => "V1001_GOOD"
 *          ],
 *      ]
 *  ]
 * ];
 * $app->menu->create($buttons);
 *
 * 删除指定
 * $app->menu->delete($menuId);
 *
 * 删除全部
 * $app->menu->delete();
 * */