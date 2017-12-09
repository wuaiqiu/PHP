<?php
/*
 *创建进程
 * */

#进程回调函数
function deal(swoole_process $worker){
    echo "PID:".$worker->pid."\n";
    sleep(3);
}

#创建进程
#标准输出输入流
$p1=new swoole_process("deal");
$p1->start();
#管道输出输入流(echo 写入管道)
$p2=new swoole_process("deal",true);
$p2->start();

#等待子进程执行完成,回收资源
swoole_process::wait();


/*
 * 进程事件(需要在子进程创建并开始后添加事件)
 * */

#进程数组
$workers = [];

#进程回调函数
function deal1(swoole_process $worker){
    #向管道中写数据
    $worker->write($worker->pid);
    sleep(3);
}

#创建进程并启动
for($i=0;$i<3 ; $i++){
    $process = new swoole_process('deal1');
    $pid = $process->start();
    $workers[$pid] = $process;
}

#添加进程事件
foreach($workers as $process){
    #$process->pipe属性为管道标识符，use是用来向匿名函数传入外部变量
    swoole_event_add($process->pipe, function ($pipe) use($process){
        $data = $process->read();
        echo "RECV: " . $data.PHP_EOL;
    });
}


/*
 * 进程队列
 * */

#进程数组
$workers = [];

#向子进程取数据
function deal2(swoole_process $worker){
    $recv = $worker->pop();
    echo "From Master: $recv\n";
    $worker->exit(0);
}

#创建进程
for($i = 0; $i < 3; $i++) {
    $process = new swoole_process('deal2');
    #使用列队
    $process->useQueue();
    $pid = $process->start();
    $workers[$pid] = $process;
}

#向子进程添加数据
foreach($workers as $pid => $process) {
    $process->push("hello worker[$pid]\n");
}

#等待回收进程
for($i = 0; $i < 3; $i++) {
    $ret = swoole_process::wait();
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo "Worker Exit, PID=".$pid.PHP_EOL;
}


/*
 * 信号触发器
 * */

#为alarm设置信号触发器
swoole_process::signal(SIGALRM,function(){
    echo "你使用了alarm定时器";
});

#触发（微秒级定时器,循环执行）
swoole_process::alarm(1000*100);


/*
 * 锁机制
 *      文件锁 SWOOLE_FILELOCK
 *      读写锁 SWOOLE_RWLOCK
 *      信号量 SWOOLE_SEM
 *      互斥锁 SWOOLE_MUTEX
 *      自旋锁 SWOOLE_SPINLOCK
 * */

#创建锁对象
$lock = new swoole_lock(SWOOLE_MUTEX);
#开始锁定
$lock->lock();
echo "[Master]Get lock\n";
#pcntl_fork()创建一个子进程(PID>0为执行父进程逻辑，PID=0为执行子进程逻辑)
if (pcntl_fork() > 0) {
    sleep(1);
    $lock->unlock();
    echo "[Master]release lock\n";
} else {
    $lock->lock();
    echo "[Child] Get Lock\n";
    $lock->unlock();
    exit("[Child] release Lock\n");
}