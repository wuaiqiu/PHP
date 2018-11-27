# Nginx调用Lua模块指令(lua-nginx-module)


## 一.执行周期

### init_by_lua（_file）

>这个指令就是初始化一些lua的全局变量，以便后续的代码使用

```
语法：init_by_lua <lua-style-str>
上下文：http
```

```lua
init_by_lua 'cjson = require "cjson"';
server {
    location = /api {
        content_by_lua '
            ngx.say(cjson.encode({dog = 5, cat = 6}))
        ';
    }
}
```

### set_by_lua（_file）

>这个指令是为了能够让nginx的变量与lua的变量相互作用赋值

```
语法：set_by_lua $res <lua-script-str> [$arg1 $arg2 ...]
上下文：server、location、location if
```

```lua
location /foo {
    set $diff '';
    set_by_lua $sum '
        local a = 32
        local b = 56
        ngx.var.diff = a - b;
        return a + b;
    ';
     echo "sum = $sum, diff = $diff";
}
```

### rewrite_by_lua（_file）

>这个指令更多的是为了替代HttpRewriteModule的rewrite指令来使用的，优先级低于rewrite指令

```
语法：rewrite_by_lua <lua-script-str>
上下文：location、location if
```

```lua
location /foo {
    set $a 12;
    set $b '';
    rewrite_by_lua '
        ngx.var.b = tonumber(ngx.var.a) + 1
        if tonumber(ngx.var.b) == 13 then
            return ngx.redirect("/bar");
        end
    ';
     echo "res = $b";
}
```

### access_by_lua（_file）

>这个指令用在验证通过或者需要验证的时候

```
语法：access_by_lua <lua-script-str>
上下文：http, server, location, location if
```

```lua
location / {
    deny    192.168.1.1;
    allow   192.168.1.0/24;
    allow   10.1.1.0/16;
    deny    all;
    access_by_lua '
        local res = ngx.location.capture("/mysql", { ... })
        ...
    ';
}
```

### content_by_lua（_file）

>通过这个指令，可以由lua直接确定nginx响应页面的正文

```
语法：content_by_lua <lua-script-str>
上下文：location、location if
```

```lua
location /nginx_var {
    default_type 'text/plain';
    content_by_lua "ngx.print(ngx.var['arg_a'], '\\n')";
}
```

## 二.其它指令

### lua_code_cache

>这个指令是指定是否开启lua的代码编译缓存，开发时可以设置为off，以便lua文件实时生效，如果是生产线上，为了性能，建议开启

```
语法：lua_code_cache on | off
默认值：lua_code_cache on
上下文：http、server、location、location if
```

### lua_package_path

>设置lua代码的寻找目录(';;' 是默认路径)

```
语法：lua_package_path <lua-style-path-str>
默认值：由lua的环境变量决定
上下文：http
```

```lua
lua_package_path "/opt/nginx/conf/www/?.lua;;"
```

### header_filter_by_lua（_file）

>用lua的代码去指定http响应的header一些内容

```
语法：header_filter_by_lua <lua-script-str>
上下文：http, server, location, location if
```

```lua
location / {
    proxy_pass http://mybackend;
    header_filter_by_lua 'ngx.header.Foo = "blah"';
}
```

### body_filter_by_lua（_file）

>这个指令可以用来篡改http的响应正文的

```
语法：body_filter_by_lua <lua-script-str>
上下文：http, server, location, location if
```

```lua
location /t {
    echo hello world;
    echo hiya globe;
    body_filter_by_lua '
        local chunk = ngx.arg[1]
        if string.match(chunk, "hello") 
        then
            ngx.arg[2] = true 
            return
        end
         ngx.arg[1] = nil
    ';
}
```