# Aggregate 


**一.MapReduce（类似于关系数据库中的group by）**

Map:将数据分组取出
Reduce:对每组取出的数据进行处理

(1).编写分组

```	
var  mapFun=function(){
  emit(this.class,this.name);	//按照class分组，取出每组的name
}

//分组后的结果
==>{key:1,values:["zhangsan","zhaoliu","qianqi"]}
==>{key:2,values:["lisi","wangwu"]}
```

(2).数据处理

```	
var  reduceFun=function(key,values){	
  return {"class":key,"names":values};
}
```

(3).数据后处理

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
   "mapreduce":"students",	#要操作的目标集合
   "map":mapFun,			#映射函数（生成键值对序列，作为reduce函数参数）
   "reduce":reduceFun,		#统计函数
   "fianlize":finalFun,		#最终处理函数（对reduce返回结果进行最终整理后存入结果集合）
   "out":"newStudents"		#统计结果存放集合
})
```

<br/>

**二.聚合框架**

aggregate([{"聚合操作1"},{"聚合操作2"}])

>支持管道操作:即聚合操作1的结果集交给聚合操作2
	
(1).$group   分组  $group:{"_id":"$分组字段"}
	
表达式|描述
---|---
$sum|返回总和
$avg|返回平均值
$min|返回最小值
$max|返回最大值
$push|返回结果数组
$addToSet|返回结果数组（不重复）
$first|返回结果数组的第一个元素
$last|返回结果数组的最后一个元素

```
#以class字段分组，计算每组的人数
db.students.aggregate([{$group:{"_id":"$class","count":{$sum:1}}}])

#以class字段分组，计算每组的总年龄
db.students.aggregate([{$group:{"_id":"$class","ages":{$sum:"$age"}}}])

#以class字段分组，计算每组的总年龄的平均值
db.students.aggregate([{$group:{"_id":"$class","avgAge":{$avg:"$age"}}}])

#以class字段分组，计算每组的年龄的最大值
db.students.aggregate([{$group:{"_id":"$class","maxAge":{$max:"$age"}}}])

#以class字段分组，返回每组的年龄（不重复）
db.students.aggregate([{$group:{"_id":"$class","ageArr":{$addToSet:"$age"}}}])
```
	
(2).$project   投影  $project:{"字段":0|1}

```	
#只显示name字段
db.students.aggregate([{$project:{"name":1,"_id":0}}])

#只显示name字段,并取别名n
db.students.aggregate([{$project:{"n":"$name","_id":0}}])

#四则运算   +($add)  -($subtract)  *($mulitipy)  /($divide)  %($mod)
db.students.aggregate([{$project:{"_id":0,"name":1,"age":{$add:["$age",2]}}}])

#关系运算  =($eq)  >($gt)  <($lt)  >=($gte)  <=($lte)  !=($ne) 判断null($ifNull);结果返回都是boolean型
db.students.aggregate([{$project:{"_id":0,"age":{$gt:["$age",12]}}}])
	
#逻辑运算   ^($and)  |($or)  !($not);结果返回都是boolean型
db.students.aggregate([{$project:{"_id":0,"age":{$and:[{$gt:["$age",12]},{$lt:["$age",14]}]}}}])

#字符串操作   连接($concat)   截取($substr)  小写($toLower)   大写($toUpper)
db.students.aggregate([{$project:{"_id":0,"name":{$concat:["$name","abc"]}}}])
db.students.aggregate([{$project:{"_id":0,"name":{$substr:["$name",0,3]}}}])
db.students.aggregate([{$project:{"_id":0,"name":{$toLower:["$name"]}}}])
```
	
(3).$match 条件过滤  $match:{"条件"}

```
#匹配name为张三的文档
db.students.aggregate([{$match:{"name":"zhangsan"}}])
	
#关系查询
db.students.aggregate([{$match:{"age":{$gt:12}}}])
	
#逻辑查询
db.students.aggregate([{$match:{$and:[{"age":{$gt:12}},{"age":{$lt:14}}]}}])

#范围查询
db.students.aggregate([{$match:{"name":{$in:["zhangsan","lisi"]}}}])
```

(4).$sort 排序  1表示升序 -1表示降序  $sort:{"字段":1|-1}

```	
#按age升序排列
db.students.aggregate([{$sort:{"age":1}}])
```
	
(5).$skip $limit  分页处理	$skip:n   $limit:n

```
#跨过2条文档，显示3条文档
db.students.aggregate([{$skip:2},{$limit:3}])
```

(6).$out 结果输入到一个新的集合中     $out:"集合名"

```	
db.students.aggregate([{$project:{"_id":0,"name":1}},{$out:"newS"}])
```