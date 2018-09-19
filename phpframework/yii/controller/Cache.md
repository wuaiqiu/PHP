# Cache

#### 一.数据缓存

>1.设置缓存组件

```
'cache' => [
      'class' => 'yii\caching\FileCache'
]
```

>2.缓存API

```
#获取缓存，不存在则返回false
$cache->get($key);

#设置缓存
$cache->set($key,$value);
$cache->set($key, $data, 45);

#不存在时添加缓存
$cache->add($key,$value);

#不存在时添加缓存并返回
$cache->getOrSet($key,function(){
    return $value;
});

#缓存是否存在
$cache->exists($key)

#删除缓存
$cache->delete($key)

#删除所有缓存
$cache->flush()

#缓存依赖
$dependency = new \yii\caching\FileDependency(['fileName' => 'example.txt']);
$cache->set($key, $data, 30, $dependency);
```

<br>

#### 二.查询缓存

>1.配置数据库

```
return [
      #是否打开或关闭查询缓存,它默认为true
      'enableQueryCache'=>true,
      #查询结果在缓存中保持有效的秒数,0来表示查询结果永久
      'QueryCacheDuration' => 60,
      #缓存应用组件ID,默认为'cache'
      'queryCache' => 'cache'
];
```

>2.使用缓存

```
(new Query())->cache(7200)->all();
User::find()->cache(7200)->all();

或者

$result = $db->cache(function ($db) {
    //使用查询缓存的SQL查询
    $db->noCache(function ($db) {
       //不使用查询缓存的SQL查询
    });
    return $result;
});
```

<br>

#### 三.片段缓存

>1.普通的片段缓存

```
$dependency = new \yii\caching\FileDependency(['fileName' => 'example.txt']);
if ($this->beginCache($id,[
       #过期时间
      'duration' => 3600,
       #只对get请求缓存
      'enabled' => Yii::$app->request->isGet，
       #依赖缓存
      'dependency' => $dependency，
   ])) {

    //在此生成内容...

    $this->endCache();
}
```

>2.缓存嵌套(外层的失效时间应该短于内层，外层的依赖条件应该低于内层)

```
if ($this->beginCache($id1，$options1)) {

    // ...在此生成内容...

    if ($this->beginCache($id2, $options2)) {

        // ...在此生成内容...

        $this->endCache();
    }

    // ...在此生成内容...

    $this->endCache();
}
```

>3.动态缓存

```
if ($this->beginCache($id1)) {

    // ...在此生成内容...

    echo $this->renderDynamic('return Yii::$app->user->identity->name;'); //每次请求都更新

    // ...在此生成内容...

    $this->endCache();
}
```

<br>

#### 四.页面缓存

```
public function behaviors()
{
    return [
        [
            'class' => 'yii\filters\PageCache',
            'only' => ['index'], //表示页面缓存只在index操作时启用
            'duration' => 60, //表示页面缓存时间
            'dependency' => [ //依赖于数据库
                'class' => 'yii\caching\DbDependency',
                'sql' => 'SELECT COUNT(*) FROM post'
            ]
        ]
    ];
}
```

<br>

#### 五.HTTP缓存(仅对GET有效，一个过滤器)

```
1.Last-Modified表明页面最后一次修改的时间戳
2.ETag页面内容的hash值
3.Cache-Control头指定了页面的常规缓存策略

public function behaviors()
{
    return [
        [
            'class' => 'yii\filters\HttpCache',
            'only' => ['index'],
            'lastModified' => function ($action, $params) {
                return 19943503495;
            },
            'etagSeed' => function ($action, $params) {
                return hash('dsfads');
            },
            $cacheControlHeader = 'public, max-age=3600'
        ]
    ];
}
```
