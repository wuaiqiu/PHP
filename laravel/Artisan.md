# Artisan

**一.常用命令**

命令|描述
---|---
php artisan (list)|查看所有的artisan命令
php artisan help migrate|查看migrate命令的详细信息
php artisan make:controller UserController|创建UserController控制器
php artisan make:model User|创建User模型
php artisan make:middleware CheckAge|创建CheckAge中间件
php artisan make:migration create_student_table --create=students|新建一个students表的迁移文件
php artisan make:model Student -m|生成模型的同时生成迁移文件
php artisan migrate|执行database/migrations目录下的迁移文件
php artisan migrate:rollback|回滚最新的一次迁移"操作"
php artisan migrate:reset|回滚所有的应用迁移
php artisan make:seeder StudentSeeder|创建一个填充文件
php artisan db:seed --class=StudentSeeder|执行database/seeds目录下的StudentSeeder文件
php artisan db:seed|执行database/seeds目录下所有的文件
php artisan queue:table|生成queue所需的迁移数据表
php artisan queue:failed-table|生成queue中失败jobs队列
php artisan make:job SendEmail|生成queue的jobs文件
php artisan queue:listen|执行queue
php artisan queue:failed|查看执行失败的jobs
php artisan queue:retry 1（all）|执行指定id的失败jobs
php artisan queue:forget 1|删除指定id的失败jobs
php artisan queue:flush|删除所有失败的jobs