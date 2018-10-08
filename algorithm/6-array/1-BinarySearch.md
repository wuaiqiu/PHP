# 二分查找


#### 分析

a.若元素之间无序，则查找某元素是否在数组中需要O(N)的时间复杂度。

b.若元素之间有序，则可以使用二分查找确定元素是否在数组中，需要O(logN)的时间复杂度。

#### 源码

```cpp
int binarySearch(vector<int> &array, int target) {
    int from = 0, to = static_cast<int>(array.size()-1), mid;
    while (from <= to) {
        mid = (from + to) / 2;
        if (array[mid] == target) {
            return mid;
        } else if (array[mid] > target) {
            to = mid - 1;
        } else {
            from = mid + 1;
        }
    }
    return -1;
}
```

# 局部最大值


给定一个无重复元素的数组A[0...N-1]，求找到一个该数组的局部最大值。即{A[i]|A[i]>A[i-1]且A[i]>A[i+1],0<=i<=N-1}。


#### 分析

a.使用索引left,right分别指向数组首尾，求中点mid=(left+right)/2。

b.A[mid]>A[mid+1]，子数组A[left...mid]为高原数组，丢弃后半段。

c.A[mid]<A[mid+1]，子数组A[mid+1...right]为高原数组，丢弃前半段。

d.递归直至left==right。

#### 源码

```cpp
int LocalMaximum(vector<int> A) {
    //初始化
    int left = 0, right = static_cast<int>(A.size() - 1), mid;
    while (left < right) {
        mid = (left + right) / 2;
        if (A[mid] > A[mid + 1])
            //当A[mid]>A[mid+1]时
            right = mid;
        else
            //当A[mid]<A[mid+1]时
            left = mid + 1;
    }
    return A[left];
}
```

# 查找旋转数组的最小值


假定一个排序数组以某个未知元素为支点做了旋转，如：原数组01234567旋转后得到456012。请找出旋转后数组的最小值。假定数组中没有重复的数字。

#### 分析

a.用索引left，right分别指向首尾元素，元素不重复。若子数组是普通升序数组，则A[left]<A[right];若子数组时循环升序数组，前半段子数组元素全部大于后半段子数组的元素，则A[left]>A[right]。

b.计算中间位置mid=(low+high)/2;显然A[low..mid]与A[mid+1...high]必有一个是循环升序数组，一个是普通升序数组。

c.当A[mid]>A[high]，说明A[low...mid]为普通升序数组，A[mid+1...high]为循环升序数组。

d.当A[mid]<A[high]，说明A[low...mid]为循环升序数组，A[mid+1...high]为普通升序数组。

e.每次依据那边是循环升序数组来更新low，high值。

#### 源码

```cpp
int FindMin(vector<int> &arr) {
    int low = 0, high = static_cast<int>(arr.size() - 1), mid;
    while (low < high) {
        mid = (low + high) / 2;
        if (arr[mid] < arr[high])
            high = mid;
        else if (arr[mid] > arr[high])
            low = mid + 1;

    }
    return arr[low];
}
```
