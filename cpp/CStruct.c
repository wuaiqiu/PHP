/*
 * 1.结构体
 *	 struct 结构体名{
 *		 类型	  类型名;
 *		 ...
 *	 };
 *
 *	 struct student a={"wu",20};
 *	  a.类型名
 *	 struct student* p=&a;
 *	  p->类型名  ===  (*p).类型名  === a.类型名
 *
 *
 * 2.共用体
 *	 union 共用体名{
 *		 类型  类型名;
 *		 ...
 *	 };
 *
 *	 union student a={"wu",20};
 *		a.类型名
 *	 union student* p=&a;
 *		p->类型名  ===  (*p).类型名  === a.类型名
 *
 *		a.共用体任何时候只有一个成员存在
 *		b.共用体长度为最长成员的长度
 *
 *
 *3.typedof类型别名
 *		typedof 类型名 类型新名
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
 * 	  2.可以放函数定义
 * 	  3.是一个特殊的类(默认访问修饰符为public)
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