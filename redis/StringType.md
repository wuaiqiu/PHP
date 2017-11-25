# String

>String是最简单的类型，一个Key对应一个Value，String类型是二进制安全的。Redis的String可以包含任何数据，比如图片或序列化对象

	
(1).**SET** 	  设置指定key的值

```
>set key1 value1
=>OK
```
	
(2).**GET** 	获取指定key的值。

```
>get key1
=>"value1"
```

(3).**SETNX** 	只有在key不存在时设置key的值。1表示成功
		   
```
>get key1
=>"value1"
>setnx key1 value11
=>(integer) 0
>setnx key2 value2
=>(integer) 1
>get key2
=>"value2"
```
		   
(4).**SETEX**	将值value关联到key，并将key的过期时间设为seconds(以秒为单位)。

```
>setex key3 3 value3
=>OK
>get key3
=>"value3"
>get key3
=>(nil)
```

(5).**SETRANGE** 设定key的value的子字符串，返回最终字符串的个数

```
>get key1
=>"value1"
>setrange key1 3 22
=>(integer) 6
>get key1
=>"val221"
```

(6).**GETRANGE** 返回 key 中字符串值的子字符
		   
```
>get key1
=>"val221"
>getrange key1 2 -1
=>"l221"
```

(7).**MSET** 	同时设置一个或多个key-value对。

```
>mset key3 value3 key4 value4
=>OK
```

(8).**MGET** 	获取所有(一个或多个)给定key的值。
		  
```
>mget key3 key4
=> 1) "value3"
=> 2) "value4"
```

(9).**MSETNX**	同时设置一个或多个key-value对，当且仅当所有给定key都不存在。1表示成功
		  
```
>get key4
=>"value4"
>msetnx key4 value44 key5 value5
=>(integer) 0
>msetnx key5 value5 key6 value6
=>(integer) 1
>mget key5 key6
=> 1) "value5"
=> 2) "value6"
```

(10).**GETSET** 将给定key的值设为value，并返回key的旧值(old value)。
		  
```
>get key5
=>"value5"
>getset key5 value55
=>"value5"
>get key5
=>"value55"
```

(11).**INCR**	将key中储存的数字值增一。返回增加后的值

```
>set key6 1
=>OK
>incr key6
=>(integer) 2
```

(12).**DECR**	将key中储存的数字值减一。返回减少后的值
		  
```
>get key6
=>"2"
>decr key6
=>(integer) 1
```

(13).**INCRBY** 将key所储存的值加上给定的增量值（increment） 。返回增加后的值
		 
```
>get key6
=>"1"
>incrby key6 5
=>(integer) 6
```

(14).**DECRBY** 将key所储存的值减去给定的减量值（decrement） 。返回减少后的值
		 
```
>get key6
=>"6"
>decrby key6 5
=>(integer) 1
```

(15).**APPEND** 如果key已经存在并且是一个字符串，APPEND命令将value追加到key原来的值的末尾。返回字符串长度
		 
```
>get key5
=>"value55"
>append key5 values
=>(integer) 13
>get key5
=>"value55values"
```

(16).**STRLEN**  返回key所储存的字符串值的长度。
		 
```
>get key5
=>"value55values"
>strlen key5
=>(integer) 13
```