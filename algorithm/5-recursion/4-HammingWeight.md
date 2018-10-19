# 海明距离


给定一个32位无符号整数N，求整数N的二进制数中1的个数。

### 分析

1.思路一:每次右移一位，奇数则累加1。

2.思路二:每次最低位清0，只需要n&=(n-1)即可。

3.思路三:海明距离(HammingWeight),如果定义两个长度相等的0/1串中对应位不相等的个数为海明距离，则某0/1串和全串为0的海明距离即为这个0/1串中1的个数。使用分治/递归的思想，将32位分成两个16位(n&0x0000ffff + (n & 0xffff0000)>>16)分别计算，将16位分成两个8位(n&0x00ff00ff + (n&0xff00ff00)>>8)分别计算...直到1位时结束。

### 源码

```cpp
//思路一
int OneNumber(int n){
    int c=0;
    while(n!=0){
        //奇数则累加1
        c+=(n&1);
        n>>=1;
    }
    return c;
}
```

```cpp
//思路二
int OneNumber(int n){
    int c=0;
    while(n!=0){
        //最低为1的位清0
        n&=(n-1);
        c++;
    }
    return c;
}
```

```cpp
//海明距离
int HammingWeight(unsigned int n) {
    n = (n & 0x55555555) + ((n & 0xaaaaaaaa) >> 1);
    n = (n & 0x33333333) + ((n & 0xcccccccc) >> 2);
    n = (n & 0x0f0f0f0f) + ((n & 0xf0f0f0f0) >> 4);
    n = (n & 0x00ff00ff) + ((n & 0xff00ff00) >> 8);
    n = (n & 0x0000ffff) + ((n & 0xffff0000) >> 16);
    return n;
}
```