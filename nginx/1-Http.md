# HTTP协议


## 一.HTTP消息结构


```
请求行\r\n(请求方法 路径 协议版本)
请求头\r\n(格式为 key: value)
空行
请求体(可选，发送内容)

GET /hello.txt HTTP/1.1
User-Agent: curl/7.16.3 libcurl/7.16.3 OpenSSL/0.9.7l zlib/1.2.3
Host: www.example.com
```

```
响应行\r\n(协议版本 状态码 状态文字)
响应头\r\n(格式为 key: value)
空行
响应体(可选，响应内容)

HTTP/1.1 200 OK
Date: Mon, 27 Jul 2009 12:28:53 GMT
Server: Apache
Last-Modified: Wed, 22 Jul 2009 19:15:56 GMT
```

<br>

## 二.请求方法

方法|描述
--|--
GET|获取一个URL指定的资源
HEAD|获取一个URL指定的资源信息，不包含响应体
POST|向服务器提交数据。数据在请求体中
PUT|向服务器提交最新数据。数据在请求体中(HTTP/1.1)
DELETE|请求服务器删除URL标识的资源(HTTP/1.1)
CONNECT|预留给能够将连接改为管道方式的代理服务器(HTTP/1.1)
OPTIONS|查询服务器支持的方法(HTTP/1.1)
TRACE|回显服务器收到的请求，主要用于测试或诊断(HTTP/1.1)

<br>

## 三.协议版本


HTTP/0.9:第一个版本的HTTP协议，已过时。它的组成极其简单，只允许客户端发送GET这一种请求，且不包含请求头部(响应头部)。只支持纯文本传输。HTTP/0.9具有典型的无状态性，每个事务独立进行处理，事务结束时就释放这个连接。


HTTP/1.0:第二个版本的HTTP协议，它增加请求头部与响应头部，不只限于纯文本传输，支持GET、HEAD、POST方法，支持长连接(即在一次TCP连接中进行多次HTTP连接传输，但默认还是使用短连接,需要添加请求头 Connection: Keep-Alive)，支持缓存机制以及身份认证。


HTTP/1.1:第三个版本的HTTP协议，是目前使用最广泛的协议版本。默认使用长连接，支持chunked编码传输(将未知长度的实体进行分块传送并逐块标明长度,直到长度为0块表示传输结束,需要添加请求头 Transfer-Encoding: chunked)，支持字节范围请求(即传送内容的一部分。比方说，当客户端已经有内容的一部分，为了节省带宽，可以只向服务器请求一部分。该功能通过在请求消息中引入了Range头域来实现，它允许只请求资源的某个部分。在响应消息中Content-Range头域返回的这部分对象的偏移值和长度且响应码为206(Partial Content))，HTTP/1.1增加了OPTIONS, PUT, DELETE, TRACE, CONNECT方法。HTTP/1.1加入了E-tags头。


HTTP/2.0:第四个版本的HTTP协议，是下一代HTTP协议，目前应用还非常少。HTTP/2.0最大的特点是不改变上一代标准的语义而是致力于突破上一代标准的性能限制，改进传输性能，实现低延迟和高吞吐量。HTTP/2.0新增的二进制分帧层(即将所有传输的信息分割为更小的消息和帧，并对它们采用二进制格式的编码 ，其中头部信息会被封装到Headers帧，数据则封装到Data帧)，支持头部压缩，支持随时复位(HTTP/1.1终止一个数据传输需要断开TCP连接，而使用HTTP/2.0的RST_STREAM将能方便停止一个数据传输，而不需要断开TCP连接)，支持服务器端推流(即服务端可以主动向客户端推送一些关联数据，并让客户端缓存以备后需)，支持数据优先权和解决数据依赖关系。

<br>

## 四.请求头/响应头

### 通用类型

