# Varnish

**一.程序结构**

>Management进程主要实现应用新的配置、编译VCL、监控Varnish、初始化Varnish以及提供一个命令行接口等。Management进程会每隔几秒钟探测一下Child进程以判断其是否正常运行，如果在指定的时长内未得到Child进程的回应，Management将会重启此Child进程。


>Child进程包含多种类型的线程,Acceptor线程：接收新的连接请求并响应；Worker线程：Child进程会为每个会话启动一个Worker线程，此Worker线程真正来管理缓存，构建响应报文，因此，在高并发的场景中可能会出现数百个Worker线程甚至更多；Expiry线程：从缓存中清理过期内容；

<br>

**二.varnish的缓存存储机制**

>file：自管理的文件系统，使用特定的一个文件存储全部的缓存数据，并通过操作系统的mmap()系统调用将整个缓存文件映射至内存区域(如果内存大小条件允许)；varnish重启时，所有缓存对象都将被清除


>malloc：使用malloc()库调用在varnish启动时向操作系统申请指定大小的内存空间以存储缓存对象；varnish重启时，所有缓存对象都将被清除

<br>

**三.处理流程(VCL状态引擎)**

```
#如果请求报文无法理解
用户请求–>vcl_recv–>vcl_hash–>vcl_pipe–>交给后端服务器->响应给用户
```

```
#如果缓存命中
用户请求–>vcl_recv–>vcl_hash–>vcl_hit–>vcl_deliver–>响应给用户
```

```
#如果缓存未命中
用户请求–>vcl_recv–>vcl_hash–>vcl_miss–>vcl_backend_fetch–>后端服务器–>vcl_backend_response–>vcl_deliver–>响应给用户
用户请求–>vcl_recv–>vcl_hash–>vcl_miss–>vcl_pass–>vcl_backend_fetch–>后端服务器–>vcl_backend_response–>vcl_deliver–>响应给用户
```

```
#如果不能从缓存中进行响应
用户请求–>vcl_recv–>vcl_hash–>vcl_pass–>vcl_backend_fetch–>后端服务器–>vcl_backend_response–>vcl_deliver–>响应给用户
```

```
#如果进行对缓存进行删除
用户请求–>vcl_recv–>vcl_hash–>vcl_purge–>vcl_synth–>返回给用户
```

>vcl_recv：接受用户请求进varnish的入口的引擎，接受到结果之后，利用return(lookup)，将请求转交给vcl_hash引擎进行处理


>vcl_hash：接受到用户请求后，对用户请求的URL进行hash计算，根据请求的首部信息，以及hash结果进行下一步处理的引擎


>vcl_hit：经过vcl_hash引擎处理后，发现用户请求的资源本地有缓存，则vcl_hash引擎通过return(hit)将请求交给vcl_hit引擎进行处理，vcl_hit引擎处理后将请求交给vcl_deliver引擎，vcl_deliver引擎构建响应报文，响应给用户


>vcl_miss：经过vcl_hash引擎处理后，发现用户请求的资源本地没有缓存，则vcl_hash引擎通过return(miss)将请求交给vcl_miss引擎进行处理


>vcl_purge：经过vcl_hash引擎处理后，发现请求是对缓存的内容进行删除时，则通过return(purge)交给vcl_purge引擎进行处理，vcl_purge引擎处理后，利用vcl_synth引擎将处理的结果告知给用户


>vcl_pipe：经过vcl_hash引擎处理后，发现用户请求的报文varnish无法理解，则通过return(pipe)，将请求交给vcl_pipe引擎，pipe引擎直接将请求交给后端真实服务器


>vcl_pass：当请求经过vcl_hash处理后，发现请求报文不让从缓存中进行响应或其他原因没办法查询缓存，则由return(pass)或return(hit-for-pass)交由vcl_pass引擎进行处理


>vcl_backend_fetch：当发现缓存未命中或由vcl_pass传递过来的某些不能查询缓存的请求，交由vcl_backend_fetch引擎处理，vcl_backend_fetch引擎会向后端真实web服务器发送请求报文，请求对应的资源


>vcl_backend_response：当后端发送响应报文到varnish后，会由vcl_backend_resonse引擎进行处理，如：判断响应的内容是否可缓存，如果能缓存，则缓存下来后，交给vcl_deliver引擎，如果不能缓存，则直接交给vcl_deliver引擎，vcl_deliver引擎构建响应报文给客户端

<br>

**四.VCL语法**

>VCL(Varnish Configuration Language)是varnish配置缓存策略的工具，它是一种基于“域”(类似钩子函数)的简单编程语言，它支持有限的算术运算和逻辑运算操作、允许使用正则表达式进行字符串匹配、允许用户使用set自定义变量、支持if判断语句，也有内置的函数和变量。

```
基本语法:

<1>//、#或/ comment /用于单行或多行注释

<2>sub $NAME 定义函数，子例程

<2>不支持循环，支持条件判断，有内置变量

<3>使用终止语句return(XXX)，没有返回值，仅仅是标明下一步交给哪个状态引擎

<4>域专用，语句用{ }括起来，用sub声明，指明为哪一段的专用代码，如：sub vcl_recv{…}，可理解为一个配置段

<5>每个语句必须以;分号结尾

<6>操作符：=(赋值)、==(等值比较)、~(模式匹配)、!(取反)、&&(逻辑与)、||(逻辑或)、>(大于)、>=(大于等于)、<(小于)、<=(小于等于)
```

```
内置函数

regsub(str,regex,sub):用于基于正则表达式搜索指定的字符串并将其替换为指定的字符串,只替换一次
regsuball(str,regex,sub)：用于基于正则表达式搜索指定的字符串并将其替换为指定的字符串,替换所有
return(pipe)：当某VCL域运行结束时将控制权返回给Varnish，并指示Varnish如何进行后续的动作
```

