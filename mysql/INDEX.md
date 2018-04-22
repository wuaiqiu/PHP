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


3.全文索引

```
CREATE TABLE student ( 
      id INT, 
      name char(10),
      FULLTEXT(name) 
);

CREATE FULLTEXT INDEX fullName ON student(name);

#使用全文索引
SELECT * FROM student WHERE MATCH(`name`) AGAINST('聪')
```

4.强制使用索引

```
SELECT * FROM student USE INDEX (name) WHERE name='zhangsan';
```

<br/>

**三.索引存储类型**

1).聚集索引(innodb):对于聚集索引，叶子结点即存储了真实的数据行，不再有另外单独的数据页。主索引直接存放在叶子节点上，次索引指向对主索引的引用，主索引的选举:a.主键索引,b.唯一索引,c.内部rowid索引

2).非聚集索引(myisam):对于非聚集索引，叶结点包含索引字段值及指向数据页数据行的逻辑指针。主索引与次索引都指向物理行


>页分裂在聚簇索引中，如果碰到不规则数据插入时，会出现页分裂现象，导致速度下降