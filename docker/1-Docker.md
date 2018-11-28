# Docker


## 一.简介

docker可以让开发者打包他们的应用以及依赖包到一个轻量级、可移植的容器中，然后发布到任何流行的Linux机器上。

```
Docker镜像(Images):Docker镜像是用于创建Docker容器的模板。
Docker容器(Container):容器是独立运行的一个或一组应用。
Docker客户端(Client):Docker客户端通过命令行或者其他工具使用。
Docker仓库(Registry):Docker仓库用来保存镜像，可以理解为代码控制中的代码仓库。

Client --操作--> Server ---创建--> Container  <--实例化--  Images
```

## 二.操作

### 1.容器生命周期管理

```
#运行一个容器并指定卷映射，随机端口，容器名称
docker run -dP -v localhost:container --name mynginx nginx

#运行一个容器并指定卷映射，端口映射，容器名称
docker run -dp localhost:container -v localhost:container --name mynginx nginx

#连接容器(常用于bridge模式下)
docker run -dP --link redis:myalias --name mynginx nginx

#操作容器
docker start mynginx
docker restart mynginx
docker stop mynginx
docker kill mynginx
docker rm mynginx

#进入交互式
docker exec -it mynginx /bin/bash
```

### 2.容器操作

```
#查看后台运行的容器(a:所有容器)
docker ps
docker ps -a

#查看容器的详细信息
docker inspect mynginx

#查看容器的日志
docker logs --tail 10 mynignx
```

### 3.容器rootfs命令

```
#复制宿主机文件到容器中
docker cp a.txt mynginx:/root

#查看容器文件系统的改变
docker diff mynginx

#备份/恢复容器文件系统
docker export -o mynginx.tar mynginx
docker import -i mynginx.tar
```

### 4.镜像仓库

```
#登录docker仓库
docker login -u 用户名 -p 密码 registry.cn-hangzhou.aliyuncs.com

#搜索镜像
docker search mysql

#下载镜像
docker pull mysql

#上传镜像
docker push registry.cn-hangzhou.aliyuncs.com/wuaiqiu/myapache:v1

#注销docker仓库
docker logout registry.cn-hangzhou.aliyuncs.com
```

### 5.本地镜像管理

```
#列出本地镜像
docker images

#删除镜像
docker rmi redis

#重新标记一个新镜像
docker tag redis:vs1 redis:vs2

#通过Dockerfile创建镜像
docker build -t runoob/ubuntu:v1 .

#提交镜像(a:作者名，m:描述信息)
docker commit -a wuaiqiu -m sss mynginx nginx:vv1

#备份/恢复镜像
docker save -o my_ubuntu_v3.tar runoob/ubuntu:v3
docker load -i ubuntu.tar
```

## 三.Dockerfile文件

```
#第一行必须指令基于的基础镜像
FROM ubuntu

#维护者信息
MAINTAINER docker_user docker_user@mail.com

#指定环境变量
ENV PATH /usr/local/postgres-$PG_MAJOR/bin:$PATH

#将本地文件夹挂载到container中(宿主机目录随机生成，或用-v指定容器目录)
VOLUME ["/tmp"]

#镜像的构造指令(一般用于安装软件，构建只读层，只能叠加因此通常一句完成，shell风格)
RUN apt-get update && apt-get install -y ngnix
RUN echo "\ndaemon off;">>/etc/ngnix/nignix.conf

#添加本地/远程文件(只在build镜像的时候运行，支持自动解压tar)
ADD /home/wu/wrodpress.tar  /srv/www

#添加本地文件(只在build镜像的时候运行，不支持自动解压tar)
COPY /home/wu/wrodpress  /srv/www

#容器启动时执行指令(一个Dockerfile中只能有一条CMD命令，多条则只执行最后一条CMD，可以被docker run覆盖，shell风格与exec风格)
CMD /usr/sbin/ngnix
CMD ["/usr/sbin/nginx"]

#容器启动时执行指令(一个Dockerfile中只能有一条ENTRYPOINT命令，多条则只执行最后一条ENTRYPOINT，不可以被docker run覆盖，shell风格与exec风格)
ENTRYPOINT /usr/sbin/nginx
ENTRYPOINT ["/usr/sbin/nginx"]

#CMD与ENTRYPOINT联合使用
CMD ["Hello"]
ENTRYPOINT ["/bin/echo"]

#指定运行用户(默认root)
USER deamon

#切换工作目录(类似cd，对RUN,CMD,ENTRYPOINT生效)
WORKDIR /path/to/workdir

#配置当前所创建的镜像作为其它新创建镜像的基础镜像时，所执行的操作指令
ONBUILD echo "Hello welcome to use this images"

#Docker服务端容器暴露的端口号(宿主机在bridge模式下还需做端口映射)
EXPOSE 22
```
