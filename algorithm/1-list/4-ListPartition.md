# 链表划分


给定一个链表和一个特定值x，对链表进行分隔，使得所有小于x的节点都在大于或等于x的节点之前。保留两个分区中每个节点的初始相对位置。

```
输入:
x=3
1->4->3->2->5->2
```

```
输出:
1->2->2->4->3->5
```

### 分析

a.分别申请两个指针l1,l2，小于x的添加到l1中，大于等于x的添加到l2中；最后，将l2连接到l1的末端即可。

b.说明快速排序对于单链表存储结构仍然适用。

### 源码

```cpp
struct ListNode {
	int val;
	ListNode *next;
	ListNode(int x) : val(x), next(NULL) {}
};

ListNode* partition(ListNode* head, int x) {
	//定义l1与l2链表
	ListNode* l1 = new ListNode(0);
	ListNode* l2 = new ListNode(0);
	//定义l1与l2的移动指针
	ListNode* p1 = l1;
	ListNode* p2 = l2;
	//定义head的移动指针
	ListNode* p = head;
	while (p) {
		if (p->val < x) {
			//当val<x，插入l1尾部
			p1->next = p;
			p1 = p1->next;
		} else {
			//当val>=x，插入l2尾部
			p2->next = p;
			p2 = p2->next;
		}
		p = p->next;
	}
	//合并l1与l2链表
	p2->next = NULL;
	p1->next = l2->next;
	//返回有效链表
	return l1->next;
}
```
