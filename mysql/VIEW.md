# 视图

**一.简介**

>视图是基于 SQL 语句的结果集的可视化的表。视图包含行和列，就像一个真实的表。视图中的字段就是来自一个或多个数据库中的真实的表中的字段。视图总是显示最新的数据！每当用户查询视图时，数据库引擎通过使用视图的 SQL 语句重建数据。

<br/>

**二.操作**

```
#创建视图
CREATE VIEW vName AS SELECT * FROM website WHERE id >4;

#查看视图
SELECT * FROM vName;

#更新视图
CREATE OR REPLACE VIEW vName AS SELECT * FROM website WHERE id<4;

#撤销视图
DROP VIEW vName;
```