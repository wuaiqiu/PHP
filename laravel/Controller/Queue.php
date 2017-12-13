<?php
/*
 * 列队
 *
 * (1).创建数据迁移(设置QUEUE_DRIVER=database)
 *      php artisan queue:table
 *      php artisan queue:failed-table
 *      php artisan migrate
 *
 * (2).生成任务类(app/jobs)
 *      php artisan make:job SendReminderEmail
 *
 * (3).编写任务
 *       public $tries = 5;#指定尝试次数
 *       public $timeout = 120;#指定超时时间（s）
 *       public function handle(){
 *          Log::info("我是一个info工作");
 *       }
 *       public function failed(Exception $e){
 *          Log::warning($e->getMessage());
 *       }
 *
 * (4).排队
 *      dispatch(new SendReminderEmail());#默认列队default
 *      dispatch((new SendReminderEmail())->delay(Carbon::now()->addMinutes(10)));#延迟10分钟,不影响同队其他进程
 *      dispatch((new SendReminderEmail())->onQueue('processing'));#指定列队
 *      dispatch((new SendReminderEmail())->onConnection('sqs'));#指定连接
 *
 * (5).运行队列进程
 *      php artisan queue:work
 *      php artisan queue:work  --queue=emails  #指定列队
 *      php artisan queue:work --queue=high,low #按顺序执行列队
 *      php artisan queue:work redis        #指定连接
 *
 * (6).查看failed任务
 *      php artisan queue:failed
 *      php artisan queue:retry 5       #重试一个ID为5的失败
 *      php artisan queue:retry all     #重试所有失败任务
 *      php artisan queue:forget 1      #删除指定id的失败jobs
 *      php artisan queue:flush         #删除所有失败的jobs
 * */
