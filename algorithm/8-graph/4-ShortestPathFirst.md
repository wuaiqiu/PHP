# Dijkstra算法


![](../img/48.png)

迪科斯彻算法使用了广度优先搜索解决加权有向图或者无向图的单源最短路径问题（源点到各个节点的最短距离），算法最终得到一个最短路径树。该算法常用于路由算法。

![](../img/49.png)

### 分析

算法思想:Dijkstra算法采用的是一种贪心的策略，声明一个数组dist来保存源点到各个顶点的最短距离和一个保存已经找到了最短路径的顶点的集合S,初始时，原点s0的路径权重被赋为0(dist[s0] = 0)。若对于顶点s存在能直接到达的点m，则把dist[m]设为w(s, m)，同时把所有其他(s不能直接到达的)顶点的路径长度设为无穷大。然后，又从dist中找出最小值，重复上述动作，直到S中包含了图的所有顶点。


### 源码

```cpp
void Dijkstra(vector<vector<int>> &graph, int S, vector<int> &dist) {
    //标记结点是否访问过
    vector<bool> flag(graph.size(), false);
    //第一轮确定最小路径(S结点)
    dist = graph[S];
    dist[S] = 0;
    flag[S] = true;
    //第i轮确定最小路径
    for (size_t i = 1; i < graph.size(); i++) {
        //记录最小值mn，索引pos
        int pos = -1, mn = -1;
        //遍历寻找最小值mn，索引
        for (size_t j = 0; j < graph.size(); j++) {
            if (flag[j])
                continue;
            if ((mn < 0) || (mn > dist[j])) {
                mn = dist[j];
                pos = static_cast<int>(j);
            }
        }
        //访问最小结点pos，并更新dist
        flag[pos] = true;
        for (size_t j = 0; j < graph.size(); j++) {
            if (flag[j])
                continue;
            dist[j] = min(dist[j], dist[pos] + graph[pos][j]);
        }
    }
}
```


# Floyd算法


弗洛伊德算法是解决任意两点间的最短路径的一种算法，可以正确处理有向图或无向图或负权的最短路径问题。

### 分析

算法思想:通过Floyd计算图各个顶点的最短路径时，需要引入矩阵D中的元素a[i][j]表示顶点i到顶点j的距离。如果图G中顶点个数为N，则需要对矩阵D进行N次更新。初始时，矩阵D中顶点a[i][j]的距离为顶点i到顶点j的权值；如果i和j不相邻，则a[i][j]=∞，接下来第1次更新时，如果a[i][j]> a[i][0]+a[0][j]，则更新a[i][j]为a[i][0]+a[0][j], 同理，第k次更新时，如果a[i][j]> a[i][k-1]+a[k-1][j]，则更新a[i][j]=a[i][k-1]+a[k-1][j]。更新N次之后，操作完成！

![](../img/50.png)

![](../img/51.png)

### 源码

```cpp
void Floyd(vector<vector<int>> &graph,vector<vector<int>> &D){
    D=graph;
    for(size_t k = 0;k<graph.size();k++){
        for(size_t i=0;i<graph.size();i++){
            for(size_t j=0;j<graph.size();j++){
                if(D[i][j]>D[i][k]+D[k][j])
                    D[i][j]=D[i][k]+D[k][j];
            }
        }
    }
}
```


# Bellman-Ford算法


Bellman-Ford算法是一种解决单源点到其它节点的最短路径算法(包含负权)，解决Dijkstra算法不能有负权的问题:

>当把一个节点选入集合S时，即意味着已经找到了从源点到这个点的最短路径，但若存在负权边，就与这个前提矛盾，可能会出现得出的距离加上负权后比已经得到S中的最短路径还短。（无法回溯）


它的原理是对图进行V-1次松弛(迭代)操作，得到所有可能的最短路径。其优于Dijkstra算法的方面是边的权值可以为负数、实现简单，缺点是时间复杂度过高，高达O(VE)。

### 分析

a.创建源顶点v到图中所有顶点的距离的集合dist，初始均为Infinite，源顶点距离为0；

b.计算最短路径，执行graph.size()-1次遍历；对于图中的每条边：如果起点j的距离dist[j]加上边的权值graph[j][k]小于终点k的距离dist[k](dist[k] > dist[k] + graph[j][k])，则更新终点k的距离值dist[k]；

c.检测图中是否有负权边形成了环，遍历图中的所有边，计算j至k的距离，如果对于k存在更小的距离，则说明存在环；

### 源码

```cpp
bool BellmanFord(vector<vector<int>> &graph, vector<int> &dist) {
    //初始化dist[0]
    dist[0] = 0;
    //遍历数目graph.size()-1,即为松弛操作
    for (int i = 0; i < graph.size()-1; i++) {
        //处理每条边
        for (int j = 0; j < graph.size(); j++) {
            for (int k = 0; k < graph.size(); k++) {
                if (dist[k] > dist[j] + graph[j][k])
                    dist[k] = dist[j] + graph[j][k];
            }
        }
    }
    //检测是否存在负环
    for (int j = 0; j < graph.size(); j++) {
        for (int k = 0; k < graph.size(); k++) {
            if (dist[k] > dist[j] + graph[j][k])
                return false;
        }
    }
    return true;
}
```


# SPFA算法


SPFA算法是Bellman-Ford算法的队列优化算法。

![](../img/52.png)

### 分析

算法思路:我们用数组dist记录每个结点的最短路径估计值，设立一个先进先出的队列用来保存待优化的结点，优化时每次取出队首结点u，并且用u点当前的最短路径估计值对离开u点所指向的结点v进行更新操作，如果v点的最短路径估计值小则更新，且v点不在当前的队列中，就将v点放入队尾。这样不断从队列中取出结点来进行更新操作，直至队列空为止。

### 源码

```cpp
void SPFA(vector<vector<int>> &graph, vector<int> &dist) {
    //初始化队列，dist数组
    dist[0] = 0;
    queue<int> q;
    q.push(0);
    //当栈不为空时
    while (!q.empty()) {
        //出栈
        int current = q.front();
        q.pop();
        for (size_t i = 0; i < dist.size(); i++) {
            //当dist[i]>dist[current]+graph[current][i]时，执行更新
            if (dist[i] > dist[current] + graph[current][i]) {
                dist[i] = dist[current] + graph[current][i];
                //当列队中不存在节点i时则进队
                if(find(q.begin(),q.end(),i)!=q.end())
                    q.push(i);
            }
        }
    }
}
```
