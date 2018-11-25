# Nginx重写


```
server {
    #访问 /last.html 的时候，页面内容重写到 /index.html 中
    rewrite /last.html /index.html last;
    
    #访问 /break.html 的时候，页面内容重写到 /index.html 中，并停止后续的匹配
    rewrite /break.html /index.html break;
    
    #访问 /redirect.html 的时候，页面直接302定向到 /index.html中
    rewrite /redirect.html /index.html redirect;
    
    #访问 /permanent.html 的时候，页面直接301定向到 /index.html中
    rewrite /permanent.html /index.html permanent;
    
    #把 /html/*.html => /post/*.html ，301定向
    rewrite ^/html/(.+?).html$ /post/$1.html permanent;
    
    #把 /search/key => /search.html?keyword=key,301定向
    rewrite ^/search\/([^\/]+?)(\/|$) /search.html?keyword=$1 permanent;
}
```

### rewrite(定义重写,ngx_http_rewrite_module)

```
语法: rewrite regex replacement [flag]
默认: —
上下文: server, location, if
```

flag类型|描述
--|--
last|本条规则匹配完成后，可以继续匹配后面的规则，浏览器地址栏URL地址不变
break|本条规则匹配完成后，不再匹配后面的规则，浏览器地址栏URL地址不变
redirect|返回302临时重定向，浏览器地址会显示跳转后的URL地址
permanent|返回301永久重定向，浏览器地址栏会显示跳转后的URL地址

### if(条件语句,ngx_http_rewrite_module)

```
语法: if (condition) { ... }
默认: —
上下文:	server, location
```

1).当表达式只是一个变量时，如果值为空或0都会当做false<br>
2).直接比较变量和内容时，使用=或!=<br>
3).~正则表达式匹配，~*不区分大小写的匹配，!~区分大小写的不匹配<br>
4).-f和!-f用来判断是否存在文件；-d和!-d用来判断是否存在目录；-e和!-e用来判断是否存在文件或目录；-x和!-x用来判断文件是否可执行

### return(直接返回,ngx_http_rewrite_module)

```
语法: return code [text]
      return code URL
      return URL
默认: —
上下文: server, location, if
```

1).支持的http状态码:200, 204, 400, 402-406, 408, 410, 411, 413, 416 , 500-504，还有非标准的444状态码<br>
2).当返回URL是，以302定向跳转

### break(终止当前重写,ngx_http_rewrite_module)

```
语法: break
默认值: —
上下文: server, location, if
```

### set(设置变量,ngx_http_rewrite_module)

```
语法: set $variable value
默认值: —
上下文: server, location, if
```

### 客户端变量

内置全局变量|描述
--|--
$schema|请求所用的协议，例如http或https
$host|请求头中的Host字段
$content_length|请求头中的Content-length字段
$content_type|请求头中的Content-Type字段
$cookie_COOKIE|请求头中的cookie中COOKIE的值
$http_HEADER|请求头中的HEADER字段(HEADER转为小写，-变为_，例如：$http_user_agent)
$uri($document_uri)|请求中的当前URI(不带请求参数)
$request_uri|请求中的当前URI(带请求参数)
$args($query_string)|这个变量等于GET请求中的所有参数
$arg_PARAMETER|这个变量值为GET请求中变量名PARAMETER参数的值
$is_args|如果请求中有参数，值为"?"，否则为空字符串
$remote_addr|客户端的IP地址
$binary_remote_addr|客户端的IP地址(二进制)
$remote_port|客户端的端口
$remote_user|已经经过Auth Basic Module验证的用户名
$request_method|这个变量是客户端请求的动作，通常为GET或POST
$request_completion|如果请求成功为"OK"；否则为空
$request_filename|当前连接请求的文件路径，由root或alias指令与URI请求生成

### 服务端变量

内置全局变量|描述
--|--
$nginx_version|当前运行的nginx版本号
$document_root|当前请求在root指令中指定的值
$body_bytes_sent|响应体的字节数
$sent_http_HEADER|响应头中的HEADER字段(HEADER转为小写，-变为_，例如：$sent_http_cache_control)
$server_addr|服务器地址
$server_name|服务器名称
$server_port|请求到达服务器的端口号
$server_protocol|请求使用的协议，通常是HTTP/1.0或HTTP/1.1