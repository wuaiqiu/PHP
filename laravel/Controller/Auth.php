<?php
/*
 * Laravel自带登录表单
 *
 * (1).生成所需文件
 *   php artisan make:auth
 *
 * (2).需要修改app/Providers/AppServiceProvider的boot方法中添加【mariadb中】
 *   Schema::defaultStringLength(191);
 *
 * (3).数据迁移
 *   php artisan migrate
 *
 * (4).修改resources/views/layouts/app.blade.php的js与css路径
 *      asset('css/app.css');
 *      asset('js/app.js');
 *
 * (5).其他
 *      a.修改重定向页面(LoginController， RegisterController 和 ResetPasswordController)
 *       protected $redirectTo = '/';
 *
 *      b.自定义用户名(LoginController)
 *        public function username(){
 *          return 'name';
 *        }
 *
 *      c.获取当前认证用户
 *          $user = Auth::user();
 *          $id = Auth::id();
 *
 *      d.判断当前用户是否通过认证
 *          $bool=Auth::check();
 *
 *      e.清除session
 *          Auth::logout();
 *
 * (6).路由保护
 *       Route::get('profile', 'ProfileController@index')->middleware('auth');
 *
 * */