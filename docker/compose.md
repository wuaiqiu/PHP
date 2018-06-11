# docker-compose

>Compose是用来编排和管理多容器服务的工具

**1.命令**

>全局配置

```
-f:用于指定Compose的配置文件
-p:用于给项目指定一个名称，默认为目录名
-v:显示版本号
```

>docker服务操作

```
#下载服务所有的所需镜像
docker-compose pull

#创建所有镜像镜像(镜像名:projectName_serviceName)
docker-compose build

#创建并运行所有服务(服务名:projectName_serviceName_n)
docker-compose up --scale web=3 --scale redis=4 -d

#停止并移除所有服务
docekr-compose down

#开启服务对应的所有容器
docker-compose start web

#重启服务对应的所有容器
docker-compose restart web

#停止服务对应的所有容器
docker-compose stop web

#强行停止服务对应的所有容器
docker-compose kill web

#暂停服务对应的所有容器
docker-compose pause web

#恢复被暂停的服务对应的所有容器
docker-compose unpause web

#显示当前项目下的服务(包含Exited)
docker-compose ps

#删除停止的服务对应的所有容器
docker-compose rm web

#命令用于展示服务的日志
docker-compose logs web

#列出本地服务所使用的镜像
docker-compose images

#查看compose配置文件
docker-compose config

#显示服务的进程
docker-compose top web

#进入交互式
docker-compose exec web /bin/bash
```

<br>

**2.配置文件**

>docker-compose.yml

```
#服务名
web:
  #指定Dockerfile文件的目录
  build: .
  #用于指定服务使用的镜像(不能与build一起使用)
  image: ubuntu
  #覆盖Dockerfile中的CMD命令
  command: ls -l
  #指定容器名称(则不能使用scale参数)
  container_name: my-web-container
  #通过文件添加环境变量
  env_file: .env
  #手动添加环境变量
  environment:  
    -RACK_ENV: development
    -SHOW: 'true'
  #对外暴露端口(在bridge模式下需要端口映射)
  expose:
    - "3000"
    - "8000"
  #指令用于向容器hosts添加IP到主机名的映射
  extra_hosts:
    - "somehost:162.242.195.82"
    - "otherhost:50.31.209.229"
  #用于连接到其他服务的容器
  links:
    - db
    - db:database
    - redis
  #为服务容器指定网络模式
  net: "bridge"
  net: "none"
  net: "container:[name or id]"
  net: "host"
  #对外暴露接口
  ports:
    - "3000"
    - "3000-3005"
    - "8000:8000"
  #向容器添加卷
  volumes:
    - /var/lib/mysql
    - cache:/tmp/cache
```
