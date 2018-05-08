# Sphinx

>Sphinx是SQL Phrase Index(查询词组索引)的缩写，Sphinx是一个基于SQL的全文检索引擎，Coreseek(sphinx+mmseg)支持中文的全文检索

**一.全文检索**

>1.索引创建(Index):将现实世界中所有的结构化和非结构化数据提取信息，创建索引的过程


>2.搜索索引(Search):就是得到用户的查询请求，搜索创建的索引，然后返回结果的过程


```
#1.读取需要检索的文档(Documents)
students should be allowed to go out with their friends,but not allowed to drink beer.

#2.将文档传给分词组件(Tokenizer)，获取词元(Token)
>将文档分成一个一个单独的单词
>去除标点符号
>去除停词(the,a,this等)
students allowed go their friends allowed drink beer

#3.将词元(Token)传给语言处理组件(Linguistic Processor),获得词(Term)
>将词元全部小写
>将词元单数化
>将词元一般现在化
student allow go their firend allow drink beer

#4.将词(Term)传给索引组件(Indexer),建立索引
>对词排序
>合并相同的词，计算每个词出现的频率(Frequency)
>将每篇文档的id按在每篇文档的频率大小顺序连接到每个词后，形成单链表(Posting List)
```

```
1.用户输入查询语句
2.对查询语句进行词法处理，及语言处理
3.搜索索引，查询符合文档
4.根据得到的文档与和查询语句的相关性进行排序
```

<br>

**二.安装coreseek**

```
#1.安装中文分词mmseg
./bootstrap
./configure
make&&make install

#2.安装sphinx
./buildconf.sh
./configure \
    --with-mmseg \
    --with-mmseg-includes=/usr/local/include/mmseg/ \
    --with-mmseg-libs=/usr/local/lib/ \
    --with-mysql

make && make install
```

```
配置文件(/usr/local/etc/sphinx.conf.dist)
将sphinx.conf.dist-->csft.conf

#主数据源
source main{
        sql_host                        = localhost
        sql_user                        = root
        sql_pass                        = 123456
        sql_db                          = blog
        sql_port                        = 3306
        sql_query_pre                   = SET NAMES utf8
        sql_query_pre                   = SET SESSION query_cache_type=OFF
        sql_query_pre                   = REPLACE INTO counter SELECT 1,MAX(id) FROM student
        sql_query                       = SELECT id,name,info  FROM student WHERE id<=(SELECT max_id FROM counter WHERE id=1)
        sql_query_info                  = SELECT * FROM student WHERE id=$id
}

#主数据索引
index main{
        source      = main
        path        = /var/data/mian
        charset_type= zh_cn.utf-8
        charset_dictpath=/usr/local/etc/
}

#增量数据源
source delta:main{
        sql_query                       = SELECT id,name,info  FROM student WHERE id>(SELECT max_id FROM counter WHERE id=1)
}

#增量数据索引
index delta:main{
        source      = delta
        path        = /var/data/delta
}

#分布式索引
index dist1{
        type=distributed
        local=chunk1
        agent=localhost:9312:chunk2
        agent=192.168.100.2:9312:chunk3
        agent=192.168.100.3:9312:chunk4
}

#索引器
indexer{
    mem_limit=32M
}
#服务进程
searchd{
    listen=127.0.0.1:9312
}
```

```
操作命令

indexer:创建索引命令
    --all       对所有索引重新编制索引
    --rotate    用于轮换索引，主要是再不停止服务器的时候，增加索引

search:命令行搜索命令

searchd:启动进程命令
```

<br>

**三.中文分词系统**

>中文分词系统:是利用计算机对中文文本进行词语自动识别的系统，词语自动识别的方法我们通常称为分词算法

```
1.基于字符串匹配的分词方法(机械分词方法)，它是基于词典，在足够大的词典中进行词条匹配，若找到了这个1字符串，就算匹配成功
```

```
2.基于理解的分词方法，它是通过让计算机模拟人对句子的理解，达到识别词的效果
```

```
3.基于统计的分词方法，相邻的字同时出现的次数，频率或概率反映成词的可信度，也叫无词典分词技术
```

<br>

**四.连接PHP**

```
#安装sphinx模块
pecl install sphinx

#实例化sphinx对象
$sphinx=new SphinxClient();
#配置
$sphinx->setServer('localhost',9312);
$sphinx->setMatchMode(SPH_MATCH_ANY); //设置全文查询的匹配模式SPH_MATCH_ALL(完全匹配).SPH_MATCH_ANY(模糊匹配)
#查询结果，查询所有索引
$result1=$sphinx->query($keyword,"*");
#高亮显示
$opts=array(
    "before_match"=>"<b>",
    "after_match"=>"</b>"
);
$result2=$sphinx->buildExcerpts($result1,"*",$keyword,$opts);
print_r($result2);
```