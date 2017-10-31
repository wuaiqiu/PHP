<?php
/*
 * 连接数据库
 * $conn=new Mongo(); #连接本地主机,默认端口
 * $conn=new Mongo("localhost:27017"); #连接指定端口主机
 * $db=$conn->test; #选择mydb数据库
 * $db=$conn->selectDB("test");#选择mydb数据库
 * $collection=$db->students; #选择集合
 * $collection=$db->selectCollection("students");#选择集合
 * $collection=$conn->test->students; #综合的写法
 * 
 * 插入文档
 * $arr=array("name"=>"php53","class"=>3);
 * $result=$collection->insert($array);
 *  
 * 更新文档
 * $where=array("name"=>"php53");
 * $newdata=array("name"=>"php53","class"=>4);
 * $result=$collection->update($where,array("$set"=>$newdata)); 
 * $result=$collection->update($where,array("$set"=>$newdata),array("multiple"=>true));#批量更新
 * $result=$collection->update($where,$newdata);#替换更新
 * $result=$collection->update($where,array("$inc"=>array("class":3)));#自动累加
 * 
 * 删除文档  
 * $collection->remove(array("name"=>"php53"));
 * $collection->remove(); #清空集合
 * 
 * 查询文档
 * $collection->count(); #全部
 * $collection->count(array("name"=>/san/)); #可以加上条件
 * $cursor = $collection->find()->snapshot();#遍历集合(实时加入也可以遍历)
 * foreach ($cursor as $value) {
 *      var_dump($value);
 * }
 * $cursor = $collection->findOne();#查询一条数据
 * $cursor = $collection->find()->fields(array("class"=>false));#class列不显示
 * $where=array("class"=>array("$gt"=>0,"$lt"=>4));
 * $cursor = $collection->find($where);#条件查询
 * $cursor = $collection->find()->limit(5)->skip(0);#分页获取结果集
 * 
 * 
 * 关闭连接
 * $conn->close();
 * 
 * */