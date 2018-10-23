# 最长回文子串(Manacher算法,马拉车算法)


给定字符串str，若子串s是回文串，称s为str的回文子串，设计算法，计算str的最长回文子串。

### 分析

a.因为回文串有奇数与偶数的不同，判断一个串是否是回文串，往往要分开编写，造成代码的拖沓。当在一个字符串之间，首部与尾部加上gap，则不需要考虑奇偶问题。

b.P[i]来记录以字符S[i]为中心的最长回文子串向左/右扩张的长度:

```
S # 1 # 2 # 2 # 1 # 2 # 3 # 2 # 1 #
P 1 2 1 2 5 2 1 4 1 2 1 6 1 2 1 2 1
```

c.当求位置为i的P[i]时，可以利用前面P[0]~P[i-1]计算节省向左/右扩张的循环次数，其中P[k]+k最大(可到达最右边)记做mx=(k,P[k],P[k]+k)。

d.记i的对称点j=2k-i，满足mx-i>=P[j],则P[i]=P[j];记i的对称点j=2k-i,满足mx-i<P[j],则P[i]>=P[j];

### 源码

```cpp
void Manacher(string &S,vector<int> &P){
    P[0]=1;
    //初始化最大范围k，mx
    int k=0,mx=1;
    for(int i=1;i<S.size();i++){
        if(mx>i){
            //当在mx范围内
            P[i]=min(P[2*k-i],mx-i);
        }else{
            //当不在mx范围内
            P[i]=1;
        }
        //继续向左/右扩展
        for(;S[i+P[i]]==S[i-P[i]];P[i]++);
        //更新mx三元组
        if(mx<i+P[i]){
            mx=i+P[i];
            k=i;
        }
    }
}
```