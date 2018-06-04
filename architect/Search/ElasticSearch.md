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

名称|注释|SQL
---|---|---
Index|索引|数据库
Type|索引的数据类型|数据表
Document|文档数据|记录
Field|文档的属性|字段
Query DSL|查询语法|SQL


>create

```
POST accounts/person/1
{
  "name":"John",
  "lastname":"Doe",
  "job_description":"Systems administrator"
}
```

>read

```
GET accounts/person/1
```

>update

```
POST accounts/person/1/_update
{
  "doc":{
    "job_description":"Linux specialist"
  }
}
```

>delete

```
DELETE accounts/person/1

DELETE accounts
```

>query

```
GET accounts/person/_search?q=john

GET accounts/person/_search
{
  "query":{
    "match": {
      "name": "john"
    }
  }
}
```
