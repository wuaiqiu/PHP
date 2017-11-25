<?php
//插入数据
$conn = new MongoDB\Driver\Manager("mongodb://localhos:27017");
$bulk = new MongoDB\Driver\BulkWrite();
$bulk->insert(['x' => 1, 'name'=>'菜鸟教程', 'url' => 'http://www.runoob.com']);
$bulk->insert(['x' => 2, 'name'=>'Google', 'url' => 'http://www.google.com']);
$bulk->insert(['x' => 3, 'name'=>'taobao', 'url' => 'http://www.taobao.com']);
$conn->executeBulkWrite('test.site', $bulk);


//查询数据
$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$filter = ['x' => ['$gt' => 1]];
$options = [
    'projection' => ['_id' => 0]
];
$query = new MongoDB\Driver\Query($filter,$options);
$cursor = $conn->executeQuery('test.site', $query);
foreach ($cursor as $document) {
    print_r($document);
}


//更新数据
$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite();
$bulk->update(
    ['x' => 2],
    ['$set' => ['name' => '菜鸟工具', 'url' => 'tool.runoob.com']],
    ['multi' => false, 'upsert' => false]
);
$result = $conn->executeBulkWrite('test.site', $bulk);


//删除数据
$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite();
$bulk->delete(['x' => 1], ['limit' => 1]);    //limit 为 1 时，删除第一条匹配数据
$bulk->delete(['x' => 2], ['limit' => 0]);   // limit 为 0 时，删除所有匹配数据
$result = $conn->executeBulkWrite('test.site', $bulk);


//安全写操作
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
$conn->executeBulkWrite('test.site', $bulk,$writeConcern);   //执行写操作(更新、删除、增加)