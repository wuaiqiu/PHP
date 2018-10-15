#include <stdio.h>
/*
 * 指针
 *
 *  1.指针类型
 *   (1)普通指针:指针可以改变，值可以改变
 *  			int* p;
 *   (2)常量指针:指针可以改变，值不可以改变
 *      	const int* p;
 *   (3)指针常量:指针不可以改变，值可以改变，且必须初始化
 *				int* const p=&a;
 *	 (4)常量指针指向常量:	指针不可以改变，值不可以改变，且必须初始化
 *				const int* const p=&a;
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
 *			  void (*fun)();
 *
 *   5.void*类型:是有指向的指针，但它的指向的数据的类型暂时不确定，所以先弄成void*类型，
 * 后期一般要强制转换的
 *    空指针:指向的值为NULL,是一个无指向的指针
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
 *   void* malloc(unsigned int num_size):申请num_size空间
 *   void* calloc(size_t n,size_t size):申请n个size空间
 *	 void realloc(void *p, size_t new_size):给动态分配的空间分配额外的空间，用于扩充容量
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
 * 7.C++动态分配内存空间:new/delete(可以触发构造函数/析构函数，而malloc/free不会):
 * 	  a.申请单个空间:
 * 	 	int* p=new int(10);
 * 	 	if(p==nullptr){
 * 	 		cout<<"ERROR"<<endl;
 * 	 		return 0;
 * 	 	}
 * 	 	delete p;
 * 	 	p=nullptr;
 *
 * 	  b.申请数组空间:
 * 	 	char* p=new char[20];
 * 	 	if(p==nullptr){
 * 	 		cout<<"ERROR"<<endl;
 * 	 		return 0;
 * 	    }
 * 	    strcpy(p,"Hello");
 * 	    delete[] p;
 * 	    p=nullptr;
 *
 * 	nullptr:出现的目的是为了替代NULL,在某种意义上来说，传统C++会把NULL、0视为同一种东西，
 *这取决于编译器如何定义NULL，有些编译器会将NULL定义为((void*)0)，有些则会直接将其定义为0。
 */

/*
 * 8.C++11智能指针(RAII,Resource Acquisition is Initialization,资源获取即初始化)
 *	1).shared_ptr:它能够记录多少个shared_ptr共同指向一个对象，从而消除显示的调用delete，
 * 当引用计数变为零的时候就会将对象自动删除
 *	2).unique_ptr:一种独占的智能指针，它禁止其他智能指针与其共享同一个对象，从而保证代码的安全
 *	3).weak_ptr:一种弱引用(shared_ptr就是一种强引用),弱引用不会引起引用计数增加
 **/

#include <iostream>
#include <memory>

class Person{
public:
   void fun(){
     cout<<"ok"<<endl;
   }
};

int main(){
     Person p;
     //创建传入参数中的对象，并返回这个对象类型的shared_ptr
     auto a=make_shared<Person>(p);
     auto b=a;//引用计数+1
     cout<<a.use_count()<<endl; //2
     cout<<b.use_count()<<endl;//2
     b.reset();//去除b的引用
     cout<<a.use_count()<<endl;//1
     cout<<b.use_count()<<endl;//0
     a.get()->fun();//获取原来指针
     return 0;
}

int main(){
    Person p;
    auto pointer = make_unique<Person>(p);
    auto pointer2 = pointer;  //非法操作
    return 0;
}

struct A{};
struct B {
    weak_ptr<A> pointer;
};
int main() {
    auto a = make_shared<A>();
    auto b = make_shared<B>();
    b->pointer = a;
    cout << a.use_count() << endl;  //1
    cout << b.use_count() << endl;  //1
}


/*
 * 9.野指针:指向内存被释放的内存或者没有访问权限的内存的指针。
 *    a.指针变量没有被初始化。任何指针变量刚被创建时不会自动成为NULL指针，它的缺省值
 *  是随机的。所以指针变量在创建的同时应当被初始化，要么将指针设置为NULL，要么让它指
 *  向合法的内存。例如char *p = NULL；
 *    b.指针p被free或者delete之后，没有置为NULL；
 *    c.指针操作超越了变量的作用范围。
 * */
