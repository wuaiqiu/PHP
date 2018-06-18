# etcd

>etcd是一个分布式的key-value存储系统，采用raft算法选举leader，保证集群数据不丢失，还可以用于共享配置和服务发现。

**1.命令行管理**

>设置键值对

```
#设置键值对
etcdctl set /foo/bar "Hello world"

#设置键值对，并有过期时间
etcdctl set /foo/bar "Hello world" --ttl 60

#当key的value为"Hello world"时，才可以设置新的value
etcdctl set /foo/bar "Goodbye world" --swap-with-value "Hello world"

#当key的索引为12时，才可以设置新的value
etcdctl set /foo/bar "Goodbye world" --swap-with-index 12

#只有当key不存在时，才可以设置键值对
etcdctl mk /foo/new_bar "Hello world"

#创建目录
etcdctl mkdir /fooDir

#只有当key存在时，才可以更新键值对
etcdctl update /foo/bar "Hola mundo"

#创建或更新目录
etcdctl setdir /mydir
```

>检索键值对

```
#获取指定key的value
etcdctl get /foo/bar

#获取指定key的详细信息
etcdctl -o extended get /foo/bar
```

>列出目录

```
#列出所有目录
etcdctl ls

#列出子目录
etcdctl ls /adir

#遍历列出所有子目录
etcdctl ls --recursive

#列出所有目录，并以"/"结尾的为目录
etcdctl ls -p
```

>删除键值对

```
#删除指定键值对
etcdctl rm /foo/bar

#删除一个空目录或一个键值对
etcdctl rmdir /path/to/dir

#删除目录以及目录下所有键值对
etcdctl rm /path/to/dir --recursive

#当key的value为"Hello world"时，才删除键值对
etcdctl rm /foo/bar --with-value "Hello world"

#当key的索引为12时，才删除键值对
etcdctl rm /foo/bar --with-index 12
```

>观察键值对的变动

```
#观察键值对的一次改变
etcdctl watch /foo/bar

#持续观察键值对的改变
etcdctl watch /foo/bar --forever

#从索引为12起，持续观察键值对的改变
etcdctl watch /foo/bar --forever --index 12

#持续观察键值对，并执行指定的命令
etcdctl exec-watch /foo/bar -- sh -c "env | grep ETCD"
```

>指定连接端口(默认2379)

```
ETCDCTL_ENDPOINT="http://10.0.28.1:4002" etcdctl set my-key to-a-value
ETCDCTL_ENDPOINT="http://10.0.28.1:4002,http://10.0.28.2:4002,http://10.0.28.3:4002" etcdctl set my-key to-a-value
etcdctl --endpoint http://10.0.28.1:4002 my-key to-a-value
etcdctl --endpoint http://10.0.28.1:4002,http://10.0.28.2:4002,http://10.0.28.3:4002 etcdctl set my-key to-a-value
```

>使用密码

```
ETCDCTL_USERNAME="root:password" etcdctl set my-key to-a-value
```

**2.HTTP API**

>获取版本号

```
>http http://127.0.0.1:2379/version

HTTP/1.1 200 OK
Content-Length: 11
Content-Type: application/json
Date: Tue, 02 Aug 2016 04:27:32 GMT

etcd 2.0.10
```

>设置键值对

```
>http PUT http://127.0.0.1:2379/v2/keys/message value=="hello, etcd"

HTTP/1.1 201 Created
Content-Length: 100
Content-Type: application/json
Date: Tue, 02 Aug 2016 04:48:04 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32 #当前etcd集群id
X-Etcd-Index: 4   #当前etcd的index，它在全局范围下改变，不属于每个值
X-Raft-Index: 28429 #raft集群的index
X-Raft-Term: 2  #raft集群的任期，每次有leader选举的时候，这个值就会增加

{
    "action": "set",  #请求出发的动作，这里因为是新建一个key并设置它的值，所以是set
    "node": {         
        "createdIndex": 4,  #createdIndex是一个递增的值，每次有key被创建的时候会增加
        "key": "/message",  #key的HTTP路径
        "modifiedIndex": 4, #modifiedIndex是一个递增的值，每次有key被修改的时候会增加
        "value": "hello, etcd" #请求处理之后，key的值
    }
}
```

