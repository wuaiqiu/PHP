# 索引

**一.索引**

```
#获取集合中的所有索引
db.students.getIndexes()

#创建索引(升序）
db.students.ensureIndex({"age":1})
db.students.ensureIndex({"age":1},{"name":"age_index"})

#创建组合索引
db.students.ensureIndex({"age":1,"class":1})
db.students.ensureIndex({"age":1,"class":1},{"name":"age_class_index"})

#强制使用索引（索引必须存在）
db.students.find({"age":12,"class":1}).hint({"age":1,"class":1})

#删除指定索引
db.students.dropIndex({"age":1,"class":1})
db.students.dropIndex("age_index");

#删除所有索引
db.students.dropIndexes()

#分析检索(带索引与不带索引) 【 IXSCAN:索引检索 COLLSCAN:全局检索 】
db.students.find({"age":12}).explain()
```
<br/>

**二.唯一索引**

```
#创建唯一索引
db.students.ensureIndex({"id":1},{"unique":true})
```

<br/>

**三.全文索引**

```
#创建全文索引
db.students.ensureIndex({"descriptions":"text"})
	
#使用全文索引	
   单个关键字   	$search : "字段值"
   或关系      	$search : "字段值1 字段值2 ..."
   与关系      	$search : "\"字段值1\" \"字段值2\" ..."
   排除关键字   	$search : "字段值1 -字段值2 ..."
  
#匹配包含san或zhangsan
db.students.find({$text:{$search:"san zhangsan"}})

#为结果打分(分数越高越好)
db.students.find({$text:{$search:"san zhangsan"}},{"score":{$meta:"textScore"}})

#为结果打分并排序
db.students.find({$text:{$search:"san zhangsan"}},{"score":{$meta:"textScore"}}).sort({"score":{$meta:"textScore"}})
```