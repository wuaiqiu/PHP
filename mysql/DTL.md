# DTL

**一.简介**

Data Transaction Language,数据库事务语言，即将多条sql语句看成一个整体，要么全执行，要么一个都不执行；

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