# 索引优化

**1.慢查询日志**

>MySQL的慢查询日志是MySQL提供的一种日志记录，它用来记录在MySQL中响应时间超过阀值的语句，具体指运行时间超过long_query_time值的SQL，则会被记录到慢查询日志中

```
#查看慢查询是否开启
>show variables like '%slow_query_log%';
#开启慢查询（默认是关闭）
>set global slow_query_log=1;
#设置时间阀值（默认是10s）
>set global long_query_time=1;
#未使用索引的查询也被记录到慢查询日志中（默认关闭）
>set global log_queries_not_using_indexes=1;
```

```
分析日志
mysqldumpslow  /var/lib/mysql/ArchLinux-slow.log

Count: 1    #访问计数    
Time=0.00s (0s)    #平均查询时间(总查询时间)
Lock=0.00s (0s)    #平均锁定时间(总锁定时间)
Rows_sent=1000.0 (1000)    #平均返回记录数(总返回记录数)
Rows_examined=1000.0 (1000)    #平均扫描过的行数(总扫描过的行数)
Rows_affected=0.0 (0)    #平均更新行数(总更新行数)
```

```
分析日志(percona-toolkit)
pt-query-digest /var/lib/mysql/ArchLinux-slow.log

开始总的摘要信息
# 170ms user time, 10ms system time, 26.00M rss, 213.39M vsz
--此工具执行日志分析时的所用时间、内存资源(rss物理内存占用大小，vsz虚拟内存占用大小)
# Current date: Mon Jul 28 09:55:34 2014
--分析时的系统时间
# Hostname: lump.group.com
--进行分析的主机名
# Files: mysql-slow.log
--分析的日志文件名称
# Overall: 5 total, 4 unique, 0.02 QPS, 0.04x concurrency 
--文件中总共的语句数量，唯一的语句数量(对语句进行了格式化)，QPS(每秒查询数(queries per second))，并发数
# Time range: 2014-07-28 09:50:30 to 09:54:50
--记录日志的时间范围

# Attribute          total     min     max     avg     95%  stddev  median
--total总计，min最小，max最大，avg平均，95%把所有值从小到大排列，位于95%的那个数
–Exec time：语句执行时间
–Lock time：锁占有时间
–Rows sent：发送到客户端的行数
–Row examine：扫描的行数(SELECT语句)
–Row affecte：发送改变的行数(UPDATE, DELETE, INSERT语句)
–Bytes sent：发送多少bytes的查询结果集
–Query size：查询语句的字符

查询分组统计结果
–Rank:分析的所有查询语句的排名，默认按查询时间降序排序
–Query ID：查询语句的指纹
–Response time：响应时间
–Calls：查询执行的次数
–R/Call：每次执行的平均响应时间
–V/M：响应时间Variance-to-mean的比率
–Item：查询语句

每个独立查询语句的分析
```

```
#保存到数据库中（简单）
pt-query-digest --user=root --password=123456 
   --review h=127.0.0.1,D=sakila,t=global_query_review --no-report --create-review-table                 
   /var/lib/mysql/ArchLinux-slow.log

#保存到数据库中（详细）
pt-query-digest --user=root --password=123456 
   --history h=127.0.0.1,D=sakila,t=global_query_history --no-report --create-history-table                 
   /var/lib/mysql/ArchLinux-slow.log
```

<br>

**2.分析数据**

```
>explain select customer_id,first_name,last_name from customer;

id:1    #如果id相同，从上往下顺序执行；否则id值越大，优先级越高，越先执行
select_type: SIMPLE    #查询类型(简单查询SIMPLE;含子查询或联合查询PRIAMRY;联合查询UNION;联合查询结果UNION RESULT;非from子查询SUBQUERY;from子查询DERIVED)
table: customer    #显示这条数据是哪一张表(表的别名;derived子查询;null计算结果)
type: ALL    #显示连接使用何种类型（null不用访问表或索引>const直接获取(主索引)>eq_ref主索引引用(常用于多表连接)>
ref次索引检索>range只检索给定范围索引>index遍历索引>all遍历全表）
possible_keys: NULL    #显示可能应用在这张表的索引
key: NULL    #实际使用的索引
key_len: NULL    #使用索引的长度（越短越好）
ref: NULL    #显示索引的那一列被使用
rows: 599    #检索行数
Extra:    #额外信息（Using index:使用索引;Using where:在使用索引的基础上进行条件判断;
Using filesort:表示MySQL需要使用临时表来存储结果集，常见于排序和分组查询;
Using temporary:MySQL中无法利用索引完成的排序操作称为“文件排序”）
```

<br>

**3.查询优化**

```
#优化Max

>explain select  max(payment_date) from payment;    (type为ALL)
>create index idx_paydate on payment(payment_date);
>explain select  max(payment_date) from payment;    (type为NULL)
```

```
#优化子查询

>explain select title,release_year,length from film where film_id in 
    (select film_id from film_actor where actor_id in
        ( select actor_id from actor where first_name ='sandra')
    );    （采用子查询）
>explain select film.title,film.release_year,film.length from film,film_actor,actor 
    where actor.first_name='sandra'  
        and film_actor.actor_id=actor.actor_id 
          and  film_actor.film_id=film.film_id;    (采用连接查询)
```

```
#去除重复索引（重复索引指相同的列以相同的顺序建立的同类型的索引）

create table test(
    id int primary key,
    name varchar(10),
    constraint union_key unique(id)
);

pt-duplicate-key-checker -u root -p '123456' -h 127.0.0.1
```

```
#去除冗余索引（冗余索引指多个索引的前缀列相同，或是在联合索引中包含主键的索引）

create table test(
    id int primary key,
    name varchar(10),
    index union_index(id,name(4))
)

pt-duplicate-key-checker -u root -p '123456' -h 127.0.0.1
```

```
#删除不用的索引

pt-index-usage -u root -p '123456' -h 127.0.0.1
```

```
#索引左前缀原则【假如有联合索引index(c1,c2,c3,c4)】

(a).where c1=x and c2=x and c4>x and c3=x : index(c1,c2,c3,c4),where添加可以交换位置
(b).where c1=x and c2=x and c4=x order(group) by c3 : index(c1,c2,c3),
(c).where c1=x and c2=x and c3=x order(group) by c4 : index(c1,c2,c3,c4)
(d).where c1=x and c4=x order(group) by c2,c3 : index(c1,c2,c3),order(group) by不可以交换位置
(e).where c1=x and c4=x order(group) by c3,c2 : index(c1)
```

```
#索引覆盖【假如主键key(c1),联合索引index(c1,c2)】

(a).select * from t1 order by c1 : key(c1),
(b).select * from t1 order by c1,c2 : index(1,2)
```

<br>

**4.如何建立索引**

>a.在where从句，group by从句，order by从句，on从句中出现的列


>b.索引字段越小越好


>c.离散度大的列放到联合索引的前面(count(distinct 字段名)越大的离散度越大)