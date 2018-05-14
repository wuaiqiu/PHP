# JWT(json web token)

>是为了在网络应用环境间传递声明而执行的一种基于JSON的开放标准,在身份鉴定的实现中，传统方法是在服务端存储一个session，给客户端返回一个cookie，而使用JWT之后，当用户使用它的认证信息登陆系统之后，会返回给用户一个JWT，用户只需要本地保存该token（通常使用local storage(可以实现跨域)，也可以使用cookie）即可。 当用户希望访问一个受保护的路由或者资源的时候，通常应该在Authorization头部使用Bearer模式添加JWT，其内容看起来是下面这样：Authorization: Bearer <token>

**JWT的结构**

>header

```
typ:声明类型
alg:声明加密算法

{

    "typ": "JWT",
    "alg": "HS256"
}
```

>payload

```
iss: jwt签发者
sub: jwt所面向的用户
aud: 接收jwt的一方
exp: jwt的过期时间，这个过期时间必须要大于签发时间
nbf: 定义在什么时间之前，该jwt都是不可用的.
iat: jwt的签发时间
jti: jwt的唯一身份标识，主要用来作为一次性token,从而回避重放攻击。


{
    name:"Free",
    age:28，
    iss:"tencent"
}
```

>signature

```
salt:盐

HMACSHA256(base64(header)+"."+base64(payload),salt);
```

>base64(header)+"."+base64(payload)+"."+signature;