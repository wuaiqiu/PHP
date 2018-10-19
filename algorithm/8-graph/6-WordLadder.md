# 单词变换问题


给定字典和一个起点单词，一个终点单词，每次只能变换一个字母，问从起点单词是否可以到达终点单词。最短多少步。

### 分析

a.建立单词间的联系：图的结点为单词，若两个单词只有一个字母不同，则两单词间存在无向边；

b.从起始单词开始，广度优先搜索，计算能否到达终点单词。若可达，则这条路径上的变换是最快的。并且从起点单词到终点单词的路径内的单词必须在词典内，但起点和终点本身是无要求的。

### 源码

```cpp
//求出当前字符串cur的下一个可达结点childern集合
void Extend(string &cur, string &end, vector<string> &childern, set<string> &dict, set<string> &visit) {
    string child = cur;
    childern.clear();
    for (int i = 0; i < cur.size(); i++) {
        //替换cur其中一个字符
        char a = child[i];
        for (char c = 'a'; c != 'z'; c++) {
            if (c == a)
                continue;
            child[i] = c;
            //若替换字符后的child存在于dict或end，并且没有访问过时，更新childern集合与visit集合
            if (((child == end) || (dict.find(child) != dict.end())) && (visit.find(child) == visit.end())) {
                childern.push_back(child);
                visit.insert(child);
            }
        }
        child[i] = a;
    }
}

int CalcLadderLength(string &start, string &end, set<string> &dict) {
    //BFS搜索列队
    queue<string> q;
    q.push(start);
    //下一层可到达的结点
    vector<string> childern;
    //已经访问过的结点
    set<string> visit;
    //返回的步数
    int step = 0;
    //当前层剩余结点数目
    int curNumber = 1;
    //下一层结点数目
    int nextNumber = 0;
    while (!q.empty()) {
        //出栈
        string cur = q.front();
        q.pop();
        curNumber--;
        //求cur下一层可达结点childern集合
        Extend(cur, end, childern, dict, visit);
        nextNumber += childern.size();
        //当层结点访问完时
        if (curNumber == 0) {
            step++;
            curNumber = nextNumber;
            nextNumber = 0;
        }
        //遍历下一层可达结点
        for (auto it = childern.begin(); it != childern.end(); it++) {
            if (*it == end)
                return step;
            q.push(*it);
        }
    }
    return 0;
}
```
