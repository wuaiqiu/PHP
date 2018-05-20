#include <stdio.h>

/*
 * 输入/输出(stdio.h)
 *
 * 1.scanf/printf函数
 *		%d  --->  int short
 *		%ld	--->  long
 *		%f  --->  float
 *		%lf --->  double
 *		%Lf --->  long double
 *		%c  --->  char
 *		%s  --->  字符串
 *		-   --->  左对齐
 *		m.n --->  m:最小长度(包括小数点); n:小数位数
 *				  m:字符总长度; n:截取的长度
 *	   %md  --->  用零来填充
 *	   %%   --->  输出%
 *
 *
 * 2.getchar/putchar字符函数
 *
 *
 * 3.fgets/fputs字符串函数
 *
 * */

void getcharDemo(){
	char str[64],ch;
	int i=0,j=0;
	while((ch=getchar())!='\n'){
		str[i++]=ch;
	}
	while(str[j]!='\0'){
		putchar(str[j++]);
	}
}

void getsDemo(){
	char str[64];
	fgets(str,64,stdin);
	fputs(str,stdout);
}


/*
 * C++输入/输出对象(endl表示换行并刷新缓冲区)
 * 	 std::cout<<"Hello world"<<endl; //不需要指定输出类型，可以自动识别类型
 * 	 std::cin>>x; 					 //不需要指定输入类型，可以自动识别类型
 * */

 void cppIO(){
 	int a;
 	std::cout<<"Hello world"<<endl;
 	std::cin>>a;
 }