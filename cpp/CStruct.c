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
 *   2.struct可以定义的时候用{}赋初值，但有构造函数时不可以
 *   3.struct更适合看成是一个数据结构的实现体，class更适合看成是一个对象的实现体
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