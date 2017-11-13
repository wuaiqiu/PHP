# MongoDB

**一.与关系型数据库比较**

SQL术语/概念|MongoDB术语/概念|解释/说明
---|---|---
database|database|数据库
table|collection|数据库表/集合
row|document|数据记录行/文档
column|field|数据字段/域
index|index|索引
primary key|primary key|主键,MongoDB自动将_id字段（时间戳+机器码+PID+计数器）设置为主键

<br/>

**二.数据库操作**

```
show dbs 			#可以显示所有数据的列表。

db 				#可以显示当前数据库对象或集合。
	
use test			#可以切换一个指定的数据库test（可以不存在）

db.createCollection("students")	#在当前数据库创建一个students集合

db.createCollection("students",{"capped":true,"size":1024,"max":5})
#固定集合size表示集合的总大小为1024个字节，max为集合总文档条数为5条，当条数超过则删除最早的一条

show collections		#显示当前数据库所有的集合

db.students.drop()		#删除当前数据库的students集合

db.dropDatabase()		#删除当前数据库
```

<br/>

**三.文档操作**

**增加文档**

```
#向students集合中添加一条文档
db.students.insert({"name":"zhangsan","age":19,"sex":"男"})

#向students集合中添加多条文档
db.students.insert([{"name":"lisi","age":21},{"name":"wangwu","sex":男}])
```

**查询文档**
	
【1】语法：  db.students.find({查询条件}[,{设置显示的字段}])

```
#查询students集合的所有文档，并格式化
db.students.find().pretty()

#查询students集合中name为lisi的文档
db.students.find({"name":"lisi"})

#只显示name域，（0：表示不显示，1：表示显示）
db.students.find({},{"name":1})

#只返回单个文档
db.students.findOne()
```
	
【2】关系查询： $gt(大于)   $lt(小于)   $eq(等于)   $gte(大于等于)   $lte(小于等于)   $ne(不等于)

```
#查询age大于19的文档
db.students.find({"age":{"$gt":19}})

#查询name为lisi的文档
db.students.find({"name":{"$eq":"lisi"}})
db.students.find({"name":"lisi"})
```	

【3】逻辑查询： $and(与)   $or(或)   $not(非)

```
#查询age大于19,并且name为lisi
db.students.find({"$and":[{"age":{"$gt":19}},{"name":"lisi"}]})
db.students.find({"age":{"$gt":19},"name":"lisi"})
```

【4】求模查询： "$mod":[除数,余数]

```
#查询age模10余数为0
db.students.find({"age":{"$mod":[10,0]}})
```	

【5】范围查询： $in(在范围中)   $nin(不在范围中)

```	
#查询name在范围["zhangsan","lisi"]中
db.students.find({"name":{"$in":["zhangsan","lisi"]}})
```

【6】数组查询： $all   $size   $slice   $elemMatch

```
#查询course（数组类型）域中含有["math","chinese"]的所有文档   "$all":["元素1","元素2"...]
db.students.find({"course":{"$all":["math","chinese"]}})
	
#查询age（整型）中等于21的所有文档
db.students.find({"age":{"$all":[21]}})

#数组类型的索引操作(下标从0开始),查询course域下标为1的值为math的所有文档
db.students.find({"course.1":"math"})

#查询course的大小为3的所有文档   "$size":元素的大小
db.students.find({"course":{"$size":3}})

#只显示course前2位元素(投影)   "$slice":显示的个数（负数表示从后开始）
db.students.find({},{"course":{"$slice":2}})

#只显示course从下标第1位开始的后2位   "$slice":[起点位置,长度]
db.students.find({},{"course":{"$slice":[1,2]}})

#集合嵌套查询，查询parent（集合）域中name为w   "$elemMatch":{条件}
db.students.find({"parent":{"$elemMatch":{"name":"w"}}})
```

【7】判断某个域的存在性 ： $exists:true(存在)|false(不存在)

```
#查询集合中包含sex域的所有文档
db.students.find({"sex":{"$exists":true}})
```
	
【8】条件过滤：  $where

```
#查询age大于19的所有文档
db.students.find({"$where":"this.age>19"})
db.students.find("this.age>19")
db.students.find(function(){return this.age>19;})
```

