<?php
/*
 * 1.开启调试(.env)
 *
 * APP_DEBUG=true   #开启调试
 * APP_LOG_LEVEL=debug  #日志错误级别(debug、info、notice、warning、error、critical、alert、emergency)
 * APP_LOG=single #日志存储方式(single, daily, syslog 和 errorlog)
 *
 *
 *2.HTTP异常
 *
 * abort(404);
 * abort(403, 'Unauthorized action.');
 *  自定义HTTP错误页面(resources/views/errors/404.blade.php)
 *  $exception->getMessage();
 *
 * 3.日志
 *
 *  Log::emergency($error);
 *  Log::alert($error);
 *  Log::critical($error);
 *  Log::error($error);
 *  Log::warning($error);
 *  Log::notice($error);
 *  Log::info($error);
 *  Log::debug($error);
 *
 * */