请求头|描述
--|--
Accept: text/plain|可接受的响应内容类型
Accept-Charset: utf-8|可接受的字符集
Accept-Encoding: gzip|可接受的响应内容的编码方式(chunked、compress、 deflate、gzip、identity)
Accept-Language: en-US|可接受的响应内容语言列表
Content-Type: application/x-www-form-urlencoded|请求体的MIME类型
Content-Length: 348|设置请求体的字节长度
Connection: keep-alive|客户端想要优先使用的连接类型
Host: www.baidu.com|表示服务器的域名以及服务器所监听的端口号
User-Agent: Mozilla|浏览器的身份标识字符串
Date: Dec, 26 Dec 2015 17:30:00 GMT|发送该消息的日期和时间
Cookie: $Version=1; Skin=new;|由之前服务器通过Set-Cookie设置的一个HTTP协议Cookie
Referer: http://baidu.com|表示浏览器所访问的前一个页面
Authorization: Basic OSdjJGRpbjpvcGVuIANlc2SdDE==|用于表示HTTP协议中需要认证资源的认证信息

<br>

响应头|描述
--|--
Allow: GET, HEAD|对于特定资源的有效动作
Content-Type: text/html; charset=utf-8|相应内容的MIME类型
Content-Encoding: gzip|响应资源所使用的编码类型
Content-Language: zh-cn|响应内容所使用的语言
Content-Length: 348|响应消息体的长度
Content-Disposition: attachment; filename="fname.ext"|对已知MIME类型资源的描述，浏览器可以根据这个响应头决定是对返回资源的动作
Transfer-Encoding: gzip|用表示实体传输给用户的编码形式(chunked、compress、 deflate、gzip、identity)
Date: Tue, 15 Nov 1994 08:12:31 GMT|此条消息被发送时的日期和时间
Location: http://www.baidu.com|	用于在进行重定向
Refresh: 5; url=http://baidu.com|用于重定向，默认会在5秒后刷新重定向
Server: nginx/1.6.3|服务器的名称
X-Powered-By: PHP/5.4.0|指定支持web应用的技术
Connection: keep-alive|服务端想要优先使用的连接类型
Set-Cookie: UserID=itbilu; Max-Age=3600; Version=1|设置HTTP cookie
Status: 200 OK|用来说明当前HTTP连接的响应状态
WWW-Authenticate: Basic|表示在请求获取这个实体时应当使用的认证模式

### 缓存类型

请求头|描述
--|--
Pragma: no-cache|"no-cache"指令表示禁用缓存，"pragma"指令表示使用缓存(HTTP/1.0)
Cache-Control: no-cache|"max-age"指令表示设置最大有效时间，"no-cache"指令表示禁用缓存，"no-store":指令表示绝对禁止缓存，"private"指令表示私有缓存，"public"指令表示共享缓存(HTTP/1.1)
If-Modified-Since: Dec, 26 Dec 2015 17:30:00 GMT|与Last-Modified对应，设置允许在对应的资源未被修改的情况下返回304(Not Modified)(HTTP/1.1)
If-None-Match: "9jd00cdj34pss9ejqiw39d82f20d0ikd"|与ETag对应，如果和服务端接受请求生成的ETage相同，允许服务端返回304(Not Modified)(HTTP/1.1)

<br>

响应头|描述
--|--
Pragma: no-cache|"no-cache"指令表示禁用缓存，"pragma"指令表示使用缓存(HTTP/1.0)
Expires: Thu, 01 Dec 1994 16:00:00 GMT|指定一个日期/时间，超过该时间则认为此回应已经过期(HTTP/1.0)
Cache-Control: no-cache|"max-age"指令表示设置最大有效时间，"no-cache"指令表示禁用缓存，"no-store":指令表示绝对禁止缓存，"private"指令表示私有缓存，"public"指令表示共享缓存(HTTP/1.1)
Last-Modified: Dec, 26 Dec 2015 17:30:00 GMT|所请求的对象的最后修改日期(HTTP/1.1)
ETag: "737060cd8c284d8af7ad3082f209582d"|对于某个资源的某个特定版本的一个标识符，通常是一个消息散列(HTTP/1.1)
Age: 12|响应对象在代理缓存中存在的时间，以秒为单位

<br>

1).强缓存:通过Pragma/Expires和Cache-Control来控制。Expires返回一个绝对时间,Cache-Control是相对时间。两者可同时启用，但Cache-Control的优先级更高。若命中强缓存，请求不会到达服务器，直接从缓存中获取。

2).协商缓存:通过Last-Modify/If-Modify-Since或ETag/If-None-Match来判断是否命中协商缓存。若命中，服务器则返回码为304，浏览器从缓存中加载资源。

