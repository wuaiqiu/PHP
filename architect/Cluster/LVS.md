# LVS（Linux Virtual Server）


```
ipvsadm+keepalived

VIP：LVS对外的IP地址。
DIP：LVS和后端服务器通讯的IP地址。
RIP：后端服务器的IP地址。
CIP：客户端的IP地址。
```

**一.LVS/NAT原理及实现**

```
(a).当用户请求到达LVS，此时报文的源IP为CIP，目标IP为VIP
(b).LVS修改数据包的目标IP地址为后端服务器RIP，此时报文的源IP为CIP，目标IP为RIP
(c).真实服务器开始构建响应报文发回给LVS。 此时报文的源IP为RIP，目标IP为CIP
(d).LVS在响应客户端前，此时会将源IP地址修改为自己的VIP地址，然后响应给客户端。 此时报文的源IP为VIP，目标IP为CIP
```

```
VIP(eth0 172.16.254.200) DIP(eth1 192.168.0.1)
RIP1(eth0 192.168.0.2)
RIP2(eth0 192.168.0.3)


LVS服务器:
#开启路由转发功能
echo "1" > /proc/sys/net/ipv4/ip_forward
#设置ipvsadm
ipvsadm -C  #清除所有规则
ipvsadm -A -t 172.16.254.200:80 -s wrr  #添加TCP协议集群，以及使用加权轮询方式
ipvsadm -a -t 172.16.254.200:80 -r 192.168.0.2:80 -m -w 1  #为已定义的集群添加真实服务器，并使用nat权重为1
ipvsadm -a -t 172.16.254.200:80 -r 192.168.0.3:80 -m -w 1
#查看ipvsadm设置的规则
ipvsadm -ln
```

<br>

**二.LVS/DR原理及实现**

```
(a).当用户请求到达LVS，此时报文的源IP为CIP，目标IP为VIP
(b).LVS将请求报文中的源MAC地址修改为DIP的MAC地址，将目标MAC地址修改RIP的MAC地址，此时的源IP和目的IP均未修改，仅修改了源MAC
地址为DIP的MAC地址，目标MAC地址为RIP的MAC地址
(c).由于LVS和真实服务器在同一个网络中，所以是通过二层来传输。那么此时数据包将会发至真实服务器。
(d).真实服务器发现请求报文的MAC地址是自己的MAC地址，就接收此报文。处理完成之后，将响应报文通过lo接口传送给eth0网卡然后向外
发出。 此时的源IP地址为VIP，目标IP为CIP
```

```
VIP(eth0:0 172.16.254.200) DIP(eth0 172.16.254.201)
RIP1(eth0 172.16.254.202 lo:0 172.16.254.200)
RIP2(eth0 172.16.254.203 lo:0 172.16.254.200)


LVS服务器:
#开启路由转发功能
echo "1" > /proc/sys/net/ipv4/ip_forward
#配置网卡信息
ifconfig eth0:0 172.16.254.200  netmask 255.255.255.0 up
route add -host 172.16.254.200 dev eth0:0
#设置ipvsadm
ipvsadm -C  #清除所有规则
ipvsadm -A -t 172.16.254.200:80 -s wrr  #添加TCP协议集群，以及使用加权轮询方式
ipvsadm -a -t 172.16.254.200:80 -r 172.16.254.202:80 -g -w 1  #为已定义的集群添加真实服务器，并使用dr权重为1
ipvsadm -a -t 172.16.254.200:80 -r 172.16.254.203:80 -g -w 1
#查看ipvsadm设置的规则
ipvsadm -ln


真实服务器:
#配置网卡信息
ifconfig lo:0 172.16.254.200 netmask 255.255.255.0 up
route add -host 172.16.254.200 lo:0
#关闭ARP响应配置
echo "1" >/proc/sys/net/ipv4/conf/lo/arp_ignore
echo "2" >/proc/sys/net/ipv4/conf/lo/arp_announce
echo "1" >/proc/sys/net/ipv4/conf/all/arp_ignore
echo "2" >/proc/sys/net/ipv4/conf/all/arp_announce
```

<br>

**三.LVS/Tun原理及实现**

```
(a).当用户请求到达LVS，此时报文的源IP为CIP，目标IP为VIP 。
(b).LVS在请求报文的首部再次封装一层IP报文，封装源IP为为DIP，目标IP为RIP。
(c).真实服务器拆除掉最外层的IP后，会发现里面目标是自己的lo接口VIP，那么此时真实服务器开始处理此请求，处理完成之后，通过lo
接口送给eth0网卡，然后向外传递。 此时的源IP地址为VIP，目标IP为CIP
```

