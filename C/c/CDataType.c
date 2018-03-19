/*
 * 数据类型
 *
 *1.基本数据类型
 * [unsigned] short(2字节)  [unsigned] int(4字节)  [unsigned] long(8字节)
 * float(4字节)  double(8字节)  long double(16字节)
 * char(1字节)
 *
 *
 *2.常量
 *	const int a=3;
 *
 *
 *3.变量
 *	  auto : 默认存储类型，动态数据区
 *	  static : 静态数据区（只在本源文件起作用）
 *	  extern : 导出非静态全局变量
 *
 *
 *4.类型转换
 *	整型 --> 实型 : 整数部分不变，增加小数部分
 *	实型 --> 整型 : 整数部分不变，去除小数部分
 *	字符 --> 整型 : 高位为0，低8位为ascii码
 *	整型 --> 字符 : 低8位填充
 *
 *
 *5.类型判断(ctype.h)
 *	int isalnum(int c):该函数检查所传的字符是否是字母和数字。
 *	int isalpha(int c):该函数检查所传的字符是否是字母。
 *	int isdigit(int c):该函数检查所传的字符是否是十进制数字。
 *
 *	int tolower(int c):该函数把大写字母转换为小写字母。
 *	int toupper(int c):该函数把小写字母转换为大写字母。
 * */