# 绝对众数


给定N个数，称出现次数最多的数为众数；若某众数出现的次数大于N/2，称该众数为绝对众数。已知给定的N个整数存在绝对众数，以最低的时间复杂度计算该绝对众数。

```
输入:
1 2 1 3 1
```

```
输出:
1
```

#### 分析

a.绝对众数在数组的个数大于N/2，则删除数组任意两个不同的数，绝对众数依然大于剩下元素的一半。

b.算法描述:

```
1).记m为绝对众数，出现次数为c；
2).遍历数组A:若c==0，则m=A[i]；若c!=0且m==A[i]，则c++；若c!=0且m!=A[i]，则c--；
```

#### 源码

```cpp
int getMode(vector<int> &arr) {
    //初始化
    int c = 0, m = arr[0];
    for (size_t i = 0; i<arr.size() ; i++) {
        if (c == 0) {
            //当c==0时    
            m = arr[i];
            c = 1;
        } else if (m != arr[i]) {
            //当c!=0且m!=arr[i]
            c--;
        } else {
            //当c!=0且m==arr[i]
            c++;
        }
    }
    return m;
}
```

#1/3众数


给定N个整数，查找出现次数超过N/3次的所有可能的数。

#### 分析

a.一个数组中的1/3众数不会超过2个。

b.算法描述:

```
1).记m,n为绝对众数，出现次数为cm,cn；
2).遍历数组A:若cm==0，则m=A[i]；若cn==0，则n=A[i]。若cm!=0且m==A[i]，则cm++；
若cn!=0且n==A[i]，则cn++。若cm!=0且cn!=0且m!=A[i]且n!=A[i]，则cm--,cn--；
```

#### 源码

```cpp
void getMode(vector<int> &arr, vector<int> &ret) {
    //初始化
    int m, n;
    int cm = 0, cn = 0;
    for (size_t i = 0; i < arr.size(); i++) {
        if (cm == 0) {
            //当cm==0时
            m = arr[i];
            cm = 1;
        } else if (cn == 0) {
            //当cn==0时
            n = arr[i];
            cn = 1;
        } else if (m == arr[i]) {
            //当cm!=0且cn!=0，m==arr[i]时
            cm++;
        } else if (n == arr[i]) {
            //当cm!=0且cn!=0，n==arr[i]时
            cn++;
        } else {
            //当cm!=0且cn!=0，m!=arr[i]且n!=arr[i]
            cm--;
            cn--;
        }
    }
    ret.push_back(m);
    ret.push_back(n);
}
```
