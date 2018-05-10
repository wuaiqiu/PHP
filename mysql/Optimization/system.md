# 系统优化

**1.操作系统优化**

```
#网络方面的配置，修改/etc/sysctl.conf

增加tcp连接的队列数
net.ipv4.tcp_max_syn_backlog=65535
减少time_wait的数量
net.ipv4.tcp_max_tw_buckets=8000
开启TCP连接复用功能，允许将time_wait sockets重新用于新的TCP连接
net.ipv4.tcp_tw_reuse=1
开启TCP连接中time_wait sockets的快速回收
net.ipv4.tcp_tw_recycle=1
保持在FIN-WAIT-2状态的时间
net.ipv4t.tcp_fin_timeout=10
```

```
#打开文件数的限制，修改/etc/security/limits.conf

*soft nofile 65535
*hard nofile 65535
```

<br>

**2.mysql配置文件（/etc/mysql/my.cnf ）**

```
#缓冲池的大小(默认为16M,设置主存的50%～80%)
innodb_buffer_pool_size=16M
#日志缓冲池大小(默认为8M,由于日志每秒就会刷新所以一般不用太大)
innodb_log_buffer_size=8M
#对innodb的IO效率控制（0:每秒刷新磁盘;1:默认，每次提交都刷新磁盘，安全性高;2:每次提交刷新缓冲区，每一秒刷新磁盘）
innodb_flush_log_at_trx_commit=1
#IO读写线程数(默认为4)
innodb_read_io_threads=4
innodb_write_io_threads=4
#ON:控制innodb每个表使用独立空间,OFF:默认，所有表都会建立在共享表空间中
innodb_file_per_table=OFF
#决定mysql在什么情况下会刷新innodb表的统计信息(默认ON)
innodb_stats_on_metadata=ON
```

>第三方配置自动生成:https://tools.percona.com/wizard