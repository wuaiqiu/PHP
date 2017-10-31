# HyperLogLog

>基数(去除重复的值)统计的算法; HyperLogLog 只会根据输入元素来计算基数，而不会储存输入元素本身，所以 HyperLogLog 不能像集合那样，返回输入的各个元素。


```
#添加元素
> PFADD runoobkey "redis"
=>(integer) 1

> PFADD runoobkey "mongodb"
=>(integer) 1

> PFADD runoobkey "mysql"
=>(integer) 1

#统计元素
>PFCOUNT runoobkey
=>(integer) 3

#合并
>PFMERGE destkey sourcekey [sourcekey ...] 
```
