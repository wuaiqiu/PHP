# 计算逆波兰式(ReversePolishNotation,RPN)


根据逆波兰表示法，求表达式的值。

```
输入:
2 1 + 3 *
```

```
输出:
9
```

### 分析

a.若当前字符是操作数，则压栈。

b.若当前字符是操作符，则弹出栈中的两个操作数，计算后仍然压入栈。

c.逆波兰表达式是计算数学表达式的最常用的方法。

### 源码

```cpp
int evalRPN(string& tokens) {
	//操作数栈
	stack<int> stack;
	//两个操作数
	int a, b;
	for (size_t i = 0; i < tokens.size(); i++) {
		if (tokens[i] == '+' || tokens[i] == '-' || tokens[i] == '*'|| tokens[i] == '/') {
			//当为操作符时进行出栈运算
			b = stack.top();
			stack.pop();
			a = stack.top();
			stack.pop();
			if (tokens[i] == '+')
				stack.push(a + b);
			else if (tokens[i] == '-')
				stack.push(a - b);
			else if (tokens[i] == '*')
				stack.push(a * b);
			else
				stack.push(a / b);
		} else {
			//当为操作数时压栈
			stack.push(tokens[i]-48);
		}
	}
	return stack.top();
}
```


```
逆波兰表达式(后缀表达式):

中缀表达式:a+(b-c)*d
后缀表达式:abc-d*+
```