# 括号匹配


给定一个只包括'('，')'，'{'，'}'，'['，']' 的字符串，判断字符串是否有效。有效字符串需满足：左括号必须用相同类型的右括号闭合。左括号必须以正确的顺序闭合。

```
输入:
([)]
```

```
输出:
false
```

#### 分析

a.从前向后扫描字符串，遇到左括号x，就压栈x。

b.遇到右括号y:如果发现栈顶元素x和该括号y匹配，则栈顶元素出栈，继续判断下一个字符；如果栈顶元素x和该括号y不匹配，返回false；如果栈为空，返回false。

c.扫描完成后，如果栈恰好为空，则返回true，否则返回false。

#### 源码

```cpp
bool isValid(string s) {
	//定义左符号栈
	stack<char> stack;
	for (size_t i = 0; i < s.size(); i++) {
		if (s[i] == '(' || s[i] == '{' || s[i] == '[') {
			//进栈操作
			stack.push(s[i]);
		} else {
			//出栈操作
			if (stack.empty()) {
				return false;
			} else {
				switch (s[i]) {
				case ')':
					if (stack.top() == '(')
						stack.pop();
					else
						return false;
					break;
				case '}':
					if (stack.top() == '{')
						stack.pop();
					else
						return false;
					break;
				case ']':
					if (stack.top() == '[')
						stack.pop();
					else
						return false;
					break;
				}
			}
		}
	}
	//读取完字符串后判断符号栈stack是否为空
	if (stack.empty())
		return true;
	else
		return false;
}
```

# 最长括号匹配


给定一个只包含'('和')'的字符串，找出最长的包含有效括号的子串的长度。

```
输入:
(()
```

```
输出:
2
```

#### 分析

a.设起始匹配位置start=-1，最大匹配长度ret=0;

b.如果c为左括号，则将i压栈。

c.如果c为右括号:如果栈为空，表示没有匹配的左括号，start=i；如果栈不为空出栈，此时栈为空则ret=max(i-start,ret),此时栈不为空则ret=max(ret,i-stack.top())。

#### 源码

```cpp
int longestValidParentheses(string s) {
	//左括号索引栈
	stack<int> stack;
	//ret返回值，start初始值
	int ret = 0, start = -1;
	for (size_t i = 0; i < s.size(); i++) {
		if (s[i] == '(') {
			//当为'('时，则压栈
			stack.push(i);
		} else {
			//当为')'时，则出栈
			if (stack.empty()) {
				start = i;
			} else {
				stack.pop();
				if (stack.empty())
					ret = max(ret,i-start);
				else
					ret = max(ret,i-stack.top());
			}
		}
	}
	return ret;
}
```
