# 全排列I


给定一个没有重复数字的序列，返回其所有可能的全排列。

```
输入:
[1,2,3]
```

```
输出:
[
  [1,2,3],
  [1,3,2],
  [2,1,3],
  [2,3,1],
  [3,1,2],
  [3,2,1]
]
```

#### 源码

```cpp
void Permutaion(vector<vector<int>> &ret,vector<int> &arr,int n){
    //当n==arr.size()-1时
    if(n==arr.size()-1){
        ret.push_back(arr);
        return;
    }
    //当0=<n<=arr.size()-2时
    for(int i=n;i<arr.size();i++){
        swap(arr[i],arr[n]);
        Permutaion(ret,arr,n+1);
        swap(arr[i],arr[n]);
    }
}
```

# 全排列I


给定一个可包含重复数字的序列，返回所有不重复的全排列。

```
输入:
[1,1,2]
```

```
输出:
[
  [1,1,2],
  [1,2,1],
  [2,1,1]
]
```

#### 分析

a.只需要保证第i个字符(前)与第j个字符(后)交换时，要求[i,j)中没有与第j个字符相等的数即可。

#### 源码

```cpp
//判断数组arr中[from,to)区间是否有与arr[to]相等的值
bool IsDuplicate(vector<int> arr,int from,int to){
    while(from<to){
        if(arr[from]==arr[to])
            return false;
        from++;
    }
    return true;
}

void Permutaion(vector<vector<int>> &ret,vector<int> &arr,int n){
    //当n==arr.size()-1时
    if(n==arr.size()-1){
        ret.push_back(arr);
        return;
    }
    //当0=<n<=arr.size()-2时
    for(int i=n;i<arr.size();i++){
        //若有重复值则不需要交换位置
        if(!IsDuplicate(arr,n,i))
            continue;
        swap(arr[i],arr[n]);
        Permutaion(ret,arr,n+1);
        swap(arr[i],arr[n]);
    }
}
```

# 全排列的非递归算法


#### 分析

a.起点:字典序最小的排列，例如12345

b.终点:字典序最大的排列，例如54321

c.过程:从当前排列生成字典序刚好比它大的下一个排列，例如21543下一个排列是23145

d.算法思想:

```
1)后找:找到数组中最后一个升序的位置i，即arr[i]<arr[i+1]；
2)查找:arr[i+1...N]中比arr[i]大的最小值arr[j];
3)交换:arr[i]与arr[j]交换位置；
4)翻转:翻转arr[i+1...N]元素；
```

e.此算法可以天然解决重复字符的问题。

d.STL在Algorithm中集成了next_permutation方法。

#### 源码

```cpp
bool getNextPermutaion(vector<int> &arr){
    //1.后找
    int i = arr.size()-2;
    while((i>=0)&&(arr[i]>=arr[i+1]))i--;
    //当完全升序时则表明到达终点，返回false
    if(i<0)return false;
    //2.查找
    size_t j= arr.size()-1;
    while(arr[j]<=arr[i])j--;
    //3.交换
    swap(arr[j],arr[i]);
    //4.翻转
    reverse(arr.begin()+i+1,arr.end());
    return true;
}


int main() {
    vector<int> arr={1,2,2,4};
    while(getNextPermutaion(arr)){
        cout<<arr[0]<<" "<<arr[1]<<" "<<arr[2]<<" "<<arr[3]<<endl;
    }
    cout<<"------------"<<endl;
    vector<int> arr1={1,2,2,4};
    while(next_permutation(arr1.begin(),arr1.end())){
        cout<<arr1[0]<<" "<<arr1[1]<<" "<<arr1[2]<<" "<<arr1[3]<<endl;
    }
    return 0;
}
```
