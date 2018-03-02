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
$app->user->get("ozYQp0zWlZCHDKQPrqxzrqWc8uYs");



/*
 * 用户管理
 *
 *
 * 获取用户列表  ["count"=>1 , "data"=>["openid"=>["ozYQp0zWlZCHDKQPrqxzrqWc8uYs"]]]
 * $app->user->list();
 *
 * 获取具体信息  ["openid","nickname","sex","language","city","province","country","remark","headimgurl","groupid","tagid_list","subscribe_time"]
 * $app->user->get($openId);
 *
 * 修改用户备注 ["errcode"=>0 , "errmsg"=>"ok"]
 * $app->user->remark($openId, $remark);
 *
 * 获取黑名单 ["count"=>1 , "data"=>["openid"=>["ozYQp0zWlZCHDKQPrqxzrqWc8uYs"]]]
 * $app->user->blacklist();
 *
 * 拉黑用户 ["errcode"=>0 , "errmsg"=>"ok"]
 * $app->user->block($openid);
 * $app->user->block([$openid1, $openid2]);
 *
 * 取消拉黑用户 ["errcode"=>0 , "errmsg"=>"ok"]
 * $app->user->unblock($openid);
 * $app->user->unblock([$openid1, $openid2]);
 *
 * 创建标签 ["tag"=>["id"=>100,"name"=>"sss"]]
 * $app->user_tag->create($name);
 *
 * 修改标签信息 ["errcode"=>0 , "errmsg"=>"ok"]
 * $app->user_tag->update($tagId, $name);
 *
 * 获取所有标签 ["tags"=>[["name"=>"星标组","id"=>2,"count"=>0]]]
 * $app->user_tag->list();
 *
 * 删除标签 ["errcode"=>0 , "errmsg"=>"ok"]
 * $app->user_tag->delete($tagId);
 *
 * 获取指定用户所属的标签 ["tagid_list"]
 * $app->user_tag->userTags($openId);
 *
 * 获取标签下用户列表 ["count"=>1 , "data"=>["openid"=>["ozYQp0zWlZCHDKQPrqxzrqWc8uYs"]]]
 * $app->user_tag->usersOfTag($tagId);
 * */