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
$app->broadcasting->sendText('大家好！欢迎使用 EasyWeChat');


/*
 * 群发消息(永久材料)
 *
 *
 * 文本消息  ["errcode"=>0 , "msg_id"=>"1000000002"]
 * $app->broadcasting->sendText("大家好！欢迎使用 EasyWeChat。");
 * $app->broadcasting->sendText("大家好！欢迎使用 EasyWeChat。", [$openid1, $openid2]);
 * $app->broadcasting->sendText("大家好！欢迎使用 EasyWeChat。", $tagId);
 *
 * 图片消息 ["errcode"=>0 , "msg_id"=>"1000000002"]
 * $app->broadcasting->sendImage($mediaId);
 * $app->broadcasting->sendImage($mediaId, [$openid1, $openid2]);
 * $app->broadcasting->sendImage($mediaId, $tagId);
 *
 * 语音消息 ["errcode"=>0 , "msg_id"=>"1000000002"]
 * $app->broadcasting->sendVoice($mediaId);
 * $app->broadcasting->sendVoice($mediaId, [$openid1, $openid2]);
 * $app->broadcasting->sendVoice($mediaId, $tagId);
 *
 * 视频消息 ["errcode"=>0 , "msg_id"=>"1000000002"]
 * $videoMedia = $app->media->uploadVideoForBroadcasting($url, '视频标题', '视频描述');
 * $app->broadcasting->sendVideo($videoMedia['media_id']);
 *
 * 图文消息 ["errcode"=>0 , "msg_id"=>"1000000002"]
 * $app->broadcasting->sendNews($mediaId);
 * $app->broadcasting->sendNews($mediaId, [$openid1, $openid2]);
 * $app->broadcasting->sendNews($mediaId, $tagId);
 *
 * 查询群发消息发送状态  ["msg_id"=>1000000002 , "msg_status"=>"SEND_SUCCESS"]
 * $app->broadcasting->status($msgId);
 * */