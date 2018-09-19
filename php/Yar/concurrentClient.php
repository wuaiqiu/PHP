<?php
//当请求成功后的回调函数
function callback($ret, $callinfo) {
    echo $callinfo['method'] , " result: ", $ret , "\n";
}

//注册一个异步调用队列
Yar_Concurrent_Client::call("http://localhost/yar/server.php", "add", array(1, 2), "callback");
Yar_Concurrent_Client::call("http://localhost/yar/server.php", "mul", array(2, 1), "callback");
//发送所有注册的调用队列, 等待返回, 成功返回后会回调callback函数
Yar_Concurrent_Client::loop();
//重置注册的调用队列
Yar_Concurrent_Client::reset();
Yar_Concurrent_Client::call("http://localhost/yar/server.php", "sub", array(2, 1), "callback");
Yar_Concurrent_Client::loop();


/*
 * $ret:返回结果
 *
 * $callinfo结构:请求信息
 *
 *  array(3) {
 *      #在请求队列中的序号
 *      ["sequence"]=>int(1)
 *      #请求地址
 *      ["uri"]=>string(31) "http://localhost/yar/server.php"
 *      #请求调用的方法名
 *      ["method"]=>string(3) "add"
 *  }
 **/