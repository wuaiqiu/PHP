# List

>List是一个链表结构，其中key为链表名，每一个元素value都是string类型，既可以实现栈，
又可以实现列队

	
(1).**LPUSH** 	将一个或多个值插入到列表头部，返回最终值个数

```
>lpush key value1
=>(integer) 1
>lrange key 0 -1
=> 1) "value1"
```

(2).**RPUSH**	将一个或多个值插入到列表尾部，返回最终值个数
	 
```
>rpush key value2
=>(integer) 2
>lrange key 0 -1
=> 1) "value1"
=> 2) "value2"
```

(3).**LPOP**	移出并获取列表的第一个元素
	
```
>lpop key
=>"value1"
>lrange key 0 -1
=> 1) "value2"
```

(4).**RPOP**	移除并获取列表最后一个元素

```
>rpop key
=>"value2"
>lrange key 0 -1
=>(empty list or set)
```

(5).**LRANGE** 获取列表指定范围内的元素
	 
```
>lrange key 0 -1
=>(empty list or set)
```

(6).**LINSERT** 在列表的元素前或者后插入元素，返回最终值个数

```
>rpush key value1
=>(integer) 1
>rpush key value2
=>(integer) 2
>linsert key before value2 value1.5
=>(integer) 3
>linsert key after value2 value3
=>(integer) 4
>lrange key 0 -1
=> 1) "value1"
=> 2) "value1.5"
=> 3) "value2"
=> 4) "value3"
```

(7).**LINDEX** 通过索引获取列表中的元素
 	
```
>lindex key 0
=>"value1"
```	

(8).**LSET**	通过索引设置列表元素的值
	 
```
>lset key 0 value11
=>OK
>lindex key 0
=>"value11"
```

(9).**LLEN**	获取列表长度(元素个数)
	 
```
>llen key
=>(integer) 4
```

(10).**LREM**	移除列表与value相同的元素(0表示全部，负数表示从尾部删除，正数表示从头部删除)
	 
```
>lrange key 0 -1
=> 1) "value11"
=> 2) "value1.5"
=> 3) "value2"
=> 4) "value3"
>rpush key value2
=>(integer) 5
>lrem key 0 value2
=>(integer) 2
>lrange key 0 -1
=> 1) "value11"
=> 2) "value1.5"
=> 3) "value3"
```

(11).**LTRIM**  保留指定索引范围的元素

```
>lrange key 0 -1
=> 1) "value11"
=> 2) "value1.5"
=> 3) "value3"
>ltrim key 0 1
=>OK
>lrange key 0 -1
=> 1) "value11"
=> 2) "value1.5"
```

(12).**RPOPLPUSH** 移除列表的最后一个元素，并将该元素添加到另一个列表的第一个并返回
 	 
```
>lrange key 0 -1
=> 1) "value11"
=> 2) "value1.5"
>rpoplpush key key1
=>"value1.5"
>lrange key 0 -1
=> 1) "value11"
>lrange key1 0 -1
=> 1) "value1.5"
```