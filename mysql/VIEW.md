# 视图

**一.简介**

>视图是基于 SQL 语句的结果集的可视化的表。视图包含行和列，就像一个真实的表。视图中的字段就是来自一个或多个数据库中的真实的表中的字段。视图总是显示最新的数据！每当用户查询视图时，数据库引擎通过使用视图的 SQL 语句重建数据。

<br/>

**二.操作**

```
#创建视图
CREATE VIEW vName AS SELECT * FROM website WHERE id >4;

#创建视图并指定列名(行列子集视图)
CREATE VIEW vName(v_name,v_url) AS SELECT name,url FROM website WHERE id>4;

#创建视图（带表达式的视图）
CREATE VIEW vName(v_name,v_url,v_num) AS SELECT name,url,num+1 FROM website WHERE id>4;

#查看视图
SELECT * FROM vName;

#查看视图结构
DESC vName;

#查看指定视图的创建信息
SHOW CREATE VIEW vName;

#查看所有视图
SELECT * FROM information_schema.views;

#修改视图(如果输入的视图名称不存在，MYSQL自动创建该视图)
CREATE OR REPLACE VIEW vName AS SELECT * FROM website WHERE id<4;

#撤销视图
DROP VIEW vName;
```
