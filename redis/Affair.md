# Affair


(1).redis 只是能执行简单的事务处理，当事务中有一条错误命令，并不会回滚事务
	 
```
>set key1 value1
=>OK
>set key2 2
=>OK
>multi		//开启事务 MULTI
=>OK
>incr key2
=>QUEUED
>incr key1
=>QUEUED
>exec		//提交事务 EXEC ; 回滚事务 DISCARD 
=> 1) (integer) 3
=> 2) (error) ERR value is not an integer or out of range
>get key1
=>"value1"
>get key2
=>"3"
```

(2).乐观锁（用于解决事务中需要处理的key被外界其他client所改变的情况）

**client1**

```	
>get key1
=>"value1"	
>watch key1  //WATCH 监视一个(或多个) key ，如果在事务执行之前这个(或这些) key 被其他命令所改动，那么事务将被打断。
=>OK
>multi
=>OK
>set key1 value11
=>QUEUED
>exec
=>(nil)	//没有执行事务
>unwatch  //UNWATCH  取消 WATCH 命令对所有 key 的监视
=>OK
```

**client2**(在client1没用提交事务的时候)

```	
>set key1 value111
=>OK
```	