# 股票最大收益 I


给定数组A[0...N-1]，其中A[i]表示某股票第i天的价格，如果允许最多只进行一次交易(先买一次，再卖一次)，计算何时买卖达到最大收益，返回最大收益值。

```
输入:
7 1 5 3 6 4
```

```
输出:
5
```

#### 分析

若在第i天卖出，则应该在A[0...i-1]中的最小值买入。则设第i天的收益为p[i]，则状态方程为:

```
p[i]=A[i]-min(A[0...i-1])
```

#### 源码

```cpp
int MaxProfit(vector<int> &prices) {
    int p = 0; //最大收益
    int mn = prices[0]; //买入的最小值
    //当卖出时间为i,从prices[0...i-1]找出最小值作为买入时间
    for (int i = 1; i < prices.size(); i++) {
        mn = min(mn, prices[i - 1]);
        p = max(p, prices[i] - mn);
    }
    return p;
}
```

# 股票最大收益 II


给定数组A[0...N-1]，其中A[i]表示某股票第i天的价格，如果允许最多只进行k次交易(先买一次，再卖一次)，计算何时买卖达到最大收益，返回最大收益值。规定买卖不能嵌套。

```
输入:
7 1 5 3 6 4
k=3
```

```
输出:
7
```

#### 分析

a.dp[k][i]表示最多k次交易在第i天的最大收益。

b.在第i天，有两种选择：要么卖出股票(dp[k][i]=dp[k-1][j]+prices[i]-prices[j],0<=j<=i-1)，要么不卖出股票(dp[k][i]=dp[k][i-1])，从而得到状态方程:

```
dp[k][i]=max(dp[k][i-1],dp[k-1][j]+prices[i]-prices[j])
```

#### 源码

```cpp
int MaxProfit(vector<int> &prices, int K) {
    //初始化dp[k][i]数组
    vector<vector<int>> dp(K + 1, vector<int>(prices.size(), 0));
    //进行k次交易(1<=k<=3)
    for (int k = 1; k <= K; k++) {
        for (int i = 0; i < prices.size(); i++) {
            //当什么都不做时
            dp[k][i] = dp[k][i - 1];
            //当卖出股票时
            for (int j = 0; j < i; j++)
                dp[k][i] = max(dp[k][i], dp[k - 1][j] + prices[i] - prices[j]);
        }
    }
    //返回dp数组最后一个元素即为所求
    return dp[K][prices.size() - 1];
}
```
