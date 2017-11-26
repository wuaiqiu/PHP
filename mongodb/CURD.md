# CURD

**一.与关系型数据库比较**

SQL术语/概念|MongoDB术语/概念|解释/说明
---|---|---
database|database|数据库
table|collection|数据库表/集合
row|document|数据记录行/文档
column|field|数据字段
index|index|索引
primary key|primary key|主键,MongoDB自动将_id字段（时间戳+机器码+PID+计数器）设置为主键

<br/>

**二.数据库操作**

```
#可以显示所有数据库
show dbs

#可以显示当前数据库
db 

#可以切换一个指定的数据库test（可以不存在）
use test

#在当前数据库创建一个students集合
db.createCollection("students")	

#固定集合size表示集合的总大小为1024个字节，max为集合总文档条数为5条，当条数超过则删除最早的一条
db.createCollection("students",{"capped":true,"size":1024,"max":5})

#显示当前数据库所有的集合
show collections

#删除当前数据库的students集合
db.students.drop()

#删除当前数据库
db.dropDatabase()
```

<br/>

**三.文档操作**

**增加文档**

```
#向students集合中添加一条文档
db.students.insert({"name":"zhangsan","age":19,"sex":"男"})

#向students集合中添加多条文档
db.students.insert([{"name":"lisi","age":21},{"name":"wangwu","sex":"男"}])

#向指定集合中插入一条文档数据
db.collection.insertOne({"name":"zhangsan","age":19,"sex":"男"})

#向指定集合中插入多条文档数据
db.collection.insertMany([{"name":"lisi","age":21},{"name":"wangwu","sex":"男"}])
```

**查询文档**
	
【1】语法：  db.students.find({查询条件},{设置显示的字段})

```
设置显示的字段（projection ），只能全1或全0，id除外
db.collection.find(query, {title: 1, by: 1}) // inclusion模式 指定返回的键，不返回其他键
db.collection.find(query, {title: 0, by: 0}) // exclusion模式 指定不返回的键,返回其他键
```

```
#查询students集合的所有文档，并格式化
db.students.find().pretty()

#查询students集合中name为lisi的文档
db.students.find({"name":"lisi"})

#只显示name字段，（0：表示不显示，1：表示显示）
db.students.find({},{"name":1})

#只返回单个文档
db.students.findOne()
```
	
【2】关系查询： $gt(大于)   $lt(小于)   $eq(等于)   $gte(大于等于)   $lte(小于等于)   $ne(不等于)

```
#查询age大于19的文档
db.students.find({"age":{$gt:19}})
```	

【3】逻辑查询： $and(与)   $or(或)   $not(非)

```
#查询age大于19,并且name为lisi
db.students.find({$and:[{"age":{$gt:19}},{"name":"lisi"}]})
```

【4】求模查询： $mod:[除数,余数]

```
#查询age模10余数为0
db.students.find({"age":{$mod:[10,0]}})
```	

【5】范围查询： $in(在范围中)   $nin(不在范围中)

```	
#查询name在范围["zhangsan","lisi"]中
db.students.find({"name":{$in:["zhangsan","lisi"]}})
```

【6】数组查询： $all   $size   $slice   $elemMatch

```
#查询course（数组类型）字段中含有["math","chinese"]的所有文档   $all:["元素1","元素2"...]
db.students.find({"course":{$all:["math","chinese"]}})

#数组类型的索引操作(下标从0开始),查询course字段下标为1的值为math的所有文档
db.students.find({"course.1":"math"})

#查询course的大小为3的所有文档   $size:元素的大小
db.students.find({"course":{$size:3}})

#只显示course前2位元素(投影)   $slice:显示的个数（负数表示从后开始）
db.students.find({},{"course":{$slice:2}})

#只显示course从下标第1位开始的后2位   $slice:[起点位置,长度]
db.students.find({},{"course":{$slice:[1,2]}})

#文档类型数组，查询parent字段中name为w   $elemMatch:{条件}
db.students.find({"parent":{$elemMatch:{"name":"w"}}})
```

【7】判断某个字段的存在性 ： $exists:true(存在)|false(不存在)

```
#查询集合中包含sex字段的所有文档
db.students.find({”sex“:{$exists:true}})
```
	
【8】条件过滤：  $where

```
#查询age大于19的所有文档
db.students.find({$where:"this.age>19"})
db.students.find("this.age>19")
db.students.find(function(){return this.age>19;})
```

【9】正则查询： {key:正则}或{key:{$regex:正则,$options:选项}}

