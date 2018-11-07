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
 *	 a.共用体任何时候只有一个成员存在
 *	 b.共用体长度为最长成员的长度
 *
 * 3.枚举
 *  enum 枚举名{
 *      枚举量,
 *      枚举量=2,
 *      ...
 *  }
 *
 *  enum Week w1=Monday;
 *  enum Week w2=static_cast<enum Week>(2);
 *  a.枚举量默认下标分别为0-6，可以自定义指定，可以存在相同下标
 *  b.只能将定义的枚举量赋值给该种枚举变量
 *  c.枚举量可以赋给非枚举变量，如int a=Monday(即为int a=0)
 *  d.枚举变量只能进行赋值运算，不能进行算术运算
 *  e.C++11枚举类型:同一作用域下两个不同的枚举类型，不能含有相同的枚举量
 * 
 * 
 * 4.typedef类型别名
 *		typedef 类型名 类型新名
 *
 * define和别名typedef的区别
 *  a.执行时间不同，typedef在编译阶段有效，typedef有类型检查的功能；define是宏
 *定义，发生在预处理阶段，不进行类型检查。
 *  b.作用域不同，define没有作用域的限制，只要是之前预定义过的宏，在以后的程序中都
 *可以使用。而typedef有自己的作用域。
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
 * 4.C++结构体:
 *   1).声明结构体变量不需要struct(编译器首先将搜索全局标识符表(全局变量或函数)，
 *若结构体名未找到，则在类标识符内搜索，因此若有同名的结构体则会覆盖此结构体)
 *   2).结构体直接可以放函数定义
 * 5.结构体与类的区别:
 *   1).默认的访问权限struct是public的，class是private的
 *   2).struct更适合看成是一个数据结构的实现体，class更适合看成是一个对象的实现体
 * 6.结构体与类的联系:
 *   1).struct能继承,多态
 *   2).struct可以继承class，同样class也可以继承struct
 * */

struct Student {
};
//定义后"Student"只代表此函数
void Student() {} 

int main() {
    Student();
    struct Student me;//这时需要加上struct
    return 0;
}

/*
 * 7.变长结构体
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
 * 8.初始化列表(C++11)
 *  1).为对象的初始化与普通数组和结构体的初始化方法提供了统一的桥梁
 *  2).初始化列表除了用在对象构造上，还能将其作为普通函数的形参
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
