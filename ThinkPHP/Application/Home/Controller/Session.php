<?php
/*
 * SESSION
 *     
 *     (1)session参数包括
 *          id	         session_id值
 *          name	     session_name 值
 *          path	     session_save_path 值
 *          prefix	     session 本地化空间前缀
 *          expire	     session.gc_maxlifetime 设置值
 *          domain	     session.cookie_domain 设置值
 *          use_cookies	 session.use_cookies 设置值
 *          use_trans_sidsession.use_trans_sid 设置值
 *          type	     session处理类型，支持驱动扩展
 *          
 *     (2)初始化
 *         手工初始化
 *         session(array('name'=>'session_id','expire'=>3600));
 *          
 *          配置文件手工初始化
 *          SESSION_OPTIONS=>array(
 *              'name'=>'session_id',
 *              'expire'=>3600
 *           ）
 *     
 *     (3)session赋值
 *          session('name','value');
 *          
 *     (4)session取值
 *          $value = session('name');
 *     
 *     (5)session删除
 *          session('name',null);
 *          session(null); //全部删除
 *      
 *     (6)session判断
 *          session('?name');
 *          
 *     (7)session管理
 *           session('[操作名]');
 *           
 *           操作名	含义
 *           start	启动session
 *           pause	暂停session写入
 *           destroy	销毁session
 *           regenerate	重新生成session id
 * 
 * */