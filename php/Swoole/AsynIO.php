<?php
/*
 * 异步读文件
 * */

#异步读文件(最大可读取4M的文件)
swoole_async_readfile(__DIR__."/a.txt", function($url, $content) {
    echo "$url: $content".PHP_EOL;
});

#异步分段读文件(默认为8K = 8192字节 )
swoole_async_read( __DIR__."/Test.txt" , function($url, $content){
    if( empty( $content ) ) {
        return false;
    } else {
        echo "$url: $content";
        return true;
    }
} , 8192 );



/*
 * 异步写文件
 * */

#异步写文件(最大可写入4M的文件);FILE_APPEND:表示是否追加内容,默认覆盖写
swoole_async_writefile('test.txt', "Hello world", function($filename) {
    echo "$filename : OK".PHP_EOL;
}, FILE_APPEND);

#异步写文件:-1：表示写入的位置为末尾，0:表示从头覆盖
swoole_async_write( 'Test.txt', "This is a test log".PHP_EOL , 0 , function( $filename, $num ){
    echo "$filename: write $num byte".PHP_EOL;
});



/*
 * 异步毫秒定时器
 * */

#每隔2000ms触发一次(直接传参)
$tid=swoole_timer_tick(2000, function ($tid,$param) {
    echo "tick-2000ms.".PHP_EOL;
    echo $param;
},'Hello');

#每隔2000ms触发一次(闭包传参)
$param='ss';
$tid=swoole_timer_tick(2000, function ($tid) use ($param) {
    echo "tick-2000ms".PHP_EOL;
    echo $param;
});

#清除计时器
swoole_timer_clear($tid);


#2000ms后执行一次此函数(直接传参)
swoole_timer_after(2000, function ($param) {
    echo "after-2000ms".PHP_EOL;
    echo $param;
},"Hello");

#2000ms后执行一次此函数(闭包传参)
$params="Hello";
swoole_timer_after(2000,function () use($params){
    echo "after-2000ms".PHP_EOL;
    echo $params;
});



/*
 * 异步mysql连接
 * */

#初始化
$link = new swoole_mysql();
$config = array(
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'root',
    'password' => '123456',
    'database' => 'users',
    'charset' => 'utf8'
);

#连接数据库
$link->connect($config,function ($link,$result){
    if(!$result){
        echo "错误信息: ".$link->connect_error.PHP_EOL;
        echo "错误码:".$link->connect_errorn.PHP_EOL;
        die;
    }
    #查询数据库
    $sql="select * from student";
    $link->query($sql,function ($link,$result){
        if(!$result){
            echo "错误信息: ".$link->error.PHP_EOL;
            echo "错误码:".$link->errorn.PHP_EOL;
            die;
        }
        var_dump($result);
        $link->close();
    });
});