# Subscribe/Publish

>Redis 发布订阅(pub/sub)是一种消息通信模式：发送者(pub)发送消息，订阅者(sub)接收消息。Redis 客户端可以订阅任意数量的频道。

```
#订阅消息
>SUBSCRIBE redis

#发布消息
>PUBLISH redis "Hello world"
```