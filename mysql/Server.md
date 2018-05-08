# Server

**一.bin-log**

>MySQL的二进制日志可以说是MySQL最重要的日志了,它记录了所有的DDL和DML(除了数据查询语句)语句,MySQL的二进制日志是事务安全型的。二进制日志包括两类文件：二进制日志索引文件（文件名后缀为.index）用于记录所有的二进制文件，二进制日志文件（文件名后缀为.00000*）记录数据库所有的DDL和DML(除了数据查询语句)语句事件。

```
开启bin-log

[mysqld]
log-bin=mysql-bin
```

```
常用binlog日志操作命令

#查看所有binlog日志列表
mysql> show master logs;

#查看master状态，即最后(最新)一个binlog日志的编号名称，及其最后一个操作事件pos结束点(Position)值
mysql> show master status;

#刷新log日志，自此刻开始产生一个新编号的binlog日志文件
mysql> flush logs;
注：每当mysqld服务重启时，会自动执行此命令，刷新binlog日志；在mysqldump备份数据时加-F选项也会刷新binlog日志；

#重置(清空)所有binlog日志
mysql> reset master;
```

```
分析binlog日志

#查询第一个(最早)的binlog日志：
mysql> show binlog events\G

#指定查询 mysql-bin.000021 这个文件：
mysql> show binlog events in 'mysql-bin.000021'\G

#指定查询 mysql-bin.000021 这个文件，从pos:249开始查起：
mysql> show binlog events in 'mysql-bin.000021' from 249\G

#指定查询 mysql-bin.000021 这个文件，从pos:249开始查起，查询10条
mysql> show binlog events in 'mysql-bin.000021' from 249 limit 10\G

#指定查询 mysql-bin.000021 这个文件，从pos:249开始查起，偏移2行，查询10条
mysql> show binlog events in 'mysql-bin.000021' from 249 limit 2,10\G
```

```
Log_name: mysql-bin.000021  查询的binlog日志文件名
Pos: 11197                  pos起始点
Event_type: Query           事件类型：Query
Server_id: 1                标识是由哪台服务器执行的
End_log_pos: 11308          pos结束点:11308
Info: use `zyyshop`; INSERT INTO `team2` VALUES (0,345,'asdf8er5')  执行的sql语句
```

```
FORMAT_DESC:它是binlog文件中的第一个事件，而且，该事件只会在binlog中出现一次。它通常指定了MySQL Server的版本，binlog的版
本。

QUERY:以文本的形式来记录事务的操作(事务的BEGIN操作，STATEMENT格式(每一条会修改数据的sql都会记录在binlog中)中的DML操作，
ROW格式(不记录sql语句上下文相关信息，仅保存哪条记录被修改)中的DDL操作)。

WRITE_ROWS，UPDATE_ROWS，DELETE_ROWS，分别对应ROWS格式的insert，update和delete操作。

XID:在事务提交操作。

ROTATE_EVENT:当binlog文件的大小达到max_binlog_size的值或者执行flush logs命令时，binlog会发生切换，这个时候会在当前的binlog
日志添加一个ROTATE_EVENT事件，用于指定下一个日志的名称和位置。

GTID:在启用GTID模式后，MySQL实际上为每个事务都分配了个GTID。

PREVIOUS_GTIDS:开启GTID模式后，每个binlog开头都会有一个PREVIOUS_GTIDS事件，它的值是上一个binlogPREVIOUS_GTIDS+GTID。

STOP_EVENT:当MySQL数据库停止时，会在当前的binlog末尾添加一个STOP_EVENT事件表示数据库停止。
```

```
利用binlog恢复数据

mysqlbinlog mysql-bin.0000xx | mysql -u用户名 -p密码 数据库名

常用选项：
    --start-position=953                   起始pos点
    --stop-position=1437                   结束pos点
    --start-datetime="2013-11-29 13:18:54" 起始时间点
    --stop-datetime="2013-11-29 13:21:53"  结束时间点
    --database=test                        指定只恢复test数据库
```

<br>

**二.主从复制**

>1.如果主服务器出现问题，可以快速切换到从服务器提供的服务
>2.可以在从服务器上执行查询操作，降低主服务器的访问压力
>3.可以在从服务器上执行备份，以避免备份期间影响主服务器的服务

```
主服务器

#创建新用户,作为从服务器的访问对象
>create user repl;

#授权从服务器的用户
>grant replication slave on *.* to 'repl'@'192.168.0.%' identified by '123456';

#修改配置文件my.cnf
server-id=1
log-bin=mysql-bin

#获取最新的bin-log日志编号
>show master status;
```

```
从服务器

#修改配置文件my.cnf
server-id=2
master-host=192.168.10.1
master-user=repl
master-password=pass
master-port=3306
log-bin=mysql-bin

#查看主从服务器状态
>show processlist\G
>show slave status\G

#动态修改配置
>slave stop;
>change master to
>master_host=192.168.10.1,
>master_user=repl,
>master_password=123456,
>master_port=3306,
>master_log_file=mysql-bin.000003,
>master_log_pos=98;
>slave start;
```

<br>

**三.分区**

>mysql的分区技术不同与之前的分表技术，它与水平分表有点类似，但是它是在逻辑层进行的水平分表，对与应用程序而言它还是一张表

分区类型|优点|缺点
---|---|--
Range|适合与日期类型，支持复合分区|有限的分区
List|适合与有固定取值的列，支持复合分区|有限的分区，插入记录在这一列的值不在List中，则数据丢失
Hash|线性Hash使得增加，删除和合并分区更快捷|线性Hash的数据分布不均匀，而一般Hash的数据分布较均匀
Key|列可以为字符型等其它非int类型|效率较之前的低，因为函数为复杂的函数(如MD5或SHA函数)

```
Range分区:

>create table employees(
>   id int not null,
>   fname varchar(30),
>   hired date not null default '1970-01-01',
>   separated date not null default '9999-12-31',
>   job_code int not null,
>   store_id int not null
>)
>partition by range (store_id)(
>   partition p0 values less than (6),
>   partition p1 values less than (11),
>   partition p2 values less than (16),
>   partition p3 values less than (21)
>);
```

```
List分区:

>create table employees(
>   id int not null,
>   fname varchar(30),
>   hired date not null default '1970-01-01',
>   separated date not null default '9999-12-31',
>   job_code int not null,
>   store_id int not null
>)
>partition by list (store_id)(
>   partition p0 values in (3,5,6,9,17),
>   partition p1 values in (1,2,10,11,19,20),
>   partition p2 values in (4,12,13,14,18),
>   partition p3 values in (7,8,15,16)
>);
```

```
Hash分区:

Range分区:

>create table employees(
>   id int not null,
>   fname varchar(30),
>   hired date not null default '1970-01-01',
>   separated date not null default '9999-12-31',
>   job_code int not null,
>   store_id int not null
>)
>partition by hash (year(hired))
>partitions 4
>;
```