# 链表相加


给定两个非空链表来表示两个非负整数。位数按照逆序方式存储，它们的每个节点只存储单个数字。将两数相加返回一个新的链表。你可以假设除了数字0之外，这两个数字都不会以零开头。

```
输入:
2->4->3
5->6->4
```

```
输出:
7->0->8
```

### 分析

a.因为两个数字求和的范围是[0,18]，进位最大是1，因此第i位相加不会影响到第i+2位的计算。

b.利用上述结构可以实现大整数运算。

### 源码

```cpp
struct ListNode {
	int val;
	ListNode *next;
	ListNode(int x) :val(x), next(NULL) {}
};

ListNode* addTwoNumbers(ListNode* l1, ListNode* l2) {
	//定义链表头结点
	ListNode* res = new ListNode(0);
	//定义链表移动指针
	ListNode* p = res;
	//进位
	int mod = 0;
	//当l1与l2链表不为空时
	while (l1 || l2) {
		int val = mod + (l1 ? l1->val : 0) + (l2 ? l2->val : 0);
		mod = val / 10;
		val = val % 10;
		p->next = new ListNode(val);
		p = p->next;
		if (l1) l1 = l1->next;
		if (l2) l2 = l2->next;
	}
	//当进位不为零时
	if (mod != 0) {
		p->next = new ListNode(mod);
		p = p->next;
	}
	//返回头结点的下一个有效结点
	return res->next;
}
```
