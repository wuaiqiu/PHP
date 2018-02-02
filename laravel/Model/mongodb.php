<?php
/*
 * Mongodb
 *
 * 一.安装与配置
 *   composer require jenssegers/mongodb
 *
 *   (config/app.php)
 *      Jenssegers\Mongodb\MongodbServiceProvider::class,
 *
 *   (config/database.php)
 *      'mongodb' => [
 *          'driver'   => 'mongodb',
 *          'host'     => env('DB_HOST', 'localhost'),
 *          'port'     => env('DB_PORT', 27017),
 *          'database' => env('DB_DATABASE'),
 *          'username' => env('DB_USERNAME'),
 *          'password' => env('DB_PASSWORD')
 *        ]
 *
 *
 * 二.Eloquent
 *
 *      use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
 *
 *      class User extends Eloquent {
 *              //链接数据库方式
 *              protected $connection = 'mongodb';
 *              //指定集合,默认为users集合
 *              protected $collection = 'relation';
 *              //指定主键，默认为id
 *              protected $primaryKey='uid';
 *      }
 *
 * 三.查询构造器
 *
 *      $users = DB::collection('users')->get();
 *      $user = DB::collection('users')->where('name', 'John')->first();
 *      $user = DB::connection('mongodb')->collection('users')->get(); //指定链接方式
 *
 * 四.数据迁移
 *
 *
 *      Schema::create('users', function($collection){
 *              $collection->index('name');
 *              $collection->unique('email');
 *      });
 *
 *
 * 五.MongoDB特殊操作
 *
 *      (1)Projections
 *          DB::collection('items')->project(['tags' => ['$slice' => 1]])->get();
 *          DB::collection('items')->project(['tags' => ['$slice' => [3, 7]]])->get();
 *
 *      (2)Push
 *          DB::collection('users')->where('name', 'John')->push('items', 'boots');
 *          DB::collection('users')->where('name', 'John')->push('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);
 *          DB::collection('users')->where('name', 'John')->push('items', 'boots', true); //不需要重复
 *
 *      (3)Pull
 *          DB::collection('users')->where('name', 'John')->pull('items', 'boots');
 *          DB::collection('users')->where('name', 'John')->pull('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);
 *
 *      (4)Unset
 *          DB::collection('users')->where('name', 'John')->unset('note');
 *
 *          $user = User::where('name', 'John')->first();
 *          $user->unset('note');
 * */