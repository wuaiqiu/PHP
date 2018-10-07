# 寻找和为定值的两个数


给定N个不同的数A[0...N-1]以及某个定值sum，找到这N个数中的两个数，使得他们的和为sum。

```
输入:
0 3 7 9 11 14 16 17
sum=20
```

```
输出:
3 17
9 11
```

#### 分析

如果数组是无序的，先排序，然后用两个指针i，j各自指向数组的首尾两端，令i=0，j=n-1，然后i++，j--，逐次判断a[i][j]是否等于sum。

```
1).若a[i]+a[j]>sum，则i不变，j--；
2).若a[i]+a[j]<sum，则i++，j不变；
3).若a[i]+a[j]==sum，如果只要求输出一个结果，则退出，否则，输出结果后i++，j--;
```

#### 源码

```cpp
void TwoSum(vector<int> &arr, int target) {
    int i = 0, j = static_cast<int>(arr.size() - 1);
    //先排序
    sort(arr.begin(), arr.end());
    while (i < j) {
        if (arr[i] + arr[j] < target) {
            i++;
        } else if (arr[i] + arr[j] > target) {
            j--;
        } else {
            cout << arr[i] << "," << arr[j] << endl;
            i++;
            j--;
        }
    }
}
```
