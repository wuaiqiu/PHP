<?php
/*
 * 用于处理耗时任务的worker进程（taskworker），普通的worker进程继续接受其他请求
 * */

#开启服务器
$server = new swoole_server("127.0.0.1", 9501);

#设置异步任务的工作进程数量
$server->set(array('task_worker_num' => 4));

#监听接受数据事件
$server->on('receive', function($server, $fd, $from_id, $data) {
    #投递异步任务
    $task_id = $server->task($data);
    echo "Dispath AsyncTask[id=$task_id]".PHP_EOL;
});

#处理异步任务
$server->on('task', function ($server, $task_id, $from_id, $data) {
    echo "New AsyncTask[id=$task_id]".PHP_EOL;
    #返回任务执行的结果
    $server->finish("$data is complete");
});

#处理异步任务的结果
$server->on('finish', function ($server, $task_id, $data) {
    echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
});

#开启服务器
$server->start();