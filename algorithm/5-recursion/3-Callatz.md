# Callatz猜想


Callatz猜想又称3n+1猜想，角谷猜想，哈色猜想等；给定某个正整数N，若为偶数，则N被更新为N/2；否则N被更新为3*N+1；问经过多少步N变成1。

### 源码

```cpp
//N为待求数，arr为存储数组
void Calc(int N, vector<int> &arr) {
    int tmp = N, t = 0;
    while (true) {
        //进行Callatz操作
        if (tmp % 2 == 0) {
            tmp /= 2;
            t++;
        } else {
            N = tmp * 3 + 1;
            t++;
        }
        //当tmp在数组中
        if ((tmp < arr.size()) && (arr[tmp] != -1)) {
            arr[N] = arr[tmp] + t;
            break;
        }
        //当tmp不在数组中
        if (tmp == 1) {
            arr[N] = t;
            break;
        }
    }
}
```