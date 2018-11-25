# Nginx静态资源服务


## 一.服务状态

### sub_status(服务基本状态,ngx_http_stub_status_module)

```
语法: stub_status
默认值: —
上下文: server, location
```

变量名|描述
--|--
Active connections|当前客户端TCP连接数
accepts|所有客户端TCP连接数
handled|所有已处理的客户端TCP连接数
requests|所有客户端HTTP连接数
Reading|当前正在读的客户端HTTP连接
Writing|当前正在写的客户端HTTP连接
Waiting|当前正在等待的客户端HTTP连接

## 二.内容替换

### sub_filter(内容替换,ngx_http_sub_module)

```
语法: sub_filter string replacement
默认值: —
上下文: http, server, location
```

### sub_filter_last_modified(是否保留last_modified头,ngx_http_sub_module)

```
语法: sub_filter_last_modified on | off
默认: sub_filter_last_modified off
上下文: http, server, location
```

### sub_filter_once(是否只匹配一次,ngx_http_sub_module)

```
语法: sub_filter_once on | off
默认值: sub_filter_once on
上下文: http, server, location
```

## 三.限制并发连接

```
limit_conn_zone $binary_remote_addr zone=limit:10m;
server {
  location  ^~ /download/ {  
    limit_conn limit 4;
    alias /data/www.ttlsa.com/download/;
  }
}
```

### limit_conn_zone(设置TCP限制规则,ngx_http_limit_conn_module)

```
语法: limit_conn_zone key zone=name:size
默认值: —
上下文: http
```

1).如果共享内存空间被耗尽，服务器将会对后续所有的请求返回 503(Service Temporarily Unavailable)错误。

### limit_conn_status(超出limit_conn时返回的状态码,ngx_http_limit_conn_module)

```
语法: limit_conn_status code
默认值: limit_conn_status 503
上下文: http, server, location
```

### limit_conn(设置具体的TCP限制数,ngx_http_limit_conn_module)

```
语法: limit_conn zone number
默认值: —
上下文: http, server, location
```

<br>

```
limit_req_zone $binary_remote_addr zone=one:10m rate=1r/s;
server {
    location /search/ {
        limit_req zone=one burst=5;
    }
}
```

### limit_req_zone(设置HTTP限制规则,ngx_http_limit_req_module)

```
语法: limit_req_zone key zone=name:size rate=rate [sync]
默认值: —
上下文: http
```

1).rate速度可以设置为每秒处理请求数和每分钟处理请求数，其值必须是整数。<br>
2).sync表示将状态同步到共享内存中。

### limit_req_status(超出limit_req时返回的状态码,ngx_http_limit_req_module)

```
语法: limit_req_status code
默认值: limit_req_status 503
上下文: http, server, location
```

### limit_req(设置具体的HTTP限制数,ngx_http_limit_req_module)

```
语法: limit_req zone=name [burst=number] [nodelay];
默认值: —
上下文: http, server, location
```

1).burst表示并发请求中最大延迟数，等待处理。<br>
2).nodelay表示其它并发请求不在延迟，直接返回503。

## 四.限制访问

### allow(允许访问,ngx_http_access_module)

```
语法: allow address | CIDR | unix: | all
默认值: —
上下文: http, server, location
```

### deny(禁止访问,ngx_http_access_module)

```
语法:	deny address | CIDR | unix: | all
默认值: —
上下文: http, server, location
```

1).当多条规则存在时，按顺序匹配。

## 五.传输文件

### sendfile(内核传输文件,ngx_http_core_module)

```
语法: sendfile on | off
默认值: sendfile off
上下文: http, server, location, if in location
```

1).sendfile系统调用在两个文件描述符之间直接传递数据(完全在内核中操作)，从而避免了数据在内核缓冲区和用户缓冲区之间的拷贝，操作效率很高，被称之为零拷贝。

### tcp_nopush(延迟传输文件,ngx_http_core_module)

```
语法: tcp_nopush on | off
默认值: tcp_nopush off
上下文: http, server, location
```

1).需要开启sendfile下，具体过程:先将数据存储到缓存中，等缓存满后将全部数据一次性发送给客户端，即表现了Nagle化(用Nagle算法把较小的包组装为更大的帧)。

### tcp_nodelay(即使传输文件,ngx_http_core_module)

```
语法: tcp_nodelay on | off
默认值: tcp_nodelay on
上下文: http, server, location
```

2).需要在keepalive连接下，用于提高数据传输的实时性，即禁用了Nagle化(用Nagle算法把较小的包组装为更大的帧)。

## 六.压缩文件

### gzip(开启gzip,ngx_http_gzip_module)

```
语法: gzip on | off
默认值: gzip off
上下文: http, server, location, if in location
```

### gzip_buffer(压缩缓冲区大小,ngx_http_gzip_module)

```
语法: gzip_buffers number size
默认值: gzip_buffers 32 4k|16 8k
上下文: http, server, location
```

### gzip_comp_level(压缩等级,ngx_http_gzip_module)

```
语法: gzip_comp_level level
默认值: gzip_comp_level 1
上下文: http, server, location
```

### gzip_disable(排除压缩文件,ngx_http_gzip_module)

```
语法: gzip_disable regex ...
默认值: —
上下文: http, server, location
```

### gzip_min_length(需进行压缩的最小字节大小,ngx_http_gzip_module)

```
语法: gzip_min_length length
默认值: gzip_min_length 20
上下文: http, server, location
```

### gzip_http_version(设置压缩的http版本,ngx_http_gzip_module)

```
语法: gzip_http_version 1.0 | 1.1
默认值: gzip_http_version 1.1
上下文: http, server, location
```

### gzip_types(设置需要压缩的文件类型,ngx_http_gzip_module)

```
语法: gzip_types mime-type ...
默认值: gzip_types text/html
上下文: http, server, location
```

### gzip_vary(是否传输gzip压缩标志,ngx_http_gzip_module)

```
语法: gzip_vary on | off
默认值: gzip_vary off
上下文: http, server, location
```

>注意:对于图片,视频等二进制文件不必压缩，因为作用不大，反而消耗CPU

## 七.处理HTTP响应头

### expires(校验过期,ngx_http_headers_module)

```
语法: expires time
      expires epoch | max | off
默认值: expires off
上下文: http, server, location, if in location
```

值|描述
--|--
epoch|指定"Expires"的值为 1 January,1970,00:00:01 GMT,即禁用缓存
max|指定"Expires"的值为31 December2037 23:59:59GMT,即永久缓存
off|不修改"Expires"和"Cache-Control"的值

### add_header(添加响应头,ngx_http_headers_module)

```
语法: add_header name value [always]
默认值: —
上下文: http, server, location, if in location
```

1).always表示不管响应如何都添加该响应头。

## 八.防盗链

```
valid_referers none blocked server_names;

if ($invalid_referer) { 
  rewrite ^/ http://********.com/ redirect; 
} 
```

### valid_referers(匹配规则,ngx_http_referer_module)

```
语法: valid_referers none | blocked | server_names | string ...
默认值: —
上下文: server, location
```

参数|描述
--|--
none|没有referer字段，$invalid_referer返回0
blocked|有referer但是被防火墙或者是代理给去除了,$invalid_referer返回0
server_names|referer等于本域名，$invalid_referer返回0
string|正在表达式用来匹配referer，匹配成功$invalid_referer返回0