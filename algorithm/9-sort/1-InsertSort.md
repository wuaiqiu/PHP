# 插入排序


![](../img/59.png)

## 直接插入排序

#### 源码

```cpp
//直接插入排序
void directInsertion(vector<int> &arr) {
    int i, j;
    for (i = 1; i < arr.size(); i++) {
        //current元素向前移动到正确位置
        if (arr[i] < arr[i - 1]) {
            int current = arr[i];
            for (j = i - 1; j >= 0 && current < arr[j]; j--) {
                arr[j + 1] = arr[j];
            }
            arr[j + 1] = current;
        }
    }
}
```

## shell排序

#### 源码

```cpp
//shell排序，直接排序的改进版，需要一个增量inc来使得元素序列局部有序，inc=1，则为直接排序
void shellSort(vector<int> &arr, int inc) {
    int i, j;
    for (i = inc; i < arr.size(); i += inc) {
        //current元素向前移动到正确位置
        if (arr[i] < arr[i - inc]) {
            int current = arr[i];
            for (j = i - inc; j >= 0 && current < arr[j]; j -= inc) {
                arr[j + inc] = arr[j];
            }
            arr[j + inc] = current;
        }
    }
}
```
