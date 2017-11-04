<?php

//1.基础路由 

#http://localhost/public/basic1
Route::get('basic1',function(){
   return 'Hello world'; 
});

#http://localhost/public/basic2
Route::post('basic2',function(){
   return 'Hello world'; 
});
#<input type="hidden" name="_token" value="{{ csrf_token() }}">

//2.多请求路由  

#http://localhost/public/basic3
Route::match(['get','post'],'basic3',function(){
    return 'Hello world';
});

#http://localhost/public/basic4
Route::any('basic4',function(){
   return 'Hello world'; 
});

//3.路由参数

#1).必须有参数 http://localhost/public/basic5/3
Route::get('basic5/{id}',function($id){
    return 'basic5-'.$id;
});

#2).参数可有可无   http://localhost/public/basic6
Route::get('basic6/{id?}',function($id=null){
   return 'basic6-'.$id; 
});

#3).限制参数  http://localhost/public/basic7/2
Route::get('basic7/{id}',function($id){
   return 'basic7-'.$id; 
})->where('id','[0-9]+');

#4).组合参数 http://localhost/public/basic8/22/str
Route::get('basic8/{id}/{name?}',function($id,$name=null){
    return 'basic8-'.$name.'-id-'.$id;
})->where(['id'=>'[0-9]+','name'=>'[a-zA-Z]+']);

//4.命名路由(常用于route函数)

#http://localhost/public/basic9
Route::get('basic9',function(){return route('basic');})->name('basic9');


//5.调用控制器
#http://localhost/public/Student/info1
Route::get('Student/info1','StudentController@info1');

//6.注册中间件
#http://localhost/public/Student/info1?age=300
Route::get('Student/info1','StudentController@info1')->middleware('checkAge');


/*
 * 7.路由群组
 *  1)中间件:'middleware' => 'auth'
 *  2)命名空间:'namespace'=>'Admin'；表示在App\Http\Controllers\Admin的控制器
 * */

Route::group(['namespace'=>'Admin'],function(){
   
    #http://localhost/public/basic10
    Route::get('basic10','StudentController@info1');
    
    #http://localhost/public/basic11
    Route::get('basic11','StudentController@info2');
});