<?php
namespace  App\Providers;

use App\Http\Services\Ioc;
use Illuminate\Support\ServiceProvider;

class IocServiceProvider extends ServiceProvider{
    
    //注册服务
    public function register(){
        $this->app->bind('Ioc', function ($app) {
            return new Ioc();
        });
    }
    
    //访问框架已注册的所有其它服务
    public function boot(){
        
    }
    
    //服务提供者加是否延迟加载.
    protected $defer = true;
    public function provides(){
        return [Ioc];
    }
    
}

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