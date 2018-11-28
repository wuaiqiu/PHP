# NginxEcho模块


### echo(带换行符输出字符,echo-nginx-module)

```
语法: echo [options] <string>...
默认值: no
上下文: location, location if
```

1).选项-n:去除换行符。

### echo_flush(刷新输出缓冲区,echo-nginx-module)

```
语法: echo_flush
默认值: no
上下文: location, location if
```

### echo_sleep(暂停n秒,echo-nginx-module)

```
语法: echo_sleep <seconds>
默认值: no
上下文: location, location if
```

### echo_exec(内部跳转,echo-nginx-module)

```
语法: echo_exec <location> [<query_string>]
      echo_exec <named_location>
默认值: no
上下文: location, location if
```

### echo_location (同步发起GET子请求,echo-nginx-module)

```
语法: echo_location <location> [<url_args>]
默认值: no
上下文: location, location if
```

```lua
location /main {
    echo_location /foo;
    echo_location /bar;
}

location /foo {
     echo foo;
}

location /bar {
    echo bar;
}


--[[
    curl 'http://localhost:8080/main'
    foo
    bar 
]]
```

1).echo_location_async:异步发起GET子请求。

### echo_reset_timer(重置时间,echo-nginx-module)

```
语法: echo_reset_timer
默认值: no
上下文: location, location if
```

```lua
echo_reset_timer;
echo_sleep 0.02;
--  0.020 sec elapsed.
echo "$echo_timer_elapsed sec elapsed.";
```

### echo_before_body(页面头输出,echo-nginx-module)

```
语法: echo_before_body [options] [argument]...
默认值: no
上下文: location, location if
```

1).echo_after_body:页面尾输出。<br>
2).选项-n:去除换行符。