<?php
/*
 * CURD
 *      创建（Create）、更新（Update）、读取（Retrieve）和删除（Delete）操作
 *      
 * 
 *  (1)创建数据
 *      #直接获取数据（根据参数名字与字段匹配）
 *      $link->create();
 *      
 *      #数组手动获取数据（可以用用扩展其他字段）
 *      $data['name']='zhangsan';
 *      $link->create($data);
 *      
 *      #创建完成的数据可以直接读取和修改
 *      $link->create();
 *      $link->name="lisi";
 *      
 *      #指定的字段数据
 *      $link->field('name,email')->create($data)
 *      
 *      #自动验证和自动完成功能，其实都必须通过create方法才能生效;使用data方法创建的数据对象
 *      不会进行自动验证和过滤操作
 *      $data['name']='zhangsan';
 *      $link->data($data);
 *   
 *   
 *   (2)插入数据
 *      #直接插入数据
 *      data['name']=$_POST['name'];
 *      $data['class']=$_POST['class'];
 *      $link->add($data);
 *      
 *     #create不支持连贯操作    
 *     $link->add($link->create());
 *     
 *     #data支持连贯操作
 *     $link->data($data)->add();
 *     
 *     
 *   (3)读取数据
 *      #只显示第一行记录
 *      $link->find();
 *      ==>	SELECT * FROM `users` LIMIT 1;
 *     
 *     #显示全部记录
 *     $link->select();
 *     ==>	SELECT * FROM `users`;   
 *     
 *     
 *   (4)更新数据;如果没有传入任何条件进行更新操作的话，不会执行更新操作
 *      #直接更新
 *      $data['name']='zhangsan1';
 *      $data['class']='103';
 *      $data['id']=1;
 *      $link->save($data); 
 *      
 *      #data数据更新
 *      $link->data($data)->save();
 *      
 *      #create数据更新
 *      $link->save($link->create());
 *      
 *      
 *   (5)数据删除;如果没有传入任何条件进行删除操作的话，不会执行删除操作
 *      #根据主键值删除,一次性可以指定多个
 *      $link->delete(1);
 *      
 *      #根据条件删除
 *      $map['id']=1;
 *      $link->where($map)->delete();
 *      ==>	DELETE FROM `users` WHERE `id` = 1;
 *      
 *      #全部删除
 *      $link->where('1')->delete();
 *    
 * */