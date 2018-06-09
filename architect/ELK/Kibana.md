# Kibana

>Kibana是一个可视化Elasticsearch的管理服务

#### 一.配置文件

>kibana.yml

```
server.host: "localhost"  #访问kibana的IP地址
server.port: 5601 #访问kibana的端口
elasticsearch.url: "http://localhost:9200" #需要管理的elasticsearch的地址
```

<br>

#### 二.功能模块

```
Discover    #数据搜索查看
Visualize   #图表制作
Dashboard   #仪表盘制作
Timelion    #时序数据的高级可视化分析
DevTools    #开发者工具
Management  #配置
```
