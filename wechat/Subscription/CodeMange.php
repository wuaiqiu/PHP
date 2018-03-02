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
$app->qrcode->forever("foo");



/*
 * 二维码
 *
 *
 * 创建临时二维码
 * $app->qrcode->temporary('foo', 6 * 24 * 3600);
 *
 * 创建永久二维码  ["ticket"=>"gQHo8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAydlBPaEpwZDRjRmoxMDAwMDAwN1IAAgTwo5haAwQAAAAA","url"=>"http://weixin.qq.com/q/02vPOhJpd4cFj10000007R"]
 * $app->qrcode->forever("foo");
 *
 * 获取二维码网址 https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQHo8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAydlBPaEpwZDRjRmoxMDAwMDAwN1IAAgTwo5haAwQAAAAA
 * $app->qrcode->url($ticket);
 *
 * 下载二维码
 * $url = $app->qrcode->url($ticket);
 * $content = file_get_contents($url);
 * file_put_contents(__DIR__ . '/code.jpg', $content);
 * */