3).强缓存的优先级大于协商缓存。

### 范围请求类型

请求头|描述
--|--
Range: bytes=500-999|表示请求某个实体的一部分，字节偏移以0开始

<br>

响应头|描述
--|--
Accept-Ranges: bytes|服务器表明自己是否接受获取其某个实体的一部分(bytes:接受，none:不接受)
Content-Range: bytes 500-999|如果是响应部分消息，表示属于完整消息的哪个部分

### 跨域类型

请求头|描述
--|--
Origin: http://www.baidu.com|发起一个针对跨域资源共享的请求的源地址

<br>

响应头|描述
--|--
Access-Control-Allow-Origin: *|指定哪些网站可以跨域源资源共享

### 代理类型

请求头|描述
--|--
Proxy-Authorization Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==|为连接代理授权认证信息
TE: trailers, deflate|设置用户代理期望接受的传输编码格式，和响应头中的Transfer-Encoding字段一样
Max-Forwards: 10|限制该消息可被代理转发的次数
X-Forwarded-For: 129.78.138.66, 129.78.64.103|用来标识客户端通过HTTP代理或者负载均衡器连接的web服务器的原始IP地址
Via: 1.0 baidu.com.com (Nginx/1.1), 1.1 baidu.com.com (Apache/1.1)|告诉服务器，这个请求是由哪些代理发出的

<br>

响应头|描述
--|--
Proxy-Authenticate: Basic|设置访问代理的请求权限
Via: 1.0 baidu.com.com (Nginx/1.1), 1.1 baidu.com.com (Apache/1.1)|告诉服务器，这个请求是由哪些代理发出的

## 五.状态码

### 测试

状态码|状态文字|描述
--|--|--
100|Continue|继续。客户端应继续其请求
101|Switching Protocols|切换协议。服务器根据客户端的请求切换协议。只能切换到更高级的协议

### 请求成功

状态码|状态文字|描述
--|--|--
200|OK|请求成功
201|Created|已创建。成功请求并创建了新的资源
202|Accepted|已接受。已经接受请求，但未处理完成
203|Non-Authoritative Information|非授权信息。请求成功。但返回的meta信息不在原始的服务器，而是一个副本
204|No Content|无内容。服务器成功处理，但未返回内容。在未更新网页的情况下，可确保浏览器继续显示当前文档
205|Reset Content|重置内容。服务器处理成功，浏览器应重置文档视图
206|Partial Content|部分内容。服务器成功处理了部分GET请求

### 重定向

状态码|状态文字|描述
--|--|--
300|Multiple Choices|多种选择。请求的资源可包括多个位置，由浏览器选择
301|Moved Permanently|永久移动
302|Found|临时移动
304|Not Modified|未修改。所请求的资源未修改，客户端应访问缓存
305|Use Proxy|使用代理。所请求的资源必须通过代理访问

### 客户端错误

状态码|状态文字|描述
--|--|--
400|Bad Request|客户端请求的语法错误，服务器无法理解
401|Unauthorized|请求要求用户的身份认证
403|Forbidden|服务器理解请求客户端的请求，但是拒绝执行此请求
404|Not Found|服务器无法根据客户端的请求找到资源（网页）
405|Method Not Allowed|客户端请求中的方法被禁止
407|Proxy Authentication Required|请求要求代理的身份认证，与401类似，但请求者应当使用代理进行授权
408|Request Time-out|服务器等待客户端发送的请求时间过长，超时

### 服务端错误

状态码|状态文字|描述
--|--|--
500|Internal Server Error|服务器内部错误，无法完成请求
501|Not Implemented|服务器不支持请求的功能，无法完成请求
502|Bad Gateway|作为网关或者代理工作的服务器尝试执行请求时，从远程服务器接收到了一个无效的响应
503|Service Unavailable|由于超载或系统维护，服务器暂时的无法处理客户端的请求。延时的长度可包含在服务器的Retry-After头信息中
504|Gateway Time-out|充当网关或代理的服务器，未及时从远端服务器获取请求
505|HTTP Version not supported|服务器不支持请求的HTTP协议的版本，无法完成处理