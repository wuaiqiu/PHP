<?php
/*
 *异步http服务器：swoole_http_server对Http协议的支持并不完整，建议仅作为应用服务器。并且在前端增加Nginx作为代理。
 * */

#创建http服务器
$http = new swoole_http_server("0.0.0.0", 9501);

#获取请求 $request:请求信息 $response:响应信息
$http->on('request', function ($request, $response) {
    #获取全局数据
    $_GET = $request->get;
    $_POST = $request->post;
    $_COOKIE = $request->cookie;
    $_FILES = $request->files;
    $_SERVER = $request->server;
    #设置返回头信息
    $response->header("Content-Type", "text/html; charset=utf-8");
    #发送信息
    $response->end("<h1>Hello Swoole".rand(1000, 9999)."</h1>");
});

#开启服务
$http->start();

/*
 * $request
 *      fd      客户端标示
 *      header  Http请求的头部信息
 *      server  Http请求相关的服务器信息
 *      get     Http请求的GET参数
 *      post    Http请求的POST参数
 *      cookie  HTTP请求携带的COOKIE信息
 *
 * $response
 *      header(string $key, string $value)  设置HTTP响应的Header信息
 *      cookie(string $key, string $value = '', int $expire = 0)  设置HTTP响应的Cookie信息
 *      status(int $http_status_code)  发送Http状态码
 *      end(string $html)   发送Http响应体，并结束请求处理
 * */



/*
 * 异步http客户端
 *      client属性
 *          body        请求响应后服务器端返回的内容
 *          statusCode  服务器端返回的Http状态码，如404、200、500等
 * */

$client = new swoole_http_client('127.0.0.1', 9501);

$client->setHeaders([
    'Host' => "localhost",
    "User-Agent" => 'Chrome/49.0.2587.3',
    'Accept' => 'text/html,application/xhtml+xml,application/xml',
    'Accept-Encoding' => 'gzip',
]);

#get请求
$client->get('/', function ($client) {
    echo $client->body;
});

#post请求
$client->post('/',array("a" => '1234', 'b' => '456'), function ($client) {
    echo $client->body;
});

#下载文件（服务器位置，本地位置）
$client->download('/Test.txt', __DIR__.'/test.txt', function ($client) {
    var_dump($client->downloadFile);
});

#上传文件(文件路径，上传的字段名)
$client->addFile(__DIR__.'/Test.txt', 'file');
$client->post('/', array("a" => '123', 'b' => '456'), function ($client) {
    echo $client->body;
});