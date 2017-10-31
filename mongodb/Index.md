# 索引

**一.索引**

```
#获取集合中的所有索引   db.students.getIndexes()
db.students.getIndexes()

#创建索引（升序）	 db.students.ensureIndex({"域"：1|-1})
db.students.ensureIndex({"age":1})

#分析检索(带索引与不带索引)
db.students.find({"age":12}).explain()		---IXSCAN：索引检索
db.students.find({"class":1}).explain()		---COLLSCAN:全局检索

#创建复合索引并设置索引名
db.students.ensureIndex({"age":1,"class":1},{"name":"age_class_index"})

#强制使用索引（必须存在）
db.students.find({"age":12,"class":1}).hint({"age":1,"class":1}).explain()

#删除一个索引   db.students.dropIndex({索引})
db.students.dropIndex({"age":1,"class":1})

#删除所有索引   db.students.dropIndexes()
db.students.dropIndexes()

1)id索引由系统维护
2)索引名由系统自动命名【域名+1|-1】
```
<br/>

**二.唯一索引**

```
#创建唯一索引
db.students.ensureIndex({"name":1},{"unique":true})
```

<br/>

**三.过期索引**

```
#创建过期索引(集合中必须有date类型的域),10s后过期
db.students.ensureIndex({"time":1},{"expireAfterSeconds":10})	
```

<br/>

**四.全文索引**

```
#创建全文索引
db.students.ensureIndex({"name":"text"})
	
#使用全文索引	
   单个关键字   "$search" : "域值"
	或关系      "$search" : "域值1 域值2 ..."
	与关系      "$search" : "\"域值1\" \"域值2\" ..."
	排除关键字   "$search" : "域值1 -域值 ..."
db.students.find({"$text":{"$search":"san zhangsan"}})

#为结果打分(分数越高越好)
db.students.find({"$text":{"$search":"san zhangsan"}},{"score"{"$meta":"textScore"}})

#为结果打分并排序
db.students.find({"$text":{"$search":"san zhangsan"}},{"score"{"$meta":"textScore"}}).sort({"score":{"$meta":"textScore"}})

#为所用域设置全文索引
db.students.ensureIndex({"$**":"text"})
```