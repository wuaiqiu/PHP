# HAProxy

**一.HAProxy均衡负载的实现**

```
HAProxy调度器 (public 172.16.254.200  privite 192.168.0.48)
RS1只有内网IP(192.168.0.18)
RS2只有外网IP(192.168.0.28)

defaults
    #默认的模式，tcp是4层，http是7层
    mode  http
    #应用全局的日志配置
    log  global
    #启用日志记录HTTP请求，默认haproxy日志记录是不记录HTTP请求日志
    option  httplog
    #每次请求完毕后主动关闭http通道
    option  http-server-close
    #获取客户端的真实的IP地址
    option  forwardfor  except 127.0.0.0/8
    #将sessionID记录到cookie中
    option redispatch
    #定义连接后端服务器的失败重连次数
    retries  3

frontend  main 172.16.254.200:80
    #定义一个名为my_app前端部分。此处将对于的请求转发给后端
    default_backend  my_webserver
    #负载均衡算法[roundrobin(轮循)、weight-round-robin(带权轮循)、source(原地址保持)、RI(请求URL)]
    balance  roundrobin

backend my_webserver
    balance  roundrobin   #负载均衡算法
    server  web01 192.168.0.18:80  check inter 2000 fall 3 weight 30  #定义的多个后端
    server  web02 192.168.0.19:80  check inter 2000 fall 3 weight 30   #定义的多个后端
```