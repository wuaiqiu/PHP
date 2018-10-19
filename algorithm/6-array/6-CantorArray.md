# Cantor数组


已知数组A[0...N-1]，现有统计后缀数组A[i+1...N-1]中小于元素A[i]的数目，并存放在数组C[i]中。C[0...N-1]为Cantor数组。

```
输入:
4 6 2 5 3 1
```

```
输出:
3 4 1 2 1 0
```

### 源码

```cpp
void Cantor(vector<int> &arr, vector<int> &ret) {
    size_t i, j;
    for (i = 0; i < arr.size(); i++) {
        //初始化Cantor数组
        ret[i] = 0;
        //计算Cantor数组
        for (j = i + 1; j < arr.size(); j++) {
            if (arr[j] < arr[i])
                ret[i]++;
        }
    }
}
```
