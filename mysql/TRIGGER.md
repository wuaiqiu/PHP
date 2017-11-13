# Trigger

**一.简介**

```
#创建触发器
>DELIMITER $
>CREATE TRIGGER triggerName
>AFTER/BEFORE INSERT/UPDATE/DELETE ON student
>FOR EACH ROW  #这句话在mysql是固定的
>BEGIN
>sql语句;(新插入的数据'NEW.列名';原来的数据'OLD.列名')
>END$
>DELIMITER ;

#查看某个数据库的触发器
>SHOW TRIGGERS FROM test;

#删除触发器
>DROP TRIGGER triggerName;


#注意
(1).触发器只能定义在基本表上，不能定义在视图上
(2).触发器的执行顺序： 执行该表的BEFORE触发器 -->  执行触发器的SQ语句 --> 执行该表的AFTER触发器 
(3).触发器执行失败，相应的操作基本表动作也失败
```