【9】正则查询： {key:正则}或{key:{"$regex":正则,"$options":选项}}

```	
#匹配name中含有san字符(不区分大小写)
db.students.find({"name":/san/i})
db.students.find({"name":{"$regex":/san/,"$options":"i"}})
```

【10】数据排序： sort()   -1表示逆序  1表示顺序

```	
#逆序排序
db.students.find().sort({"_id":-1})
	
#自然排序（按加入顺序排序,也就是按"_id"排序）
db.students.find().sort({"$natural":1})
```

【11】数据分页:   skip(n)跳过n条文档	limit(n)显示n条文档

```
#显示第一页(skip(0) limit(3))
db.students.find().skip(0).limit(3)

#显示第二页(skip(3) limit(3))
db.students.find().skip(3).limit(3)
```

**文档更新**
	
【1】 update(更新条件,新的对象数据,upsert,multi)
	upsert:当为true时，如果文档不存在，则新加一条文档，默认false
	multi:当为true时，则可以更新所有符合条件的文档，默认为false

```
#更新一条文档,不存在则添加相应域
db.students.update({"age":22},{"$set":{"sex":"男"}})

#更新多条文档,不存在则添加相应域
db.students.update({"age":22},{"$set":{"sex":"男"}},true,true)
```
	
【2】 sava({具体文档})，替换所有域，不存在则添加

```	
#将指定的文档替换成{"name":"zhansan"}
db.students.save({"_id":ObjectId("59ef008e7fc1a4560396146b"),"name":"zhangsan"})
```

【3】修改器

```
1).$inc	针对一个数值域，增加某个数值域的值	"$inc":{"域":值}
#对匹配到的文档的age值增加12
db.students.update({"name":"zhangsan"},{"$inc":{"age":12}})	

2).$set 进行域重新设置	"$set":{"域":值}
#对匹配到的文档的age值改成12
db.students.update({"name":"zhangsan"},{"$set":{"age":12}})

3).$unset 删除某个域    "$unset":{"域":1}
#对匹配到的文档的age值删除
db.students.update({"name":"zhangsan"},{"$unset":{"age":1}})
	
4).$push 将元素添加指定的文档中（数组）	"$push":{"域":"元素"}
#对匹配到的文档的course追加chinese
db.students.update({"name":"leehom"},{"$push":{"course":"chinese"}})

5).$pushAll 一次性添加多个元素（数组）	"$pushAll":{"域":["元素1","元素2"]}
#对匹配到的文档的course追加["chinese","math"]
db.students.update({"name":"leehom"},{"$pushAll":{"course":["chinese","math"]}})

6).$addToSet 向文档追加一个域（不存在时），向一个域中添加元素（存在时）  "$addToSet":{"域"："元素"}
#对匹配到的文档追加sex
db.students.update({"name":"leehom"},{"$addToSet":{"sex":"男"}})

7).$pop 删除域中的元素（数组）	"$pop":{"域":1|-1}
#对匹配到的文档的course删除最后一个元素
db.students.update({"name":"leehom"},{"$pop":{"course":1}})

8).$pull  删除域中指定的元素（数组）	"$pull":{"域":"元素"}
#对匹配到的文档的course删除指定元素
db.students.update({"name":"leehom"},{"$pull":{"course":"chinese"}})

9).$pullAll 一次性删除多个元素（数组）	"$pullAll":{"域":["元素1","元素2"]}
#对匹配到的文档的course删除指定多个元素
db.students.update({"name":"leehom"},{"$pullAll":{"course":["chinese","math"]}})

10).rename  给域重新命名	 "$rename":{"域名":"新域名"}
#对匹配到的文档的name改名为sname
db.students.update({"name":"leehom"},{"$rename":{"name":"sname"}})
```

**删除文档**

【1】remove({"条件"},multi)
	multi:当为true时，只删除一个，默认为false

```	
#删除name中有san字符的所有文档
db.students.remove({"name":/san/})

#删除当前全部文档
db.students.remove({})
```	

<br/>

**三.游标**
	
只文档可以一行行进行操作，类似ResultSet结果集

```	
var result = db.students.find()
while(result.hasNext()){
    var res=result.next();
    printjson(res);
}
```