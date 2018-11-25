# Nginx全局配置


### 一.常用指令

```
#显示版本信息
nginx -v
#显示版本和配置选项信息
nginx -V
#检测配置文件是否有语法错误，并指定配置文件
nginx -t -c /etc/nginx/nginx.conf
#重新加载配置|重启|快速停止|完整退出nginx
nginx -s reload|reopen|stop|quit
```

```
#发起100个请求，同时并发10个
ab -n 100 -c 10 https://www.baidu.com/


#服务器版本
Server Software:        BWS/1.1
#服务器Host
Server Hostname:        www.baidu.com
#服务器端口
Server Port:            443
#加密协议
SSL/TLS Protocol:       TLSv1.2,ECDHE-RSA-AES128-GCM-SHA256,2048,128

#访问路径
Document Path:          /
#页面响应体的字节数
Document Length:        227 bytes

#并发数
Concurrency Level:      10
#完成请求的总时间
Time taken for tests:   1.220 seconds
#总请求数
Complete requests:      100
#失败的请求数
Failed requests:        0
#从服务器接收的字节总数
Total transferred:      89300 bytes
#从服务器接受响应体的字节总数
HTML transferred:       22700 bytes
#服务器单位时间内能处理的最大请求数
Requests per second:    81.94 [#/sec] (mean)
#用户平均请求等待时间
Time per request:       122.034 [ms] (mean)
#服务器平均请求处理时间
Time per request:       12.203 [ms] (mean, across all concurrent requests)
#网络传输速率
Transfer rate:          71.46 [Kbytes/sec] received

#网络上消耗的时间的分解
Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:       59   79  13.6     76     114
Processing:    19   26   4.5     25      42
Waiting:       19   26   4.5     25      42
Total:         81  105  17.2    101     148

#每个请求处理时间的分布情况，50%的处理时间在101ms内
Percentage of the requests served within a certain time (ms)
  50%    101
  66%    105
  75%    114
  80%    123
  90%    132
  95%    144
  98%    146
  99%    148
 100%    148 (longest request)
```

<br>

### 二.默认配置文件 

```
#运行用户
user  html;
#启动工作进程个数,通常设置cpu核数的数量相等
worker_processes  1;
#全局错误日志及PID文件
#error_log  logs/error.log;
#error_log  logs/error.log  notice;
#error_log  logs/error.log  info;
#pid  logs/nginx.pid;

#工作模式及连接数上限
events {
    #单个工作进程最大允许的连接数
    worker_connections  1024;
}

#设定http服务器
http {
    #设定mime类型,类型由mime.type文件定义
    include  mime.types;
    #默认文件类型
    default_type  application/octet-stream;
    #日志格式
    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
    #                  '$status $body_bytes_sent "$http_referer" '
    #                  '"$http_user_agent" "$http_x_forwarded_for"';
    #设定访问日志
    #access_log  logs/access.log main;
    #是否采用零拷贝传输文件方式
    sendfile  on;
    #当数据包累计到一定大小后就发送,而不一个接一个的发送
    #tcp_nopush  on;
    #连接超时时间
    #keepalive_timeout  0;
    keepalive_timeout  65;
    #开启gzip压缩
    #gzip  on;
    #设定虚拟主机
    server {
        #侦听80端口
        listen  80;
        #服务器的域名
        server_name  localhost;
        #设置编码
        #charset koi8-r;
        #设定本虚拟主机的访问日志
        access_log  logs/host.access.log  main;
        #默认请求
        location / {
            #定义服务器的默认网站根目录位置
            root  /usr/share/nginx/html;
            #定义首页索引文件的名称
            index  index.html index.htm;
        }
        #定义错误提示页面
        #error_page  404  /404.html;
        error_page  500 502 503 504  /50x.html;
        location = /50x.html {
            root  /usr/share/nginx/html;
        }
    }
}
```

### user(定义运行用户,ngx_core_module)

```
语法: user user [group]
默认值: user nobody nobody
上下文: main
```

### worker_processes(定义工作进程数目,ngx_core_module)

```
语法: worker_processes number | auto
默认值: worker_processes 1
上下文: main
```

### worker_cpu_affinity(指定CPU核心数,ngx_core_module)

```
语法: worker_cpu_affinity cpumask ...
      worker_cpu_affinity auto [cpumask]
默认值: —
上下文: main
```

<br>

```
#开启4个工作进程
worker_processes    4;
#为每个进程指定CPU核心
worker_cpu_affinity 0001 0010 0100 1000;
```

### events(工作进程处理连接设置,ngx_core_module)

```
语法: events { ... }
默认值: —
上下文: main
```

### use(IO模型设置,ngx_core_module)

```
语法: use method
默认值: —
上下文: events
```

### worker_connections(工作进程最大连接数,ngx_core_module)

```
语法: worker_connections number
默认值: worker_connections 512
上下文: events
```

### pid(设置pid路径,ngx_core_module)

```
语法: pid file
默认值: pid logs/nginx.pid
上下文: main
```

### include(包含配置文件,ngx_core_module)

```
语法: include file | mask
默认值: —
上下文: any
```

## 三.通用配置文件

```

```