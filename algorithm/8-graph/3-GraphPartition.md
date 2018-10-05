# 图的划分


某个国家有N个小岛组成，经过多年的基础设施积累，若干岛屿之间建立了若干桥梁。先重新完善该国的行政区划分，规定只要有桥梁连接的岛屿则归属同一个城市，问该国一共有多少个城市。

#### 分析

a.合并集:将所有结点的父节点改为该节点的祖父结点，以此完成一个集合的合并。

#### 源码

```cpp
//查找i结点的祖父结点
int Find(vector<int> &sup, int i) {
    if ((i < 0) || (i >= sup.size()))
        return -1;
    //找出结点i的祖父节点
    int root = i;
    while (root != sup[root])
        root = sup[root];
    //将i至root之间的结点的祖父结点指向root
    int current = i;
    while (current != root) {
        int parent = sup[current];
        sup[current] = root;
        current = parent;
    }
    return root;
}

//将j结点祖父改变为指向i结点的祖父
void Union(vector<int> &sup, int i, int j) {
    if ((i < 0) || (i >= sup.size()) || (j < 0) || (j >= sup.size()))
        return;
    int ri = Find(sup, i);
    int rj = Find(sup, j);
    if (ri != rj)
        sup[ri] = rj;
}

//统计
int Count(vector<int> &sup) {
    vector<int> sum(sup.size(), 0);
    for (int i = 0; i < sup.size(); i++)
        sum[Find(sup, i)]++;
    int ret = 0;
    for (int i = 0; i < sup.size(); i++) {
        if (sum[i] != 0)
            ret++;
    }
    return ret;
}
```
