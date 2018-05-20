#include <stdio.h>
/*
 * 指针
 *
 *  1.指针类型
 *   (1)普通指针:指针可以改变，值可以改变
 *  			int* p;
 *   (2)常量指针:指针可以改变，值不可以改变
 *      		const int* p;
 *   (3)指针常量:指针不可以改变，值可以改变，且必须初始化
 *			int* const p=&a;
 *	 (4)常量指针指向常量:	指针不可以改变，值不可以改变，且必须初始化
 *			const int* const p=&a;
 *
 *
 *	2.指针优先级
 *		a=*p++ ==> a=*p;p++
 *		a=*++p ==> p++;a=*p
 *
 *
 *	3.指针可以为形参，也可以为返回值
 *		void fun(int* a);
 *		int* fun(int a);
 *
 *	4.指针函数与函数指针
 *	   指针函数:本质是一个函数，函数返回类型是某一类型的指针。
 *	   		void* fun();
 *	   函数指针:指向函数的指针变量，即本质是一个指针变量
 *			void (*fun)();
 *
 *   5.void*类型:是有指向的指针，但它的指向的数据的类型暂时不确定，所以先弄成void* 类型，后期一般要强制转换的
 *     空指针:指向的值为NULL,是一个无指向的指针
 *
 * 	6.动态分配内存空间(stdlib.h)
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

int* fun1(int* a){
	(*a)++;
	return a;
}

int deal(int* a){
	(*a)++;
	return *a;
}

int (*fun2)(int* a);

int main() {
	int a=1;
	printf("a=%d\n",a);
	printf("b=%d\n",*(fun1(&a)));
	printf("a=%d\n",a);
	fun2=deal;
	printf("a=%d\n",a);
	printf("b=%d\n",fun2(&a));
	printf("a=%d\n",a);
	return 1;
}

/*
 * C++动态分配内存空间:new/delete(可以触发构造函数/析构函数，而malloc/free不会):
 * 	  a.申请单个空间:
 * 	 	int* p=new int(10);
 * 	 	if(p==NULL){
 * 	 		cout<<"ERROR"<<endl;
 * 	 		return 0;
 * 	 	}
 * 	 	delete p;
 * 	 	p=NULL;
 *
 * 	  b.申请数组空间:
 * 	 	char* p=new char[20];
 * 	 	if(p==NULL){
 * 	 		cout<<"ERROR"<<endl;
 * 	 		return 0;
 * 	    }
 * 	    strcpy(p,"Hello");
 * 	    delete[] p;
 * 	    p=NULL;
 */	