<?php
#1.编写Service类(App/Http/Services)
class IocService{
    public function service(){
        return 'Hello World';
    }
}

#2.编写ServiceProvider(App/Providers)
#php artisan make:provider IocServiceProvider
class IocServiceProvider extends ServiceProvider{

    //注册服务
    public function register(){
        $this->app->bind('Ioc', function ($app) {
            return new IocService();
        });
    }

    //访问框架已注册的所有其它服务
    public function boot(){}
}

#3.注册ServiceProvider(config/app.php)


/*
 * 1.简单的绑定(第一个参数是我们想要注册的类名或接口名称，第二个参数是返回类的实例的闭包)
 * $this->app->bind('Ioc', function ($app) {
 *      return new Ioc();
 *  });
 *
 * 2.绑定一个单例(接下来对容器的调用将会返回同一个实例)
 * $this->app->singleton('Ioc', function ($app) {
 *      return new Ioc();
 * });
 *
 * 3.绑定实例
 * $Ioc =new Ioc();
 * $this->app->instance('Ioc', $Ioc);
 *
 * 4.获取对象
 * $Ioc = $this->app->make('Ioc');//只能在服务提供器中用
 * $Ioc = resolve('Ioc');//能在任何地方用
 * */