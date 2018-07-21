# OriginSQL

#### 一.查询操作(所有从数据库取得的数据都被表现为字符串)

>1.结果集类型

```
//返回多行，如果该查询没有结果则返回空数组
$posts = Yii::$app->db->createCommand('SELECT * FROM post')
            ->queryAll();

//返回一行，如果该查询没有结果则返回false
$post = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=1')
           ->queryOne();

//返回一列，如果该查询没有结果则返回空数组
$titles = Yii::$app->db->createCommand('SELECT title FROM post')
             ->queryColumn();

//返回一个标量值，如果该查询没有结果则返回false
$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM post')
             ->queryScalar();
```

>2.绑定参数

```
$post = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id AND status=:status')
           ->bindValue(':id', $_GET['id'])
           ->bindValue(':status', 1)
           ->queryOne();


$params = [':id' => $_GET['id'], ':status' => 1];
$post = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id AND status=:status')
           ->bindValues($params)
           ->queryOne();


//bindParam还可以引用绑定
$command = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id')
              ->bindParam(':id', $id);
$id = 1;
$post1 = $command->queryOne();
$id = 2;
$post2 = $command->queryOne();
```

<br>

#### 二.非查询操作

```
//返回执行SQL所影响到的行数
Yii::$app->db->createCommand('UPDATE post SET status=1 WHERE id=1')
   ->execute();

//INSERT
Yii::$app->db->createCommand()->insert('user', [
    'name' => 'Sam',
    'age' => 30,
])->execute();

//UPDATE
Yii::$app->db->createCommand()->update('user', [
    'status' => 1
], 'age > 30')->execute();

//DELETE
Yii::$app->db->createCommand()->delete('user',
'status = 0')->execute();
```

```
//一次插入多行
Yii::$app->db->createCommand()->batchInsert('user', ['name', 'age'], [
    ['Tom', 30],
    ['Jane', 20],
    ['Linda', 25],
])->execute();
```

<br>

#### 三.事务

```
Yii::$app->db->transaction(function($db) {
    $db->createCommand($sql1)->execute();
    $db->createCommand($sql2)->execute();
    // ... executing other SQL statements ...
});
```

```
$db = Yii::$app->db;
$transaction = $db->beginTransaction();
try {
    $db->createCommand($sql1)->execute();
    $db->createCommand($sql2)->execute();
    // ... executing other SQL statements ...

    $transaction->commit();
} catch(\Exception $e) {
    $transaction->rollBack();
    throw $e;
} catch(\Throwable $e) {
    $transaction->rollBack();
    throw $e;
}
```

<br>

#### 四.其他

>a.引用表和列名称(自动加上标点符号)

```
//SELECT COUNT(`id`) FROM `employee`
$count = Yii::$app->db->createCommand("SELECT COUNT([[id]]) FROM {{employee}}")
              ->queryScalar();
```

>b.使用表前缀

```
//SELECT COUNT(`id`) FROM `tbl_employee`
$count = Yii::$app->db->createCommand("SELECT COUNT([[id]]) FROM {{%employee}}")
            ->queryScalar();
```
