# 第一个缺失的整数


给定一个数组A[0...N-1]，找到从1开始，第一个不在数组中的正整数。

```
输入:
3 5 1 2 -3 7 14 8
```

```
输出:
4
```

#### 分析

a.将找到的元素放在正确的位置上，如果最终发现某个元素一直没有找到，则该元素即为所求。

b.算法描述:

```
1).A[i]=i，i加1，继续比较后面的元素。
2).A[i]<i或A[i]>N或A[A[i]]=A[i]，丢弃A[i]。
3).A[i]>i，则将A[A[i]]和A[i]交换。
```

#### 源码

```cpp
int FirstMissingInteger(int *arr, int size) {
    //从1开始数
    arr--;
    int i = 1;
    while (i <= size) {
        if (arr[i] == i) {
            //当arr[i]=i
            i++;
        } else if ((arr[i] < i) || (arr[i] > size) || (arr[i] == arr[arr[i]])) {
            //arr[i]<i或arr[i]>N或arr[arr[i]]=arr[i]
            arr[i] = arr[size];
            size--;
        } else {
            //arr[i]>i
            swap(arr[arr[i]], arr[i]);
        }
    }
    return i;
}
```
