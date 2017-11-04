<?php
//全局中间件
protected $middleware = [

];
    
//注册路由中间件
protected $routeMiddleware = [
    'checkAge'=>\App\Http\Middleware\CheckAge::class,
];
    
//中间件组
protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
     ]
];