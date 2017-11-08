# Server

**一.管理redis有关命令**

(1).**PING**	用于检测 redis 服务是否启动。PONG表示启动

```	
>ping
=>PONG
```

(2).**ECHO** 	 在命令行打印一些字符

```
>echo hello
=>"hello"
```

(3).**SELECT**	切换数据库（0-15）
	 
```
>select 0
=>OK
>select 16
=>(error) ERR DB index is out of range
```

(4).**QUIT/EXIT** 退出数据库

(5).**DBSIZE**    返回当前数据库的 key 的数量

```
>dbsize
=>(integer) 2
```

(6).**INFO**	   返回redis有关信息
	
(7).**CONFIG GET**	获取指定配置参数的值
	 
```
>config get loglevel
=> 1) "loglevel"
=> 2) "notice"
```

(8).**CONFIG SET**	修改 redis 配置参数，无需重启，但不会写到redis.conf中(但永久有作用，重启后无作用)
	 
```
>config set loglevel warning
=>OK
>config get loglevel
=> 1) "loglevel"
=> 2) "warning"
```

(9).**CONFIG REWRITE** 对启动 Redis 服务器时所指定的 redis.conf 配置文件进行改写（需要root）
	 
```	
>config set loglevel warning
=>OK
>config rewrite
=>OK
```

(10).**FLUSHDB** 	删除当前数据库的所有key

```
>flushdb
=>OK
```

(11).**FLUSHALL** 	删除所有数据库的所有key
	 
```
>flushall
=>OK
```

(12).**CLIENT LIST** 	获取连接到服务器的客户端连接列表
	 
```
>client list
=>id=2 addr=127.0.0.1:35936 fd=7 name= age=139 idle=0 flags=N db=1 sub=0 psub=0 multi=-1 qbuf=0 qbuf-free=32768 obl=0 oll=0 omem=0 events=r cmd=client
```

(13).**CLIENT KILL**	关闭客户端连接

```
>client kill 127.0.0.1:36016
=>OK
```

<br/>

**二.持久化**

>Redis是一个内存数据库，也就是说redis需要经常将内存中的数据同步到硬盘来保证持久化，redis支持两种持久化方式:Snapshotting(快照),Append-only File(AOF)

Snapshotting（默认）

```
save 900 1 #900秒内如果超过1个key被修改，则发起快照保存
save 300 10 #300秒内如果超过10个key被修改，则发起快照保存
```

AOF（追加更新）

```
appendonly yes #启动aof持久化方式
appendfsync always #收到写命令就立即写入磁盘，最慢，但是保证完全的持久化
appendsync everysec #每秒钟写入磁盘一次，在性能和持久化方面做了很好的折中
appendfsync no#完全依赖os，性能最好，持久化没保证
```

<br>

**三.用户管理**

设置密码

```
requirepass beijing
```

验证方式

```
在登录前:
redis-cli -a beijing

在登录后:
auth beijing
```

<br/>

**四.主从复制**

从服务器

```
slaveof 192.168.1.110 6379#指定master的ip与port
masterauth beijingb  #指定master的验证密码
```

>info命令可以查看是否为主从服务器