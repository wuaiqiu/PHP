# Nginx虚拟主机


```
server { 
    listen  80; 
    server_name  localhost; 

    location / { 
        root  /usr/share/nginx/html;
        index  index.html index.htm; 
    } 
}
```

### server(虚拟主机配置,ngx_http_core_module)

```
语法: server { ... }
默认值:	—
上下文:	http
```

### listen(监听socket,ngx_http_core_module)

```
语法: listen address[:port] 
      listen port
      listen unix:sockpath
默认值: listen  80
上下文:	server
```

### server_name(主机名,ngx_http_core_module)

```
语法: server_name name ...
默认值: server_name localhost
上下文:	server
```

1).可以匹配多个，例如: server_name www.baidu.com baidu.com<br>
2).可以使用"*"通配符，例如: server_name *.baidu.com<br>
3).可以使用正则表达式，前面需要加"~"，例如: server_name ~(wwww\.)?baidu\.com<br>
4).匹配顺序:准确名 > 最长前缀通配符 > 最长后缀通配符 > 第一个正则表达式

### location(定位匹配,ngx_http_core_module)

```
语法: location [ = | ~ | ~* | ^~ ] uri { ... }
默认值:	—
上下文:	server, location
```

1).=:表示精确匹配<br>
2).~:表示区分大小写的正则匹配<br>
3).~*:表示不区分大小写的正则匹配<br>
4).^~:表示uri以某个常规字符串开头<br>
5)./:通用匹配，任何请求都会匹配到<br>
6).匹配顺序: =精确匹配 > ^~开头匹配 > ~第一个正则表达式 > /通用匹配

```
location = / {  
   #规则A  
}  
location = /login {  
   #规则B  
}  
location ^~ /static/ {  
   #规则C  
}  
location ~ \.(gif|jpg|png|js|css)$ {  
   #规则D  
}  
location ~* \.png$ {  
   #规则E  
}  
location / {  
   #规则F
}  
```

链接|访问规则
--|--
http://localhost|规则A
http://localhost/login|规则B
http://localhost/register|规则F
http://localhost/static/a.gif|规则C
http://localhost/a.gif|规则D
http://localhost/a.PNG|规则E


### root(网站根目录,ngx_http_core_module)

```
语法: root path
默认值:	root /usr/share/nginx
上下文:	http, server, location, if in location
```

### alias(网站根目录别名,ngx_http_core_module)

```
语法: alias path
默认值: —
上下文: location
```

<br>

```
location /request {
    root /local_path;
}
location /request {
    alias /local_path;
}

http://localhost/request/index.html
root=>http://localhost/local_path/request/index.html
alias=>http://localhost/local_path/index.html
```

### index(内部跳转,ngx_http_index_module)

```
语法: index file ...
默认值:	index index.html index.htm
上下文:	http, server, location
```

1).只会作用于那些URI以/结尾的请求。<br>
2).依次寻找index.htm和index.html这两个文件。如果index.htm文件存在，则直接发起"内部跳转"到/index.htm这个新的地址。若不存在继续匹配下一个。

```lua
location / {
    root /var/www/;
    index index.html;
}

location /index.html {
    set $a 32;
    echo "a = $a";
}


--[[
    curl 'http://localhost:8080/'
    a = 32
]]
```

### try_files(按顺序检查文件是否存在,ngx_http_core_module)

```
语法: try_files file ... uri
默认值: —
上下文: server, location
```

### autoindex(目录列表展示,ngx_http_autoindex_module)

```
语法: autoindex on | off
默认值:	autoindex off
上下文:	http, server, location
```

1).只会作用于那些URI以/结尾的请求。

### autoindex_exact_size(显示文件大小,ngx_http_autoindex_module)

```
语法: autoindex_exact_size on | off
默认值: autoindex_exact_size on
上下文:	http, server, location
```

### autoindex_localtime(显示文件时间,ngx_http_autoindex_module)

```
语法: autoindex_localtime on | off
默认值:	autoindex_localtime off
上下文:	http, server, location
```