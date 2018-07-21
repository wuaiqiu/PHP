# ActiveRecord

#### 一.查询操作

>a.查询数据(find(根据one与all判断)，findOne(一个实例对象)，findAll(一系列实例对象))

```
//返回ID为123的客户,SELECT * FROM `customer` WHERE `id` = 123
$customer = Customer::find()
    ->where(['id' => 123])
    ->one();

//返回所有活跃客户并以他们的ID排序,SELECT * FROM `customer` WHERE `status` = 1 ORDER BY `id`
$customers = Customer::find()
    ->where(['status' => 1])
    ->orderBy('id')
    ->all();

//返回活跃客户的数量,SELECT COUNT(*) FROM `customer` WHERE `status` = 1
$count = Customer::find()
    ->where(['status' => 1])
    ->count();
```

```
//返回id为123的客户,SELECT * FROM `customer` WHERE `id` = 123
$customer = Customer::findOne(123);

//返回id是100, 101, 123, 124的客户,SELECT * FROM `customer` WHERE `id` IN (100, 101, 123, 124)
$customers = Customer::findAll([100, 101, 123, 124]);

//返回id是123的活跃客户,SELECT * FROM `customer` WHERE `id` = 123 AND `status` = 1
$customer = Customer::findOne([
      'id' => 123,
      'status' => 1,
]);
```

>b.原生sql语句查询

```
//返回所有不活跃的客户
$sql = 'SELECT * FROM customer WHERE status=:status';
$customers = Customer::findBySql($sql, [':status' => 1])->all();
```

>c.访问数据属性

```
$customer = Customer::findOne(123);
$id = $customer->id;
$email = $customer->email;
```

>d.以数组形式获取数据

```
//返回所有客户，每个客户返回一个关联数组
$customers = Customer::find()
    ->asArray()
    ->all();
```

>e.批量获取数据

```
//每次获取10条客户数据
foreach (Customer::find()->batch(10) as $customers) {
    //$customers是一个含有10个Customer对象的数组
}

//每次获取10条客户数据
foreach (Customer::find()->each(10) as $customer) {
    //$customer是一个含有10条记录的Customer对象
}
```

<br>

#### 二.非查询操作

>a.保存数据(save(false)跳过验证过程)

```
//插入新记录
$customer = new Customer();
$customer->name = 'James';
$customer->email = 'james@example.com';
$customer->save();

//更新记录
$customer = Customer::findOne(123);
$customer->email = 'james@newexample.com';
$customer->save();

//块赋值插入
$values = [
    'name' => 'James',
    'email' => 'james@example.com',
];
$customer = new Customer();
$customer->attributes = $values;
$customer->save();

//更新计数,UPDATE `post` SET `view_count` = `view_count` + 1 WHERE `id` = 100
$post = Post::findOne(100);
$post->updateCounters(['view_count' => 1]);
```

<br>

#### 三.事务操作

```
$customer = Customer::findOne(123);
Customer::getDb()->transaction(function($db) use ($customer) {
    $customer->id = 200;
    $customer->save();
    // ...其他 DB 操作...
});
```

```
$transaction = Customer::getDb()->beginTransaction();
try {
    $customer->id = 200;
    $customer->save();
    // ...other DB operations...
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

#### 四.关联模型

>a.声明关联关系

```
主键id

class Customer extends ActiveRecord
{
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
```

```
外键customer_id

class Order extends ActiveRecord
{
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
```

>b.访问关联数据

```
//SELECT * FROM `customer` WHERE `id` = 123
$customer = Customer::findOne(123);
//SELECT * FROM `order` WHERE `customer_id` = 123
$orders = $customer->orders;
```

>c.中间关联表

```
外键item_id

class Order extends ActiveRecord
{
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])
            ->viaTable('order_item', ['order_id' => 'id']);
    }
}
```

```
主键id

class Item extends ActiveRecord
{
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['item_id' => 'id'])
            ->viaTable('order_item', ['order_id' => 'id']);
    }
}
```

<br>

#### 五.延迟加载与即时加载

>延迟加载

```
//SELECT * FROM `customer` WHERE `id` = 123
$customer = Customer::findOne(123);
//SELECT * FROM `order` WHERE `customer_id` = 123
$orders = $customer->orders;
//没有 SQL 语句被执行
$orders2 = $customer->orders;
```

>即时加载

```
//SELECT * FROM `customer` LIMIT 100;
//SELECT * FROM `orders` WHERE `customer_id` IN (...)
$customers = Customer::find()
  ->with('orders')
  ->limit(100)
  ->all();

foreach ($customers as $customer) {
  //没有任何的 SQL 执行
  $orders = $customer->orders;
}
```

<br>

#### 六.分页

```
use yii\data\Pagination;

//1.创建一个 DB 查询来获得所有 status 为 1 的文章
$query = Article::find()->where(['status' => 1]);

//2.得到文章的总数（但是还没有从数据库取数据）
$count = $query->count();

//3.使用总数来创建一个分页对象
$pagination = new Pagination(['totalCount' => $count,'pageSize'=>20]);

//4.使用分页对象来填充 limit 子句并取得文章数据
$articles = $query->offset($pagination->offset)
    ->limit($pagination->limit)
    ->all();

//5.渲染视图
return $this->render('index', [
    'articles' => $articles,
    'pagination' => $pagination
]);
```

```
use yii\widgets\LinkPager;

//1.循环展示数据
foreach ($articles as $article) {
    // ......
}

//2.显示分页页码
echo LinkPager::widget([
    'pagination' => $pagination,
    'nextPageLabel' => '下一页',
    'prevPageLabel' => '上一页',
    'firstPageLabel' => '首页',
    'lastPageLabel' => '尾页',
    'maxButtonCount' => 5
]);
```
