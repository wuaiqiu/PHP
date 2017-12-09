<?php
/*
 * 异步udp服务器
 * */

#创建Server对象，监听 127.0.0.1:9502端口，类型为SWOOLE_SOCK_UDP
$server = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

#监听数据接收事件 $server:服务器信息 $data:接受的数据 $clientInfo:客户端信息
$server->on('Packet', function ($server, $data, $clientInfo) {
    #服务器发送数据 $ip:客户端ip $port:客户端端口
    $server->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
});

#启动服务器
$server->start();
