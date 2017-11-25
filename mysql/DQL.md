# DQL
					
					
**一.简介**

Data Query Language: 数据查询语言,【查询记录】(不修改记录)
	
(1).**单表查询**
	
```
#全表查询
SELECT * FROM student;

#指定列查询		
SELECT name (AS) '姓名' FROM student;

#去重复指定列查询		
SELECT DISTINCT data FROM student;

#指定列乘5后返回
SELECT id*5  FROM student;

#连接字符并返回		
SELECT CONCAT('$',id) FROM student;

#空字段转0后乘12并返回		
SELECT IFNULL(id,0)*12 FROM student;

#where查询（比较大小）
SELECT id,name  FROM student WHERE id>10;

#where查询（between，not between）
SELECT * FROM Websites  WHERE id BETWEEN 1 AND 20;

#where查询（in，not in）
SELECT * FROM Websites  WHERE name IN ('Google','菜鸟教程');

#where查询（模糊查询，like，not like）
SELECT * FROM student WHERE name LIKE 'zh\_ang_';
SELECT * FROM student WHERE name LIKE 'zhang%';

#排序(order by，NULL最小)；不能用于子查询
SELECT * FROM WHERE id>1 ORDER BY id ASC;
SELECT * FROM WHERE id>1 ORDER BY id ASC, data DESC;

#聚集函数（count，sum，avg，max，min）；只能用于select子句与having子句
#计算student表的id字段数量【不为NULL的记录】
SELECT COUNT(id) FROM student;
#计算student表的id字段值的平均值【不为NULL的记录】
SELECT AVG(id) FROM student;
#计算student表class字段值种类【不为NULL的记录】
SELECT COUNT(DISTINCT class) FROM student;
#计算student表class总数大于2的class
SELECT class FROM demo1 GROUP BY class HAVING COUNT(class)>2;

#分组（group by，having）
#以data分组，计算各组的记录数	
SELECT data,COUNT(*) FROM student GROUP BY data;
#以data分组，计算各组的记录数,并记录数大于3
SELECT data,COUNT(*) nums FROM student GROUP BY data HAVING nums>3;

#LIMIT限定行数
#截取5,6,7行记录
SELECT * FROM student LIMIT 4,3;
```

<br/>

(2).**连接查询**

```
#内连接(等值连接);两表的公共记录部分
SELECT * FROM student stu,teacher tea WHERE stu.id=tea.id;
SELECT * FROM student stu INNER JOIN teacher tea ON stu.id=tea.id;
SELECT stu.id,tea.name FROM student stu INNER JOIN teacher tea ON stu.id=tea.id;

#外连接；以一张表为主表，另一张表为附表	
#右外连接
SELECT * FROM student stu LEFT OUTER JOIN teacher tea ON stu.id=tea.id;
#左外连接
SELECT * FROM student stu RIGHT OUTER JOIN teacher tea ON stu.id=tea.id;

#嵌套查询
SELECT * FROM users WHERE id IN (SELECT id FROM demo1);
SELECT * FROM users WHERE id >ANY (SELECT id FROM demo1);
SELECT * FROM users WHERE id >ALL (SELECT id FROM demo1);
SELECT * FROM users WHERE EXISTS(SELECT * FROM demo1 WHERE users.id=demo1.id);
SELECT * FROM users WHERE NOT EXISTS(SELECT * FROM demo1 WHERE users.id=demo1.id);
SELECT * FROM users,(SELECT * FROM demo1) AS demo1 WHERE users.id=demo1.id;

#并集查询（要求被合并的表中，列的类型与列数相同）
#不去除重复行
SELECT * FROM student
UNION ALL
SELECT * FROM teacher;
#去除重复行
SELECT * FROM student
UNION
SELECT * FROM teacher;
```