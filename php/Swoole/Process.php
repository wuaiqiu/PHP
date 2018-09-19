<?php
/*
 *  swoole_process($function,$redirect_stdin_stdout, $create_pipe)
 *      $function：子进程创建成功后要执行的函数
 *      $redirect_stdin_stdout：重定向子进程的标准输入和输出。设置为true，则在进程内echo将不是打印屏幕，而是写入到管道，
 *  默认为false，阻塞读取。
 *      $create_pipe：是否创建管道，默认为true
 * */


/*
 * 进程间通信:管道通信
 * */

#子进程数组
$workers = [];

#子进程回调函数
function deal1($worker){
    #向父进程向管道中写数据
    $worker->write($worker->pid);
    #从父进程读数据(在此阻塞，等待数据)
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
    #从子进程读数据(在此阻塞，等待数据)
    $data = $process->read();
    echo "Child: " . $data.PHP_EOL;
    #向子进程向管道中写数据
    $process->write("Hello".$data.PHP_EOL);
}

#等待回收进程
for($i = 0; $i < 3; $i++) {
    $ret = swoole_process::wait(); //阻塞回收结束运行的子进程。
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo "Worker Exit, PID=".$pid.PHP_EOL;
}



/*
 * 进程间通信:消息队列(抢占式)
 * */

#进程数组
$workers = [];

#子进程回调函数
function deal2($worker){
    #从父进程读取数据(在此阻塞，等待数据)
    $data = $worker->pop();
    echo "Father:".$data.PHP_EOL;
}

#创建子进程并使用消息列队
for($i = 0; $i < 3; $i++) {
    $process = new swoole_process('deal2', false, false);
    $process->useQueue();
    $pid = $process->start();
    $workers[$pid] = $process;
}

#父进程写入数据
foreach($workers as $process) {
    #向子进程写入数据
    $process->push($process->pid);
}

#等待回收进程
for($i = 0; $i < 3; $i++) {
    $ret = swoole_process::wait(); //阻塞回收结束运行的子进程。
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo "Worker Exit, PID=".$pid.PHP_EOL;
}