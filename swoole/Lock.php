<?php
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
echo "[Master]Get lock".PHP_EOL;
#pcntl_fork()创建一个子进程(PID>0为执行父进程逻辑，PID=0为执行子进程逻辑)
if (pcntl_fork() > 0) {
    sleep(1);
    $lock->unlock();
    echo "[Master]release lock".PHP_EOL;
} else {
    $lock->lock();
    echo "[Child] Get Lock".PHP_EOL;
    $lock->unlock();
    exit("[Child] release Lock".PHP_EOL);
}


/*
 * Table内存表:用于解决多进程/多线程数据共享
 * */

#创建table内存表对象 1024：为表格的行数
$table = new swoole_table(1024);

#设置表的列名及类型
$table->column('id', swoole_table::TYPE_INT, 4);       //1,2,4,8字节
$table->column('name', swoole_table::TYPE_STRING, 64); //64字节
$table->column('num', swoole_table::TYPE_FLOAT); //8字节

#初始化表
$table->create();

#为表设置值
$table->set('tianfenghan@qq.com', array('id' => 145, 'name' => 'rango', 'num' => 3.1415));
$table->set('350749960@qq.com', array('id' => 358, 'name' => "Rango1234", 'num' => 3.1415));
$table->set('hello@qq.com', array('id' => 189, 'name' => 'rango3', 'num' => 3.1415));

#获取值
$data = $table->get('350749960@qq.com');
var_dump($data);

#删除值
$table->del('hello@qq.com');

#遍历table
foreach($table as $row) {
    var_dump($row);
}
