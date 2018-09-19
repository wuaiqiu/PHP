<?php
/*
 *  Yar 是一个轻量级, 高效的RPC框架, 它提供了一种简单方法来让PHP项目之间可以互相远程调用对方的本地方法.
 * 并且Yar也提供了并行调用的能力. 可以支持同时调用多个远程服务的方法.
 * */

#http://localhost/yar/server.php

class Operator {
    public function add($a, $b) {
        return $this->_add($a, $b);
    }
    public function sub($a, $b) {
        return $a - $b;
    }
    public function mul($a, $b) {
        return $a * $b;
    }
    //protected方法不会暴露在外界
    protected function _add($a, $b) {
        return $a + $b;
    }
}

//实例化Yar RPC服务
$server = new Yar_Server(new Operator());
//启动HTTP RPC Server
$server->handle();