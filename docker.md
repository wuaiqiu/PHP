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

(1)运行一个新容器 docker run

```
    docker run  ubuntu:15.10  /bin/echo "Hello world" 	#在容器中执行密码
	docker run -t  -i  ubuntu:15.10 /bin/bash
				    -t:在新容器内指定一个伪终端或终端。
				    -i:允许你对容器内的标准输入 (STDIN) 进行交互
    docker run -d ubuntu:15.10 /bin/sh  "while true; do echo hello world; sleep 1; done"
				    -d:后台模式

	docker run -d -P training/webapp python app.py	#运行一个web容器
				    -P 自动安排监听端口
				    -p Localhost:Container 自定义端口
     docker run -d --name wordpress -v "$PWD/":/var/www/html php:5.6-apache
                      --rm：停止运行后，自动删除容器文件。
                      --name wordpress：容器的名字叫做wordpress。
                      -v "$PWD/":/var/www/html：将当前目录（$PWD）映射到容器的/var/www/html
                      --env MYSQL_ROOT_PASSWORD=123456 :设置全局变量
                      --link wordpressdb:mysql，表示 WordPress 容器要连到wordpressdb容器，冒号表示该容器的主机名是mysql。
```

(2)查看后台容器

```
    docker ps 	#查看后台容器
    docker ps -l 	#查询最后一次创建的容器
		      -a	所有创建的容器
```

(3)容器操作

```
	docker logs	容器ID/容器名	#查看容器内的标准输出
	docker stop 	容器ID/容器名 	#停止容器
	docker start 容器ID/容器名	#启动容器
	docker restart 容器ID/容器名	#重启容器
    docker port 容器ID/容器名	    #查看容器端口的映射情况
    docker top 容器ID/容器名	    #查看容器后台进程
    docker rm  容器ID/容器名	    #删除容器，容器必须是停止状态-f可以强制
```

(4)镜像操作

```
    docker images 			#来列出本地主机上的镜像
    docker pull ubuntu:13.10	#预下载镜像
    docker search httpd		#查找镜像
    docker tag ubuntu:15.10 runoob/ubuntu:v3    #将镜像ubuntu:15.10标记为 runoob/ubuntu:v3 镜像
    docker commit -m="has update" -a="runoob" e218edb10161 runoob/ubuntu:v2		#修改后提交镜像
				-m:提交的描述信息
				-a:指定镜像作者
				e218edb10161：容器ID
				runoob/ubuntu:v2:指定要创建的目标镜像名
    docker build	-t runoob/centos:6.7 .		#根据Dorkerfile创建镜像
				-t ：指定要创建的目标镜像名
				. ：Dockerfile 文件所在目录
    docker rmi ubuntu:v2  	#删除本地镜像。
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

<br>

**六.docker登录操作**

```
docker login -u 用户名 -p 密码 registry.cn-hangzhou.aliyuncs.com
docker logout registry.cn-hangzhou.aliyuncs.com
docker push registry.cn-hangzhou.aliyuncs.com/myapache:v1
```