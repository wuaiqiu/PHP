# Nginx日志管理


```
error_log  logs/error.log  notice;

log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                  '$status $body_bytes_sent "$http_referer" '
                  '"$http_user_agent" "$http_x_forwarded_for"';
access_log  logs/access.log main;
```

### error_log(错误日志,ngx_core_module)

```
语法: error_log file [level]
默认: error_log logs/error.log error
上下文: main, http, server, location
```

1).常见的错误日志级别有:debug , info , notice , warn , error , crit , alert , emerg

### log_format(访问日志格式,ngx_http_log_module)

```
语法: log_format name string ...
默认: log_format mian "..."
上下文: http
```

### access_log(访问日志,ngx_http_log_module)

```
语法: access_log path [format [buffer=size] [gzip[=level]] [flush=time]]
      access_log off
默认: access_log logs/access.log combined
上下文: http, server, location, if in location
```

选项|描述
--|--
buffer=size|为存放访问日志的缓冲区大小
flush=time|为缓冲区的日志刷到磁盘的时间
gzip[=level]|表示压缩级别