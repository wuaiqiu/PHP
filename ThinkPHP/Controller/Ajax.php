<?php
/*
 * AJAX返回（用于ajax响应）
 *         
 *         'DEFAULT_AJAX_RETURN'   =>  'JSON'    #默认AJAX 数据返回格式，JSON与XML与EVAL(纯字符)
 *         
 *         //返回字符串
 *         $data = 'ok';
 *         $this->ajaxReturn($data);
 *         
 *         //返回数组
 *         $data['status']  = 1;
 *         $data['content'] = 'content';
 *         $this->ajaxReturn($data);
 *         
 *         //指定XML格式返回数据
 *         $data['status']  = 1;
 *         $data['content'] = 'content';
 *         $this->ajaxReturn($data,'xml');
 * */