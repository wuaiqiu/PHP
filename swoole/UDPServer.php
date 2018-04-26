<?php
/*
* 异步udp服务器
 *
 *  单线程模式(SWOOLE_BASE):BASE模式下Reactor和Worker可以理解为是同一个角色，在Reactor内直接回调PHP的函数。
 * 如果回调函数中有阻塞操作会导致Server退化为同步模式，用户服务器与客户端交互较少的场景下
 *  多进程模式(SWOOLE_PROCESS,默认):提供了完善的进程管理、内存保护机制。 在业务逻辑非常复杂的情况下，也可以
 * 长期稳定运行。
* */

#创建Server对象,监听 127.0.0.1:9502端口
$server = new swoole_server("127.0.0.1", 9502, SWOOLE_BASE, SWOOLE_SOCK_UDP);

#设置运行参数
$server->set([
    'worker_num' => 4, // 4个worker
    'task_worker_num' => 4 // 4个task
]);

#监听数据接收事件 $server:服务器信息 $data:接受的数据 $clientInfo:客户端信息
$server->on('packet', function ($server, $data, $clientInfo) {
    #服务器发送数据 $ip:客户端ip $port:客户端端口 $msg:发送的数据
    $server->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    #把任务丢给task
    $server->task($data);
});

#处理task任务
$server->on('Task', function ($server, $task_id, $from_id, $data) {
    echo "This Task {$task_id} from Worker {$from_id}\n";
    echo "Data: {$data}\n";
    #模拟慢io查询、
    for($i = 0 ; $i < 2 ; $i ++ ) {
        sleep(1);
        echo "Task {$task_id} Handle {$i} times...\n";
    }
    #return 数据 给 Finish，以及worker
    return "Task {$task_id}'s result";
});

#task任务处理完毕
$server->on('Finish', function ($server,$task_id, $data) {
    echo "Task {$task_id} finish\n";
    echo "Result: {$data}\n";
});

#启动服务器
$server->start();



/*
 * 异步udp客户端
 * */

$client = new swoole_client(SWOOLE_SOCK_UDP);

$client->connect('127.0.0.1', 9503, 1);

$i = 0;
while ($i < 1000) {
    $client->send($i."\n");
    $message = $client->recv();
    echo "Get Message From Server:{$message}\n";
    $i++;
}