# docker

**一.安装**

```
pacman -S docker
systemctl start docker.service
systemctl enable docker.service
sudo docker info
```

<br>

**二.简介**

```
Docker 可以让开发者打包他们的应用以及依赖包到一个轻量级、可移植的容器中，然后发布到任何流行的 Linux 机器上，也可以实现虚拟化。

Docker 镜像(Images)		Docker 镜像是用于创建 Docker 容器的模板。
Docker 容器(Container)	容器是独立运行的一个或一组应用。
Docker 客户端(Client)		Docker 客户端通过命令行或者其他工具使用 
Docker 仓库(Registry)		Docker 仓库用来保存镜像，可以理解为代码控制中的代码仓库。
					     Docker Hub(https://hub.docker.com) 提供了庞大的镜像集合供使用。

Client --操作--> Server ---创建--> Container  <--实例化--  Images
```

<br>

**三.操作**

(1)容器生命周期管理

```
docker run -dP -v localhost:container --name mynginx nginx
docker run -dp localhost:container -v localhost:container --name mynginx nginx

docker start mynginx
docker restart mynginx
docker stop mynginx
docker kill mynginx
docker rm mynginx

docker exec -it mynginx /bin/bash
```

(2)容器操作

```
docker ps
docker ps -a
docker inspect mynginx
docker logs --tail 10 mynignx
docker export -o mynginx.tar mynginx
docker import -i mynginx.tar
```

(3)容器rootfs命令

```
docker commit -a wuaiqiu -m sss mynginx nginx:vv1
docker cp a.txt mynginx:/root
docker diff mynginx
```

(4)镜像仓库

```
docker login -u 用户名 -p 密码 registry.cn-hangzhou.aliyuncs.com
docker search mysql
docker pull mysql
docker push registry.cn-hangzhou.aliyuncs.com/wuaiqiu/myapache:v1
docker logout registry.cn-hangzhou.aliyuncs.com
```

(5)本地镜像管理

```
docker images
docker rmi redis
docker tag redis:vs1 redis:vs2
docker build -t runoob/ubuntu:v1 .
docker save -o my_ubuntu_v3.tar runoob/ubuntu:v3
docker load -i ubuntu.tar
```

<br>	

**四.Dockerfile**

```
#第一行必须指令基于的基础镜像
FROM ubuntu

#维护者信息
MAINTAINER docker_user docker_user@mail.com

#指定一个环境变量
ENV PATH /usr/local/postgres-$PG_MAJOR/bin:$PATH

#镜像的操作指令
RUN apt-get update && apt-get install -y ngnix 
RUN echo "\ndaemon off;">>/etc/ngnix/nignix.conf

#添加本地文件
ADD /home/wu/wrodpress.tar  /srv/www

#VOLUME命令用于让你的容器访问宿主机上的目录
VOLUME ["/data"]

#容器启动时执行指令
CMD /usr/sbin/ngnix

#Docker服务端容器暴露的端口号
EXPOSE 22
```