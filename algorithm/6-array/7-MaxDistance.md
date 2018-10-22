# 数组最大间隔


给定整数数组A[0...N-1]，求这N个数排序后最大间隔，如：1,7,14,9,4,13的最大间隔为4。

### 分析

将N个数用间距(max-min)/(N-1)分成N个区间，则落在同一区间内的数不可能有最大间距。统计后一个区间的最小值与前一个区间的最大值的差即可。若没有任何数落在某区间，则该区间无效，不参与统计。

### 源码

```cpp
struct Bucket {
    bool bValid;
    int nMin;
    int nMax;

    Bucket() : bValid(false) {}

    void add(int n) {
        if (!bValid) {
            //当区间不存在任何元素时
            nMin = nMax = n;
            bValid = true;
        } else {
            //当区间存在元素时，找出最值
            if (nMax < n)
                nMax = n;
            else if (nMin > n)
                nMin = n;
        }
    }
};

int CalcMaxGap(vector<int> &arr) {
    //初始化区间
    auto p = new Bucket[arr.size()];
    //求出最值
    int nMax = arr[0], nMin = arr[0];
    for (int i = 1; i < arr.size(); i++) {
        if (nMax < arr[i])
            nMax = arr[i];
        else if (nMin > arr[i])
            nMin = arr[i];
    }
    //依次将数据放入对应的区间中
    for (int i = 1; i < arr.size(); i++) {
        int n = (arr[i] - nMin) * arr.size() / (nMax - nMin);
        if (n >= arr.size())
            n = arr.size() - 1;
        p[n].add(arr[i]);
    }
    //计算相邻元素之间的最大距离gap
    int currnet = 0, next = 1, gap = (nMax - nMin) / arr.size();
    for (; next < arr.size(); next++) {
        if (p[next].bValid) {
            int tmp = p[next].nMin - p[currnet].nMax;
            if (gap < tmp)
                gap = tmp;
            currnet = next;
        }
    }
    return gap;
}
```