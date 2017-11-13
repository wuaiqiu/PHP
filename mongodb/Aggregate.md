# Aggregate 


**一.取得数据量**   count({条件})

```
#统计students集合的文档数目
db.students.count()

#带条件的统计
db.students.count({"name":/san/})
```

<br/>

**二.消除重复项**

```
#筛选class	返回   "values" : [ 1, 2 ]
db.runCommand({"distinct":"students","key":"class"})
```

<br/>

**三.MapReduce**

Map:将数据分别取出
Reduce:将取出的数据进行处理

(1).编写分组

```	
var  mapFun=function(){
  emit(this.class,this.name);	//按照class分组，取出name
}

==>{key:1,values:["zhangsan","zhaoliu","qianqi"]
==>{key:2,values:["lisi","wangwu"]}
```

(2).数据处理

```	
var  reduceFun=function(key,values){
  return {"class":key,"names":values};
}
```

(3).数据在处理

```	
var finalFun=function(key,values){
    if(key==1){
	return {"class":key,"names":values,"info":"Hello"};
    }else{
	return {"class":key,"names":values};
    }
}
```

(4).进行整合
	
```
db.runCommand({
   "mapreduce":"students",
   "map":mapFun,
   "reduce":reduceFun,
   "fianlize":finalFun,
   "out":"newStudents"
})
```

<br/>

**四.聚合框架**(支持管道操作)

aggregate([{"聚合操作"},{"聚合操作"}])

	
(1).$group   分组  "$group":{"_id":"分组域"}
	
表达式|描述
---|---
$sum|计算总和
$avg|计算平均值
$min|获取集合中所有文档对应值得最小值
$max|获取集合中所有文档对应值得最大值
$push|在结果文档中插入值到一个数组中
$addToSet|在结果文档中插入值到一个数组中，但不重复
$first|根据资源文档的排序获取第一个文档数据
$last|根据资源文档的排序获取最后一个文档数据

```
#求出每个class的人数
db.students.aggregate([{"$group":{"_id":"$class","count":{"$sum":1}}}])

#求出每个class的总年龄
db.students.aggregate([{"$group":{"_id":"$class","ages":{"$sum":"$age"}}}])

#求出每个class的年龄的平均值
db.students.aggregate([{"$group":{"_id":"$class","avgAge":{"$avg":"$age"}}}])

#求出每个class的年龄的最大
db.students.aggregate([{"$group":{"_id":"$class","maxAge":{"$max":"$age"}}}])

#求出每个class的年龄数组（不重复）
db.students.aggregate([{"$group":{"_id":"$class","ageArr":{"$addToSet":"$age"}}}])
```
	
(2).$project   投影  "$project":{"域":0|1}
	普通域 {"_id":0}: 1|true表示显示,0|false表示不显示；注意默认会显示_id域，需要特别声明
	条件域 {"name":"zhangsan"}: 满足表达式的域显示

```	
#只显示name域
db.students.aggregate([{"$project":{"name":1,"_id":0}}])

#只显示name域,并取别名n
db.students.aggregate([{"$project":{"n":"$name","_id":0}}])

#四则运算   +($add)  -($subtract)  *(mulitipy)  /($divide)  %($mod)
db.students.aggregate([{"$project":{"_id":0,"name":1,"age":{"$add":["$age",2]}}}])

#关系运算   比较($cmp)  =($eq)  >($gt)  <($lt)  >=($gte)  <=($lte)  !=($ne) 判断null($ifNull) ;结果返回都是boolean型
db.students.aggregate([{"$project":{"_id":0,"age":{"$gt":["$age",12]}}}])
	
#逻辑运算   ^($and)  |($or)  !($not);结果返回都是boolean型
db.students.aggregate([{"$project":{"_id":0,"age":{"$and":[{"$gt":["$age",12]},{"$lt":["$age",14]}]}}}])

#字符串操作   连接($concat)   截取($substr)  小写($toLower)   大写($toUpper)  不区分大小写($strcasecmp)
db.students.aggregate([{"$project":{"_id":0,"name":{"$concat":["$name","abc"]}}}])
```
	
(3).$match 条件过滤  "$match":{"条件"}

```
#匹配name为张三的文档
db.students.aggregate([{"$match":{"name":"zhangsan"}}])
	
#关系查询
db.students.aggregate([{"$match":{"age":{"$gt":12}}}])
	
#逻辑查询
db.students.aggregate([{"$match":{"$and":[{"age":{"$gt":12}},{"age":{"$lt":14}}]}}])

#范围查询
db.students.aggregate([{"$match":{"name":{"$in":["zhangsan","lisi"]}}}])
```

(4).$sort 排序  1表示升序 -1表示降序  "$sort":{"域":1|-1}

```	
#按age升序排列
db.students.aggregate([{"$sort":{"age":1}}])
```
	
(5).$skip $limit  分页处理	"$skip":n   "$limit":n

```
#跨过2条文档，显示3条文档
db.students.aggregate([{"$skip":2},{"$limit":3}])
```

(6).$out 结果输入到一个新的集合中     "$out":"集合名"

```	
db.students.aggregate([{"$project":{"_id":0,"name":1}},{"$out":"newS"}])
```