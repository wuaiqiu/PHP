# docker-swarm

>Docker Swarm为Docker容器提供了原生的集群，它将多个Docker引擎的资源汇聚在一起，并提供Docker标准的API，使Docker可以轻松扩展到多台主机，除加入集群与离开集群指令外，全部有manager执行

>集群管理

```
#swarm集群初始化(--advertise-addr <MANAGER-IP>:指定网卡IP)
docker swarm init --listen-addr <MANAGER-IP>:<PORT>

#加入swarm集群(--listen-addr <WORKER-IP>:<PORT>:备选manager)
docker swarm join --token <MANAGER-TOKEN> <MANAGER-IP>:<PORT>

#从manager获取称为manager的token
docker swarm join-token manager

#离开swarm集群
docker swarm leave
```

>节点管理

```
#查看swarm所有节点
docker node ls

#查看swam节点详细信息
docker node inspect node_name

#降级swarm管理节点
docker node demote node_name

#升级swarm工作节点
docker node promote node_name

#删除节点
docker node rm node_name

#列出所有节点的运行的服务
docker node ps
```

>服务管理

```
#创建服务并随机部署在集群上，指定服务个数，并使用跨主机网络overlay
docker service create --replicas 2 --name service_name --network overlay_name nginx

#查看创建的服务列表
docker service ls

#查看服务详细信息
docker service inspect server_name

#查看服务运行状态
docker service ps service_name

#删除服务
docker service rm service_name

#改变服务数量
docker service scale service_name=3
```
