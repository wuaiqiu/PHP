<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Ioc extends Facade{
    
    //返回服务提供者中注册的对象
    protected static function getFacadeAccessor() { return 'Ioc'; }
}

/*
 * 访问方式(依赖注入的静态方式)
 * 
 * Ioc::方法名
 * 
 * */