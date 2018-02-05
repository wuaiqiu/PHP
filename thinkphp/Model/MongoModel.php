<?php
/*
 * Mongo模型（继承Think\Model\MongoModel）
 *
 *  (1).主键
 *      protected $pk = 'id';   #改变主键名称(默认的主键名是 _id)
 *
 *      protected $_idType = self::TYPE_OBJECT;#设置主键为MongoId(默认)
 *
 *      protected $_idType = self::TYPE_INT;#设置主键整型自增长
 *      protected $_autoinc =  true;
 *
 *      protected $_idType = self::TYPE_STRING; #设置主键hash
 *
 *  (2).连贯操作【不支持group、union、join、having、distinct操作】
 *      $Model = new Think\Model\MongoModel("User");
 *      $Model->field("name,email,age")->order("status desc")->limit("10,8")->select();
 *
 *  (3).查询支持
 *      a.首先，支持所有的基本查询和快捷查询；
 *      b.表达式查询增加了一些针对MongoDb的查询用法；
 *      c.统计查询目前只能支持count操作;
 *
 *  (4).表达式查询（支持sql表达式查询，除了like外）
 *      模糊查询
 *      Mysql模糊查询 Mongo模糊查询
 *      array('like','%thinkphp%'); array('like','thinkphp');
 *      array('like','thinkphp%');  array('like','^thinkphp');
 *      array('like','%thinkphp');  array('like','thinkphp$');
 *
 *      inc 数字字段增长或减少
 *      set 字段赋值
 *      unset 删除字段值
 *      push  追加一个值到字段（必须是数组类型）里面去
 *      pushall 追加多个值到字段（必须是数组类型）里面去
 *      addtoset  增加一个值到字段（必须是数组类型）内，而且只有当这个值不在数组内才增加
 *      pop 根据索引删除字段（必须是数组字段）中的一个值
 *      pull  根据值删除字段（必须是数组字段）中的一个值
 *      pullall 一次删除字段（必须是数组字段）中的多个值
 *
 * */
