<?php
/*
 * 异步tcp服务器
 * */

#创建Server对象，监听 127.0.0.1:9501端口
$server = new swoole_server("127.0.0.1", 9501);

#监听连接进入事件 $server:服务器信息 $fd:客户端标示
$server->on('connect', function ($server, $fd) {
    echo "Client: Connect.".PHP_EOL;
});

#监听数据接收事件 $server:服务器信息 $fd:客户端标示 $from_id：worker id  $data:接受的数据
$server->on('receive', function ($server, $fd, $from_id, $data) {
    #发送数据 $fd:客户端标示
     $server->send($fd, "Server: ".$data);
});

#监听连接关闭事件 $server:服务器信息 $fd:客户端标示
$server->on('close', function ($server, $fd) {
    echo "Client: Close.".PHP_EOL;
});

#启动服务器
$server->start();


/*
 *同步tcp客户端(connect/send/recv 会等待IO完成后再返回)
 * */

#创建tcp客户端
$client = new swoole_client(SWOOLE_SOCK_TCP);

#连接到服务器
if (!$client->connect('127.0.0.1', 9501, 0.5)) {
    die("connect failed.");
}

#向服务器发送数据
if (!$client->send("hello world")) {
    die("send failed.");
}

#从服务器接收数据
if (!($data=$client->recv())) {
    die("recv failed.");
}
echo $data;

#关闭连接
$client->close();


/*
 * 异步tcp客户端
 * */

#创建异步tcp客户端
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

#注册连接成功回调
$client->on("connect", function($client) {
    $client->send("hello world".PHP_EOL);
});

#注册数据接收回调
$client->on("receive", function($client, $data){
    echo "Received: ".$data.PHP_EOL;
});

#注册连接失败回调
$client->on("error", function($client){
    echo "Connect failed".PHP_EOL;
});

#注册连接关闭回调
$client->on("close", function($client){
    echo "Connection close".PHP_EOL;
});

#发起连接
$client->connect('127.0.0.1', 9501, 0.5);