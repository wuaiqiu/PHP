<?php
require 'vendor/autoload.php';

use EasyWeChat\Factory;

$signature=$_GET["signature"];
$timestamp=$_GET["timestamp"];
$nonce=$_GET["nonce"];
$token='wechat';
$tmpArr = array($timestamp, $nonce,$token);
sort($tmpArr, SORT_STRING);
$tmpStr = implode( $tmpArr );
$tmpStr = sha1( $tmpStr );
if( $tmpStr != $signature ){
    return false;
}

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
    return $message['Content'];
});
$response = $app->server->serve();
$response->send();


/*
 * message
 *
 * $message['ToUserName']    接收方帐号（该公众号 ID）
 * $message['FromUserName']  发送方帐号（OpenID, 代表用户的唯一标识）
 * $message['CreateTime']    消息创建时间（时间戳）
 * $message['MsgId']         消息 ID（64位整型）
 * $message['MsgType']      消息类型
 *
 * 文本（text）：
 *  - Content  文本消息内容
 *
 * 图片（image）：
 *  - MediaId        图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
 *  - PicUrl         图片链接
 *
 * 语音（voice）：
 *  - MediaId        语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
 *  - Format         语音格式，如 amr，speex 等
 *  - Recognition    开通语音识别后才有
 *
 * 视频（video）：
 *  - MediaId       视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
 *  - ThumbMediaId  视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
 *
 * 地理位置（location）：
 *  - Location_X  地理位置纬度
 *  - Location_Y  地理位置经度
 *  - Scale       地图缩放大小
 *  - Label       地理位置信息
 *
 * 链接(link)：
 *  - MsgType      link
 *  - Title        消息标题
 *  - Description  消息描述
 *  - Url          消息链接
 * */


/*
 * 自动回复
 *
 * 文本
 * use EasyWeChat\Kernel\Messages\Text;
 * new Text('您好！overtrue');
 *
 * 图片
 * use EasyWeChat\Kernel\Messages\Image;
 * new Image($mediaId);
 *
 * 声音
 * use EasyWeChat\Kernel\Messages\Voice;
 * new Voice($mediaId);
 *
 * 图文消息
 * use EasyWeChat\Kernel\Messages\News;
 * use EasyWeChat\Kernel\Messages\NewsItem;
 * $items = [
 *      new NewsItem([
 *        'title'       => '图文标题',
 *        'description' => '图文描述',
 *        'url'         => '跳转地址',
 *        'image'       => '图文图片',
 *      ]),
 *      new NewsItem([...]),
 *      new NewsItem([...]),
 * ];
 * new News($items);
 * */