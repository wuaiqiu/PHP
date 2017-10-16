<?php 
/*
 * 命名范围（将sql操作封装成Model）
 *    
 *  a.定义
 *  	 protected $_scope=array(
 *        'sql1'=>array('where'=>array('id'=>1)) ,
 *        'sql2'=>array('order'=>'id desc','limit'=>2)
 *        #默认的命名范围
 *        'default'=>array('where'=>array('status'=>1),'limit'=>10)
 *       );
 *       
 *    
 *  b.调用
 *      $link->scope('sql1')->select()：调用指定的sql操作
 *      $link->sql1()->select()：调用指定的sql操作
 *      $link->scope()->select()：调用默认sql操作
 *      $link->scope('sql1')->scope('sql2')->select():调用多个sql操作
 *      $Model->scope('normal,latest')->select():调用多个sql操作
 * 
 * */

?>