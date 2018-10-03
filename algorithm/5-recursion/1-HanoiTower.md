# hanoi塔


![](../img/6.png)

有三根相邻的柱子，标号为A,B,C，A柱子上按从小到大叠放着n个不同大小的盘子，要求把所有盘子每次移动一个，最终放到C柱子上；移动过程中可以借助B柱子，但要求每次移动中必须保持小盘子在大盘子的上面。比如n=10，请给出最少次数的移动方案。

#### 分析

a.N个盘子的Hanoi塔，至少需要几次移动:2^N-1

```
T(n)=2T(n-1)+1
T(n)+1=2(T(n-1)+1)
q=(T(n)+1)/(T(n-1)+1)=2
T(1)=1
Sn=T(1)*(1-q^n)/(1-q)=2^n-1
```

#### 源码

```cpp
//将1个盘从from柱移动到to柱
void moveOne(char from,char to){
    cout<<from<<"-->"<<to<<endl;
}

//将n个盘从from柱移动到to柱，以aux为辅助柱
void move(char from,char to,char aux,int n){
    if(n==1){
        moveOne(from,to);
        return;
    }
    move(from,aux,to,n-1);
    moveOne(from,to);
    move(aux,to,from,n-1);
}
```
