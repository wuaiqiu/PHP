# ZSet

>有序集合和集合一样也是string类型元素的集合，与Set不同的是ZSet每个元素都会关联一个double类型的Score,Score可以重复



(1).**ZADD**	    向有序集合添加一个或多个成员，或者更新已存在成员的分数，返回增加成功的数目
	 
```
>zadd key 1 value1
=>(integer) 1
>zadd key 1 value2
=>(integer) 1
>zadd key 2 value3
=>(integer) 1
```

(2).**ZRANGE**	      顺序（指定索引范围）

```
>zrange key 0 -1
=> 1) "value1"
=> 2) "value2"
=> 3) "value3"
>zrange key 0 -1 withsocres
=> 1) "value1"
=> 2) "1"
=> 3) "value2"
=> 4) "1"
=> 5) "value3"
=> 6) "2"
```

(3).**ZREVRANGE**	逆序（指定索引范围）
	 
```
>zrevrange key 0 -1
=> 1) "value3"
=> 2) "value2"
=> 3) "value1"
>zrevrange key 0 -1 withsocres
=> 1) "value3"
=> 2) "2"
=> 3) "value2"
=> 4) "1"
=> 5) "value1"
=> 6) "1"
```

(4).**ZRANK**		顺序返回索引（指定元素）
	 
```
>zrank key value1
=>(integer) 0
```

(5).**ZREVRANK**	逆序返回索引（指定元素）
	 
```
>zrevrank
=>(integer) 2
```

(6).**ZINCRBY**	有序集合中对指定成员的分数加上增量 increment，返回增加后的分数
	 
```
>zincrby key 0.5 value2
=>"1.5"
>zrange key 0 -1 withscores
=> 1) "value1"
=> 2) "1"
=> 3) "value2"
=> 4) "1.5"
=> 5) "value3"
=> 6) "2"
```
	 
(7).**ZRANGEBYSCORE**	通过【分数】返回有序集合指定区间内的成员
	 
```
>zrange key 0 -1 withscores
=> 1) "value1"
=> 2) "1"
=> 3) "value2"
=> 4) "1.5"
=> 5) "value3"
=> 6) "2"
>zrangebyscore key 1 1.5
=> 1) "value1"
=> 2) "value2"
```

(8).**ZCOUNT**		计算在有序集合中【指定区间分数】的成员数目

```
>zcount key 1 2
=>(integer) 3
```

(9).**ZCARD**		获取有序集合的成员数目
	 
```
>zcard	key
=>(integer) 3
```

(10).**ZREM**		移除有序集合中的一个或多个成员，返回成功的个数
	 
```
>zrem key value1
=>(integer) 1
```

(11).**ZREMRANGEBYRANK**移除有序集合中给定的【索引】区间的所有成员，返回成功的个数
	 
```
>zremrangebyrank key 0 1
=>(integer) 2
```

(12).**ZREMRANGEBYSCORE**移除有序集合中给定的【分数】区间的所有成员，返回成功的个数
	
```
>zremrangebyscore key 1 1.5
=>(integer) 2
```