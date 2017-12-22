# sphinx

数据源

```
#数据源src1
source src1
{
    type            = mysql
    sql_host        = localhost
    sql_user        = root
    sql_pass        = 123456
    sql_db          = blog
    sql_port        = 3306
    sql_sock        =/var/run/mysqld/mysqld.sock
    sql_query_pre     = SET NAMES utf8
    #indexer的sql执行语句
    sql_query       = SELECT uid, sex, intro, mail FROM info
}

#索引test1
index test1
{
    #索引数据源
    source          = src1
    #索引文件存放路径
    path            = /var/lib/sphinx/data/test1
    docinfo         = extern
    #缓冲内存锁定
    mlock           = 0
    #词形处理器
    morphology      = none
    #最小索引词长度，小于这个长度的词不会被索引。
    min_word_len        = 1
}

#建立索引
indexer
{
    #建立索引的时候，索引内存限制
    mem_limit       = 128M
}

#搜索服务配置
searchd
{
    #监听端口
    listen          = 9312
    listen          = 9306:mysql41
    #监听日志
    log         = /var/lib/sphinx/log/searchd.log
    #查询日志
    query_log       = /var/lib/sphinx/log/query.log
}
```

```
require 'sphinxapi.php';
$link=new SphinxClient();
$link->SetServer('localhost',9312);
$link->SetMatchMode(SPH_MATCH_ANY);
$res=$link->Query("ss")
var_dump($res);
```