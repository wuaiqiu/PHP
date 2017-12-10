<?php
/*
 * 异步读文件(最大可读取4M的文件)
 * */

swoole_async_readfile(__DIR__."/a.txt", function($url, $content) {
    echo "$url: $content".PHP_EOL;
});


/*
 *异步分段读文件(每次读取8192个字节)
 * */

swoole_async_read( __DIR__."/Test.txt" , function($url, $content){
    if( empty( $content ) ) {
        return false;
    } else {
        echo "$url: $content";
        return true;
    }
} , 8192 );


/*
 * 异步写文件(最大可写入4M的文件)
 * */

#FILE_APPEND:表示是否追加内容,默认覆盖写
swoole_async_writefile('test.txt', "Hello world", function($filename) {
    echo "$filename : OK".PHP_EOL;
}, FILE_APPEND);


/*
 * 异步写文件:-1：表示写入的位置为末尾，0:表示从头覆盖
 * */

swoole_async_write( 'Test.txt', "This is a test log".PHP_EOL , 0 , function( $filename, $num ){
    echo "$filename: write $num byte".PHP_EOL;
});