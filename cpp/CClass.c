/*
 * C++类
 *
 * 	 1.成员变量
 * 	 	a.普通成员变量
 * 	 	b.成员常量:必须初始化且不能改变值
 * 	 	c.静态成员变量:必须在类外(全局范围)进行初始化
 *
 *	 2.成员函数
 *	 	a.成员函数:可以定义在类内，也可以定义在类外(必须加类限定)
 *		b.静态成员函数:不能使用this，只能访问静态成员，非静态函数可以访问一切
 *
 *   3.访问修饰符
 *   	a.private:类内可见(默认)
 *   	b.protected:类内可见，子类可见
 *   	c.public:全部可见
 */

class Person{
	public:
	int a=20; 		//普通成员变量
	const int b=1; //成员常量
	static int c; //静态成员变量
	void fun1(){ //实现在类内的成员函数
		cout<<this->a<<": Fun1"<<endl;
	}
	void fun2(); //实现在类外的成员函数
	static void fun3(){ //静态成员函数
		cout<<c<<": Static"<<endl;
	}
};

int Person::c=12;
void Person::fun2(){
	cout<<this->a<<": Fun2"<<endl;
}

int main(){
	Person p;
	cout<<p.a<<endl; //访问普通成员变量
	cout<<p.c<<endl; //访问静态成员变量
	cout<<Person::c<<endl; //访问静态成员变量
	p.fun1();
	p.fun2();
	Person::fun3();
	return 0;
}


/*
 *   5.构造函数
 *		a.可以有多个构造函数，无返回值
 *		b.构造函数调用时期:栈区普通对象声明;堆区指针对象进行new
 *		c.初始化列表:按成员变量声明顺序进行初始化，优先级比默认参数高
 *	 (在调用构造函数之前就初始化)
 *
 *	 6.析构函数(当类中有指向其他对象的指针则需要自定义析构函数，否则造成内存泄漏)
 *	    a.只有一个析构函数，没有参数，无返回值
 *	    b.构造函数调用时期:栈区普通对象作用区域失效;堆区指针对象进行delete;临时对象(存在于栈区);
 *	    c.自定义析构函数还是调用了默认的析构函数
 *
 *	 内存泄漏(memory leak):是指程序在申请内存后，无法释放已申请的内存空间，一次内存
 *  泄漏似乎不会有大的影响，但内存泄漏堆积后的后果就是内存溢出。 
 *	 内存溢出(out of memory):指程序申请内存时，没有足够的内存供申请者使用，或者说，给
 *  了你一块存储int类型数据的存储空间，但是你却存储long类型的数据，那么结果就是内存不
 *  够用，此时就会报错OOM,即所谓的内存溢出。 
 */

class Person{
public:
	int a,b,c;
	Person(int a,int b=3):b(2),c(b){  //构造函数
		this->a=a;
	}
	Person():b(2),c(b){		//构造函数
		this->a=11;
	}
	~Person(){ //析构函数
		cout<<"This is ～Person"<<endl;
	}
};

int main(){
	//a.栈区普通对象作用区域
	{
		Person p1(10); //1.实例化(栈区普通对象)
		cout<<p1.a<<endl;
		cout<<p1.b<<endl;
		cout<<p1.c<<endl;
	}

	//b.堆区指针对象进行delete
	Person* p2=new Person; //2.实例化(堆区指针对象)
	cout<<p2->a<<endl;
	delete p2;

	//c.临时对象(只作用于一条语句，当它赋值给一个对象，则控制权移交)
	cout<<Person(10).a<<endl;
}


/*
 * 7.常函数
 *	  a.构造函数与析构函数不能是常函数
 *	  b.可以使用成员变量，但不可以修改
 *	  c.常对象只能调用常函数，不能调用普通函数，非常对象既可以调用常函数又
 *	可以调用普通函数
 *
 * 8.拷贝构造函数
 *	  a.本质上是一个构造函数，只是参数为对象的常引用
 *	  b.使用方式:
 *	 	 CPerson p;
 *
 *	 	 CPerson p1(p);
 *	 	 CPerson p2=p;
 *	 	 CPerson p3=CPerson(p);
 *	 	 CPerson* p4=new CPerson(p);
 *	  c.默认拷贝构造函数只实现了浅拷贝(不会对对象中的对象进行拷贝)
 *
 * 9.友元函数(类)
 *    a.使用关键字friend
 *    b.友元函数不是类的成员函数，在类体外实现时，不需要加类限定
 *    c.友元函数可以访问类中的所有成员，但是没有this
 *    d.友元函数在调用上同一般函数一样，不必通过对象进行调用
 *	 e.友元函数可以访问对应类所有的成员
 * */

