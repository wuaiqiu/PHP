# 虚拟主机


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

### server(虚拟主机配置)

```
语法: server { ... }
默认值:	—
上下文:	http
```

### listen(监听socket)

```
语法: listen address[:port] 
      listen port
      listen unix:sockpath
默认值: listen  80
上下文:	server
```

### server_name(主机名)

```
语法: server_name name ...
默认值: server_name localhost
上下文:	server
```

1).可以匹配多个，例如: server_name www.baidu.com baidu.com<br>
2).可以使用"*"通配符，例如: server_name *.baidu.com<br>
3).可以使用正则表达式，前面需要加"~"，例如: server_name ~(wwww\.)?baidu\.com<br>
4).匹配顺序:准确名 > 最长前缀通配符 > 最长后缀通配符 > 第一个正则表达式

### location(定位匹配)

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


### root(网站根目录)

```
语法: root path
默认值:	root /usr/share/nginx
上下文:	http, server, location, if in location
```

### index(网站主索引)

```
语法: index file ...
默认值:	index index.html
上下文:	http, server, location
```

### autoindex(目录列表展示)

```
语法: autoindex on | off
默认值:	autoindex off
上下文:	http, server, location
```

### autoindex_exact_size(显示文件大小)

```
语法: autoindex_exact_size on | off
默认值: autoindex_exact_size on
上下文:	http, server, location
```

### autoindex_localtime(显示文件时间)

```
语法: autoindex_localtime on | off
默认值:	autoindex_localtime off
上下文:	http, server, location
```