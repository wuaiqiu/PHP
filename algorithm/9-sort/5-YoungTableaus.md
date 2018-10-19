# 杨氏矩阵


给定M*N的二维数组，每一行，每一列都是有序的，则该二维数组称为杨氏矩阵。求杨氏矩阵的增删改查。

### 源码

```cpp
//定义无穷大
#define INFINITY 10000

//插入
bool Insert(vector<vector<int>> &table, int x) {
    int row = static_cast<int>(table.size() - 1);
    int col = static_cast<int>(table[0].size() - 1);
    if (table[row][col] < INFINITY)//杨氏矩阵已满
        return false;
    table[row][col] = x; //在最后一格插入x
    int r = row, c = col;
    while ((row >= 0) || (col >= 0)) {
        //当x<table[row-1][col]时，向上走
        if ((row >= 1) && (table[row - 1][col] > table[r][c])) {
            r = row - 1;
            c = col;
        }
        //当x<table[row][col-1]时，向左走
        if ((col >= 1) && (table[row][col - 1] > table[r][c])) {
            r = row;
            c = col - 1;
        }
        //当x>=table[row-1][col]且x>=table[row][col-1]时，找到插入位置，跳出循环
        if ((r == row) && (c == col))
            break;
        //交换位置，进行下一次循环
        swap(table[row][col], table[r][c]);
        row = r;
        col = c;
    }
    return true;
}

//查询，找到x时返回i，j
bool Find(vector<vector<int>> &table, int x, int &i, int &j) {
    //从table的右上角开始查询
    i = 0;
    j = static_cast<int>(table[0].size() - 1);
    while ((i < table.size()) && (j >= 0)) {
        //当找到返回true
        if (table[i][j] == x)
            return true;
        if (x > table[i][j])
            i++;//当x大于当前元素，向下移动
        else
            j--;//当x小于当前元素，向左移动
    }
    return false;
}

//删除
void Delete(vector<vector<int>> &table, int x) {
    int row, col;
    //当待删除元素x存在时
    if (Find(table, x, row, col)) {
        int r = row, c = col;//下一次带删除的位置
        while ((row < table.size()) && (col < table[0].size())) {
            //如果table[row][col]为INFINITY时，则退出
            if (table[row][col] == INFINITY)
                break;
            //r,c先赋值为table[row][col]下面元素
            if (row + 1 < table.size()) {
                r = row + 1;
                c = col;
            }
            //table[row+1][col]与table[row][col+1]比较，谁小r,c就取谁
            if ((col + 1 < table[0].size()) && (table[row][col + 1] < table[r][c])) {
                r = row;
                c = col + 1;
            }
            //带删除元素为最后一个元素时，跳出循环
            if ((row == r) && (col == c))
                break;
            table[row][col] = table[r][c];
            //进行下一轮交换
            row = r;
            col = c;
        }
        table[table.size() - 1][table[0].size() - 1] = INFINITY;
    }
}
```
