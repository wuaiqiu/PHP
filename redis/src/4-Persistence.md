#  持久化

**一.RDB**

>RDB(Redis DataBase)，也常叫做snapshots：是在某个时间点将数据写入一个临时文件，持久化结束后，用这个临时文件替换上次持久化的文件，达到数据恢复。 snapshot首先将数据写入临时文件，当成功结束后，将临时文件重名为dump.rdb。

```
//使用配置文件进行持久化
save 900 1 #900秒内如果超过1个key被修改，则发起快照保存
save 300 10 #300秒内如果超过10个key被修改，则发起快照保存


//使用命令进行持久化
redis-cli -h ip -p port save #用主线程进行持久化，这种方式会阻塞所有client请求
redis-cli -h ip -p port bgsave #另外开启一条子线程进行持久化
```

<br>

**二.AOF**

>AOF(Append-only file):将“操作 + 数据”以格式化指令的方式追加到操作日志文件的尾部，在append操作返回后(已经写入到文件或者即将写入)，才进行实际的数据变更，“日志文件”保存了历史所有的操作过程；当server需要数据恢复时，可以直接replay此日志文件，即可还原所有的操作过程。

(1).同步写入

>AOF是文件操作，对于变更操作比较密集的server，那么必将造成磁盘IO的负荷加重；此外redis提供了3中aof记录同步选项（appendfsync）：

```
always：每一条aof记录都立即同步到文件，这是最安全的方式，也以为更多的磁盘操作和阻塞延迟，是IO开支较大。
everysec：每秒同步一次，性能和安全都比较中庸的方式，也是redis推荐的方式。如果遇到物理服务器故障，有可能
导致最近一秒内aof记录丢失(可能为部分丢失)。
no：redis并不直接调用文件同步，而是交给操作系统来处理，操作系统可以根据buffer填充情况/通道空闲时间等择机
触发同步；这是一种普通的文件操作方式。性能较好，在物理服务器故障时，数据丢失量会因OS配置有关。
```

(2).压缩AOF日志文件

>AOF文件会不断增大，它的大小直接影响“故障恢复”的时间,而且AOF文件中历史操作是可以丢弃的。AOF rewrite操作就是“压缩”AOF文件的过程，当然redis并没有采用“基于原aof文件”来重写的方式，而是采取了类似snapshot的方式：基于copy-on-write，全量遍历内存中数据，然后逐个序列到aof文件中。

``` 
//使用配置文件进行持久化
no-appendfsync-on-rewrite no  #在aof-rewrite期间，appendfsync是否暂缓文件同步
auto-aof-rewrite-min-size 64mb  #aof文件rewrite触发的最小文件尺寸(mb,gb)
auto-aof-rewrite-percentage 100  #相对于“上一次”rewrite，本次rewrite触发时aof文件应该增长的百分比。 


//使用命令进行持久化
redis-cli -h ip -p port bgrewriteaof #开启一个子进程来完成rewrite
```