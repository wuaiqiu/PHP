# 入栈出栈问题


给定无重复元素的两个等长数组，分别表述入栈序列和出栈序列，请问:这样的出栈序列是否可行。

```
输入:
ABCDEFG
BAEDFGC
```

```
输出:
true
```

### 分析

a.使用一个栈S来模拟压栈出栈的操作，记做入栈序列为A，出栈序列为B。

b.遍历B的每个元素b:若b等于栈顶元素s，则检查B的下一个元素，栈顶元素s出栈；若b不等于栈顶元素s或栈为空，则将A中剩下的元素压入栈，直到与b相等为止，否则返回false。

c.当A与B全部遍历完成，返回true。

### 源码

```cpp
bool isPossible(const char* strln,const char* strout){
	//中间栈
	stack<char> s;
	while(*strout){
		if((!s.empty())&&(s.top()==*strout)){
			//当stack不为空并strout与栈顶字符相同
			s.pop();
			strout++;
		}else{
			//当stack为空或stack栈顶字符与strout不相等
			if(strlen(strln)==0)return false;
			s.push(*strln);
			strln++;
		}
	}
	return true;
}
```