class Person{
public:
	int a=12;
	void fun1(){ 	   //普通函数
		cout<<"Common: "<<this->a<<endl;
	}
	void fun2() const{ //常函数
		cout<<"Const: "<<this->a<<endl;
	}
	Person(){ //默认构造函数

	}
	Person(const Person &p){ //拷贝构造函数
		this->a=p.a;
	}
private:
	friend int getAge(Person &p);//友元函数
	friend class Student;//友元类
};

//友元函数可以直接实现
int getAge(Person &p){
	return p.a;
}

//友元类的实现
class Student{
public:
	int getAge(Person &p){
		return p.a;
	}
};
int main(){
	Person p1; //普通对象
	p1.a=13;
	p1.fun1();
	p1.fun2();

	Person p3=p1; //拷贝对象
	p3.fun1();

	const Person p2; //常对象
	p2.fun2();
	return 0;
}


/*
 * 10.继承
 *    a.继承限定词
 *    	public:子类继承的控制限定符与父类相同
 *    	protected:父类中public在子类降为protected，其他都一样
 *    	private:父类中所有控制限定符在子类都为private，默认为private
 *    b.构造函数的继承
 *    	a).先执行父类的构造函数，在执行子类的构造函数
 *		b).调用父类有参构造函数，需要在子类的初始化参数列表中初始化
 *		c).子类可以指定调用父类的构造函数
 *	  c.析构函数的继承
 *	  	a).先执行子类的析构函数，在执行父类的析构函数
 *	  d.重定义(覆盖需要父类为虚函数)
 *	  	a).当子类出现与父类同名(只有同名即可)的成员，采用子类覆盖父类成员方式
 *	  	b).调用父类成员，可以使用类名作用域指定需要调用的成员
 *		c).返回类型必须相同，参数列表可以相同，可以不同
 *	  e.静态成员，友元，构造函数，析构函数不能被继承
 *	  f.C++支持多继承
 *	  g.虚继承:解决复杂的继承链关系，如继承关系链为菱形时，子类调用祖父类的成员，会
 *	 发生冲突，则可以在两个父类的继承限定词前加virtual关键字，即可在子类去除重复，不
 *	 建议使用，内存开销大
 * */

class Person{
public:
	Person(){
		cout<<"Person"<<endl;
	}
	Person(int a){
		cout<<"Person: "<<a<<endl;
	}
	~Person(){
		cout<<"Person destory"<<endl;
	}
	void show(){
		cout<<"This is Father"<<endl;
	}
};

class Student : public Person{
public:
	Student():Person(){
		cout<<"Student"<<endl;
	}
	Student(int a):Person(12){
		cout<<"Student: "<<a<<endl;
	}
	~Student(){
		cout<<"Student destroy"<<endl;
	}
	void show(){
		Person::show(); //类内调用父类成员函数
		cout<<"This is child"<<endl;
	}
};

int main(){
	Student stu1;
	stu1.show();
	stu1.Person::show(); //类外调用父类成员函数

	Student stu2(11);
	return 0;
}


/*
 * 11.多态
 *   a.只针对于堆区指针对象
 *   b.形如:"Person* p=new Student"，只会调用Person类中的成员，Student类所
 *  增加的成员失效
 *	 c.虚函数保证调用子类同名(参数列表相同，返回值相同)成员函数，当父类定义了虚函
 *	数，对应子类同名函数默认也为虚函数
 *	 d.当使用虚函数时，对应的父类需要指定虚析构函数，否则子类的析构函数不会被调用
 * 	 e.构造函数不能是虚构函数
 * 	 f.虚表:存储虚函数地址的表，在对象的前四个字节为虚表首地址，表中每个虚函数地址占
 * 	(int:32位系统;long:64为系统)字节大小
 * */

class Person{
public:
	virtual void show(){
		cout<<"This is Person"<<endl;
	}
	virtual void run(){
		cout<<"This is Person[Run]"<<endl;
	}
	virtual ~Person(){
		cout<<"Person is destroy"<<endl;
	}
};

class Student : public Person{
public:
	void show(){
		cout<<"This is Student"<<endl;
	}
	void fun(){//fun函数失效
		cout<<"This is Stduent[Fun]"<<endl;
	}
	~Student(){
		cout<<"Student is destroy"<<endl;
	}
};

int main(){
	Person* p=new Student;
	p->show();
	//利用虚表实现p->run()
	typedef void (*fun)();
	long* a=(long*)p; //虚表首地址指针
	long* b=(long*)*a+1; //run函数地址指针
	((fun)*b)(); //执行run函数
	delete p;
	return 0;
}


