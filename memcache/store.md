# store

存储命令


**add**

```
#用于添加不存在的key-value
add key flags exptime bytes
value

key：键值 key-value 结构中的 key，用于查找缓存值。
flags：可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息 。
exptime：在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）
bytes：在缓存中存储的字节数
```


**append**

```
#向已存在的key的value后追加内容
append key flags exptime bytes
value
```


**prepend**

```
#向已存在的key的value前追加内容
prepend key flags exptime bytes
value
```


**replace**

```
#更新存在的key-value
replace key flags exptime bytes
value
```


**set** 

```
#如果key存在，该命令可以更新该key；如果key不存在则添加
set key flags exptime bytes
value
```


**cas**

```
#设置已存在key的某一个版本（最新版本）的值
cas key flags exptime bytes unique_cas_token
value

unique_cas_token通过 gets 命令获取的一个唯一的64位值。
```