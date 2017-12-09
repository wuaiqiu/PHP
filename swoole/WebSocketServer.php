<?php
/*
 *异步websocket服务器（http的长链接）
 * */

#创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);

#监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    #发送信息
    $ws->push($request->fd, "hello, welcome\n");
});

#监听WebSocket消息事件
$ws->on('message', function ($ws, $request) {
    echo "Message: {$request->data}\n";
});

#监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

#开启服务器
$ws->start();
