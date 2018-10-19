# 归并排序


![](../img/59.png)

### 源码

```cpp
//归并
void merge(vector<int> &arr, int start, int endA, int endB) {
    vector<int> aux(6); //aux为辅助数组
    int i = start, j = endA + 1; //i为[start...endA],j为[endA+1...endB]
    int k = 0;    //k为aux数组的下标
    for (; i <= endA && j <= endB; k++) { //小的元素先进入新数组
        if (arr[i] <= arr[j])
            aux[k] = arr[i++];
        else
            aux[k] = arr[j++];
    }
    while (i <= endA)
        aux[k++] = arr[i++];
    while (j <= endB)
        aux[k++] = arr[j++];
    //将aux数组合并的值赋值到原数组arr中
    for (size_t m = 0; m < k; m++)
        arr[start + m] = aux[m];
}

//递归归并，start为数组的开始，end为数组的结束
void mergeSort(vector<int> &arr, int start, int end) {
    //递归结束条件
    if (start >= end) return;
    int mid = (start + end) / 2;
    mergeSort(arr, start, mid);
    mergeSort(arr, mid + 1, end);
    merge(arr, start, mid, end);
}
```