```
内置变量

#req.* : 由客户端发来的http请求相关的变量（vcl_recv）
req.method --> 表示客户端的请求方法
req.url --> 表示客户端请求的url
req.http.host --> 表示客户端请求报文的主机
req.http.* --> 代表引用http的某个请求首部

#berequ.* : varnish主机在向后端真实服务器发送http请求报文时的相关变量（vcl_backend_fetch）
bereq.http.* --> 代表varnish发往后端的真实的web服务器的相关的请求报文中的首部
bereq.method --> 表示varnish发往后端真实web服务器的请求报文的请求方法
bereq.ur --> 表示varnish发往后端真实web服务器的请求报文的请求的url
bereq.proto --> 表示varnish发往后端真实web服务器的请求报文的http协议的协议版本
bereq.backend --> 表示要varnish发送请求到后端真实web服务器时，后端服务器不止一台时，所调用的后端主机

#beresp.* : 由后端真实服务器发来的http响应报文中的某些首部信息相关的变量 (vcl_backend_response)
beresp.http.* --> 表示后端真实web服务器发给varnish的http响应报文的某个首部的信息
beresp.proto --> 表示后端真实web服务器发给varnish的http响应报文的http协议版本
beresp.status --> 表示后端真实web服务器发给varnish的http响应报文的响应状态码
beresp.backend.name --> 表示后端真实web服务器发给varnish的http响应报文的后端主机的名称
beresp.ttl --> 后端服务器响应中的内容的余下的生存时长

#resp.* : 由varnish响应给客户端的响应报文相关的变量 (vcl_deliver,vcl_synth)
resp.http.* --> 表示varnish发送给客户端的响应报文的某个首部的信息
resp.proto --> 表示varnish发送给客户端的http响应报文的http协议版本
resp.status --> 表示varnish发送给客户端的http响应报文的响应状态码

#obj.* : 对存储在缓存空间中的缓存对象属性的引用变量。obj开头的变量都是只读的 (vcl_hit)
obj.hits --> 某个缓存对象的缓存的命中次数
obj.ttl --> 此对象的ttl值，也就是其缓存时长

#client.，server.：可用在所有阶段使用
client.ip --> 代表客户端的IP地址
server.ip --> 代表当前varnish的IP地址
client.port --> 代表客户端的端口
server.port --> 代表当前varnish的端口
```

<br>

**五.配置文件**

>主配置文件:配置varnish服务进程的工作特性,其对应的程序自身配置文件在/etc/default/varnish

```
#加载的缓存策略的配置文件路径
VARNISH_VCL_CONF=/etc/varnish/default.vcl
#varnish监听的端口
VARNISH_LISTEN_PORT=6081
#varnish管理接口监听的地址
VARNISH_ADMIN_LISTEN_ADDRESS=127.0.0.1
#varnish管理接口监听的端口
VARNISH_ADMIN_LISTEN_PORT=6082
#varnish管理时的秘钥文件
VARNISH_SECRET_FILE=/etc/varnish/secret
#varnish缓存时，本处是指使用file文件方式,总共使用1G大小的空间
VARNISH_STORAGE="file,/var/lib/varnish/varnish_storage.bin,1G"
#如果后端服务器没有指明缓存内容的TTL时间，则varnish自身为缓存定义的TTL时间
VARNISH_TTL=120
#配置参数生效
DAEMON_OPTS="-a ${VARNISH_LISTEN_ADDRESS}:${VARNISH_LISTEN_PORT} \
             -f ${VARNISH_VCL_CONF} \
             -T ${VARNISH_ADMIN_LISTEN_ADDRESS}:${VARNISH_ADMIN_LISTEN_PORT} \
             -t ${VARNISH_TTL} \
             -S ${VARNISH_SECRET_FILE} \
             -s ${VARNISH_STORAGE}"
```

>vcl配置文件:配置各Child/Cache线程的工作属性,其对应的程序自身配置文件在/etc/varnish/default.vcl

```
#定义健康状态检测方法
probe healthcheck{
    #检测时请求的URL，默认为”/"
    .url ="/";
    #检测频度
    .interval=60s;
    #超时时长
    .timeout=0.3s;
    #期望的响应码，默认为200
    .expected_response=200;
    #基于最近的多少次检查来判断其健康状态
    .window=8;
    #最近.window中定义的这么次检查中至有.threshhold定义的次数是成功的
    .threshhold=3;
}

backend server1 {
    .host = "192.168.10.2";
    .port = "80";
    .probe=heathcheck;
}

backend server2 {
    .host = "192.168.10.3";
    .port = "80";
    .probe=heathcheck;
}

sub vcl_recv {
    #当请求类型为Purge,用于清除缓存
    if(req.method=='PURGE'){
        return(purge);
    }
}
#清除缓存,200为状态码,Purged为相应信息
sub vcl_purge{
    return(synth(200,"Purged"));
}

sub vcl_backend_response {

}

sub vcl_deliver {

}
```

<br>

**六.管理**

```
varnishadm -S /etc/varnishadm/sercet -T localhost:6802

>help 帮助命令
>quit 退出命令
>status 当前varnish的工作状态
>start 启动varnish
>stop 停止varnish
>vcl.load name1 default.vcl 加载vcl文件(默认在/etc/varnish目录下)，并取名为name1
>vcl.use name1 启用name1配置
>vcl.discard name1 删除load中的name1
>vcl.list 列出load中的配置文件
>vcl.show name1 查看name1配置文件内容
>param.show 查看varnish配置参数(-l 详细信息)
>param.set param value 设置varnish配置参数
>backend.list 查看后端服务器列表(-v 详细内容)
```