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
 *		strcmp(str1,str2) 字符串比较
 *		strcat(str1,str2) 字符串连接
 *		
 * 
 * 3.字符数组赋值异常（指针没有错误）
 * 		char str[10];
 * 		str="sss"; //错误
 * 		
 * 		==> strcpy(str,"sss");
 * */