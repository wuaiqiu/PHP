# 荷兰国旗问题


现有红，白，蓝三个不同颜色的小球，乱序排列在一起，请重新排列这些小球，使得红白蓝三色的同颜色的球在一起。


#### 分析

a.给定一个数组A[0...N-1]，元素只能取0(红),1(白),2(蓝)，转化为设计一个算法使得A[0,...,1,...,2,...]形式。

b.借鉴快速排序中partition的过程，定义三个指针:begin=0,current=0,end=N-1;

c.可以得出[0...begin]为0，[begin...current]为1，[current...end]未知，[end...N-1]为2；

```
1).A[current]==2，则A[current]与A[end]交换，end--；
2).A[current]==1，则current++；
3).A[current]==0，若begin==current，则begin++，current++；若begin!=current，则A[current]与A[begin]交换，
begin++，current++。
```

#### 源码

```cpp
void Holland(vector<int> &arr) {
    int begin = 0, current = 0, end = static_cast<int>(arr.size() - 1);
    while (current <= end) {
        if (arr[current] == 2) {
            //当arr[current]==2时
            swap(arr[end], arr[current]);
            end--;
        } else if (arr[current] == 1) {
            //当arr[current]==1时
            current++;
        } else {
            //当arr[current]==0时
            if (begin != current)
                swap(arr[current], arr[begin]);
            begin++;
            current++;
        }
    }
}
```
