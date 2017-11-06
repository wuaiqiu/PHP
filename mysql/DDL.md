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

#创建数据表指定引擎
CREATE TABLE student(
        name   char(10),
        id     int
)engine=mysiam|innodbd;	

#创建与student表相同的user数据表
CREATE TABLE user  SELECT * FROM student;

#显示所有的数据表
SHOW TABLES;

#显示数据表结构	
DESC student;

#显示创建表过程	
SHOW CREATE TABLE student;

#修改表结构(删除列)												
ALTER TABLE student DROP name;

#删除表	
DROP TABLE student;

#删除数据表,并返回一张空表	
TRUNCATE TABLE student;

#修改表结构(添加列)	
ALTER TABLE student ADD (
	brith data
);

#修改表(重命名表)
ALTER TABLE student RENAME TO students;

#修改表结构(修改列类型)	
ALTER TABLE student MODIFY name char(11);

#修改表结构(修改列名,列类型)	
ALTER TABLE student CHANGE name  newName char(11);

#修改表引擎
ALTER TABLE student engine=myisam;
```	
		
<br/>

**二.SQL数据类型**

数据类型|描述
---|---
**Text类型**|
char(size)|字符型(256B)
varchar(size)|可变字符型(256B)
text|字符串类型；tinytext(256B)，text(64K)，mediumtext(16M)，longtext(4G)
enum|枚举类型（所有可能值）；内部利用整数管理
set|集合类型（所有可以组合的值）；内部利用整数管理
**二进制类型**|
blob|二进制类型；tinyblob(256B)，blob(64K)，mediumblob(16M)，longblob(4G)
**Number类型**|
int|整型；tinyint(1B)，smallint(2B)，mediumint(3B)，int(4B)，bigint(8B)
float(size,d)| 浮点型，float(5,2)表示最多5位,其中必须有2位小数
double(size,d)|浮点型，double(5,2)表示最多5位,其中必须有2位小数
decimal(size,d)|浮点型，精确度比double高
**Date类型**|
data|日期类型； yyyy-mm-dd
time|时间类型；hh:mm:ss
datatime|日期与时间结合；yyyy-mm-dd hh:mm:ss
timestamp|时间戳与datatime相同只是范围变小
