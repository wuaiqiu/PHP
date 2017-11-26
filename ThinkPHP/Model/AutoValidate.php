<?php
/*
 * 自动验证
 * 
 *  (1)静态验证;在Model中验证
 *      protected $_validate=array(
 *            array(验证字段,验证规则,错误提示[,验证条件,附加条件,验证时间]),
 *      );
 *      
 *      protected $patchValidate=true;  #批量验证；一次性将所用错误指出
 *      
 *      验证规则：require 字段必须、email 邮箱、url URL地址、currency 货币、number 数字。
 *      
 *      验证条件：	self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
 *                  self::MUST_VALIDATE 或者1 必须验证
 *                  self::VALUE_VALIDATE或者2 值不为空的时候验证
 *                  
 *      附加规则:	regex	    正则验证，定义的验证规则是一个正则表达式（默认）
 *                  equal	    验证是否等于某个值，该值由前面的验证规则定义
 *                  notequal	验证是否不等于某个值，该值由前面的验证规则定义
 *                  confirm	    验证表单中的两个字段是否相同，定义的验证规则是一个字段名
 *                  in	        验证是否在某个范围内，定义的验证规则可以是一个数组或者逗号分割的字符串
 *                  notin	    验证是否不在某个范围内，定义的验证规则可以是一个数组或者逗号分割的字符串
 *                  length	    验证长度，定义的验证规则可以是一个数字（表示固定长度）或者数字范围（例如3,12 表示长度从3到12的范围）
 *                  between	    验证范围，定义的验证规则表示范围，可以使用字符串或者数组，例如1,31或者array(1,31)
 *                  notbetween	验证不在某个范围，定义的验证规则表示范围，可以使用字符串或者数组
 *                  callback	方法验证，定义的验证规则是当前模型类的一个方法
 *                  function	函数验证，定义的验证规则是一个函数名(内置的functions或Common下的functions)
 *                  
 *      验证时间：	self::MODEL_INSERT或者1新增数据时候验证
 *                  self::MODEL_UPDATE或者2编辑数据时候验证
 *                  self::MODEL_BOTH或者3全部情况下验证（默认）
 *  
 *    
 *   1)	array('name','/^\d{3,6}$/','不是3-6数字',0,'regex')
 *   
 *   2)	array('name','lisi','名字不一致',0,'equal')
 *   
 *   3)	array('name','class','字段name与class不相等',0,'confirm')
 *   
 *   4)	array('id',array(1,2,3),'字段id不在指定范围内',0,'in')
 *   
 *   5)	array('name','checkLength','用户名在3-5位',0,'callback',3,array(3,5))
 *   
 *      protected function checkLength($str,$v1,$v2){
 *              preg_match_all('/./u', $str, $matches);
 *              $len=count($matches[0]);
 *              if($len < $v1 || $len > $v2){
 *                  return false;   
 *              }else{
 *                  return true;
 *              }
 *      }
 *   
 *   
 * (2)动态验证;直接在Controller中验证
 * 
 *      $rule =array(
 *          array('name','require','用户名不能为空')
 *      );
 *      
 *      $data['name']='';
 *      
 *      if($link->validate($rule)->create($data)){
 *              echo "<meta charset=utf8 />";
 *              echo "验证成功";
 *      }else{
 *              echo "<meta charset=utf8 />";
 *              var_dump($link->getError());
 *      }
 * 
 * */