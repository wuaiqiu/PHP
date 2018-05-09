# Squid

>工作流程:当一个请求到达反向代理器Squid时，Squid根据请求的内容查询是否在cache中，若存在，则Squid向后台服务器查询cache是否过期，若不存在，则Squid直接请求后台服务器获取响应内容，并进行缓存

**一.配置**

```
#缓存占内存大小
cache_mem 64MB

#最大缓存块,超过4M的文件不保存到硬盘
maximum_object_size 4096KB

#可见的主机名
visible_hostname 192.168.10.1

#ufs:缓存数据的存储格式
#/var/spool/squid    缓存目录
#100：缓存目录占磁盘空间大小（M）
#16：缓存空间一级子目录个数
#256：缓存空间二级子目录个数
cache_dir ufs /var/spool/squid 100 16 256

#访问控制
acl all src 0.0.0.0/0.0.0.0
http_access allow all

#反向代理对外ip
http_host 200.168.10.1:80 vhost

#cache_peer server地址 服务器类型 http端口 icp端口
cache_peer 192.168.10.2 parent 80 0 originserver
cache_peer 192.168.10.3 parent 80 0 originserver
cache_peer 192.168.10.4 parent 80 0 originserver
cache_peer 192.168.10.5 parent 80 0 originserver
```

<br>

**二.访问控制**

```
#源地址为192.168.1.0/24的所有主机
acl opt1 src 192.168.1.0/24

#访问域名为.qq.com与.kaixin001.com
acl opt2 dstdomain .qq.com .kaixin001.com

#在周一到周五的08:30-17:30之间访问的所有主机
acl opt3 time MTWHF 08:30-17:30

#单一IP的最大连接数
acl opt4 maxconn 20

#访问url中含有sex与adult
acl opt5 url_regex -i sex adult

#访问url含有rmvb与rm格式
acl opt6 urlpath_regex -i \.rmvb$ \.rm$
```

```
http_access allow 列表名
http_access deny 列表名
```

>1.没有设置任何规则时，将拒绝所有客户端的访问请求


>2.有规则但找不到相匹配的项时，将采用与最后一条规则相反的权限，即如果最后一条规则是allow，那么就拒绝客户端的请求，否则允许请求