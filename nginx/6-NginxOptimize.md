# Nginx优化


## 一.gzip

### gzip(开启gzip)

```
语法: gzip on | off;
默认值: gzip off;
上下文:	http, server, location, if in location
```

### gzip_buffer(压缩缓冲区大小)

```
语法: gzip_buffers number size;
默认值: gzip_buffers 32 4k|16 8k;
上下文:	http, server, location
```

### gzip_comp_level(压缩等级)

```
语法: gzip_comp_level level;
默认值:	gzip_comp_level 1;
上下文:	http, server, location
```

### gzip_disable(排除压缩文件)

```
语法: gzip_disable regex ...;
默认值:	—
上下文:	http, server, location
```

### gzip_min_length(需进行压缩的最小字节大小)

```
语法: gzip_min_length length;
默认值:	gzip_min_length 20;
上下文:	http, server, location
```

### gzip_http_version(设置压缩的http版本)

```
语法: gzip_http_version 1.0 | 1.1;
默认值: gzip_http_version 1.1;
上下文:	http, server, location
```

### gzip_types(设置需要压缩的文件类型)

```
语法: gzip_types mime-type ...;
默认值:	gzip_types text/html;
上下文:	http, server, location
```

### gzip_vary(是否传输gzip压缩标志)

```
语法: gzip_vary on | off;
默认值:	gzip_vary off;
上下文:	http, server, location
```

>注意:对于图片,视频等二进制文件不必压缩，因为作用不大，反而消耗CPU。

## 二.expires过期缓存

```
语法: expires [modified] time;
      expires epoch | max | off;
默认值: expires off;
上下文:	http, server, location, if in location
```

值|描述
--|--
epoch|指定“Expires”的值为 1 January,1970,00:00:01 GMT
max|指定“Expires”的值为31 December2037 23:59:59GMT,"Cache-Control"的值为10年
-1|指定“Expires”的值为当前服务器时间-1s，即永远过期。
off|不修改“Expires”和"Cache-Control"的值