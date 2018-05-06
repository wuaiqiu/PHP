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

<br>

**五.分区**

>分区是分割数据到多个Redis实例的处理过程

```
1.Redis集群:Redis集群是自动分片和高可用的首选方案

2.Twemproxy:Twemproxy是Twitter维护的（缓存）代理系统，代理Memcached的ASCII协议和Redis协议。支持自动分区，如果其代理的其中
一个Redis节点不可用时，会自动将该节点排除.

3.支持一致性哈希的客户端:在客户端实现一致性哈希或者其他类似算法。有很多客户端已经支持一致性哈希，如RPredis.
```

```
Redis集群原理
1、所有的redis节点彼此互联(PING-PONG机制),内部使用二进制协议优化传输速度和带宽。
2、节点的fail是通过集群中超过半数的节点检测失效时才生效。
3、客户端与redis节点直连,不需要中间proxy层.客户端不需要连接集群所有节点,连接集群中任何一个可用节点即可。
4、redis-cluster把所有的物理节点映射到[0-16383]slot上（不一定是平均分配）。
5、Redis集群预分好16384个桶，当需要在Redis集群中放置一个key-value时，根据CRC16(key) mod 16384的值，决定将一个key放到哪个桶
中。
```

>如果Redis被当做缓存使用，使用一致性哈希实现动态扩容缩容。如果Redis被当做一个持久化存储使用,则使用集群

```
一致性Hash算法

先构造一个长度为0~2^32的整数环(这个环被称为一致性Hash环)，根据节点名称的Hash值(其分布范围同样为0~2^32)将缓存服务器节点放置
在这个Hash环上，然后根据需要缓存的数据的KEY值计算得到其Hash值(其分布范围同样为0~2^32),然后在Hash环上顺时针查找距离这个KEY
的Hash值最近的缓存服务器节点，完成KEY到服务器的Hash映射查找。这样就保证当节点增加或者减少的时候，影响的数据最少

使用虚拟节点的一致性Hash算法
当环上有NDOE0，NODE1，NODE2三个节点，新增一个节点NODE3时，只影响了NODE0，而NODE1，NODE2没有影响，则意味NODE1与NDOE2的负载
压力为原来的2倍，当使用虚拟节点来控制环上NDOE可以改变这一状况，就是将新加入的节点虚拟成多个虚拟节点均匀分布在环上
```