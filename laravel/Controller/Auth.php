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
 * (7).手动编写
 *      #认证成功的话 attempt 方法将会返回 true
 *      Auth::attempt(['email' => $email, 'password' => $password])
 *      #intended 方法将用户重定向到登录之前用户想要访问的 URL，在目标 URL 无效的情况下回退 home
 *      redirect()->intended('home')
 *      #“记住”用户
 *      Auth::attempt(['email' => $email, 'password' => $password], $remember)
 * */