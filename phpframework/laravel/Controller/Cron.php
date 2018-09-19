<?php
/*
 * 任务调度
 *
 *  1.编写调度（ App\Console\Kernel ）
 *
 *     protected function schedule(Schedule $schedule){
 *
 *          #a.调度闭包
 *          $schedule->call(function () {
 *              DB::table('recent_users')->delete();
 *          })->daily();
 *
 *          #b.调度 Artisan 命令
 *          $schedule->command('queue:work')->daily();
 *
 *          #c.执行系统命令
 *          $schedule->exec('node /home/forge/script.js')->daily();
 *
 *     }
 *
 *
 *  2.调度时间
 *      everyMinute();	        每分钟运行一次任务
 *      everyFiveMinutes();	    每五分钟运行一次任务
 *      everyTenMinutes();	    每十分钟运行一次任务
 *      everyThirtyMinutes();	每三十分钟运行一次任务
 *      hourly();	            每小时运行一次任务
 *      daily();	            每天凌晨零点运行任务
 *      dailyAt('13:00');	    每天13:00运行任务
 *      twiceDaily(1, 13);	    每天1:00 & 13:00运行任务
 *      weekly();	            每周运行一次任务
 *      monthly();	            每月运行一次任务
 *      monthlyOn(4, '15:00');	每月4号15:00运行一次任务
 *      yearly();	            每年运行一次
 *      cron('* * * * *');	    在自定义Cron调度上运行任务
 *
 *
 *  3.特定时间
 *      weekdays();	            只在工作日运行任务
 *      sundays();	            每个星期天运行任务
 *      mondays();	            每个星期一运行任务
 *      tuesdays();	            每个星期二运行任务
 *      wednesdays();	        每个星期三运行任务
 *      thursdays();	        每个星期四运行任务
 *      fridays();	            每个星期五运行任务
 *      saturdays();	        每个星期六运行任务
 *      between($start, $end);	基于特定时间段运行任务
 *      when(Closure);	        基于特定测试运行任务
 *
 *
 * 4.任务输出(只对command方法有效)
 *      sendOutputTo($filePath)
 *      appendOutputTo($filePath)
 *
 *
 * 5.任务钩子
 *      before(function () {
 *          // 任务即将开始...
 *      })
 *      after(function () {
 *          // 任务已经完成...
 *      });
 *
 *
 * 6.启动调度(/etc/cron)
 *     * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
 * */
