# 删除排序链表中的重复元素I


给定一个排序链表，删除所有重复的元素，使得每个元素只出现一次。

```
输入:
1->1->2->3->3
```

```
输出:
1->2->3
```

### 分析

a.若p->next的值和p的值相等，则将p->next->next赋值给p->next，删除p->next，重复上述过程，直到链表尾端。

### 源码

```cpp
struct ListNode {
	int val;
	ListNode *next;
	ListNode(int x) : val(x), next(NULL) {}
};

ListNode* deleteDuplicates(ListNode* head) {
	if (!head) return head;
	//p结点指针
	ListNode* p = head;
	//p结点的值
	int val = p->val;
	while (p && p->next) {
		if (p->next->val != val) {
			//向后移动p结点
			val = p->next->val;
			p = p->next;
		} else {
			//删除next
			p->next = p->next->next;
		}
	}
	return head;
}
```

# 删除排序链表中的重复元素II


给定一个排序链表，删除所有含有重复数字的节点，只保留原始链表中没有重复出现的数字。

```
输入:
1->2->3->3->4->4->5
```

```
输出:
1->2->5
```

### 分析

a.此时需要记录prev父指针，便于删除所有重复的结点。

### 源码

```cpp
struct ListNode {
	int val;
	ListNode *next;
	ListNode(int x) : val(x), next(NULL) {}
};

ListNode* deleteDuplicates(ListNode* head) {
	if (!head) return head;
	//定义指向head的头结点
	ListNode* res = new ListNode(0);
	res->next = head;
	//定义当前指向的结点
	ListNode* p = head;
	//定义p的父节点
	ListNode* prev = res;
	while (p && p->next) {
		if (p->val != p->next->val) {
			//如果没有重复,prev与p向前移动
			prev = p;
			p = p->next;
		} else {
			//如果有重复,tmp向前移动直到tmp->val与p->val不相等
			int val = p->val;
			ListNode* tmp = p->next->next;
			while (tmp) {
				if (tmp->val != val) break;
				tmp = tmp->next;
			}
			//删除重复节点
			prev->next = tmp;
			p = tmp;
		}
	}
	//返回有效结点
	return res->next;
}
```
