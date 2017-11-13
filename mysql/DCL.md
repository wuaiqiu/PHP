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

#创建数据库角色（权限的集合）
CREATE ROLE privileges;

#给角色授予权限
GRANT ALL ON mydb1.*  to privileges;

#将角色授予其他的用户或角色
GRANT privileges TO wu@'%';

#激活角色（默认连接数据库后，角色处于不活动状态）
SET DEFAULT ROLE ALL TO wu@'%';

#撤销角色权限
REVOKE INSERT ON mydb1.* FROM privileges;

#删除角色
DROP ROLE privileges;
```

<br/>

**二.审计***

(1).开启审计

```
#加载audit_log插件
[mysqld] 
plugin-load=audit_log.so

#如果希望数据库强制开启审计功能，如果不开启的话server不启动，或者审计功能不能进行时server挂住，加入
[mysqld] 
plugin-load=audit_log.so 
audit-log=FORCE_PLUS_PERMANENT
```

(2).设置审计

```
show variables like '%audit%';

audit_log_policy:记录了审计日志的控制策略(ALL->记录所有，LOGINS->只记录登录信息，QUERIES->只记录语句信息，NONE->什么都不记录)
audit_log_connection_policy:记录了连接审计的信息(ALL->记录所有连接信息，ERRORS->记录错误连接，NONE->什么都不记录)
audit_log_statement_policy：记录了语句的审计策略(ALL->记录所有语句,ERRORS->只记录错误语句，NONE->什么也不记录)
audit_log_exclude_accounts：控制哪儿些用户可以不进入审计，字符串类型，默认可以使用逗号分隔（只能选其一）。
audit_log_include_accounts：控制哪儿些用户可以进入审计，字符串类型，默认可以使用逗号分隔（只能选其一）。
audit_log_current_session：标志当前会话是否进入审计。
audit_log_file：可以用于控制审计日志的名称和路径
audit_log_format：审计日志的格式，分为OLD和NEW
audit_log_rotate_on_size：审计日志的文件大小。当参数大于0的时候，当审计日志超过限制后，会自动的重命名为加时间戳后缀的日志文件。同时创建新的审计日志
audit_log_buffer_size:审计缓存，建议设置为4096的倍数，该参数只有在audit_log_strategy为ASYNCHRONOUS时生效。
```
