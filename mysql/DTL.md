# DTL

**一.简介**

Data Transaction Language,数据库事务语言，即将多条sql语句看成一个整体，要么全执行，要么一个都不执行；

<br/>

**二.问题读取**

1).脏读(Dirty Read):事务1更新了某一条记录，但未提交；事务2读取到新的未提交记录;
2).不可重复读取(Nonrepeatable Read):事务1读取某一条记录；事务2修改事务1读取的记录提交后；事务1再次读取该记录;
3).幻象读取(Phantom Read):事务1按WHERE子句读取一批记录；事务2插入一条或多条符合事务1读取规则的记录；事务1再按一样的WHERE子句读取一批记录;

隔离级别

隔离级别|脏读|不可重复读|幻读
---|---|---|---
Read Uncommitted(未提交读)|√|√|√
Read Committed(提交读)|×|√|√
Repeatable Read(可重复读)|×|×|√
Serializable(可串行化)|×|×|×

<br/>

**三.事务控制语句**

描述|语句
--|---
查看当前会话隔离级别|select @@tx_isolation;
查看系统当前隔离级别|select @@global.tx_isolation;
设置当前会话隔离级别|set session transaction isolatin level repeatable read;
设置系统当前隔离级别|set global transaction isolation level repeatable read;

<br/>

**四.事务的特性（ACID）**

原子性 (atomicity),一致性(consistency),隔离性 (isolation),持久性(durability) 

<br/>

**五.执行方式**

方式一

```
mysql>select @@autocommit;   		//"自动提交":默认提交方式，即提交一句sql语句，就执行一条语句
	
mysql>set  autocommit = 0;		//"人为提交":手动提交
	
mysql> insert into t select 1; 

mysql> insert into t select 2; 

mysql>commit;				//提交数据

mysql>rollback;			//回滚事务，即重新开始
```	

方式二

```
mysql>start transaction;  	//开启事务

mysql> insert into t select 1; 

mysql> insert into t select 2; 

mysql>commit;			//提交数据

mysql>rollback;			//回滚事务，即重新开始
```

<br/>

**六.事务日志**

&nbsp;&nbsp;预写式日志（write-Ahead Logging）:可以帮助提高事务的效率。使用事务日志，存储引擎在修改表的数据时，只需要修改其内存拷贝，再把该修改行为记录到硬盘上的事务日志中，而不用每次都将修改的数据本身持久到磁盘。事务日志采用的是追加的方式，因此写日志的操作是磁盘上一小块区域内的顺序I/O，而不是随机I/O，所以快很多。事务日志持久以后，内存中被修改的数据在后台可以慢慢地刷回到磁盘。此方式称之为，预写式日志，修改数据需要写两次磁盘。
&nbsp;&nbsp;如果数据的修改已经纪录到事务日志中，但数据本身还没有写回磁盘，此时系统崩溃，存储引擎在重启时，能够自动恢复这部分修改的数据（具体恢复方式则视存储引擎而定）。