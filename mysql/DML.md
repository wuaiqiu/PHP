# DML
							
**一.简介**

Data Manipulation Language,数据操作语言,【插入】【修改】【删除】---【记录】
	
```
#指定列插入数据
INSERT INTO student(name,id) VALUES('zhangsan',12);

#插入全列数据
INSERT INTO student VALUES('zhangsan',12,1996-11-08);

#将apps表的app_name,country字段插入websites表中
INSERT INTO Websites (name, country) SELECT app_name, country FROM apps;

#修改数据	
UPDATE student SET name='lisi' WHERE id=12;

#删除数据	
DELETE FROM student WHERE id=12;

#删除所有数据
DELETE FROM student;
```

>注意:SQL的字符串必须要用单引号('),不能用双引号(")