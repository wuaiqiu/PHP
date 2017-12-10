<?php
#每隔2000ms触发一次(支持传参)
$tid=swoole_timer_tick(2000, function ($tid,$param) {
    echo "tick-2000ms.".PHP_EOL;
    echo $param;
},'Hello');
#使用闭包
$param='ss';
$tid=swoole_timer_tick(2000, function ($tid) use ($param) {
    echo "tick-2000ms".PHP_EOL;
    echo $param;
});
#清除计时器
swoole_timer_clear($tid);


#3000ms后执行一次此函数(不支持传参)
swoole_timer_after(3000, function () {
    echo "after 3000ms.".PHP_EOL;
});
swoole_timer_after(3000,function () use($param){
   echo "after 3000ms.".PHP_EOL;
   echo $param;
});