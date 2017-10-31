# Set

>Set是string类型的无序集合。集合成员是唯一的，集合是通过哈希表实现的


(1).**SADD**	向集合添加一个或多个成员，返回添加的个数

```
>sadd key value1 value2
=>(integer) 2
```

(2).**SMEMBERS**返回集合中的所有成员

```
>smembers key
=> 1) "value2"
=> 2) "value1"
```

(3).**SDIFF**	返回给定所有集合的差集

```
>sadd key1 value1 value3
=>OK
>smembers key
=> 1) "value2"
=> 2) "value1"
>sdiff key key1
=> 1) "value2"
```

(4).**SDIFFSTORE** 返回给定所有集合的差集并存储在 destination 中，返回符合条件的元素个数
		
```
>sdiffstore des key key1
=>(integer) 1
>smembers des
=> 1) "value2"
```

(5).**SINTER**	   返回给定所有集合的交集
		
(6).**SINTERSTORE** 返回给定所有集合的交集并存储在 destination 中，返回符合条件的元素个数

(7).**SUNION**	    返回所有给定集合的并集
		
(8).**SUNIONSTORE** 所有给定集合的并集存储在 destination 集合中，返回符合条件的元素个数
		
(9).**SMOVE**	    将 member 元素从 source 集合移动到 destination 集合

```
>smembers key
=> 1) "value2"
=> 2) "value1"
>smembers key1
=> 1) "value3"
=> 2) "value1"
>smove key key1 value2
=>(integer) 1
>smembers key
=> 1) "value1"
>smembers key1
=> 1) "value3"
=> 2) "value2"
=> 3) "value1"
```

(10).**SCARD**	  获取集合的成员数目

```
>smembers key1
=> 1) "value3"
=> 2) "value2"
=> 3) "value1"
>scard key1
=>(integer) 3
```

(11).**SISMEMBER** 判断 member 元素是否是集合 key 的成员，1表示存在
		
```
>smembers key1
=> 1) "value3"
=> 2) "value2"
=> 3) "value1"
>sismember key1 value1
=>(integer) 1
```
		
(12).**SRANDMEMBER**	返回集合中一个或多个随机数

```
>smembers key1
=> 1) "value3"
=> 2) "value2"
=> 3) "value1"
>srandmember key1
=>"value3"
>srandmember key1 2
=> 1) "value3"
=> 2) "value2"
```
	
(13).**SREM**		移除集合中一个或多个成员

```
>smembers key1
=> 1) "value3"
=> 2) "value2"
=> 3) "value1"
>srem key value1
=>(integer) 1
>smembers key1
=> 1) "value3"
=> 2) "value2"
```

(14).**SPOP**		移除并返回集合中的一个(多个)随机元素
		 
```
>smembers key1
=> 1) "value3"
=> 2) "value2"
>spop key1 2
=> 1) "value3"
=> 2) "value2"
>smembers key1
=>(empty list or set)
```