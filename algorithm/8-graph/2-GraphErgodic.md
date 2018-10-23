# 图的遍历


![](../img/47.png)

## BFS(Breadth First Search)广度优先遍历

![](../img/46.png)

```cpp
//链表节点定义
struct ArcNode {
    int index; //下标
    ArcNode *next; //下一节点
};
struct Graph {
    ArcNode list[5];
    int vexnum, arcnum;
};

//广度遍历
void BFS(Graph &G, int i) {
    queue<int> q;//初始化一个队列
    q.push(i); //进队
    vector<int> visited(5, 0);//0表示没有访问，1表示访问过
    visited[i] = 1;//i被访问过
    ArcNode *temp = nullptr;
    while (!q.empty()) {
        int v = q.front();
        q.pop();//出队
        cout << v << "-->";
        temp = G.list[v].next;
        while (temp) {
            if (!visited[temp->index]) {
                q.push(temp->index); //进队
                visited[temp->index] = 1; //标记已经访问过
            }
            temp = temp->next;
        }
    }
}
```

## DFS(Depth First Search)深度优先遍历

![](../img/45.png)

```cpp
//链表节点定义
struct ArcNode {
    int index; //下标
    ArcNode *next; //下一节点
};
struct Graph {
    ArcNode list[5];
    int vexnum, arcnum;
};

//深度遍历
void DFS(Graph &G, int i, vector<int> &visited) {
    ArcNode *temp = nullptr;
    visited[i] = 1;
    cout << i << "-->";
    temp = G.list[i].next;
    while (temp) {
        if (!visited[temp->index])
            DFS(G, temp->index, visited);
        temp = temp->next;
    }
}
```
