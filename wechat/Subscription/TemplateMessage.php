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
$app->template_message->setIndustry(1, 2);
$app->template_message->getIndustry();


/*
 * 模板管理
 *
 * 修改账号所属行业 ["errcode"=>0 , "errmsg"=>"ok"]
 * $app->template_message->setIndustry($industryId1, $industryId2);
 *
 * 获取支持的行业列表 ["primary_industry"=>["first_class"=>"IT科技","second_class"=>"互联网|电子商务"] ,"secondary_industry"=> ["first_class"=>"IT科技" ,"second_class"=>"IT软件与服务" ]]
 * $app->template_message->getIndustry();
 *
 * 添加模板  ["errcode"=>0 , "errmsg"=>"ok" , template_id"=>"qev3t2jefiqC9gMFqBvUYqHaW4gu72RBYYKqD0PUmm8"]
 * $app->template_message->addTemplate($shortId);
 *
 * 获取所有模板列表 ["template_list"=>["template_id","title","primary_industry","deputy_industry","content","example"]]
 * $app->template_message->getPrivateTemplates();
 *
 * 删除模板 ["errcode"=>0,"errmsg"=>"ok"]
 * $app->template_message->deletePrivateTemplate($templateId);
 *
 * 发送模板消息 ["errcode"=>0,"errmsg"=>"ok","msgid"=>173793506630893568]
 * $app->template_message->send([
 *      'touser' => 'user-openid',
 *      'template_id' => 'template-id',
 *       'url' => 'https://easywechat.org',
 *              'data' => [
 *                  'key1' => ['VALUE','COLOR'],
 *                  'key2' => ['VALUE2','COLOR']
 *      ]
 * ]);
 * */