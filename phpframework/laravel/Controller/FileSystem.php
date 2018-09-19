<?php
/*
 * 文件系统(config/filesystems.php)
 *
 * 1.公共文件(storage/app/public)
 *      php artisan storage:link #生成软连接(public/storage --> storage/app/public)
 *      http://localhost/public/storage #即可访问
 *
 * 2.文件操作
 *      Storage::put('file.txt','Contents');       #使用默认存储方式（local）
 *      Storage::disk('local')->put('file.txt','Contents'); #指定存储方式
 *      Storage::put('file4.txt', 'sss', 'private');    #设置不可见（无法看到内容,可以获取）
        Storage::put('file5.txt','sss','public');   #默认可见
 *
 *      Storage::get('file.txt','Contents');        #获取文件内容
 *      Storage::disk('local')->get('file.txt','Contents')
 *
 *      Storage::disk('local')->exists('file.txt'); #文件是否存在
 *      Storage::disk('local')->size('file.txt');   #文件大小
 *
 *      Storage::prepend('file.txt', 'Prepended Text'); #添加内容到文件开头
 *      Storage::append('file.txt', 'Appended Text');   #添加内容到文件结尾
 *      Storage::copy('file.txt', 'app/file.txt');  #复制
 *      Storage::move('file1.txt', 'app/file1.txt');   #移动
 *      Storage::delete('file.jpg');        #删除文件
 *      Storage::delete(['file1.jpg', 'file2.jpg']);
 *
 *      $visibility = Storage::getVisibility('file4.txt');#获取文件可见度
 *      Storage::setVisibility('file4.txt', 'public');#设置文件可见度
 *
 * 3.目录操作
 *
 *      Storage::files();           #显示app目录下的所有文件
 *      Storage::files('public');   #显示app/public目录下的所有文件
 *      Storage::allFiles();        #显示app目录下的所有文件及子子目录下的文件
 *      Storage::directories();     #显示app目录下的所有目录
 *      Storage::allDirectories();  #显示app目录下的所有目录及子子目录下的目录
 *      Storage::makeDirectory('pas');#创建目录
 *      Storage::deleteDirectory('pas');#删除目录
 * */
