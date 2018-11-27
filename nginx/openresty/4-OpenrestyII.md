# Lua调用Nginx接口(lua-nginx-module)


## 一.基本操作

### ngx.arg

>nginx的变量作为参数传入lua

```
语法：val = ngx.arg[index]
上下文：set_by_lua*, body_filter_by_lua*
```

```lua
location /foo {
    set $a 32;
    set $b 56;
    set_by_lua $sum
        'return tonumber(ngx.arg[1]) + tonumber(ngx.arg[2])' $a $b; 
    echo $sum;
}
```

### ngx.var.VARIABLE

>读写nginx的变量

```
语法：ngx.var.VARIABLE
上下文：set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua*
```

```lua
location /foo {
    set $my_var '';
    content_by_lua '
        ngx.var.my_var = 123;
    ';
}
```

### ngx.ctx

>ngx.ctx可以看成一个临时Table，作用域是每一个请求，也就是说不同的request是不同的ngx.ctx

```
语法：ngx.ctx.VARNAME
上下文：set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua
```

```lua
location /sub {
    content_by_lua '
        ngx.say("sub pre: ", ngx.ctx.blah)
        ngx.ctx.blah = 32
        ngx.say("sub post: ", ngx.ctx.blah)
    ';
}
 
location /main {
    content_by_lua '
        ngx.ctx.blah = 73
        ngx.say("main pre: ", ngx.ctx.blah)
        local res = ngx.location.capture("/sub")
        ngx.print(res.body)
        ngx.say("main post: ", ngx.ctx.blah)
    ';
}

--[[
    main pre: 73
    sub pre: nil
    sub post: 32
    main post: 73
]]
```

### ngx.location.capture

>访问本server的其他location

```
语法：res = ngx.location.capture(uri, options?)
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*
```

选项|描述
--|--
method|设置访问的method类型(ngx.HTTP_GET，ngx.HTTP_HEAD，ngx.HTTP_PUT，ngx.HTTP_POST，ngx.HTTP_DELETE)
args|设置请求的参数
cxt|设置传入Table
vars|这个参数用来在父请求中设置nginx的变量值并向子请求传递
copy_all_vars|拷贝父请求的nginx的变量给子请求
share_all_vars|同享父请求和子请求的nginx的变量

```lua
-- 返回对象属性有res.status，res.body，res.header
res = ngx.location.capture("/foo")

-- 等价于ngx.location.capture('/foo?a=1&b=2')
ngx.location.capture('/foo',
    { args = { a = 1,b = 2 }, method= ngx.HTTP_GET }
)

-- 输出 bar nil
location /sub {
    content_by_lua '
        ngx.ctx.foo = "bar";
    ';
}
location /lua {
    content_by_lua '
        local ctx = {}
        res = ngx.location.capture("/sub", { ctx = ctx })
        ngx.say(ctx.foo);
        ngx.say(ngx.ctx.foo);
    ';
}

-- 输出 dog = hello  cat = 32
location /other {
    content_by_lua '
        ngx.say("dog = ", ngx.var.dog)
        ngx.say("cat = ", ngx.var.cat)
    ';
}
location /lua {
    set $dog '';
    set $cat '';
    content_by_lua '
        res = ngx.location.capture("/other",
            { vars = { dog = "hello", cat = 32 }});
        ngx.print(res.body)
    ';
}

-- 输出 [hello world]  [hello]
location /other {
    set $dog "$dog world";
    echo "[$dog]";
}
location /lua {
    set $dog 'hello';
    content_by_lua '
        res = ngx.location.capture("/other",
            { copy_all_vars = true });
        ngx.print(res.body)
        ngx.say("[",ngx.var.dog,"]")
    ';
}

-- 输出 [hello world]  [hello world]
location /other {
    set $dog "$dog world";
    echo "[$dog]";
}
location /lua {
    set $dog 'hello';
    content_by_lua '
        res = ngx.location.capture("/other",
            { share_all_vars = true });
        ngx.print(res.body)
        ngx.say("[",ngx.var.dog,"]")
    ';
}
```

### ngx.exec

>执行内部跳转根据url和请求参数

```
语法：ngx.exec(uri, args?)
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*
```

