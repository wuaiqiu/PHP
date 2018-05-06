# Nginx负载均衡

**一.Nginx负载均衡的实现**

```
Nginx调度器 (public 172.16.254.200  privite 192.168.0.48)
RS1只有内网IP(192.168.0.18)
RS2只有外网IP(192.168.0.28)


http{
    upstream test {
        #利用源地址散列均衡算法，默认为轮询
        ip_hash;
        #设置真实服务器
        server 192.168.0.18 weight=3;
        server 192.168.0.28;
    }
    server {
        listen 80;
        location / {
            proxy_pass http://test/;
            #获取用户真实信息
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        }
    }
}
```

<br>

**二.Nginx+Keepalived**

```
Master Nginx调度器 (public 172.16.254.200  privite 192.168.0.48)
Backup Nginx调度器 (public 172.16.254.200  privite 192.168.0.49)
RS1只有内网IP(192.168.0.18)
RS2只有外网IP(192.168.0.28)

#Master Nginx服务器:
vrrp_script chk_http_port {
    #最后手动执行下此脚本，以确保此脚本能够正常执行
    script "/usr/local/src/check_nginx_pid.sh"
    #检测脚本执行的间隔，单位是秒
    interval 2
    #脚本执行失败priority-2
    weight 2
}
vrrp_instance VI_1 {
    state MASTER
    interface eth0
    virtual_router_id 66
    priority 100
    advert_int 1
    authentication {
        auth_type PASS
        auth_pass 1111
    }
    track_script {
        chk_http_port
    }
    virtual_ipaddress {
        172.16.254.200
    }
}


Backup Nginx服务器:
#设置为BACKUP服务器
state MASTER --> state BACKUP
#降低优先级
priority 100 --> priority 90
```

```
check_nginx_pid.sh

#!/bin/bash
A=`ps -C nginx --no-header |wc -l`
if [ $A -eq 0 ];then
      /usr/local/nginx/sbin/nginx
      #nginx重启失败，则停掉keepalived服务，进行VIP转移
      if [ `ps -C nginx --no-header |wc -l` -eq 0 ];then
              killall keepalived
      fi
fi
```