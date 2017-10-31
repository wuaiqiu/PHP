# DCL
							
		
**一.简介**

Data Control Langage,数据控制语言,【添加】【授权】【撤销】【删除】--【用户】
	
```
#添加用户并设置密码,但用户必须为此ip地址
CREATE USER wu@192.168.0.200 IDENTIFIED BY '123456';
								
#添加用户并设置密码,用户可以是任意ip地址								
CREATE USER wu@'%'	IDENTIFIED BY '123456';
								
#授权给指定的用户								
GRANT [ALL,CREATE,ALTER,DROP,INSERT,UPDATE,DELETE,SELECT] ON mydb1.* TO wu@'%';
								
#撤销指定的用户的权限								
REVOKE [ALL,CREATE,ALTER,DROP,INSERT,UPDATE,DELETE,SELECT] ON mydb1.* FROM wu@'%';
								
#查看权限					
SHOW GRANTS FOR wu@'%';	
	
#删除用户
DROP USER  wu@'%';
```