# 找零钱问题


给定某不超过100万元的现金总额，换成数量不限的100,50,20,10,5,2,1元的纸币组合，共有多少种组合。

### 分析

a.定义dp[i][j]：使用面额小于等于i的钱币，凑成j元钱，共有多少种组合方法。可以分为用面额等于i的纸币dp[i][j]=dp[i][j-i]，或者不用面额等于i的纸币dp[i][j]=dp[ismall][j];

```
设:dom[]={1,2,5,10,20,50,100},dp[0][j]=1,dp[i][0]=1
当j>=dom[i]时：dp[i][j]=dp[i-1][j]+dp[i][j-dom[i]]
当j<dom[i]时：dp[i][j]=dp[i-1][j]
```

### 源码

```cpp
int Charge(int value) {
    //初始化dom数组
    vector<int> dom = {1, 2, 5, 10, 20, 50, 100};
    //初始化dp数组
    vector<vector<int>> dp(dom.size(), vector<int>(value + 1));
    //只用面额为1元
    for (int i = 0; i <= value; i++)
        dp[0][i] = 1;
    //从面额为2元开始到100结束
    for (int i = 1; i < dom.size(); i++) {
        dp[i][0] = 1;
        for (int j = 1; j <= value; j++) {
            if (j >= dom[i])
                dp[i][j] = dp[i - 1][j] + dp[i][j - dom[i]];
            else
                dp[i][j] = dp[i - 1][j];
        }
    }
    return dp[dom.size() - 1][value];
}
```
