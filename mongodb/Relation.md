# Relation


uesr文档

```
{
   "_id":ObjectId("52ffc33cd85242f436000001"),
   "name": "Tom Hanks"
}
```

address文档

```
{
   "_id":ObjectId("52ffc4a5d85242602e000000"),
   "building": "22 A, Indiana Apt",
   "pincode": 123456
} 

{
   "_id":ObjectId("52ffc4a5d85242602e0000001"),
   "building": "22 B, Indiana Edd",
   "pincode": 789012
}
```

<br/>

**1.嵌入式关系**

user文档

```
{
    "_id":ObjectId("52ffc33cd85242f436000001"),
    "name": "Tom Hanks".
    "address": [
      {
        "_id":ObjectId("52ffc4a5d85242602e000000"),
        "building": "22 A, Indiana Apt",
        "pincode": 123456
      },
      {
         "_id":ObjectId("52ffc4a5d85242602e0000001"),
         "building": "22 B, Indiana Edd",
         "pincode": 789012
      }]
} 
```

查询

```
db.users.findOne({"name":"Tom Hanks"},{"address":1})
```

>这种数据结构的缺点是，如果用户和用户地址在不断增加，数据量不断变大，会影响读写性能。

<br/>

**2.引用式关系**

user文档

```
{
    "_id":ObjectId("52ffc33cd85242f436000001"),
    "name": "Tom Hanks".
    "address": [
     	ObjectId("52ffc4a5d85242602e000000"),
     	ObjectId("52ffc4a5d85242602e0000001")
      ]
} 
```

查询

```
var result = db.users.findOne({"name":"Tom Hanks"},{"address":1})
db.address.find({"_id":{"$in":result["address"]}})
```

>这种方法需要两次查询，第一次查询用户地址的对象id（ObjectId），第二次通过查询的id获取用户的详细地址信息。

<br/>

**3.DBRefs**

user文档

```
{
    "_id":ObjectId("52ffc33cd85242f436000001"),
    "name": "Tom Hanks".
    "address": [
     	{
     		"$ref": "address",
	  	"$id": ObjectId("52ffc4a5d85242602e000000")
  	},
   	{
   		"$ref": "address",
	   	"$id": ObjectId("52ffc4a5d85242602e0000001")
	},
      ]
} 
```

查询方式

```
var dbRef = db.users.findOne({"name":"Tom Hanks"}).address[0]
db[dbRef.$ref].findOne({"_id":(dbRef.$id)})
```

>一个文档从多个集合引用文档，我们应该使用 DBRefs