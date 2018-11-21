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

### rewrite(定义重写)

```
语法: rewrite regex replacement [flag]
默认: —
上下文:	server, location, if
```

flag类型|描述
--|--
last|本条规则匹配完成后，可以继续匹配后面的规则，浏览器地址栏URL地址不变
break|本条规则匹配完成后，不再匹配后面的规则，浏览器地址栏URL地址不变
redirect|返回302临时重定向，浏览器地址会显示跳转后的URL地址
permanent|返回301永久重定向，浏览器地址栏会显示跳转后的URL地址

### if(条件语句)

```
语法: if (condition) { ... }
默认: —
上下文:	server, location
```

1).当表达式只是一个变量时，如果值为空或0都会当做false<br>
2).直接比较变量和内容时，使用=或!=<br>
3).~正则表达式匹配，~*不区分大小写的匹配，!~区分大小写的不匹配<br>
4).-f和!-f用来判断是否存在文件；-d和!-d用来判断是否存在目录；-e和!-e用来判断是否存在文件或目录；-x和!-x用来判断文件是否可执行

全局变量|描述
--|--
$args|这个变量等于请求行中的参数
$content_length|请求头中的Content-length字段
$content_type|请求头中的Content-Type字段
$document_root|当前请求中root指令中指定的值
$host|请求主机头字段，否则为服务器名称
$http_user_agent|客户端agent信息
$http_cookie|客户端cookie信息
$limit_rate|这个变量可以限制连接速率
$request_method|客户端请求的动作，通常为GET或POST
$remote_addr|客户端的IP地址
$remote_port|客户端的端口
$remote_user|已经经过Auth Basic Module验证的用户名
$request_filename|当前请求的文件路径，由root或alias指令与URI请求生成
$scheme|HTTP方法（如http，https）
$server_protocol|请求使用的协议，通常是HTTP/1.0或HTTP/1.1
$server_addr|服务器地址，在完成一次系统调用后可以确定这个值
$server_name|服务器名称
$server_port|请求到达服务器的端口号
$request_uri|包含请求参数的原始URI，不包含主机名，如：”/foo/bar.php?arg=baz”
$uri|不带请求参数的当前URI，$uri不包含主机名，如”/foo/bar.html”
$document_uri|与$uri相同


### return(直接返回)

```
语法: return code [text];
      return code URL;
      return URL;
默认: —
上下文: server, location, if
```

1).支持的http状态码:200, 204, 400, 402-406, 408, 410, 411, 413, 416 , 500-504，还有非标准的444状态码<br>
2).当返回URL是，以302定向跳转