<?php
/*
 *创建进程
 * */

#子进程回调函数
function deal($worker){
    echo "PID:".$worker->pid.PHP_EOL;
    sleep(3);
}

#创建子进程进程
$p1=new swoole_process("deal");
$p1->start();
$p2=new swoole_process("deal");
$p2->start();
$p3=new swoole_process("deal");
$p3->start();

#监听子进程退出信号
swoole_process::signal(SIGCHLD, function($sig) {
    #必须为false，非阻塞模式
    while($ret =  swoole_process::wait(false)) {
        echo "退出:PID={$ret['pid']}".PHP_EOL;
    }
});


/*
 * 进程间通信
 * */

#子进程数组
$workers = [];

#子进程回调函数
function deal1($worker){
    #子进程向管道中写数据
    $worker->write($worker->pid);
    #子进程读数据
    $data=$worker->read();
    echo "Father:".$data;
}

#创建子进程
for($i=0;$i<3 ; $i++){
    $process = new swoole_process('deal1');
    $pid = $process->start();
    $workers[$pid] = $process;
}

#父进程读取管道数据及写入数据
foreach($workers as $process){
    $data = $process->read();
    echo "Child: " . $data.PHP_EOL;
    $process->write("Hello".$data.PHP_EOL);
}

swoole_process::signal(SIGCHLD, function($sig) {
    #必须为false，非阻塞模式
    while($ret =  swoole_process::wait(false)) {
        echo "退出:PID={$ret['pid']}".PHP_EOL;
    }
});


/*
 * 进程消息队列
 * */

#进程数组
$workers = [];

#子进程取父进程的数据
function deal2($worker){
    $recv = $worker->pop();
    echo "From Master: $recv".PHP_EOL;
    $worker->exit(0);
}

#创建子进程进程
for($i = 0; $i < 3; $i++) {
    $process = new swoole_process('deal2');
    #使用列队
    $process->useQueue();
    $pid = $process->start();
    $workers[$pid] = $process;
}

#向子进程添加数据
foreach($workers as $pid => $process) {
    $process->push("hello worker[$pid]".PHP_EOL);
}

#等待回收进程
for($i = 0; $i < 3; $i++) {
    $ret = swoole_process::wait();
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo "Worker Exit, PID=".$pid.PHP_EOL;
}