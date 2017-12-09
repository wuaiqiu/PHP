<?php
#每隔2000ms触发一次
$tid=swoole_timer_tick(2000, function ($tid) {
    echo "tick-2000ms\n";
});

#3000ms后执行此函数
$aid=swoole_timer_after(3000, function () {
    echo "after 3000ms.\n";
});

#清除计时器
swoole_timer_clear($tid);
swoole_timer_clear($aid);
