<?php
//开启一个普通的Yar RPC客户端
$client = new yar_client("http://localhost/yar/server.php");
//掉用相应的方法
var_dump($client->add(1, 2));
var_dump($client->call("add", array(3, 2)));