<?php
/*
 * 跳转与重定向
 *      
 *         a.成功跳转与错误跳转
 *              success('提示信息','跳转地址','跳转时间')
 *              error('提示信息','跳转地址','跳转时间')
 *              
 *              #操作完成3秒后跳转到 
 *              $this->success('操作完成','/Public/success.php',3);
 *              #操作失败5秒后跳转到
 *              $this->error('操作失败','/Public/success.php',5);
 *          
 *          b.配置跳转页面
 *              #设置错误跳转对应的模板文件
 *              'TMPL_ACTION_ERROR' =>'Public:error',
 *              #设置成功跳转对应的模板文件
 *              'TMPL_ACTION_SUCCESS' =>'Public:success',
 *             
 *          c.模板文件可以使用模板标签
 *              $message	页面提示信息
 *              $error		页面错误提示信息
 *              $waitSecond	跳转等待时间 单位为秒
 *              $jumpUrl	跳转页面地址
 *          
 *          d.重定向
 *          
 *              //控制器的redirect方法
 *              $this->redirect('New/category', array('cate_id' => 2), 5, '页面跳转中...');
 *              //redirect函数
 *              redirect('http://www.baidu.com', 5, '页面跳转中...')
 * */