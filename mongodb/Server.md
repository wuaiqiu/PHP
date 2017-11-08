# Server

**一.备份与恢复**

```
#备份test数据库至当前目录下(dump目录)
mongodump -h localhost:27017 -d test  -o .

#恢复test数据库(drop为删除存在的newTest)
mongorestore -h localhost:27017 -d newTest --drop  dump/test
```

<br/>

**二.GridFS**

>存储二进制文件（图片，音乐等）

```
#将文件保存到文件库
mongofiles put photo.jpg

#查看保存的文件
mongofiles list

#在mongodb的test数据库中有
fs.chunks #二进制数据
fs.files #保存文件的信息

#删除文件
mongofiles delete 1.jpg
```

<br/>

**三.用户管理**

```
#打开授权认证
auth=true

#创建用户
db.createUser({"user":"hello",
		"pwd":"java",
		"roles":[{"role":"readWrite","db":"test"}]});



#关闭授权认证
noauth=true

#修改密码
db.changeUserPassword("hello","happy");
```

```
#验证
mongo localhost/test -u hello -p java
```