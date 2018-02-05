<?php 
/*
 * 自动完成
 * 
 *  (1)静态方式;在Model中定义
 *          protected $_auto = array(
 *              array(完成字段,完成规则,[完成条件,附加规则])	
 *           );
 *           
 *      完成条件：	self::MODEL_INSERT或者1	新增数据的时候处理（默认）
 *                  self::MODEL_UPDATE或者2	更新数据的时候处理
 *                  self::MODEL_BOTH或者3	所有情况都进行处理
 *      附加规则：	function	使用函数，表示填充的内容是一个函数名;
 *                  callback	回调方法 ，表示填充的内容是一个当前模型的方法
 *                  field	    用其它字段填充，表示填充的内容是一个其他字段的值
 *                  string	    字符串（默认方式）
 *                  ignore	    为空则忽略
 *   
 *                  
 *   1）	array('class','103')自动填充（修改）
 *   
 *   2)	array('name','sha1',3,'function')	使用系统内置函数sha1给name字段加密
 *   
 *   3)	array('name','class',3,'field')		将class字段值填充name
 *   
 *   4)	array('name','updateUser',3,'callback',"_")	给name字段值前加"_"
 *          protected function updateUser($str,$v){
 *              return $v.$str;
 *          }
 *          
 *   5)	array('id','',2,'ignore')		当id值为空，则不对id值修改
 *   
 * 
 * 
 * (2)动态方式;在Controller中
 * 
 *      $data['name']='ddd';
 *      $rule=array(
 *          array('id','19')
 *       );
 *       
 *       if($link->auto($rule)->create($data)){
 *              $link->add();
 *        }
 *        
 * */

?>