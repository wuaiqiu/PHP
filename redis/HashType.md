# Hash

>hash 是一个string类型的field和value的映射表key，hash特别适合用于存储对象。


(1).**HSET**	将哈希表key中的字段field的值设为value。1表示成功

```
>hset key1 field1 value1
=>(integer) 1
```

(2).**HGET**	获取存储在哈希表中指定字段的值。

```
>hget key1 field1
 =>"value1"
```

(3).**HSETNX**	只有在字段field不存在时，设置哈希表字段的值。1表示成功

```
>hget key1 field1
=>"value1"
>hsetnx key1 field1 value11
=>(integer) 0
>hsetnx key1 field2 vlaue2
=>(integer) 1
```

(4).**HMSET**	同时将多个field-value(域-值)对设置到哈希表key中。

```
>hmset key1 field3 value3 field4 value4
=>OK
```	

(5).**HMGET** 	获取所有给定字段的值

```
>hmget key1 filed3 field4
=> 1) "value3"
=> 2) "value4"
```

(6).**HINCRBY** 为哈希表key中的指定字段的整数值加上增量increment，返回增加后的值

```
>hset key1 field5 1
=>(integer) 1
>hincrby key1 field5 5
=>(integer) 6
```

(7).**HEXISTS** 查看哈希表key中，指定的字段是否存在。1表示存在

```
>hget key1 field5
=>"6"
>hexists key1 field5
=>(integer) 1
```
	 
(8).**HLEN**	获取哈希表中字段的数量

```
>hlen key1
=>(integer) 5
```

(9).**HKEYS**	获取哈希表key中的所有字段

```
>hkeys key1
=> 1) "field1"
=> 2) "field2"
=> 3) "field3"
=> 4) "field4"
=> 5) "field5"
```

(10).**HVALS**	获取哈希表key中所有值

```
>hvals key1	
=> 1) "value1"
=> 2) "value2"
=> 3) "value3"
=> 4) "value4"
=> 5) "6"
```

(11).**HGETALL**获取在哈希表key中的所有字段和值

```	
>hgetall key1
=> 1) "field1"
=> 2) "value1"
=> 3) "field2"
=> 4) "value2"
=> 5) "field3"
=> 6) "value3"
=> 7) "field4"
=> 8) "value4"
=> 9) "field5"
=>10) "6"
```

(12).**HDEL** 	删除一个或多个哈希表字段,返回成功的个数

```
>hdel key1 field1
=>(integer) 1
>hget key1 field1
=>(nil)
>hdel key1 field2 field3
=>(integer) 2
```