```
VIP(tunl0 172.16.254.200) DIP(eth0 192.168.0.1)
RIP1(eth0 192.168.0.2 tunl0 172.16.254.200)
RIP2(eth0 192.168.0.3 tunl0 172.16.254.200)


LVS服务器:
#配置网卡
ifconfig tunl0 172.16.254.200 netmask 255.255.255.0 up
route add -host 172.16.254.200 dev tunl0
#打开转发重定向
echo "1" >/proc/sys/net/ipv4/conf/all/send_redirects
echo "1" >/proc/sys/net/ipv4/conf/default/send_redirects
echo "1" >/proc/sys/net/ipv4/conf/eth0/send_redirects
#设置ipvsadm
ipvsadm -C  #清除所有规则
ipvsadm -A -t 172.16.254.200:80 -s wrr  #添加TCP协议集群，以及使用加权轮询方式
ipvsadm -a -t 172.16.254.200:80 -r 192.168.0.2:80 -i -w 1   #为已定义的集群添加真实服务器，并使用tun权重为1
ipvsadm -a -t 172.16.254.200:80 -r 192.168.0.3:80 -i -w 1
#查看ipvsadm设置的规则
ipvsadm -ln


真实服务器:
#配置网卡
ifconfig tunl0 172.16.254.200 netmask 255.255.255.0 up
route add -host 172.16.254.200 dev tunl0
#关闭ARP响应配置
echo "1" > /proc/sys/net/ipv4/conf/tunl0/arp_ignore
echo "2" > /proc/sys/net/ipv4/conf/tunl0/arp_announce
echo "1" > /proc/sys/net/ipv4/conf/all/arp_ignore
echo "2" > /proc/sys/net/ipv4/conf/all/arp_announce
```

<br>

**四.调度算法**

```
1. 轮询调度 rr
2. 加权轮询 wrr
3. 最少链接 lc
4. 加权最少链接 wlc
5. 源地址散列调度算法 sh
```

<br>

**五.Keepalive（LVS的管理器）**

>LVS可以实现负载均衡，但是不能够进行健康检查，比如一个真实服务器出现故障，LVS仍然会把请求转发给故障的真实服务器，这样就会导致请求的无效性。keepalive软件可以进行健康检查，而且能同时实现LVS的高可用性，解决LVS单点故障的问题

```
采用DR模式
Master LVS:VIP(eth0:0 172.16.254.200) DIP(eth0 172.16.254.201)
Buckup LVS:VIP(eth0:0 172.16.254.200) DIP(eth0 172.16.254.202)
RIP1(eth0 172.16.254.203 lo:0 172.16.254.200)
RIP2(eth0 172.16.254.204 lo:0 172.16.254.200)


Master LVS服务器:
#VRRP实例定义块
vrrp_instance VI_1 {
    #设置为MASTER服务器
    state MASTER
    #指定存活检测的网卡
    interface eth0
    #虚拟路由标识，同一个vrrp_instance的MASTER和BACKUP的vitrual_router_id是一致的。
    virtual_router_id 51
    #优先级，同一个vrrp_instance的MASTER优先级必须比BACKUP高。
    priority 100
    #MASTER与BACKUP负载均衡器之间同步检查的时间间隔，单位为秒
    advert_int 1
    #同一vrrp实例MASTER与BACKUP,使用相同的密码才能正常通信。
    authentication {
        auth_type PASS
        auth_pass 1111
    }
    #VIP
    virtual_ipaddress {
        172.16.254.200
    }
}

#虚拟服务器定义块
virtual_server 172.16.254.200 80 {
    #健康检查时间间隔，单位：秒
    delay_loop 6
    #负载均衡调度算法，互联网应用常用方式为wlc或rr
    lb_algo rr
    #负载均衡转发规则。包括DR、NAT、TUN 3种
    lb_kind DR
    #http服务会话保持时间，单位：秒
    persistence_timeout 0
    #转发协议，分为TCP和UDP两种
    protocol TCP

    #真实服务器IP和端口
    real_server 172.16.254.203 80 {
       #权重
        weight 1
        #服务有效性检测
        TCP_CHECK {
            #服务连接超时时长，单位：秒
            connect_timeout 10
            #服务连接失败重试次数
            nb_get_retry 3
            #重试连接间隔，单位：秒
            delay_before_retry 3
            #服务连接端口
            connect_port 80
        }
    }

    real_server 172.16.254.204 80 {
        weight 1
        TCP_CHECK {
            connect_timeout 10
            nb_get_retry 3
            delay_before_retry 3
            connect_port 80
        }
    }
}


Buckup LVS服务器:
#设置为BACKUP服务器
state MASTER --> state BACKUP
#降低优先级
priority 100 --> priority 90
```

>VRRP（Virtual Router Redundancy Protocol，虚拟路由器冗余协议）将可以承担网关功能的路由器加入到备份组中，形成一台虚拟路由器，由VRRP的选举机制决定哪台路由器承担转发任务，局域网内的主机只需将虚拟路由器配置为缺省网关