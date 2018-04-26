<?php
/*
 * 异步tcp服务器
 * */

#创建Server对象，监听 127.0.0.1:9501端口
$server = new swoole_server("127.0.0.1", 9501);

#设置运行时参数
$server->set([
    'worker_num' => 10, //设置worker进程数(默认为CPU核数)
    'task_worker_num' => 8,//设置taskworker进程数(默认为0)
    'deamonize' => true, //设置为守护进程(只能用于init，不能用于systemd)
]);

#增加新的监控
$server->addlistener("127.0.0.1", 9500, SWOOLE_SOCK_TCP);

#Manager进程启动
$server->on('ManagerStart', function ($server){
    echo "On manager start.";
});

#work进程启动
$server->on('WorkerStart', function($server, $workerId) {
    echo $workerId . '---';
});

#worker进程终止
$server->on('WorkerStop', function($server,$workerId) {
    echo '--stop';
});

#启动server时候会触发。
$server->on('start',function ($server){
        echo "Start".PHP_EOL;
});

#监听连接进入事件 $server:服务器信息 $fd:客户端标示
$server->on('connect', function ($server, $fd) {
    echo "Client: Connect.".PHP_EOL;
});

#监听数据接收事件 $server:服务器信息  $from_id：workerId  $data:接受的数据
$server->on('receive', function ($server, $fd, $from_id, $data) {
    #发送数据 $fd:客户端标示
    $server->send($fd, "Server: ".$data);
    #关闭该work进程
    $server->stop();
    #关闭服务器
    $server->shutdown();
    #主动关闭 客户端连接,也会触发onClose事件
    $server->close($fd);
    #遍历所有连接
    $list = $server->connection_list();
    foreach ($list as $fd) {
            $server->send($fd, $data);
    }
    #开启一个taskworker进程处理任务
    $server->task(json_encode($data));
});

#监听连接关闭事件 $server:服务器信息 $fd:客户端标示
$server->on('close', function ($server, $fd) {
    echo "Client: Close.".PHP_EOL;
});

#处理task任务，处理结果返回worker，以及传给onFinish
$server->on('task',function ($server, $task_id, $from_id, $data){
    echo "This Task {$task_id} from Worker {$from_id}\n";
    echo "Data: {$data}\n";
    for($i = 0 ; $i < 200 ; $i ++ ) {
        sleep(1);
        echo "Task {$task_id} Handle {$i} times...\n";
    }
    $fd = json_decode($data, true);
    $server->send($fd['fd'] , "Data in Task {$task_id}");
    return "Task {$task_id}'s result";
});

#task任务处理完毕（$data为onTask返回的数据）
$server->on('finish',function ($server,$task_id, $data){
    echo "Task {$task_id} finish\n";
    echo "Result: {$data}\n";
});

#启动服务器
$server->start();



/*
 *同步tcp客户端(connect/send/recv 会等待IO完成后再返回)
 * */

#创建tcp客户端(keepAlive)
$client = new swoole_client(SWOOLE_SOCK_TCP|SWOOLE_KEEP);

#连接到服务器(0.5s超时)
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
    $client->isConnected(); //swoole_client的连接状态
    $client->getsockname(); //获取客户端socket的本地host:port
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