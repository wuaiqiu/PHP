# OAuth2.0

>OAuth(Open Authorization):OAuth的授权不会使第三方触及到用户的帐号信息（如用户名与密码），即第三方无需使用用户的用户名与密码就可以申请获得该用户资源的授权，因此 OAuth是安全的。

**一.授权码模式（authorization code）**

>步骤1:用户访问客户端，后者将前者导向认证服务器

```
response_type：表示授权类型，必选项，此处的值固定为"code"
client_id：表示客户端的ID，必选项。（如微信授权登录，此ID是APPID）
redirect_uri：表示重定向URI，可选项
scope：表示申请的权限范围，可选项
state：一个随机字符串，用于防止跨站攻击（CSRF），可选项


https://open.weixin.qq.com/connect/qrconnect?
appid=APPID&redirect_uri=https://client.example.com/cb&response_type=code&scope=SCOPE&state=STATE
```

>步骤2:假设用户给予授权，认证服务器将返回客户端事先指定的重定向URI，同时附上一个授权码

```
code：表示授权码，必选项。
state：如果客户端的请求中包含这个参数，认证服务器的回应也必须一模一样包含这个参数。


HTTP/1.1 302 Found
Location: https://client.example.com/cb?code=CODE&state=STATE
```

>步骤3:客户端的后台服务器收到授权码，附上早先的重定向URI，向认证服务器申请令牌。

```
grant_type：表示使用的授权模式，必选项，此处的值固定为"authorization_code"。
code：表示上一步获得的授权码，必选项。
redirect_uri：表示重定向URI，必选项，且必须与步骤1中的该参数值保持一致。
client_id：表示客户端ID，必选项。


POST /token HTTP/1.1
Host: open.weixin.qq.com
Content-Type: application/x-www-form-urlencoded

grant_type=authorization_code&code=CODE
&redirect_uri=https%3A%2F%2Fclient%2Eexample%2Ecom%2Fcb
```

>步骤4:认证服务器核对了授权码和重定向URI，确认无误后，向客户端的后台服务器发送访问令牌（access token）和更新令牌（refresh token）等

```
access_token：表示访问令牌，必选项。
token_type：表示令牌类型，该值大小写不敏感，必选项，可以是bearer类型或mac类型。
expires_in：表示过期时间，单位为秒。如果省略该参数，必须其他方式设置过期时间。
refresh_token：表示更新令牌，用来获取下一次的访问令牌，可选项。
scope：表示权限范围，如果与客户端申请的范围一致，此项可省略。


{
    "access_token":"ACCESS_TOKEN",
    "expires_in":7200,
    "refresh_token":"REFRESH_TOKEN",
    "token_type":bearer,
    "scope":"SCOPE"
}


{
    "access_token":"ACCESS_TOKEN",
    "expires_in":7200,
    "refresh_token":"REFRESH_TOKEN",
    "token_type":mac,
    "scope":"SCOPE",
    "mac_key":"adijq39jdlaska9asud", //随机秘钥
    "mac_algorithm":"hmac-sha-256" //加密算法
}
```

>步骤5:更新令牌

```
grant_type：表示使用的授权模式，此处的值固定为"refresh_token"，必选项。
refresh_token：表示早前收到的更新令牌，必选项。
scope：表示申请的授权范围，不可以超出上一次申请的范围，如果省略该参数，则表示与上一次一致。


POST /token HTTP/1.1
Host:open.weixin.qq.com
Content-Type: application/x-www-form-urlencoded

grant_type=refresh_token&refresh_token=REFRESH_TOKEN
```

>步骤6:请求资源

```
bearer类型的access_token是建立在HTTP/1.1版本之上的token类型，需要TLS（Transport Layer Security）提供安
全支持


#在请求头设置（推荐）
GET /resource HTTP/1.1
Host: open.weixin.qq.com
Authorization: Bearer ACCESS_TOKEN

#在POST请求参数设置
POST /resource HTTP/1.1
Host: open.weixin.qq.com
Content-Type: application/x-www-form-urlencoded
access_token=ACCESS_TOKEN

#在GET请求中设置（不推荐）
GET /resource?access_token=ACCESS_TOKEN HTTP/1.1
Host: open.weixin.qq.com
```

```
mac类型的token设计的主要目的就是为了应对不可靠的网络环境。非TLS网络传输


GET /resource HTTP/1.1
Host: open.weixin.qq.com
Authorization: MAC id=ACCESS_TOKEN,ts=TIMESTAMP
                   ,nonce=Client_ID,mac=hmac-sha-256(mac_key, header)
```

<br>

**二.简化模式（implicit）**

>步骤1:用户访问客户端，后者将前者导向认证服务器,直接获取access_token

```
response_type：表示授权类型，必选项，此处的值固定为"token"
client_id：表示客户端的ID，必选项。（如微信授权登录，此ID是APPID）
redirect_uri：表示重定向URI，可选项
scope：表示申请的权限范围，可选项
state：一个随机字符串，用于防止跨站攻击（CSRF），可选项


https://open.weixin.qq.com/connect/qrconnect?
appid=APPID&redirect_uri=https://client.example.com/cb&response_type=token&scope=SCOPE&state=STATE
```

>步骤2:假设用户给予授权，认证服务器将返回客户端事先指定的重定向URI，同时附上一个access_token

```
access_token：表示访问令牌，必选项。
token_type：表示令牌类型，该值大小写不敏感，必选项，可以是bearer类型或mac类型。
expires_in：表示过期时间，单位为秒。如果省略该参数，必须其他方式设置过期时间。
state：如果客户端的请求中包含这个参数，认证服务器的回应也必须一模一样包含这个参数。


HTTP/1.1 302 Found
Location: https://client.example.com/cb?access_token=ACCESS_TOKEN&state=STATE&token_type=TOKEN_TYPE
```

>步骤3:请求资源

<br>

**三.密码模式（resource owner password credentials）**

>步骤1:客户端向用户索要认证信息，username与password,最后客户端向认证服务器获取token

```
grant_type:该模式下为“password”
scope:业务访问控制范围，可选参数
client_id:应用注册时获得的客户id
client_secret:应用注册时获得的客户密钥
username:用户的用户名，以UTF-8编码
password:用户的密码，以UTF-8编码


POST /token HTTP/1.1
Host:open.weixin.qq.com
Content-Type: application/x-www-form-urlencoded

grant_type=password&client_id=CLIENT_ID&username=USERNAME&password=PASSWORD
```

>步骤2:如果用户提供的认证信息正确，则认证服务器会返回一段application/json数据并包含access_token

```
access_token:用于访问API接口的访问令牌。这是该响应中唯一需要的内容
instance_url:访问API时的URL前缀
‍‍signature‍‍:一个签名，用于验证URL在传输过程中没有被篡改


{
    "instance_url":"https://open.weixin.qq.com",
    "signature":"Q2KTt8Ez5dwJ4Adu6QttAhCxbEP3HyfaTUXoNI=",
    "access_token":"ACCESS_TOKEN"
}
```

>步骤3:访问资源

<br>

**四.客户端模式（client credentials）**

>步骤1:用客户端证书交换访问令牌access_token

```
grant_type:这里为"client_credentials"
client_id:应用注册时获得的client id
client_secret:应用注册时获得的client secret


POST /token HTTP/1.1
Host:open.weixin.qq.com
Content-Type: application/x-www-form-urlencoded

grant_type=client_credentials&client_id=CLIENT_ID&client_secret=CLIENT_SECRET
```

>步骤2:如果认证成功，服务器将会返回access_token

```
{
    "access_token":ACCESS_TOKEN
}
```

>步骤3:访问资源
