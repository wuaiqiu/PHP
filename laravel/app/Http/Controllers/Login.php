<?php
/*
 * Laravel自带登入表单
 *
 * (1).生成所需文件
 *   php artisan make:auth
 *
 * (2).数据迁移
 *   php artisan migrate
 *
 * (3).修改resources/views/layouts/app.blade.php的js与css路径
 *      asset('css/app.css');
 *      asset('js/app.js');
 *   
 * (4).需要修改app/Providers/AppServiceProvider的boot方法中添加【mariadb中】
 *      Schema::defaultStringLength(191);
 * */