/*
 * 12.纯虚函数(类似抽象函数)
 * 	 a.没有函数实现
 * 	 b.父类中含有纯虚函数则父类不能实例化，子类必须实现纯虚函数才可以实例化
 * 	 b.抽象类:包含纯虚函数的类
 * 	 c.接口:成员函数全是纯虚函数，除构造函数
 *
 * */

class Person{
public:
	virtual void fun() = 0; //纯虚函数
	virtual ~Person()=0;
};

class Student : public Person{
public:
	void fun(){
		cout<<"I am Student"<<endl;
	}
	~Student(){
		cout<<"Student is destroy"<<endl;
	}
};

//实现纯析构函数
Person::~Person(){
	cout<<"Person is destroy"<<endl;
}

int main(){
	Student s;
	s.fun();
	return 0;
}


/*
 * 13.内部类
 *   a.内部类访问外部类成员:
 *   	a).通过在内部类定义外部类对象进行调用(此时与外部类对象不同)
 *   	b).通过内部类的构造函数传递外部类的指针对象(此时与外部类对象相同)
 *   b.外部类访问内部类成员:
 *   	a).通过在外部类定义内部类对象进行调用
 * */

class Person{
public:
	int a=10;

	//内部类调用外部类的成员
	Person():stu(this){}
	class Student{
	public:
		int b=12;
		Person* per;
		Student(Person* per){
			this->per=per;
		}
		void show(){
			cout<<"Student: "<<per->a<<endl;
		}
	};

	//外部类调用内部类的成员
	Student stu;
	void show(){
		cout<<"Person: "<<stu.b<<endl;
	}
};

int main(){
	Person p;
	p.show();
	p.stu.show();
	return 0;
}


/*
 *  14.动态联编与静态联编
 *	  a.静态联编是在编译阶段完成的，静态联编对函数的选择是基于对象的声明类型。
 * 	  b.动态联编是在运行阶段完成的，动态联编对函数的选择是基于对象的实例类型。
 * */

class A{
public:
	void fun1(){
		cout<<"A"<<endl;
	}
	virtual void fun2(){
		cout<<"A"<<endl;
	}
};

class B:public A{
public:
	void fun1(){
		cout<<"B"<<endl;
	}
	void fun2(){
		cout<<"B"<<endl;
	}

};

int main(){
	//静态联编
	A* pa=new B();
	pa->fun1(); //A
	//动态联编
	A* pb=new B();
	pb->fun2(); //B
	return 0;
}


/*
 * 15.C++11新增构造
 *	1.委托构造:使得构造函数可以在同一个类中一个构造函数调用另一个构造函数，不能同时使用委派构造函数和初始化列表
 *  	2.继承构造:将基类中的构造函数全继承到派生类
 *	  a.派生类的构造默认与基类一样,若派生类出现与基类相同的构造参数列表时，先调用基类在调用派生类
 *	  b.当派生类没有构造时，可以使用快速初始化成员变量(int d{3}) 
 *	  c.基类的构造函数有默认值的不会被继承
 **/

class Base {
public:
    Base() {
    	cout<<"Base1"<<endl;
    }
    //委托Base()构造函数
    Base(int value) : Base() {
    	cout<<"Base2"<<endl;
    }
};

class Subclass : public Base {
public:
	int d{3};
	//继承构造
    using Base::Base;
    Subclass(){
    	this->d=4;
    	cout<<"Subclass1"<<endl;
    }
};

int main()
{
	Subclass str1(2); //Base1 Base2
	cout<<str1.d<<endl; //3
	Subclass str2; //Base1 Subclass
	cout<<str2.d<<endl; //4
	return 0;
}


/*
 * 16.C++新增关键字
 *   1.override:显式的告知编译器进行重载
 *   2.final:为了防止类被继承以及虚函数被重载
 *   3.delete:显式禁用默认函数
 **/

struct Base {
    virtual void foo(int);
    virtual void hello(int) final;
};
struct SubClass: Base {
    void foo(int) override; //指定需要覆盖父类方法
    void foo(float) override; // 保错, 编译器检查到父类没有此虚函数
    void hello(int); //保错，hello不允许继承
};

(1).default关键字

class Magic {
public:
    Magic() = default; // 显式声明使用编译器生成的构造
    Magic(int magic_number);
};

等价于

class Magic {
public:
    Magic();
    Magic(int magic_number);
};

(2).delete关键字

class Magic {
public:
    Magic() = delete; // 显式声明使用编译器生成的构造
    Magic(int magic_number);
};

等价于

class Magic {
public:
    Magic(int magic_number);
};