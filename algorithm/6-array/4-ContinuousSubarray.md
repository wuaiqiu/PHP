# 零子数组


对于长度为N的数组A，求连续子数组的和最接近0的值。

### 分析

a.申请比A长1的空间sum[0...N]，sum[i]是A的前i项和。

b.对sum[0...N]进行排序，然后计算sum相邻元素的差的绝对值，最小值即为所求(其中一段子数组)。

### 源码

```cpp
int MinSubarray(vector<int> &arr) {
    //初始化
    vector<int> sum(arr.size() + 1, 0);
    int ret = 0;
    //求sum数组
    for (size_t i = 0; i < arr.size(); i++) {
        sum[i + 1] = sum[i] + arr[i];
    }
    //求排序后sum相邻元素绝对差最小的值
    sort(sum.begin(), sum.end());
    for (size_t i = 0; i < arr.size(); i++) {
        ret = min(abs(sum[i + 1] - sum[i]), ret);
    }
    return ret;
}
```


# 最大连续子数组


给定一个数组A[0...n-1]，求A的连续子数组，使得该子数组的和最大。

```
输入:
1 -2 3 10 -4 7 2 -5
```

```
输出:
3 10 -4 7 2
```

### 分析

a.记S[i]为以A[i]结束的数组中和最大的子数组，S[0]=A[0]。

b.S[i+1]=max(S[i]+A[i+1],A[i+1])

### 源码

```cpp
//求连续子数组最大和
int MaxSubarray(vector<int> &arr) {
    int sum = arr[0];//当前子串和
    int ret = sum;//记录最优解
    for (size_t i = 1; i < arr.size(); i++) {
        if (sum > 0)
            sum += arr[i];
        else
            sum = arr[i];
        ret = max(sum, ret);
    }
    return ret;
}
```

```cpp
//记录子数组
int MaxSubarray(vector<int> &arr, int &from, int &to) {
    from = to = 0;
    int sum = arr[0];//当前子串和
    int ret = sum;//记录最优解
    int fromNew; //新的子数组起点
    for (size_t i = 1; i < arr.size(); i++) {
        if (sum > 0) {
            sum += arr[i];
        } else {
            sum = arr[i];
            fromNew = i;
        }
        if (ret < sum) {
            ret = sum;
            from = fromNew;
            to = i;
        }
    }
    return ret;
}
```

# 数字连续的子数组


给定长度为N的数组A[0...N-1]，求递增且连续数字最长的子数组。

```
输入:
1,2,3,34,56,57,58,59,60,61,99,121
```

```
输出:
56,57,58,59,60,61
```

### 分析

a.利用一个与A等长的数组P来记录连续递增的序列个数。

### 源码

```cpp
//记录连续序列个数
int MaxSequence(vector<int> &arr) {
    //记录长度数组
    vector<int> p(arr.size(), 1);
    int ret = 1;
    for (size_t i = 1; i < arr.size(); i++) {
        //当连续时
        if (arr[i] - arr[i - 1] == 1) {
            p[i] += p[i - 1];
            ret = max(p[i], ret);
        }
    }
    return ret;
}
```

```cpp
//记录子序列
int MaxSequence(vector<int> &arr, int &from, int &to) {
    //记录长度数组
    vector<int> p(arr.size(), 1);
    int ret = 1;
    from = to = 0;
    for (size_t i = 0; i < arr.size(); i++) {
        //当连续时
        if (arr[i] - arr[i - 1] == 1) {
            p[i] += p[i - 1];
            ret = max(p[i], ret);
            to = i;
        }
    }
    from = to - ret + 1;
    return ret;
}
```
