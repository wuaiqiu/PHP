# docker-machine

>Docker Machine用于一键部署Docker，使用它可以自动的创建主机并在主机上安装Docker。通过Docker Machine创建了主机之后，可以使用它提供的一系列命令管理这些主机

**1.命令**

```
#创建并启动host(driver指定驱动)
docker-machine create --driver virtualbox
  --virtualbox-boot2docker-url url
  --virtualbox-cpu-count 1
  --virtualbox-disk-size 20000 (MB)
  --virtualbox-memory 1024  (MB)
  --virtualbox-share-folder /home/wu/mylinux:share
  dev

#查看已经创建的host的状态
docker-machine ls

#启动host
docker-machine start dev

#重启host
docker-machine restart dev

#停止host
docker-machine stop dev

#强制停止host
docker-machine kill dev

#查看host的状态
docker-machine status dev

#删除host
docker-machine rm dev

#查看host的环境变量等信息
docker-machine env dev

#查看host的IP地址
docker-machine ip dev

#查看host的连接配置
docker-machine config dev

#查看host的详细信息
docker-machine inspect dev

#更新host的docker
docker-machine upgrade dev

#与host通信
docekr-machine ssh dev

#在machine之间传输文件
docker-machine scp root@dev:/root/a.txt root@dev2:/root/b.txt
```
