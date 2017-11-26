# Server

**一.备份与恢复**

```
#备份test数据库至当前目录下(test目录)
mongodump -h localhost:27017 -d test  -o .

#恢复test数据库
mongorestore -h localhost:27017 -d test --drop  dump/test
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

<br/>

**四.MongoDB 复制（副本集,Replica set）**

```
#修改配置文件(主从一样)
replSet = rs0

#初始化副本集
rs.initiate()

#查看副本集的配置
rs.conf()

#查看副本集状态
rs.status() 

#添加副本集的成员
rs.add(HOST_NAME:PORT)

#删除副本集的成员
rs.remove(HOST_NAME:PORT)

# 判断当前运行的Mongo服务是否为主节点
db.isMaster()

#删除local数据库即可清除副本集的配置
```

**五.服务器监控**

```
mongotop

ns：数据库命名空间，后者结合了数据库名称和集合。
db：数据库的名称。名为 . 的数据库针对全局锁定，而非特定数据库。
total：mongod在这个命令空间上花费的总时间。
read：在这个命令空间上mongod执行读操作花费的时间。
write：在这个命名空间上mongod进行写操作花费的时间。
```