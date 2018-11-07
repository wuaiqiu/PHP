#include <stdio.h>
/*
 * 指针
 *
 *  1.指针类型
 *   (1)普通指针:指针可以改变，值可以改变
 *  		int* p;
 *   (2)常量指针:指针可以改变，值不可以改变
 *      	const int* p;
 *   (3)指针常量:指针不可以改变，值可以改变，且必须初始化
 *			int* const p=&a;
 *	 (4)常量指针指向常量:指针不可以改变，值不可以改变，且必须初始化
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
 *   5.void*类型:是有指向的指针，但它的指向的数据的类型暂时不确定，所以先弄成void*类型，
 * 后期一般要强制转换的
 *    空指针:指向的值为NULL,是一个无指向的指针
 *
 * 	 6.动态分配内存空间(stdlib.h)
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
 * 8.C++11智能指针
 *    RAII(Resource Acquisition is Initialization,资源获取即初始化):一种利用对象生命周期来控制
 * 程序资源(如内存、文件句柄、网络连接、互斥量等等)的简单技术。
 *    RAII的一般做法是这样的:在对象构造时获取资源，接着控制对资源的访问使之在对象的生命周期内始终保
 * 持有效，最后在对象析构的时候释放资源。实际上是把管理一份资源的责任托管给了一个存放在栈空间上的局部
 * 对象。因为当函数返回时，栈上的局部变量就会立即释放空间，能确保资源释在返回前一定被释放。
 **/

#include <iostream>
#include <memory>

class Person{
private:
    int num;
public:
    explicit Person(int n):num(n){
        cout<<this->num<<":Construct"<<endl;
    }
    void say(){
        cout<<this->num<<":Hello World"<<endl;
    }
    ~Person(){
        cout<<this->num<<":Destory"<<endl;
    }
};

//自定义删除器
void deleter(int* ptr) {
    delete[] ptr;
    ptr = nullptr;
    cout << "deleter" << endl;
}

/*
 * 1).unique_ptr
 *   a.用于取代c++98的auto_ptr的产物，支持移动语义，支持自定义删除器deleter，支持对象数组
 *   b.一种独占的智能指针，它禁止其他智能指针与其共享同一个对象，从而保证代码的安全
 *   c.无法进行复制构造，无法进行复制赋值操作。但是可以进行移动构造和移动赋值操作
 *   d.当它本身被删除释放的时候，会使用给定的删除器释放它指向的对象
 *
 *   p.get():返回原始指针
 *   p.release():释放控制权，返回原始指针
 *   p.reset(p1):重新控制p1原始指针
 *   p1.swap(p2):交换控制权
 *   p[n]:访问数组p[n]
 *   make_unique<T>(args...):初始化unique_ptr对象
 *   make_unique<T[]>(size):初始化unique_ptr数组对象
 * */

int main(){
    unique_ptr<Person> p1(new Person(1));//输出 1:Construct
    unique_ptr<Person> p2(new Person(2));//输出 2:Construct
    p1->say(); //输出 1:Hello World
    p2->say(); //输出 2:Hello World
    p2=move(p1); //注意不能直接p2=p1，输出 2:Destory
    if(p1==nullptr) //输出 p1==nullptr
        cout<<"p1==nullptr"<<endl;
    Person* p3=p2.get(); //获取p2的原始指针
    Person* p4=p2.release(); //p2释放控制权，并返回原始指针
    if(p2==nullptr) //输出 p2==nullptr
        cout<<"p2==nullptr"<<endl;
    p1.reset(p3); //p1重新控制p3原始指针
    p1->say(); //输出 1:Hello World
    p3->say(); //输出 1:Hello World
    p4->say(); //输出 1:Hello World
    typedef void (*tp) (int*);//定义函数类型
    unique_ptr<int[],tp> p5(new int[5],deleter); //使用自定义删除器
    p5[1]=2; //赋值
    cout<<p5[1]<<endl; //输出 2
    unique_ptr<Person> p6=make_unique<Person>(3); //初始化Person对象
    unique_ptr<int[]> p7=make_unique<int[]>(5); //初始化大小为5的Person数组对象
    return 0; //输出  deleter 1:Destory
}


/*
 * 2).shared_ptr
 *  a.它使用计数机制来表明资源被几个指针共享
 *  b.当计数等于0时，资源会被释放
 *
 *  p.get():返回原始指针
 *  p.use_count():返回p所指的对象引用值
 *  p.reset(p1):p重新指向p1原始指针
 *  p1.swap(p2):交换共享指针所指的对象
 *  make_shared<T>(args...):初始化make_shared对象
 * */

int main(){
    shared_ptr<Person> p1(new Person(1)); //输出 1:Construct
    shared_ptr<Person> p2(new Person(2)); //输出 2:Construct
    p1->say(); //输出 1:Hello World
    p2->say(); //输出 2:Hello World
    p2=p1; //p2指向p1的对象，p2原来的对象销毁。输出 2:Destory
    cout<<p1.use_count()<<" "<<p2.use_count()<<endl; //输出 2 2
    shared_ptr<Person> p3(new Person(3),
            [](Person* p){delete p;p= nullptr;cout<<"deleter"<<endl;}
            );//使用自定义删除器 输出 3:Construct
    shared_ptr<Person> p4=make_shared<Person>(4); //初始化Person对象 输出 4:Construct
    return 0; //输出 4:Destory 3:Destory deleter 1:Destory
}


/*
 * 3).weak_ptr
 *  a.用来解决shared_ptr相互引用时的死锁问题
 *  b.一种弱引用(shared_ptr就是一种强引用),弱引用不会引起引用计数增加
 *  c.weak_ptr和shared_ptr之间可以相互转化
 *
 *  p.use_count():返回p所指的对象引用值
 *  p.reset(p1):p重新指向p1原始指针
 *  p1.swap(p2):交换共享指针所指的对象
 *  p.lock():返回shared_ptr对象，才可以访问对象成员
 * */

class B;
class A {
public:
    weak_ptr<B> pb;
    ~A() {
        cout<<"A delete\n";
    }
};
class B {
public:
    shared_ptr<A> pa;
    ~B() {
        cout<<"B delete\n";
    }
};

int main(){
    shared_ptr<A> a(new A());
    shared_ptr<B> b(new B());
    a->pb= b;
    b->pa =a;
    cout<<a.use_count()<<" "<<b.use_count()<<endl; //输出 2 1
    b.reset(); //b所指对象引用-1，则对象B的引用为0；输出 B delete
    cout<<a.use_count()<<" "<<b.use_count()<<endl; //输出 1 0
    return  0; //输出 A delete
}