<?php
/*
 * 异步读文件
 * */

swoole_async_readfile(__DIR__."/a.txt", function($url, $content) {
    echo "$url: $content".PHP_EOL;
});


/*
 * 异步写文件
 * */

#flags:表示是否追加内容
swoole_async_writefile('test.txt', "Hello world", function($filename) {
    echo "$filename : OK".PHP_EOL;
}, false);