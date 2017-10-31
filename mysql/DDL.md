# DDL
						
						
**一.简介**

Data Definition Language ,数据定义语言,【创建】【查看】【删除】【修改】---【数据库】【表】

操作数据库
	
```
#创建数据库
CREATE DATABASE mydb1;

#显示所有数据库	
SHOW DATABASES;

#删除数据库
DROP DATABASE mydb1;

#转换数据库	
USE mydb1;
```	

操作数据表

```
#创建数据表
CREATE TABLE student (
	name	char(10),
	id 	int
);
	
#创建与student表相同的user数据表
CREATE TABLE user  SELECT * FROM student;

#显示所有的数据表
SHOW TABLES;

#显示数据表结构	
DESC student;

#显示创建表过程	
SHOW CREATE TABLE student;

#删除表	
DROP TABLE student;

#删除数据表,并返回一张空表	
TRUNCATE TABLE student;

#修改表(重命名表)
ALTER TABLE student RENAME TO students;

#修改表结构(添加列)	
ALTER TABLE student ADD (
	brith data
);

#修改表结构(修改列类型)	
ALTER TABLE student MODIFY name char(11);

#修改表结构(修改列名,列类型)	
ALTER TABLE student CHANGE name  newName char(11);

#修改表结构(删除列)												
ALTER TABLE student DROP name;
```	
		
<br/>

**二.SQL数据类型**

数据类型|描述
---|---
**Text类型**|
char(size)|字符型(256B-->2^8)
varchar(size)|可变字符型(256B-->2^8)
text|字符串类型；tinytext(256B-->2^8)，text(64K-->2^16)，mediumtext(16M-->2^24)，longtext(4G-->2^32)
**二进制类型**|
blob|二进制类型；tinyblob(256B-->2^8)，blob(64K-->2^16)，mediumblob(16M-->2^24)，longblob(4G-->2^32)
**Number类型**|
int(size)|整型；tinyint(-2^7B ~ 2^7-1B)，smallint(-2^15B ~ 2^15-1B)，mediumint(-2^23B ~ 2^23-1B)，int(-2^31B ~ 2^31-1B)，bigint(-2^63B ~ 2^63-1B)
float(size,d)| 浮点型
double(size,d)|浮点型，double(5,2)表示最多5位,其中必须有2位小数
decimal(size,d)|浮点型，精确度比double高
**Date类型**|
data|日期类型； yyyy-mm-dd
time|时间类型；hh:mm:ss
datatime|日期与时间结合；yyyy-mm-dd hh:mm:ss	