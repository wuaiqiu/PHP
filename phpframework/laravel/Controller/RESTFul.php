<?php
#1.生成RESTFul控制器
#php artisan make:controller PhotoController --resource

#2.注册路由
Route::resource('photos', 'PhotoController');

#3.各个动作的意义
#GET	/photos	index	photos.index
#GET	/photos/create	create	photos.create
#POST	/photos	store	photos.store
#GET	/photos/{photo}	show	photos.show
#GET	/photos/{photo}/edit	edit	photos.edit
#PUT/PATCH	/photos/{photo}	update	photos.update
#DELETE	/photos/{photo}	destroy	photos.destroy

#4.伪造表单（PUT，PATCH，DELETE）
#{{ method_field('PUT') }}