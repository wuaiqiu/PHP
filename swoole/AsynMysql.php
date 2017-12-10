<?php
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