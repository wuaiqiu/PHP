<?php
/*
 *  ActiveRecord(将CURD对象化)
 * 
 *      #增加数据
 *      $link->name="zhangsan";
 *      $link->class="103";
 *      $link->id=1;
 *      $link->add();
 *      
 *      $link->create();
 *      $link->add();
 *      
 *      #修改数据
 *      $link->name="zhangsan1";
 *      $link->class="103";
 *      $link->id=1;
 *      $link->save();
 *      
 *      #删除数据
 *      $link->name="zhangsan1";
 *      $link->class="103";
 *      $link->id=1;
 *      $link->delete();
 *      
 *      #读取数据(主键或某个关键的字段)
 *      $link->select(3);
 *      
 *      $link->getByName("zhangsan");
 * */