/*
 * 字符串
 *
 * 1.表示方式
 *		char str[]="Hello";
 *		char* str="Hello";
 *
 *
 * 2.操作函数(string.h)
 *		strlen(str)  	  返回数组长度
 *		strcpy(des,src)   字符串复制
 *		memcpy(des,src,size)
 *		strcmp(str1,str2) 字符串比较
 *		memcmp(str1,str2,size)
 *		strcat(str1,str2) 字符串连接
 *		memmove(dest,src,size)
 *
 *
 * 3.字符数组赋值异常（指针没有错误）
 * 		char str[10];
 * 		str="sss"; //错误
 *
 * 		==> strcpy(str,"sss");
 *
 * 4.转换函数(stdlib.h)
 * 	int atoi(const char *str): string --> int
 * 	long int atol(const char *str): string --> long
 * 	double atof(const char *str): string --> double
 * */

/*
 * string
 *
 *	string s;				默认初始化，一个空字符串
 *	string s("ssss");		s是字面值“ssss”的副本
 *	
 *	s.substr(pos);			得到一个pos到结尾的串
 *	s.substr(pos1,n);		返回字符串位置为pos1后面的n个字符组成的串
 *	s.insert(pos,str);		在s的pos位置插入str
 *	s.erase(10);			删除字符串第十个字符
 *	s.erase (10,8);       	直接指定删除的字符串位置第十个后面的8个字符
 *	s.append(str2); 		直接追加一个str2的字符串  
 * */