```	
#匹配name中含有san字符(不区分大小写)
db.students.find({"name":/san/i})
db.students.find({"name":{$regex:/san/,$options:"i"}})
```

【10】数据排序： sort()   -1表示逆序  1表示顺序

```	
#逆序排序
db.students.find().sort({"_id":-1})
	
#自然排序（按加入顺序排序,也就是按"_id"排序）
db.students.find().sort({$natural:1})
```

【11】数据分页:   skip(n)跳过n条文档	limit(n)显示n条文档

```
#显示第一页(skip(0) limit(3))
db.students.find().skip(0).limit(3)

#显示第二页(skip(3) limit(3))
db.students.find().skip(3).limit(3)
```

【12】.取得数据量 count({条件})

```
#统计students集合的文档数目
db.students.count()

#带条件的统计
db.students.count({"name":/san/})
```

【13】.消除重复项

```
#筛选class    返回   "values" : [ "zhangsan", "lisi" ]
db.runCommand({"distinct":"students","key":"name"})
```

**文档更新**
	
【1】 update(更新条件,新的对象数据,upsert,multi)

>upsert:当为true时，如果文档不存在，则新加一条文档，默认false 

>multi:当为true时，则可以更新所有符合条件的文档，默认为false,只用于修改器

```
#替换一条文档
db.students.update({"age":22},{"sex":"男"})

#替换一条文档,不存在则添加相应的文档
db.students.update({"age":22},{"sex":"男"},true)
```
	
【2】 save({具体文档})

```	
#如果不指定 _id 字段 save() 方法类似于 insert() 方法。如果指定 _id 字段，则会替换该 _id 的数据。
db.students.save({"_id":ObjectId("59ef008e7fc1a4560396146b"),"name":"zhangsan"})
```

【3】其他更新

```
#向指定集合更新单个文档，不存在不添加
db.collection.updateOne({"条件"},{"修改器"}) 

#向指定集合更新多个文档，不存在不添加
db.collection.updateMany({"条件"},{"修改器"}) 
```

【4】修改器（局部更新）

```
1).$inc	针对一个数值字段，增加某个数值字段的值	$inc:{"字段":值}
#对匹配到的文档的age值增加12
db.students.update({"name":"zhangsan"},{$inc:{"age":12}})	

2).$set 进行字段重新设置	$set:{"字段":值}
#对匹配到的文档的age值改成12
db.students.update({"name":"zhangsan"},{$set:{"age":12}})

3).$unset 删除某个字段    $unset:{"字段":1}
#对匹配到的文档的age值删除
db.students.update({"name":"zhangsan"},{$unset:{"age":1}})
	
4).$push 将元素添加指定的文档中（数组）	$push:{"字段":"元素"}
#对匹配到的文档的course追加chinese
db.students.update({"name":"leehom"},{$push:{"course":"chinese"}})

5).$pushAll 一次性添加多个元素（数组）	$pushAll:{"字段":["元素1","元素2"]}
#对匹配到的文档的course追加["chinese","math"]
db.students.update({"name":"leehom"},{$pushAll:{"course":["chinese","math"]}})

6).$addToSet 向文档追加一个数组字段（不存在时），不添加数组字段（存在时）  $addToSet:{"字段"："元素"}
#对匹配到的文档追加sex
db.students.update({"name":"leehom"},{$addToSet:{"sex":"男"}})

7).$pop 删除字段中的元素（数组）	$pop:{"字段":1|-1}
#对匹配到的文档的course删除最后一个元素
db.students.update({"name":"leehom"},{$pop:{"course":1}})

8).$pull  删除字段中指定的元素（数组）	$pull:{"字段":"元素"}
#对匹配到的文档的course删除指定元素
db.students.update({"name":"leehom"},{"$pull":{"course":"chinese"}})

9).$pullAll 一次性删除多个元素（数组）	$pullAll:{"字段":["元素1","元素2"]}
#对匹配到的文档的course删除指定多个元素
db.students.update({"name":"leehom"},{$pullAll:{"course":["chinese","math"]}})

10).$rename  给字段重新命名	 $rename:{"字段名":"新字段名"}
#对匹配到的文档的name改名为sname
db.students.update({"name":"leehom"},{$rename:{"name":"sname"}})
```

**删除文档**

```	
#删除集合下全部文档：
db.student.deleteMany({})

#删除 name 等于 zhangsan 的全部文档：
db.student.deleteMany({ "name" : "zhangsan" })

#删除 name 等于 zhangsan 的一个文档：
db.student.deleteOne( { "name": "zhangsan" } )
```	