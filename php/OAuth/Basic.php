<?php

header("Content-type: text/html; charset=utf-8");

function validate($user, $pass) {
    $users = ['wu'=>'123456', 'admin'=>'admin'];
    if(isset($users[$user]) && $users[$user] === $pass) {
        return true;
    } else {
        return false;
    }
}

if(empty($_SERVER['PHP_AUTH_USER']) || !validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    //发送401请求验证
    http_response_code(401);
    header('WWW-Authenticate: Basic realm="google.com"');
    //取消验证后显示
    echo '需要用户名和密码才能继续访问';
    exit;
} else {
    //验证成功后
    var_dump($_SERVER['PHP_AUTH_USER']);
    var_dump($_SERVER['PHP_AUTH_PW']);
}