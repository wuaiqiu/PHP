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

/*
 * 使用模型工厂
 *
 * 1.定义模式工厂(database/factories/ModelFactory.php)
 *      $factory->define(App\Phone::class, function (Faker\Generator $faker) {
 *      return [
 *          'uid'=>$faker->randomDigit,
 *          'num'=>str_random(3)
 *       ];
 *     });
 *
 *
 * 2.使用工厂(随机产生10条数据)
 *      factory('App\Phone',10)->create();
 * */