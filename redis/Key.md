# Key

>用于管理 redis 的键key。


(1).**DEL** 	用于在key存在时删除一个或多个key。返回成功个数

```
>del key1 key2
=>(integer) 2
```

(2).**EXISTS**	检查给定一个或多个key是否存在。返回存在的个数

```
>exists key1 key2
=>(integer) 1
```

(3).**EXPIRE**	为给定 key 设置过期时间以秒计，1表示成功

```
>expire key1 10
=>(integer) 1
```

(4).**PEXPIRE** 设置 key 的过期时间以毫秒计，1表示成功

```
>pexpire key2 10
=>(integer) 1
```

(5).**PERSIST** 移除 key 的过期时间，key 将持久保持，1表示成功

```
>persist key1
=>(integer) 0
```

(6).**PTTL**	以毫秒为单位返回 key 的剩余的过期时间。-1表示过期

```
>pttl key1
=>(integer) 15
```

(7).**TTL**	以秒为单位，返回给定 key 的剩余生存时间。-1表示过期或取消过期时间

```
>ttl key1
=>(integer) 7570
```

(8).**RANDOMKEY** 从当前数据库中随机返回一个 key

```
>randomkey
=>"key1"
```

(9).**KEYS**	  查找所有符合给定模式( pattern)的 key

```
>keys key*
=> 1) "key2"
=> 2) "key1"
```

(10).**RENAME**  修改 key 的名称，当newkey存在时，原来的key会被覆盖

```
>rename key1 newkey
=>OK
```

(11).**RENAMENX**仅当 newkey 不存在时，将 key 改名为 newkey ，1表示成功

```
>renamenx key1 newkey
=>(integer) 1
>renamenx key1 key2
=>(integer) 0
```

(12).**TYPE**	  返回 key 所储存的值的类型，none表示不存在

```
>type key1
=>string
```

(13).**MOVE**	  将当前数据库的 key 移动到给定的数据库 db 当中。1表示成功

```
>select 0	//默认当前为索引为0数据库，共有0-15数据库
=>OK
>set key1 value1
=>OK
>move key1 1
=>(integer) 1
>select 1  //选择数据库
=>OK
>get key1
=>"value1"
```