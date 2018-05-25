# HTTP Basic

>HTTP基本认证的目标是提供简单的用户验证功能，其认证过程简单明了，适合于对安全性要求不高的系统或设备中

**BASIC认证的过程**

>步骤1:客户端向服务器请求数据

```
Get /index.html HTTP/1.1
Host:www.google.com
```

>步骤2:因为客户端未认证，服务器向客户端发送验证请求代码401

```
HTTP/1.0 401 Unauthorised
Server: SokEvo/1.0
WWW-Authenticate: Basic realm="google.com"  //表示认证方式
Content-Type: text/html
```

>步骤3:用户输入用户名和密码后，浏览器将用户名及密码以BASE64加密方式加密，并将密文放入请求信息中,注意当用户名出现":"时,则":"为password的字符串

```
Get /index.html HTTP/1.0
Host:www.google.com
Authorization: Basic base64_encode($username.":".$password)
```

>步骤4:服务器收到上述请求信息后，将Authorization字段后的用户信息取出、解密，将解密后的用户名及密码与用户数据库进行比较验证，如用户名及密码正确，服务器则根据请求，将所请求资源发送给客户端

```
$_SERVER['PHP_AUTH_USER']
$_SERVER['PHP_AUTH_PW']
```
