/*
JavaScript 正则表达式

	(1)search() 方法使用正则表达式
		用于检索字符串中指定的子字符串，或检索与正则表达式相匹配的子字符串，并返回子串的起始位置
		var str = "Visit Runoob!"; 
		var n = str.search(/Runoob/i);		//6
		var n = str.search("Runoob");		//6
		
	(2)replace() 方法使用正则表达式
		用于在字符串中用一些字符替换另一些字符，或替换一个与正则表达式匹配的子串。
		var str = "请访问 Microsoft!"; 
		var txt = str.replace(/microsoft/i,"Runoob");	//请访问 Runoob
		var txt = str.replace("Microsoft","Runoob");	//请访问 Runoob
	
	(3)修饰符 可以在全局搜索中不区分大小写:
		i	执行对大小写不敏感的匹配。
		g	执行全局匹配（查找所有匹配而非在找到第一个匹配后停止）。
		
	(4)方括号用于查找某个范围内的字符
		[abc]	查找方括号之间的任何字符。
		[0-9]	查找任何从 0 至 9 的数字。
		(x|y)	查找任何以 | 分隔的选项。
		
	(5)量词:
		n+	匹配任何包含至少一个 n 的字符串。
		n*	匹配任何包含零个或多个 n 的字符串。
		n?	匹配任何包含零个或一个 n 的字符串。
		
	(6)使用 RegExp 对象
		在 JavaScript 中，RegExp 对象是一个预定义了属性和方法的正则表达式对象。
		a.使用 test(),test() 方法是一个正则表达式方法。test()方法用于检测一个字符串是否匹配某个模式，
	如果字符串中含有匹配的文本，则返回 true，否则返回 false。
		
		var patt = /e/;
		patt.test("The best things in life are free!");  //true
		
	你可以不用设置正则表达式的变量，以上两行代码可以合并为一行：
		/e/.test("The best things in life are free!")
		
		b.使用 exec(),exec() 方法是一个正则表达式方法。exec() 方法用于检索字符串中的正则表达式的匹配。
	该函数返回一个数组，其中存放匹配的结果。如果未找到匹配，则返回值为 null。
	
		/e/.exec("The best things in life are free!"); //e	
*/