```
>http PUT http://127.0.0.1:2379/v2/keys/anotherdir dir==true
```

>获取键值对

```
>http GET http://127.0.0.1:2379/v2/keys/message

HTTP/1.1 200 OK
Content-Length: 97
Content-Type: application/json
Date: Tue, 02 Aug 2016 05:23:14 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 4
X-Raft-Index: 30801
X-Raft-Term: 2

{
    "action": "get",
    "node": {
        "createdIndex": 4,
        "key": "/message",
        "modifiedIndex": 4,
        "value": "hello, etcd"
    }
}
```

```
>http GET http://127.0.0.1:2379/v2/keys/
>http GET http://127.0.0.1:2379/v2/keys/ recursive==true
```

>更新键值对

```
>http PUT http://127.0.0.1:2379/v2/keys/message value=="I'm changed"

HTTP/1.1 200 OK
Content-Length: 184
Content-Type: application/json
Date: Tue, 02 Aug 2016 05:28:17 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 5
X-Raft-Index: 31407
X-Raft-Term: 2

{
    "action": "set",
    "node": {
        "createdIndex": 5,
        "key": "/message",
        "modifiedIndex": 5,
        "value": "I'm changed"
    },
    "prevNode": {
        "createdIndex": 4,
        "key": "/message",
        "modifiedIndex": 4,
        "value": "hello, etcd"
    }
}
```

>删除键值对

```
>http DELETE http://127.0.0.1:2379/v2/keys/message

HTTP/1.1 200 OK
Content-Length: 168
Content-Type: application/json
Date: Tue, 02 Aug 2016 05:31:56 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 6
X-Raft-Index: 31847
X-Raft-Term: 2

{
    "action": "delete",
    "node": {
        "createdIndex": 5,
        "key": "/message",
        "modifiedIndex": 6
    },
    "prevNode": {
        "createdIndex": 5,
        "key": "/message",
        "modifiedIndex": 5,
        "value": "I'm changed"
    }
}
```

```
>http DELETE http://127.0.0.1:2379/v2/keys/queue dir==true
>http DELETE http://127.0.0.1:2379/v2/keys/queue dir==true recursive==true
```

>设置键值对过期时间

```
>http PUT http://127.0.0.1:2379/v2/keys/tempkey value=="Gone with wind" ttl==5

HTTP/1.1 201 Created
Content-Length: 159
Content-Type: application/json
Date: Tue, 02 Aug 2016 05:48:17 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 10
X-Raft-Index: 33810
X-Raft-Term: 2

{
    "action": "set",
    "node": {
        "createdIndex": 10,
        "expiration": "2016-08-02T05:48:22.618695843Z",#过期时间
        "key": "/tempkey",
        "modifiedIndex": 10,
        "ttl": 5,#剩余时间
        "value": "Gone with wind"
    }
}
```

```
>http PUT http://127.0.0.1:2379/v2/keys/foo value==bar ttl==
```

>监听变化(目前etcd只会保存最近1000个事件)

```
>http http://127.0.0.1:2379/v2/keys/foo wait==true

HTTP/1.1 200 OK
Content-Type: application/json
Date: Tue, 02 Aug 2016 06:09:47 GMT
Transfer-Encoding: chunked
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 22
X-Raft-Index: 36401
X-Raft-Term: 2
```

```
>http http://127.0.0.1:2379/v2/keys/foo wait==true recursive==true
```

>自动创建有序的keys

```
>http POST http://127.0.0.1:2379/v2/keys/queue value==job1

HTTP/1.1 201 Created
Content-Length: 121
Content-Type: application/json
Date: Tue, 02 Aug 2016 07:08:38 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 1030
X-Raft-Index: 44470
X-Raft-Term: 2

{
    "action": "create",
    "node": {
        "createdIndex": 1030,
        "key": "/queue/00000000000000001030",
        "modifiedIndex": 1030,
        "value": "job1"
    }
}
```

