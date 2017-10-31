# query
							
							
**一.合并查询**（要求被合并的表中，列的类型与列数相同）

```
#不去除重复行
SELECT * FROM student
UNION ALL
SELECT * FROM teacher;
	
#去除重复行
SELECT * FROM student
UNION
SELECT * FROM teacher;
```

<br/>

**二.内连接**
	
两表的公共记录部分

```
SELECT * FROM student stu,teacher tea WHERE stu.id=tea.id;
	
SELECT * FROM student stu INNER JOIN teacher tea ON stu.id=tea.id;

SELECT stu.id,tea.name FROM student stu INNER JOIN teacher tea on stu.id=tea.id;
```

<br/>

**三.外连接**

以一张表为主表，另一张表为附表	

```
#右外连接
SELECT * FROM student stu LEFT OUTER JOIN teacher tea ON stu.id=tea.id;

#左外连接
SELECT * FROM student stu RIGHT OUTER JOIN teacher tea ON stu.id=tea.id;

#全连接，mysql不支持
SELECT * FROM student stu FULL OUTER JOIN teacher tea ON stu.id=tea.id;
```