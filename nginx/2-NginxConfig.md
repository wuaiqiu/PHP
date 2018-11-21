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

<br>

### 二.配置文件 

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