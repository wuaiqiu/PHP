<?php
/*
 *异步websocket服务器（http的长链接）
 * */

#创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);

#监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    #发送信息
    $ws->push($request->fd, "hello, welcome".PHP_EOL);
});

#监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}".PHP_EOL;
});

#监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed".PHP_EOL;
});

#开启服务器
$ws->start();

/*
 * $frame : 客户端发来的数据帧信息
 *          fd      客户端的标示
 *          data    数据内容，可以是文本内容也可以是二进制数据，可以通过opcode的值来判断
 *          opcode  WebSocket的OpCode类型，WEBSOCKET_OPCODE_TEXT = 0x1 ，文本数据；WEBSOCKET_OPCODE_BINARY = 0x2 ，二进制数
 *          finish  表示数据帧是否完整，一个WebSocket请求可能会分成多个数据帧进行发送
 * */


/*
 *异步websocket客户端
 * */
#创建websocket异步客户端
$client = new swoole_http_client('127.0.0.1', 9502);

#接受信息
$client->on('message', function ($client, $frame) {
    echo $frame->data;
});

#发送信息
$client->upgrade('/', function ($client) {
    $client->push("hello world");
});


/*
<script>
    var wsServer = 'ws://127.0.0.1:9502';
    var websocket = new WebSocket(wsServer);
    websocket.onopen = function (evt) {
        console.log("Connected to WebSocket server.");
        websocket.send("Hello");
    };

    websocket.onclose = function (evt) {
        console.log("Disconnected");
    };

    websocket.onmessage = function (evt) {
        console.log('Retrieved data from server: ' + evt.data);
    };

    websocket.onerror = function (evt, e) {
        console.log('Error occured: ' + evt.data);
    };
</script>
 */
