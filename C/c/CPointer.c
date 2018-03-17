#include <stdio.h>
/*
 * 指针
 *
 *  1.指针类型
 *  	(1)普通指针:指针可以改变，值可以改变
 *  			int* p;
 *      (2)常量指针:指针可以改变，值不可以改变
 *      		const int* p;
 *		(3)指针常量:指针不可以改变，值可以改变，且必须初始化
 *				int* const p=&a;
 *		(4)常量指针指向常量:	指针不可以改变，值不可以改变，且必须初始化
 *				const int* const p=&a;
 *
 *
 *	2.指针优先级
 *		a=*p++ ==> a=*p;p++
 *		a=*++p ==> p++;a=*p
 *
 *
 *	3.指针可以为形参，也可以为返回值
 *
 *
 * 	4.动态分配内存空间(stdlib.h)
 *		char* p=(char*)malloc(20);  //申请空间
 *		if(p==NULL){		//判断是否成功
 *			printf("ERROR");
 *			return 0;
 *		}
 *		strcpy(p,"Hello");
 *		free(p); //释放空间
 *		p=NULL;	//指针设置为空
 *
 * */

int* fun(int* a){
	(*a)++;
	return a;
}

int main() {
	int a=1;
	printf("a=%d\n",a);
	printf("b=%d\n",*fun(&a));
	printf("a=%d\n",a);
	return 1;
}