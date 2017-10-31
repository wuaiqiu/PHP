# 导出与导入数据

**一.sql导入与导出**

(1).数据库的导出

```
#导出database数据库所有表的数据及结构
$mysqldump -u root -p database > database.sql

#导出database数据库所有表的结构
$mysqldump -u root -p -d database > database.sql

#导出database中的table表结构及数据
$mysqldump -u root -p database table > table.sql

#导出多个数据库所有表的数据及结构
$mysqldump -u root -p --databases database1 database2 >databases.sql

#导出所有数据库所有表的数据及结构
$mysqldump -u root -p --all-databeas >all.sql
```

(2).数据库的导入
		
```
#导入database数据库（已存在）的所有表的数据及结构
$mysql -u root -p database < database.sql

#在mysql命令行中	
>source database.sql;
```

<br/>

**二.数据记录导入与导出**

(1).数据表的导出

```
#普通文本
>SELECT * FROM table INTO OUTFILE '/tmp/table.txt';

#csv格式
>SELECT * FROM table INTO OUTFILE '/tmp/table.txt'  FIELDS TERMINATED BY ',' ENCLOSED BY '"'  LINES TERMINATED BY '\r';
```

(2).数据表的导入

```
#导入数据文本LOCAL表示本地
>LOAD DATA LOCAL INFILE 'table.txt' INTO TABLE mytbl;
```