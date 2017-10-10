/*
 * 
 *正则表达式
 *
 *	(1)search():返回子串的起始位置
 *			var str = "Visit Runoob!"; 
 *			str.search(/Runoob/i);		//6
 *			str.search("Runoob");		//6
 *
 *	(2)replace():替换字符
 *			var str = "请访问 Microsoft!"; 
 *			var txt = str.replace(/microsoft/i,"Runoob");	//请访问 Runoob
 *			var txt = str.replace("Microsoft","Runoob");		//请访问 Runoob
 *
 *	(3)match():返回匹配数组
 *			var str="sgadslkiafajgalga";
 *			str.match("ga"); //["ga", index: 1, input: "sgadslkiafajgalga"];只能匹配一组
 *			str.match(/ga/g);//["ga", "ga", "ga"];全局匹配
 *
 *	(4)修饰符 可以在全局搜索中不区分大小写:
 *		i	执行对大小写不敏感的匹配。
 *		g	执行全局匹配（查找所有匹配而非在找到第一个匹配后停止）。
 *	
 *	(5)方括号用于查找某个范围内的字符
 *		[abc]	查找方括号之间的任何字符。
 *		[^abc]	查找任何不在方括号之间的字符。
 *		[0-9]	查找任何从 0 至 9 的数字。
 *		[a-z]	查找任何从小写 a 到小写 z 的字符。
 *		[A-Z]	查找任何从大写 A 到大写 Z 的字符。
 *		[A-z]	查找任何从大写 A 到小写 z 的字符。
 *		(x|y)	查找任何以 | 分隔的选项。
 *
 *	(6)元字符
 *		.	查找单个字符，除了换行和行结束符。
 *		\w	查找单词字符。
 *		\W	查找非单词字符。
 *		\d	查找数字。
 *		\D	查找非数字字符。
 *
 *	(6)量词
 *		n+		匹配任何包含至少一个 n 的字符串。
 *		n*		匹配任何包含零个或多个 n 的字符串。
 *		n?		匹配任何包含零个或一个 n 的字符串
 *		n{X}	匹配包含 X 个 n 的序列的字符串。
 *		n{X,Y}	匹配包含 X 至 Y 个 n 的序列的字符串。
 *		n{X,}	匹配包含至少 X 个 n 的序列的字符串。
 *		n$		匹配任何结尾为 n 的字符串。
 *		^n		匹配任何开头为 n 的字符串。
 *
 *	(7)使用 RegExp 对象
 *		global				RegExp 对象是否具有标志 g
 *		ignoreCase			RegExp 对象是否具有标志 i
 *
 *		exec(String)		返回一个数组，其中存放匹配的结果。如果未找到匹配，则返回值为 null
 *		test(String)		用于检测一个字符串是否匹配某个模式,返回一个boolean	
 *		
 **/

var str="sgadslkiafajgalga";
var reg=/ga/g;	//<==> var reg=new RegExp("ga","g")
var i=0;
while(i<4){
	console.log(reg.exec(str)); //一次只能匹配一个
	i++;
}

/*
 * ["ga", index: 1, input: "sgadslkiafajgalga"]
 * ["ga", index: 12, input: "sgadslkiafajgalga"] 
 * ["ga", index: 15, input: "sgadslkiafajgalga"]
 * null
 * */