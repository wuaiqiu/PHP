# 最大二叉搜索子树


给定某二叉树，计算它的最大二叉搜索子树，返回该最大二叉搜索子树的结点数目。

### 分析

a.验证某二叉树是否为二叉搜索树。

b.算法思路:把每个节点都当做根节点，来验证其是否是二叉搜索数，并记录节点的个数，若是二叉搜索树，就更新最终结果。

### 源码

```cpp
//验证二叉树是否为二叉搜索树
bool isValidBST(BitNode* root, int mn, int mx) {
    //递归结束条件
    if (!root) return true;
    //当根节点<=左节点或者根节点>=右节点时，返回false
    if (root->index <= mn || root->index >= mx) return false;
    //分别递归左结点与右结点
    return isValidBST(root->lchild, mn, root->index) && isValidBST(root->rchild, root->index, mx);
}

bool isValid(BitNode* root) {
    //首先从根节点开始验证
    return isValidBST(root, INT_MIN, INT_MAX);
}
```

```cpp
//记录以root为根的节点数
int count(BitNode* root) {
    if (!root) return 0;
    return count(root->lchild) + count(root->rchild) + 1;
}

//以每个结点为根的有效结点数
int largestBSTSubtree(BitNode* root) {
    if (!root) return 0;
    if (isValid(root, INT_MIN, INT_MAX)) return count(root);
    else return max(largestBSTSubtree(root->lchild), largestBSTSubtree(root->rchild));
}
```