```lua
location /foo {
    content_by_lua '
        ngx.exec("@bar", "a=goodbye");
    ';
}
 
location @bar {
    content_by_lua '
        local args = ngx.req.get_uri_args()
        for key, val in pairs(args) do
            if key == "a" then
                ngx.say(val)
            end
        end
    ';
}
```

### ngx.print(ngx.say)

>发送数据给客户端响应页面

```
语法：ok, err = ngx.print(...)
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*
```

```lua
local table = {
    "hello, ",
    {"world: ", true, " or ", false,{": ", nil}}
    }
ngx.print(table)
```

### ngx.exit

>终止向下执行

```
语法：ngx.exit(status)
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*
```

```lua
ngx.say("This is our own content")
ngx.exit(ngx.HTTP_OK)
ngx.say("This is our own content")
```

1).当status>=200的时候，直接停止当前请求的后续操作，并且返回状态码。当status==0的时候，跳过此次代码片段，并且继续执行下面的。<br>
2).ngx.eof()：关闭结束输出流。

## 二.请求操作

### ngx.header.HEADER

>获取或者设置HTTP头信息

```
语法：ngx.header.HEADER = VALUE
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua
```

```lua
ngx.header.content_type = 'text/plain';
ngx.header["X-My-Header"] = 'blah blah';
ngx.header['Set-Cookie'] = {'a=32; path=/', 'b=4; path=/'}
```

1).ngx.req.get_headers()：获取当前请求的头信息。

### ngx.req.get_method

>获得当前请求的method

```
语法：method_name = ngx.req.get_method()
上下文：set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*
```

### ngx.req.get_uri_args

>获得get请求的参数

```
语法：args = ngx.req.get_uri_args(max_args?)
上下文：set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua
```

```lua
location = /test {
    content_by_lua '
        local args = ngx.req.get_uri_args()
        for key, val in pairs(args) do
            if type(val) == "table" then
                ngx.say(key, ": ", table.concat(val, ", "))
            else
                ngx.say(key, ": ", val)
            end
        end
    ';
}
```

1).ngx.req.get_post_args()：得到post提交的参数，注意首先调用ngx.req.read_body()。

## 三.响应操作

### ngx.status

>读取或者设置状态码

```
上下文：set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua
```

状态码|描述
--|--
ngx.HTTP_OK|200状态码
ngx.HTTP_CREATED|201状态码
ngx.HTTP_SPECIAL_RESPONSE|300状态码
ngx.HTTP_MOVED_PERMANENTLY|301状态码
ngx.HTTP_MOVED_TEMPORARILY|302状态码
ngx.HTTP_NOT_MODIFIED|304状态码
ngx.HTTP_BAD_REQUEST|400状态码
ngx.HTTP_UNAUTHORIZED|401状态码
ngx.HTTP_FORBIDDEN|403状态码
ngx.HTTP_NOT_FOUND|404状态码
ngx.HTTP_NOT_ALLOWED|405状态码
ngx.HTTP_INTERNAL_SERVER_ERROR|500状态码
ngx.HTTP_METHOD_NOT_IMPLEMENTED|501状态码
ngx.HTTP_SERVICE_UNAVAILABLE|503状态码

### ngx.header.HEADER

>获取或者设置HTTP头信息

```
语法：ngx.header.HEADER = VALUE
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua
```

```lua
ngx.header.content_type = 'text/plain';
ngx.header["X-My-Header"] = 'blah blah';
ngx.header['Set-Cookie'] = {'a=32; path=/', 'b=4; path=/'}
```

1).ngx.resp.get_headers()：得到所有的响应头信息，以Table的形式返回。

### ngx.redirect

>执行301或者302的重定向

```
语法：ngx.redirect(uri, status?)
上下文：rewrite_by_lua*, access_by_lua*, content_by_lua*
```

## 四.日志操作

### print

>等同于ngx.log(ngx.NOTICE,...)

```
语法：print(...)
上下文：init_by_lua*,  set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua
```

### ngx.log

>向error.log中记录日志

```
语法：ngx.log(log_level, ...)
上下文：init_by_lua*, set_by_lua*, rewrite_by_lua*, access_by_lua*, content_by_lua*, header_filter_by_lua*, body_filter_by_lua*
```

1).日志等级：ngx.STDERR，ngx.EMERG，ngx.ALERT，ngx.CRIT，ngx.ERR，ngx.WARN，ngx.NOTICE，ngx.INFO，ngx.DEBUG