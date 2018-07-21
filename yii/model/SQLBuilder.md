# SQLBuilder

>1.普通查询

```
$query = new \yii\db\Query();

//选取字段
$query->select(['alias'=>'id', 'email']);
$query->select(["CONCAT(first_name,last_name) AS full_name", 'email']);

//字段去重
$query->select('user_id')->distinct();

//选取数据表
$query->from('user');
$query->from(['u' => 'user', 'p' => 'post']);

//select子查询
$subQuery = $query->select('COUNT(*)')->from('user');
$query->select(['id', 'count' => $subQuery])->from('post');

//from子查询
$subQuery = $query->select('id')->from('user')->where('status=1');
$query->from(['u' => $subQuery]);
```

>2.条件查询(where , andWhere , orWhere)

```
1.字符串格式

$query->where('status=1');
$query->where('status=:status', [':status' => $status]);
```

```
2.哈希格式

$query->where([
    'status' => 10,
    'type' => null,
    'id' => [4, 8, 15],
]);
```

```
3.操作符格式

['and', 'id=1', 'id=2']  ==> id=1 AND id=2
['or', 'id=1', 'id=2']   ==> id=1 OR id=2
['between', 'id', 1, 10] ==> id BETWEEN 1 AND 10   
['not between', 'id', 1, 10] ==> id NOT BETWEEN 1 AND 10
['in', 'id', [1, 2, 3]]  ==> id IN (1, 2, 3)
['not in', 'id', [1, 2, 3]]  ==> id NOT IN (1, 2, 3)
['like', 'name', 'tester'] ==> name LIKE '%tester%'
['like', 'name', ['test', 'sample']] ==> name LIKE '%test%' AND name LIKE '%sample%'
['or like', 'name', ['test', 'sample']] ==> name LIKE '%test%' OR name LIKE '%sample%'
['>', 'age', 10] ==> age>10
```

>4.其他操作

```
$query->orderBy([
    'id' => SORT_ASC,
    'name' => SORT_DESC,
]);

//GROUP BY
$query->groupBy(['id', 'status']);

//HAVING
$query->having(['status' => 1]);

//LIMIT 10 OFFSET 20
$query->limit(10)->offset(20);

//LEFT JOIN | RIGHT JOIN | INNER JOIN
$query->join('LEFT JOIN', 'post', 'post.user_id = user.id');
$query->leftJoin('post', 'post.user_id = user.id');

//UNION
$query1->union($query2);
```

>5.查询方法

```
all()：返回结果集的所有行
one()：返回结果集的第一行
column()：返回结果集的第一列
scalar()：返回结果集的第一行第一列的标量值
count()：返回 COUNT 查询的结果
```

>6.批处理查询

```
$query = $query
    ->from('user')
    ->orderBy('id');

foreach ($query->batch($num=100) as $users) {

}
foreach ($query->each() as $user) {

}
```
