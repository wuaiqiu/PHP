#include <stdio.h>

/*
 * 输入/输出(stdio.h)
 *
 * 1.scanf/printf(标准流)有格式输入/输出函数
 *   fscanf/fprintf(指定流)有格式输入/输出函数
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
 * 2.getchar/putchar(标准流)无格式输入/输出字符函数
 *	 fgetc/fputc(指定流)无格式输入/输出字符函数
 *
 * 3.fgets/fputs(指定流)无格式输入/输出字符串函数
 * */

//遇到空格和换行时结束
void scanfDemo() {
    char str[10];
    scanf("%s", str);
    printf("%s", str);
}
//遇到空格和换行时结束
void fscanfDemo() {
    char str[10];
    fscanf(stdin, "%s", str);
    fprintf(stdout, "%s", str);
}


//读取一个字符，获取失败返回EOF
void getcharDemo() {
    char a;
    a = getchar();
    putchar(a);
}
//读取一个字符，获取失败返回EOF
void fgetcDemo() {
    char a;
    a = fgetc(stdin);
    fputc(a, stdout);
}


//遇到换行时结束
void fgetsDemo() {
    char str[10];
    fgets(str, 64, stdin);
    fputs(str, stdout);
}


/*
 * 4.C++输入/输出对象(endl表示换行并刷新缓冲区)
 * 	 std::cout<<"Hello world"<<endl; //不需要指定输出类型，可以自动识别类型
 * 	 std::cin>>x; 					 //不需要指定输入类型，可以自动识别类型
 * */

 void cppIO(){
 	int a;
 	std::cout<<"Hello world"<<endl;
 	std::cin>>a;
 }

 
