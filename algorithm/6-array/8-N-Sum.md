# 子集和数问题


已知数组arr[0...N-1]，给定某数值target，找出数组中的若干个数，使得这些数的和为target。

### 分析

使用布尔向量flag[0...N-1]，当flag[i]=false表示不取arr[i]，当flag[i]=true时表示取arr[i]。然后采用递归方式即可。

### 源码

```cpp
//arr为待求数组，flag为辅助数组，i为数组下标，sum为前i-1项和，target为目标数
void EnumNumber(vector<int> &arr, vector<bool> &flag, int i, int sum, int target) {
    //递归结束条件
    if (i >= arr.size())return;
    //当找到target时
    if (sum + arr[i] == target) {
        flag[i] = true;
        for (auto a :flag)
            cout << a << " ";
        cout << endl;
        flag[i] = false;
    }
    //进行递归
    flag[i] = true;
    EnumNumber(arr, flag, i + 1, sum + arr[i], target);
    flag[i] = false;
    EnumNumber(arr, flag, i + 1, sum, target);
}
```