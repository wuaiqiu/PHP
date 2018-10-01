# 拓扑排序


现在你总共有n门课需要选，记为0到n-1。在选修某些课程之前需要一些先修课程。例如，想要学习课程0，你需要先完成课程1，我们用一个匹配来表示他们:[0,1],给定课程总量以及它们的先决条件，返回你为了学完所有课程所安排的学习顺序。可能会有多个正确的顺序，你只要返回一种就可以了。如果不可能完成所有课程，返回一个空数组。

```
输入:
n=2
[[1,0]]
```

```
输出:
[0,1]
```

#### 分析

a.拓扑排序的本质是不断输出入度为0的点，该算法可用于判断图中是否存在环。

b.可以用队列保存入度为0的点，避免每次遍历所有点。

####  源码

```cpp
vector<int> findOrder(int numCourses, vector<pair<int, int>>& prerequisites) {
	//定义输出数组
	vector<int> res;
	//定义course入度
	vector<int> degress(numCourses, 0);
	//定义course邻接矩阵
	vector<vector<int>> graph(numCourses * 2);
	//定义course入度为0的列队
	queue<int> q;
	//初始化邻接矩阵
	for (int i = 0; i < numCourses; i++)
		for (int j = 0; j < numCourses; j++)
			graph[i].push_back(0);
	//读取prerequisites以及其入度
	for (size_t i = 0; i < prerequisites.size(); i++) {
		graph[prerequisites[i].second][prerequisites[i].first] = 1;
		degress[prerequisites[i].first]++;
	}
	//当入度为0时，入队
	for (size_t i = 0; i < degress.size(); i++) {
		if (degress[i] == 0)
			q.push(i);
	}
	//出队以及入度减小
	while (!q.empty()) {
		int current = q.front();
		q.pop();
		res.push_back(current);
		for (int i = 0; i < numCourses; i++) {
			if (graph[current][i] != 0) {
				degress[i]--;
				if (degress[i] == 0)
					q.push(i);
			}
		}
	}
	//当结点入度不为零时，则存在环
	for (int i = 0; i < numCourses; ++i){
		if (degress[i] > 0) {
			res.clear();
			break;
		}
	}
	return res;
}
```
