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
$app->material->uploadImage("./a.jpg");


/*
 * 素材管理
 *
 *
 * 上传临时图片（PNG\JPEG\JPG\GIF，2M，保存时间为3天） ["type"=>"image","media_id"=>"DP3dOxccE5kUH8XZNKpDsFyAicoPj4ceJUMrKgFL3UNI1ITQ3i0hcuKS1jBPDMdz","created_at"=>1519909236]
 * $app->media->uploadImage($path);
 *
 * 上传临时声音（AMR\MP3，<60s,2M，保存时间为3天） ["type"=>"voice","media_id"=>"Hb_vTIYnvBw_z-J1pJRY4r7yX_-9amWso5WB4llzLyVCVGxSEvuxtcZ7YFB40qD_","created_at"=>1519909602]
 * $app->media->uploadVoice($path);
 *
 * 上传临时视频（MP4，10M，保存时间为3天） ["type"=>"video","media_id"=>"pZIds6oW3yU6Mp20NxpLZ6LVV-4tv3Qsj_DHUxMsMp6oz-SCbAnCBRWe2kcqbzZQ","created_at"=>1519909913]
 * $app->media->uploadVideo($path, $title, $description);
 *
 * 上传临时缩略图，用于视频封面或者音乐封面。（JPG，64K，保存时间为3天）["type"=>"thumb","thumb_media_id"=>"QUxTFDxPcfIOxieznHYOTlOvrlMYrs4Eii0lDq5VYWpdASHrYTxADwcNlrRHWnnl","created_at"=>1519909713]
 * $app->media->uploadThumb($path);
 *
 * 获取临时素材内容
 * $stream = $app->media->get($mediaId);
 * $stream->save('保存目录');
 * $stream->saveAs('保存目录', '文件名');
 *
 * 上传永久图片（ 2M，bmp/png/jpeg/jpg/gif）["media_id" , "url"]
 * $app->material->uploadImage($path);
 *
 * 上传语音（2M，<60s，mp3/wma/wav/amr）["media_id" , "url"]
 * $app->material->uploadVoice($path);
 *
 * 上传视频（10MB，MP4）["media_id" , "url"]
 * $app->material->uploadVideo($path, $title, $description);
 *
 * 上传缩略图（64KB，JPG）["media_id" , "url"]
 * $app->material->uploadThumb($path);
 *
 * 上传图文消息 ["media_id" , "url"]
 * $article = new Article([]);
 * $app->material->uploadArticle($article);
 * $app->material->uploadArticle([$article1, $article2]);
 *
 * 获取永久素材
 * $resource = $app->material->get($mediaId);
 * $stream->save('保存目录');
 * $stream->saveAs('保存目录', '文件名');
 *
 * 获取素材计数
 * $stats = $app->material->stats();
 *
 * 删除永久素材
 * $app->material->delete($mediaId);
 * */