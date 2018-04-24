# Server

**一.备份与恢复**

```
#备份test数据库至当前目录下(test目录)
mongodump -h localhost:27017 -d test  -o .

#恢复test数据库
mongorestore -h localhost:27017 -d test --drop  dump/test
```

<br/>

**二.固定集合**

>固定集合不能手工删除文档，只能自动替换，优点:插入性能好，不需要额外分配空间，直接插入队列尾部，按插入顺利查询速度极快

```
#固定集合size表示集合的总大小为1024个字节，max为集合总文档条数为5条，当条数超过则删除最早的一条
db.createCollection("students",{"capped":true,"size":1024,"max":5})
```

<br>

**三.GridFS**

>存储二进制文件（图片，音乐等）

```
#将文件保存到文件库
mongofiles -d local put photo.jpg

#查看保存的文件
mongofiles -d local list

#删除文件
mongofiles -d local delete 1.jpg

#获取文件
mongofiles -d local get 1.jpg

#查询文件
mongofiles -d local search 1.jpg

#在mongodb的local数据库中有
db.fs.chunks.find() #二进制数据
db.fs.files.find() #保存文件的信息
```

<br/>

**四.用户管理**

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

**五.MongoDB 复制（副本集,Replica set）**

>副本集是一组服务器，其中有一个主服务器(primary),用于处理客户端请求；还有多个备份服务器(secondary),用于保存主服务器的数据副本。如果主服务器崩溃了，备份服务器会自动将其中一个成员升级为新的主服务器。

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


#判断当前运行的Mongo服务是否为主节点
db.isMaster()

#从备份节点读取数据，需要设置标识;避免读取到过期数据
db.getMongo().setSlaveOk();
```

>注意:不能对备份节点执行写入操作，备份节点只能通过复制功能写入数据，不接受客户端的写入请求

<br>

**六.分片**

>分片是指将数据拆分，将其分散到不同机器上的过程，当磁盘不够用，单个mongodb不能满足写数据性能要求时，就需要分片

```
a.启动3个mongodb分片节点(1000,1001,1002)
systemctl start mongodb

b.启动1个mongodb配置节点(1003)
systemctl start mongodb

c.启动mongos服务进程
mongos --configdb localhost:1003

d.选取片键(指从集合挑选一个键，该键值作为数据拆分的依据)

e.向mongos添加分片节点与设置片键
db.runCommand({addshard:"lcoalhost:1000",allowLocal:true})
db.runCommand({addshard:"lcoalhost:1001",allowLocal:true})
db.runCommand({addshard:"lcoalhost:1002",allowLocal:true})

db.runCommand({enablesharing:"blog"}) //指定需要分片的数据库
db.runCommand({shardcollection:"blog.user",key:{"name":1}}) //指定集合及对应的片键
```

<br>

**七.服务器监控**

```
mongotop

ns：数据库命名空间，后者结合了数据库名称和集合。
db：数据库的名称。名为 . 的数据库针对全局锁定，而非特定数据库。
total：mongod在这个命令空间上花费的总时间。
read：在这个命令空间上mongod执行读操作花费的时间。
write：在这个命名空间上mongod进行写操作花费的时间。
```