# 链表翻转


反转从位置m到n的链表。请使用一趟扫描完成反转。1<=m<=n<=链表长度

```
输入:
1->2->3->4->5
m=2
n=4
```

```
输出:
1->4->3->2->5
```

### 分析

a.向前空转m-1次，找到第m-1个结点，即开始翻转的第一个结点的前驱，记为prev。

b.以prev为起始点遍历n-m次，将第i次找到的结点插入prev的next中即可。(头插法)

### 源码

```cpp
struct ListNode {
	int val;
	ListNode *next;
	ListNode(int x) : val(x), next(NULL) {}
};

ListNode* reverseBetween(ListNode* head, int m, int n) {
	if (!head) return head;
	//定义一个指向head的头结点
	ListNode* res = new ListNode(0);
	res->next = head;
	//m的父节点
	ListNode* prev = res;
	for (int i = 1; i < m; i++) {
		prev = prev->next;
	}
	//m结点
	ListNode* current = prev->next;
	//每次待翻转的结点成为prev的直接子节点
	for (int i = m; i < n; i++) {
		ListNode* tmp = current->next;
		current->next = tmp->next;
		tmp->next = prev->next;
		prev->next = tmp;
	}
  //返回有效结点
	return res->next;
}
```
