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
 *这取决于编译器如何定义NULL，有些编译器会将NULL定义为((void*)0)，有些则会直接将其定义为 0。
 */	

/*
 * C++11智能指针
 *	1.shared_ptr:它能够记录多少个shared_ptr共同指向一个对象，从而消除显示的调用delete，
 * 当引用计数变为零的时候就会将对象自动删除
 *	2.unique_ptr:一种独占的智能指针，它禁止其他智能指针与其共享同一个对象，从而保证代码的安全
 *	3.weak_ptr:一种弱引用(shared_ptr就是一种强引用),弱引用不会引起引用计数增加
 **/

#include <iostream>
#include <memory>

int main()
{
    //1.创建传入参数中的对象，并返回这个对象类型的std::shared_ptr指针
	auto pointer = make_shared<int>(10);
	auto pointer2 = pointer; //引用计数+1
	auto pointer3 = pointer; //引用计数+1
	cout << pointer.use_count() <<endl; //3
	cout << pointer2.use_count() <<endl; //3
	cout << pointer3.use_count() <<endl; //3
	pointer2.reset(); //去除pointer2的引用
	cout << pointer.use_count() <<endl; //2
	cout << pointer2.use_count() <<endl; //0
	cout << pointer3.use_count() <<endl; //2
    //2.离开作用域前，shared_ptr会被析构从而释放内存
    return 0;
}



int main()
{
	//1.创建对象引用
	std::unique_ptr<int> pointer = std::make_unique<int>(10);   
	std::unique_ptr<int> pointer2 = pointer;  //非法操作
	//2.离开作用域前，shared_ptr会被析构从而释放内存
	return 0;
}


struct A{};
struct B {
    weak_ptr<A> pointer;
};
int main() {
    auto a = std::make_shared<A>();
    auto b = std::make_shared<B>();
    b->pointer = a;
    cout << a.use_count() << endl;  //1
    cout << b.use_count() << endl;  //1
}