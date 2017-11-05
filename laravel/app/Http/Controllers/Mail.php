<?php
/*
 * 发送邮件
 * 
 * (1).配置.env文件
 *  MAIL_DRIVER=smtp
 *  MAIL_HOST=smtp.163.com
 *  MAIL_PORT=465
 *  MAIL_USERNAME=wuaiqiu22@163.com
 *  MAIL_PASSWORD=1351367889msw
 *  MAIL_ENCRYPTION=ssl
 * 
 * 
 * (2).Mail门面
 *  
 *  a.发送文本
 *      Mail::raw("Hello world",function($message){
 *          $message->from("wuaiqiu22@163.com","laravel");
 *          $message->subject("php主题");
 *          $message->to("1351367889@qq.com");
 *      });
 *  
 *      if(count(Mail::failures()) < 1){
 *              echo '发送邮件成功，请查收！';
 *       }else{
 *              echo '发送邮件失败，请重试！';
 *       }
 *      
 *      
 *  b.发送blade
 *          Mail::send('mail',['name'=>'php'],function($message){
 *              $message->from("wuaiqiu22@163.com","laravel");
 *              $message->subject("php主题");
 *              $message->to("1351367889@qq.com");
 *              $message->attach(storage_path('app/1.png'));
 *           });
 *           
 *           if(count(Mail::failures()) < 1){
 *              echo '发送邮件成功，请查收！';
 *           }else{
 *              echo '发送邮件失败，请重试！';
 *           }
 * */