#DQL
					
					
**一.简介**

Data Query Language: 数据查询语言,【查询记录】(不修改记录)
	
(1).基本查询
	
```
#全表查询
SELECT * FROM student;

#指定列查询		
SELECT name FROM student;

#去重复指定列查询		
SELECT DISTINCT data FROM student;
```
	
(2).列运算

```
#指定列乘5后返回
SELECT id*5  FROM student;

#连接字符并返回		
SELECT CONCAT('$',id) FROM student;

#空字段转0后乘12并返回		
SELECT IFNULL(id,0)*12 FROM student;

#列别名返回		
SELECT id (AS) ids FROM student;
```
		
(3).条件控制

```
#where基本查询
SELECT id,name  FROM student WHERE id>10;

#in包含查询
SELECT * FROM Websites  WHERE name IN ('Google','菜鸟教程');

#between之间查询
SELECT * FROM Websites  WHERE id BETWEEN 1 AND 20;
```
		
(4).模糊查询（'_'表示单个字符,'%'表示多个字符,[charlist]字符列中的任何单一字符,[^charlist]或[!charlist]不在字符列中的任何单一字符）
	
```
SELECT * FROM student WHERE name LIKE 'zhang_';
		
SELECT * FROM student WHERE name LIKE 'zhang%';

SELECT * FROM student WHERE name where name REGEXP '^[abc]';

SELECT * FROM student WHWRE name where name NOT REGEXP '[abc]';
```	
	
(5).排序（ASC:默认,表示从小到大排序;DESC:表示从大到小排序）

```	
SELECT * FROM WHERE id>1 ORDER BY id ASC;
		
SELECT * FROM WHERE id>1 ORDER BY id ASC, data DESC;
```	
	
(6).聚合函数
	
1).COUNT记录数总个数
		
```
#计算student表的id字段【不为NULL的记录数】
SELECT COUNT(id) FROM student;
```
							
2).MAX,MIN,SUM,AVG

```
#计算student表的【id字段值的平均值】	
SELECT AVG(id) FROM student;
```

(7).分组查询

```
#以data分组，计算各组的记录数	
SELECT data,COUNT(*) FROM student GROUP BY data;

#以data分组，计算各组的记录数,并记录数大于3
SELECT data,COUNT(*) nums FROM student GROUP BY data HAVING nums>3;
```

(8).LIMIT限定行数

```	
SELECT * FROM student LIMIT 4,3;#截取5,6,7行记录
```

<br/>

**二.SQL语句排序**
	

>SELECT --> FROM --> WHERE --> GROUP BY --> HAVING --> ORDER BY
							
		
where子句中的运算符

符号|描述
---|---
=|等于
<>|不等于。注释：在 SQL 的一些版本中，该操作符可被写成 !=
>|大于
<|小于
>=|大于等于
<=|小于等于
BETWEEN|在某个范围内
LIKE|搜索某种模式
IN|指定针对某个列的多个可能值