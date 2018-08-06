/*
 * 1.结构体
 *	 struct 结构体名{
 *		 类型	  类型名;
 *		 ...
 *	 };
 *
 *	 struct student a={"wu",20};  //a.类型名
 *	 struct student* p=&a;  //p->类型名  ===  (*p).类型名  === a.类型名
 *
 *
 * 2.共用体
 *	 union 共用体名{
 *		 类型  类型名;
 *		 ...
 *	 };
 *
 *	 union student a={"wu",20}; //a.类型名
 *	 union student* p=&a; //p->类型名  ===  (*p).类型名  === a.类型名
 *		a.共用体任何时候只有一个成员存在
 *		b.共用体长度为最长成员的长度
 *
 *
 * 3.typedof类型别名
 *		typedof 类型名 类型新名
 *
 * */

struct Student{
	int age;
	void (*fun)();
};
void deal(){
	printf("Hello");
}

int main(){
	struct Student stu={1,deal};
	stu.fun();
	return 0;
}


/*
 * 	C++结构体:
 * 	  1.声明结构体变量不需要struct
 * 	  2.结构体直接可以放函数定义
 * */

struct Student{
	int age;
	void fun(){
	 cout<<"Hello"<<endl;
	}
private:
	int sex;
};

int main(){
	Student stu={1};
	stu.fun();
	return 0;
}


/*
 *  结构体与类的区别:
 *   1.默认的访问权限struct是public的，class是private的
 *   2.struct更适合看成是一个数据结构的实现体，class更适合看成是一个对象的实现体
 *
 *  结构体与类的联系:
 * 	 1.struct能继承
 * 	 2.struct能实现多态
 * 	 3.struct可以继承class，同样class也可以继承struct
 * */

struct A{
  A(){
	  cout<<"This is A constructor"<<endl;
  }
  virtual void fun(){
	  cout<<"This is A Fun"<<endl;
  }
  virtual ~A(){
	  cout<<"This is A destory"<<endl;
  }
};
struct B : A{
	B(){
		  cout<<"This is B constructor"<<endl;
	  }
	void fun(){
		  cout<<"This is B Fun"<<endl;
	 }
	~B(){
		cout<<"This is B destory"<<endl;
	}
};

int main(){
	A* a=new B;
	a->fun();
	delete a;
	return 0;
}

/*
 * 变长结构体
 * 	 结构体最后使用0或1的长度数组，主要是为了方便的管理内存缓冲区，如果你直接使用指针而不使
 * 用数组，那么，你在分配内存缓冲区时，就必须分配结构体一次，然后再分配结构体内的指针一次，
 * 而此时分配的内存已经与结构体的内存不连续了，所以要分别管理即申请和释放，而如果使用数组，那
 * 么只需要一次就可以全部分配出来，反过来，释放时也是一样，使用数组，一次释放，减少内存的碎片化
 * */

struct node{
    int member1;
    int member2[0];//变长数组
};

int main(void) {
	 struct node *xiaobo1;
	 printf("%d\n",sizeof(struct node));
	 xiaobo1 = malloc(sizeof(struct node)+3*sizeof(int));//变长分配内存
	 memset(xiaobo1,0,sizeof(*xiaobo1));
	 (*xiaobo1).member1 = 1;
	 (*xiaobo1).member2[0] = 30;
	 (*xiaobo1).member2[1] = 31;
	 (*xiaobo1).member2[2] = 32;
	 printf("%d\n%d",sizeof(struct node),xiaobo1->member2[2]);
	 free(xiaobo1);
	 return 0;
}



/*
 * 初始化列表(C++11)
 *	1.为对象的初始化与普通数组和结构体的初始化方法提供了统一的桥梁
 *   2.初始化列表除了用在对象构造上，还能将其作为普通函数的形参
 **/

#include <initializer_list>
class Magic {
public:
    Magic(initializer_list<int> list){
		for(auto a : list)
			cout<<a<<endl;
	}
};
Magic magic = {1,2,3,4,5};


void fun(initializer_list<int> list){
	for(auto a : list)
		cout<<a<<endl;
}
foo({1,2,3});
