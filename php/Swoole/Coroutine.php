<?php
/*
 *     协程:(Coroutine)也叫用户级线程,swoole协程与线程不同，在一个进程内创建的多个协程，实际上是串行的。同一CPU时间，
 * 只有一个协程在执行，因此swoole协程是阻塞运行的，语法也是用的同步的方式在写，只不过是在底层做了切换调度，提高的仅仅
 * 是单个进程接收请求的能力，并没有提高执行速度（总共需要的时间）
 * */



/*
 *  Server:
 *        swoole\server ==>  onWorkerStart onClose  onConnect  onReceive  onPacke
 *        swoole\websocket\server ==> onMessage onOpen
 *        swoole_http_server ==> onRequest
 * */



/*
 * Swoole\Coroutine\Client
 * */

$server = new swoole_http_server("127.0.0.1", 9502);

$server->on('request', function ($request, $response) {

    #创建协程客户端
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);

    #连接服务器并开启超时处理（同时作用于Connect和Recv、Send 超时,超时时间单位是秒s）
    if (!$client->connect('127.0.0.1', 9502, 0.5)) {
        return $response->end(' swoole response error:' . $client->errCode);
    }

    #发送数据给server
    $client->send("hello world".PHP_EOL);

    #接收数据(参数为超时时间，如果不设置以connect的为准。超时会自动close掉)
    echo "from server: ".$client->recv().PHP_EOL;

    #close 关闭连接
    $client->close();
    $response->end('ok');
});

$server->start();



/*
 * Swoole\Coroutine\Http\Client
 * */

$server = new swoole_http_server("127.0.0.1", 9502);

$server->on('request', function ($request, $response) {

    #创建协程客户端
    $client = new Swoole\Coroutine\Http\Client('localhost', 80);

    #设置请求头
    $client->setHeaders([
        'Host' => "localhost",
        "User-Agent" => 'Chrome/49.0.2587.3',
        'Accept' => 'text/html,application/xhtml+xml,application/xml',
        'Accept-Encoding' => 'gzip',
    ]);

    #设置超时时间
    $client->set(['timeout' => 5]);

    #get方法，协程会阻塞
    $client->get('/index.php');

    #输出返回体
    echo $client->body;

    #close 关闭连接
    $client->close();
    $response->end('ok');
});

$server->start();



/*
 * Swoole\Coroutine\MySQL
 *
 * */

$server = new swoole_http_server("127.0.0.1", 9502);

$server->on('Request', function ($request, $response) {

    #创建协程Mysql
    $db = new Swoole\Coroutine\MySQL();

    #配置
    $server = array(
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '123456',
        'database' => 'blog',
    );

    #连接
    $db->connect($server);

    #a.直接query
    $result1 = $db->query('SELECT * FROM admin WHERE aid=1512142019');
    var_dump($result1);

    #b.预处理
    $stmt = $db->prepare('SELECT * FROM admin WHERE aid=?');
    if ($stmt == false) {
        var_dump($db->errno, $db->error);
    } else {
        $result2 = $stmt->execute(array(1512142019));
        var_dump($result2);
    }

    #close 关闭
    $response->end('ok');
});
$server->start();



/*
 *  协程并发:需要用延迟收包，当遇到IO 阻塞的时候，协程就挂起了，不会阻塞在那里等着网络回报，而是继续往下走。
 * */

$server = new swoole_http_server("127.0.0.1", 9502);

$server->on('Request', function ($request, $response) {

    #创建mysql客户端协程1
    $mysql1 = new Swoole\Coroutine\MySQL();
    $mysql1->connect([
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '123456',
        'database' => 'blog',
    ]);
    $mysql1->setDefer();
    $mysql1->query('select name from admin');


    #创建mysql客户端协程2
    $mysql2 = new Swoole\Coroutine\MySQL();
    $mysql2->connect([
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '123456',
        'database' => 'blog',
    ]);
    #声明延迟收包
    $mysql2->setDefer();
    $mysql2->query('select aid from admin');


    #收包
    $result1=$mysql1->recv();
    $result2=$mysql2->recv();
    var_dump($result1,$result2);

    #close 关闭
    $response->end('Test End');
});
$server->start();