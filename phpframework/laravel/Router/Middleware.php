<?php
#1.生成中间件
#php artisan make:middleware CheckAge

#2.编写中间件
class CheckAge{
    public function handle(Request $request, Closure $next){
        if ($request->input('age') <= 200) {
            return redirect('info2');//请求不通过
        }
        return $next($request);//请求通过
    }
}

#3.注册中间件(app/http/kernel.php)
//全局中间件
protected $middleware = [];

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