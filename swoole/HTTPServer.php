<?php
/*
 *异步http服务器
 * */

#创建http服务器
$http = new swoole_http_server("0.0.0.0", 9501);

#获取请求 $request:请求信息 $response:响应信息
$http->on('request', function ($request, $response) {
    #设置返回头信息
    $response->header("Content-Type", "text/html; charset=utf-8");
    #发送信息
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});

#开启服务
$http->start();
