# ElasticSearch

>Elasticsearch 是一个实时的分布式搜索分析引擎，它被用作全文检索、结构化搜索、数据分析

#### 一.配置文件

>elasticsearch.yml

```
cluster.name: my-application #集群名称，用来判断是否同一集群
node.name: node-1 #节点名称，用来区分同一集群的不同节点
network.host: 192.168.0.1 #IP地址
http.port: 9200 #监听端口
path.data: /path/to/data #数据存储地址
path.logs: /path/to/logs #日志存储地址
```

<br>

#### 二.基础

>http://ip:port/index/type/id

名称|注释|SQL
---|---|---
Index|索引|数据库
Type|索引的数据类型(只能有一个)|数据表
Document|文档数据|记录
Field|文档的属性|字段
Query DSL|查询语法|SQL

<br>

#### 三.基本操作

>创建索引

```
PUT weather
```

>删除索引

```
DELETE weather
```

>索引操作

```
POST weather/_close
POST weather/_open
```

>新增数据

```
PUT accounts/person/1
{
  "name":"John",
  "lastname":"Doe",
  "job_description":"Systems administrator"
}

POST accounts/person
{
  "name":"John",
  "lastname":"Doe",
  "job_description":"Systems administrator"
}
```

>查看数据

```
GET accounts/person/1?pretty=true
```

>更新数据

```
POST accounts/person/1/_update
{
  "doc":{
    "job_description":"Linux specialist"
  }
}
```

```
PUT accounts/person/1
{
    "name":"John",
    "lastname":"Doe",
    "job_description":"Linux specialist"
}
```

>删除数据

```
DELETE accounts/person/1

DELETE accounts
```

>全文检索

```
GET accounts/person/_search?q=john

GET accounts/person/_search
{
  "query":{
    "match": {
      "name": "john"
    }
  },
  "from":2,
  "size":1
}
```

```
#获取多个索引
GET  aaaa,accounts/_search
#获取所有索引
GET _all/_search
#获取以account开头的索引
GET  account*/_search
#获取以account开头，但不是accounts的索引
GET a*,-accounts/_search
#忽略不存在的索引，不报错
GET  accounts,aaaa/_search?ignore_unavailable=true
#获取以account开头的索引，当不存在时不报错(默认)
GET  ad*/_search?allow_no_indices=true
```

<br>

#### 四.设置中文分词

```
elasticsearch-plugin install https://github.com/medcl/elasticsearch-analysis-ik/releases/download/v5.5.1/elasticsearch-analysis-ik-5.5.1.zip

PUT accounts
{
  "mappings": {
    "person": {
      "properties": {
        "user": {
          "type": "text",
          "analyzer": "ik_max_word",
          "search_analyzer": "ik_max_word"
        },
        "title": {
          "type": "text",
          "analyzer": "ik_max_word",
          "search_analyzer": "ik_max_word"
        },
        "desc": {
          "type": "text",
          "analyzer": "ik_max_word",
          "search_analyzer": "ik_max_word"
        }
      }
    }
  }
}
```
