# 构造二叉树


1.利用带0(空节点)的先序遍历构造二叉树。

```
输入:
1 2 0 3 0 0 4 5 0 0 6 0 0
```

```
输出:
前序:1 2 3 4 5 6
中序:2 3 1 5 4 6
后序:3 2 5 6 4 1
```

### 源码

```cpp
struct BitNode{
	int index;
	BitNode *lchild,*rchild;
};

//利用先序构建二叉树,叶子节点要以两个子空节点结束
void createTree(BitNode* &T){
	int index;
	cin>>index;
	if(!index)T=nullptr; //0表示空节点
	else {
		T=(BitNode*)malloc(sizeof(BitNode));
		T->index=index;
		createTree(T->lchild);
		createTree(T->rchild);
	}
}
```


2.利用先序与中序构造二叉树。


### 分析

a.算法思想:

前序遍历:GDAFEMHZ
中序遍历:ADEFGHMZ

```
1).根据前序遍历的特点，可以得知根节点为G。
2).根节点G将中序遍历结果ADEFGHMZ分成ADEF和HMZ两个左右子树。
3).递归确定中序遍历序列ADEF和前序遍历序列DAEF的子树结构。
4).递归确定中序遍历序列HMZ和前序遍历序列MHZ的子树结构。
```

### 源码

```cpp
BitNode* build(vector<int> pre,vector<int> in,int preL,int preR,int inL,int inR){
    //终止条件
    if(preL>preR) return nullptr;
    //先序的第一个值即为根的值
    int rootValue=pre[preL];
    auto root=(BitNode*)malloc(sizeof(BitNode));
    root->index=rootValue;
    //在中序中寻找左右子树的划分点
    int k=0;
    for(int i=0;i<in.size();i++){
        if(rootValue==in[i]){
            k=i;
            break;
        }
    }
    //构造左右子树
    int numLeft=k-inL;
    root->lchild=build(pre,in,preL+1,preL+numLeft,inL,k-1);
    root->rchild=build(pre,in,preL+numLeft+1,preR,k+1,inR);
    return root;
}

BitNode* createTree(vector<int> &pre, vector<int> &in) {
    if(pre.empty()||in.empty())
        return nullptr;
    return build(pre,in,0,pre.size()-1,0,in.size()-1);
}
```


3.利用后序与中序构造二叉树。


### 分析

a.算法思想:

后序遍历:AEFDHZMG
中序遍历:ADEFGHMZ

```
1).根据后序遍历的特点，可以得知根节点为G。
2).根节点G将中序遍历结果ADEFGHMZ分成ADEF和HMZ两个左右子树。
3).递归确定中序遍历序列ADEF和后序遍历序列AEFD的子树结构。
4).递归确定中序遍历序列HMZ和后序遍历序列HZM的子树结构。
```

### 源码

```cpp
BitNode* build(vector<int> post,vector<int> in,int postL,int postR,int inL,int inR){
    //终止条件
    if(postL>postR) return nullptr;
    //后序的最后一个值即为根的值
    int rootValue=post[postR];
    auto root=(BitNode*)malloc(sizeof(BitNode));
    root->index=rootValue;
    //在中序中寻找左右子树的划分点
    int k=0;
    for(int i=0;i<in.size();i++){
        if(rootValue==in[i]){
            k=i;
            break;
        }
    }
    //构造左右子树
    int numLeft=k-inL;
    root->lchild=build(post,in,postL,postL+numLeft-1,inL,k-1);
    root->rchild=build(post,in,postL+numLeft,postR-1,k+1,inR);
    return root;
}

BitNode* createTree(vector<int> &post, vector<int> &in) {
    if(post.empty()||in.empty())
        return nullptr;
    return build(post,in,0,post.size()-1,0,in.size()-1);
}
```
