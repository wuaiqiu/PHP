/*
 * 预处理
 *
 * 1.宏定义
 * 		(1)无参;简单的替换 #define PI 3.14
 * 			#define 标识符 字符串
 * 		(2)带参;替换后，需要实参替换形参 #define PI(x) x*x
 * 			#define 标识符(形参) 字符串
 * 	a.宏名一般用大写字母
 * 	b.宏定义末尾不带分号
 * 	c.可以用"#undef 标识符"终止宏作用域 #undef PI
 *
 *
 *2.头文件包含
 *	 #include <stdio.h> 直接按标准库查找
 *	 #include "stdio.h" 先本地查找，在按标准库查找
 *
 *
 *3.条件编译
 *	#ifdef 宏名  //#ifndef 宏名
 *		//语句段
 *	#else
 *		//语句段
 *	#endif
 *
 *	#if	表达式
 *		//语句块
 *	#elif
 *		//语句段
 *	#else
 *		//语句段
 *	#endif
 * */

#ifndef AAA
	#define AAA
	void fun();
#endif


/*
 * 4.C++新增预处理:
 * 		#pragma once:保证头文件只被include一次
 * */

#pragma once
	void fun();

/*
 * 5.##是一个连接符号，用于把参数连在一起
 *   #是把跟在后面的参数转换成一个字符串
 * */

#define STR(s)      #s
#define CONS(a,b)   a##b

int main(){
    cout<<STR(hello)<<endl; //hello
    cout<<CONS(1,2)<<endl; //12
    return 0;
}
