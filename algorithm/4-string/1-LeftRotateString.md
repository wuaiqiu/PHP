# 字符串循环左移


给定一个字符串string，要求把string前k个字符移动到string的尾部。

```
输入:
abcdef
k=2
```

```
输出:
cdefab
```

### 源码

```
void leftRotateString(string& str, int pos) {
	//左移size+pos等于pos
	pos %= str.size();
	//首先翻转0...pos
	reverse(str.begin(), str.begin() + pos);
	//在翻转pos...size
	reverse(str.begin() + pos, str.end());
	//最后翻转0...size
	reverse(str.begin(), str.end());
}
```
