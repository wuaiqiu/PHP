<?php
/*
 * 锁机制(互斥锁)
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
 * 缓存区:不支持内存共享
 * */

#创建一个内存对象（默认128字节）
$buffer=new swoole_buffer();
#向缓存区的任意内存位置写数据
$buffer->write(0, "Hello world");
#将一个字符串数据追加到缓存区末尾
$buffer->append("swoole");
#读取缓存区任意位置的内存
$str=$buffer->read(0, 12);
echo $str;
#清理缓存区数据。
$buffer->clear();



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



/*
 *Atomic:原子计数操作类，可以方便整数的无锁原子增减
 * */

#创建一个原子计数对象。
$atomic = new swoole_atomic(123);
#增加计数
echo $atomic->add(12).PHP_EOL;
#减少计数
echo $atomic->sub(11).PHP_EOL;
#如果不等于返回false
echo $atomic->cmpset(122, 999).PHP_EOL;
#如果当前数值等于$cmp_value返回true，并将当前数值设置为$set_value
echo $atomic->cmpset(124, 999).PHP_EOL;
#获取当前计数的值
echo $atomic->get().PHP_EOL;
#将当前值设置为指定的数字。
$atomic->set(123);