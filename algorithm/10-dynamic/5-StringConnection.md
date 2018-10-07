# 字符串交替连接


输入三个字符串s1，s2和s3，判断第三个字符串s3是否由前两个字符串s1和s2交错而成，即不改变s1和s2中各个字符原有的相对顺序，例如s1="aabcc",s2="dbbca",s3="aadbbcbcac"时，则输出true，但如果s3="accabdbbca"，则输出false；

#### 分析

为了算法表述方便，从1开始数（构成[0...i]×[0....j]的矩阵）:令dp[i,j]表示s3[1...i+j]是否由s1[1...i]和s2[1...j]的字符组成，即dp[i,j]取值范围为true/false;

```
1).s1[i]==s3[i+j]且dp[i-1,j]为true，则dp[i][j]为true；
2).s2[j]==s3[i+j]且dp[i,j-1]为true，则dp[i][j]为true；
3).其它情况，dp[i][j]为false。
```

#### 源码

```cpp
bool IsInterlace(string &s1, string &s2, string &s3) {
    //如果长度不相等，返回false
    if (s1.size() + s2.size() != s3.size())
        return false;
    //初始化dp[0...s1.size()][0...s2.size()]数组
    vector<vector<bool>> dp(s1.size() + 1, vector<bool>(s2.size()) + 1);
    dp[0][0] = true;
    for (int i = 1; i <= s1.size(); i++) //首列
        dp[i][0] = dp[i - 1][0] && s1[i - 1] == s3[i - 1];
    for (int j = 1; j <= s2.size(); j++)//首行
        dp[0][j] = dp[0][j - 1] && s2[j - 1] == s3[j - 1];
    //计算dp数组的其它部分
    for (int i = 1; i < s1.size(); i++) {
        for (int j = 1; j < s2.size(); j++) {
            dp[i][j] = (dp[i - 1][j] && s3[i + j - 1] == s1[i - 1]) ||
                       (dp[i][j - 1] && s3[i + j - 1] == s2[j - 1]);
        }
    }
    return dp[s1.size()][s2.size()];
}
```
