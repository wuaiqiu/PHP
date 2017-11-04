# 索引

**一.简介**

>MySQL索引的建立对于MySQL的高效运行是很重要的，索引可以大大提高MySQL的检索速度。实际上，索引也是一张表，该表保存了主键与索引字段，并指向实体表的记录。虽然索引大大提高了查询速度，同时却会降低更新表的速度，如对表进行INSERT、UPDATE和DELETE。因为更新表时，MySQL不仅要保存数据，还要保存一下索引文件。

<br/>

**二.创建索引**

1.单列索引:一个索引只包含一个列,一个表可以有多个单列索引.

(1).普通索引
	
```
#如果是CHAR,VARCHAR类型,length可以小于字段的实际长度,如果是BLOB和TEXT类型就必须指定长度
CREATE TABLE student(
	 id INT, 
	 name VARCHAR(16), 
	 INDEX indexName (name(8))
);
		
CREATE INDEX indexName ON student(name(4)); 
	
ALTER TABLE student ADD INDEX indexName(name(4));

DROP INDEX indexName ON student; 
	
SHOW INDEX FROM student;
```	
	
(2).唯一索引，即添加唯一约束即可
			
(3).主键索引,即添加主键约束即可

2.组合索引:一个组合索引包含两个或两个以上的列

```
CREATE	 INDEX indexName On student(id,name(4));
```

>注意：	索引where时的条件要按照建立索引的时候字段的排序方式


3.全文索引:如果文本中出现多个一样的字符,普通索引将失效,则需要全文索引

```
CREATE TABLE student ( 
      id INT, 
      name char(10),
      FULLTEXT(id) 
);

ALTER TABLE student ADD FULLTEXT fullName(id);

CREATE FULLTEXT INDEX fullName ON student(id);

#使用全文索引
SELECT * FROM student WHERE MATCH(`name`) AGAINST('聪')
```
