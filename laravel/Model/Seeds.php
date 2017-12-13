<?php
/*
 * 数据填充
 *
 * (1).相关命令
 *  #生成填充类
 *  php artisan make:seeder Seeds
 *  #运行填充器
 *  php artisan db:seed
 *  #运行指定的填充器
 *  php artisan db:seed --class=UserTableSeeder
 *  #回滚并重新运行迁移
 *  php artisan migrate:refresh --seed
 * */

class Seeds extends Seeder{

    //运行数据库填充
    public function run(){
        DB::table('users')->insert(
            ['name'=>'zhagnsan','id'=>1,'class'=>'12'],
            ['name'=>'lisi','id'=>2,'class'=>'12']
        );
    }
}