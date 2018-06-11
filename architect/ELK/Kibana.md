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

>Discover:菜单界面主要用于通过搜索请求，过滤结果，查看文档数据。可以查询搜索请求的文档总数，获取字段值的统计情况并通过柱状图进行展示。


>Visualize:菜单界面主要用于将查询出的数据进行可视化展示，且可以将其保存或加载合并到Dashboard中。


>Dashboard:在此菜单界面中，我们可以自由排列一组已保存的可视化数据。


>Timelion:是一个时间序列数据的可视化，可以结合在一个单一的可视化完全独立的数据源。它是由一个简单的表达式语言驱动的，用来检索时间序列数据，进行计算，找出复杂的问题的答案，并可视化的结果。


>DevTools:使用户方便的通过浏览器直接与Elasticsearch进行交互，发送RESTFUL请求可以对Elasticsearch数据进行增删改查


>Management:kibana的配置选项