```
>http http://127.0.0.1:2379/v2/keys/queue sorted==true

HTTP/1.1 200 OK
Content-Length: 385
Content-Type: application/json
Date: Tue, 02 Aug 2016 07:11:32 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 1032
X-Raft-Index: 44819
X-Raft-Term: 2

{
    "action": "get",
    "node": {
        "createdIndex": 1030,
        "dir": true,
        "key": "/queue",
        "modifiedIndex": 1030,
        "nodes": [
            {
                "createdIndex": 1030,
                "key": "/queue/00000000000000001030",
                "modifiedIndex": 1030,
                "value": "job1"
            },
            {
                "createdIndex": 1031,
                "key": "/queue/00000000000000001031",
                "modifiedIndex": 1031,
                "value": "job2"
            },
            {
                "createdIndex": 1032,
                "key": "/queue/00000000000000001032",
                "modifiedIndex": 1032,
                "value": "job3"
            }
        ]
    }
}
```

>设置目录过期时间

```
>http PUT http://127.0.0.1:2379/v2/keys/dir dir==true ttl==5

HTTP/1.1 200 OK
Content-Length: 226
Content-Type: application/json
Date: Tue, 02 Aug 2016 07:15:42 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 1033
X-Raft-Index: 45325
X-Raft-Term: 2

{
    "action": "update",
    "node": {
        "createdIndex": 1029,
        "dir": true,
        "expiration": "2016-08-02T07:15:47.970434032Z",
        "key": "/dir",
        "modifiedIndex": 1033,
        "ttl": 5
    },
    "prevNode": {
        "createdIndex": 1029,
        "dir": true,
        "key": "/dir",
        "modifiedIndex": 1029
    }
}
```

>条件更新

```
>http PUT http://127.0.0.1:2379/v2/keys/foo prevValue==bar value==changed

HTTP/1.1 200 OK
Content-Length: 190
Content-Type: application/json
Date: Tue, 02 Aug 2016 07:37:05 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 1036
X-Raft-Index: 47893
X-Raft-Term: 2

{
    "action": "compareAndSwap",
    "node": {
        "createdIndex": 1035,
        "key": "/foo",
        "modifiedIndex": 1036,
        "value": "changed"
    },
    "prevNode": {
        "createdIndex": 1035,
        "key": "/foo",
        "modifiedIndex": 1035,
        "value": "bar"
    }
}
```

```
preValue：检查key的值是否和提供的一致，一致则执行更新，否则报错
prevIndex：检查key的modifiedIndex是否和提供的一致，一致则执行更新，否则报错
prevExist：检查key是否已经存在。如果存在(true)就执行更新操作，如果不存在(false)，执行create操作
```

>条件删除

```
>http DELETE http://127.0.0.1:2379/v2/keys/foo prevValue==bar

HTTP/1.1 412 Precondition Failed
Content-Length: 85
Content-Type: application/json
Date: Tue, 02 Aug 2016 07:49:13 GMT
X-Etcd-Cluster-Id: cdf818194e3a8c32
X-Etcd-Index: 1043

{
    "cause": "[bar != changed]",
    "errorCode": 101,
    "index": 1043,
    "message": "Compare failed"
}
```

```
只支持prevValue和prevIndex两种条件检查，没有prevExist，因为删除不存在的值本身就会报错。
```

<br>

**3.PHP**

```
#etcd-php

$client = new Client($server);
//设置键值对
$client->set('/foo', 'fooValue');
$client->set('/foo', 'fooValue', 10);
//获取键值对
echo $client->get('/foo');
//更新键值对
$client->update('/foo', 'newFooValue');
//删除键值对
$client->rm('/foo');
//创建目录
$client->mkdir('/fooDir');
//删除目录
$client->rmdir('/fooDir');
```
