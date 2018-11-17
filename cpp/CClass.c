/*
 * C++类
 *
 * 1.成员变量
 * 	 a.普通变量:类内进行初始化
 * 	 b.常量:类内进行初始化
 * 	 c.静态变量:类外进行初始化
 *
 *  2.成员函数:类内进行初始化，类外进行初始化(常用)
 *	 a.普通函数
 * 	 b.常函数
 *	   1).构造函数与析构函数不能是常函数
 *	   2).可以使用成员变量，但不可以修改
 *	   3).常对象只能调用常函数，不能调用普通函数，非常对象既可以调用常函数又
 *	可以调用普通函数
 *	 c.静态函数:不能使用this，只能访问静态成员，非静态函数可以访问一切
 *
 *  3.this指针(在成员函数的开始执行前构造的，在成员函数的执行结束后清除)
 *   a.普通函数:this ---> Person* const p;
 *   b.常函数:this ---> const Person* const p;
 *
 *  4.访问修饰符
 *   	a.private:类内可见(默认)
 *   	b.protected:类内可见，子类可见
 *   	c.public:全部可见
 */

class Person{
public:
    int a=1;	//普通变量
    const int b=2;	//常量
    static int c;	//静态变量
    void fun1();	//普通函数
    void fun2() const;	//常函数
    static void fun3();//静态函数
};

int Person::c=3;

void Person::fun1(){
    cout<<"This is fun1"<<endl;
}
void Person::fun2() const{
    cout<<"This is fun2"<<endl;
}
void Person::fun3(){
    cout<<"This is fun3"<<endl;
}

int main(){
    Person p;
    cout<<p.a<<endl;	//访问普通变量
    cout<<p.b<<endl;	//访问常量
    cout<<Person::c<<endl;	//访问静态变量
    p.fun1();	//访问普通函数
    p.fun2();	//访问常函数
    Person::fun3();	//访问静态函数
    return 0;
}


/*
 * 5.构造函数
 *	a.可以有多个构造函数，无返回值
 *	b.构造函数调用时期:栈区普通对象声明;堆区指针对象进行new
 *	c.初始化列表:按成员变量声明顺序进行初始化，优先级比形参高
 *
 * 6.析构函数(当类中有指向其他对象的指针则需要自定义析构函数，否则造成内存泄漏)
 *	a.只有一个析构函数，没有参数，无返回值
 *	b.构造函数调用时期:栈区普通对象作用区域失效;堆区指针对象进行delete;临时对象(存在于栈区);
 *	c.自定义析构函数还是调用了默认的析构函数
 *
 *	内存泄漏(memory leak):是指程序在申请内存后，无法释放已申请的内存空间，一次内存
 *  泄漏似乎不会有大的影响，但内存泄漏堆积后的后果就是内存溢出。
 *	内存溢出(out of memory):指程序申请内存时，没有足够的内存供申请者使用，或者说，给
 *  了你一块存储int类型数据的存储空间，但是你却存储long类型的数据，那么结果就是内存不
 *  够用，此时就会报错OOM,即所谓的内存溢出。
 */

class Person{
public:
    int a,b,c;
    Person(); //构造函数
    Person(int a); //构造函数
    ~Person(); //析构函数
};

Person::Person():a(1),b(a+1),c(b+1){

}
Person::Person(int p):a(1),b(a+1),c(b+1){
    this->a=p;
}
Person::~Person(){
    cout<<"This is ～Person"<<endl;
}

int main(){
    //a.栈区普通对象作用区域
    {
        Person p1(10); //1.实例化(栈区普通对象)
        cout<<p1.a<<endl; //10
        cout<<p1.b<<endl; //2
        cout<<p1.c<<endl; //3
    }

    //b.堆区指针对象进行delete
    auto p2=new Person; //2.实例化(堆区指针对象)
    cout<<p2->a<<endl; //1
    cout<<p2->b<<endl; //2
    cout<<p2->c<<endl; //3
    delete p2;

    //c.临时对象(只作用于一条语句，当它赋值给一个对象，则控制权移交)
    cout<<Person(10).a<<endl; //10
    return 0;
}


/*
 * 7.拷贝构造函数
 *    a.本质上是一个构造函数，只是参数为对象的常引用
 *    b.使用方式:
 *	   CPerson p;
 *	   CPerson p1(p);
 * 	   CPerson p2=p;
 *	   CPerson p3=CPerson(p);
 *	   CPerson* p4=new CPerson(p);
 *    c.默认拷贝构造函数只实现了浅拷贝(不会对对象中的对象进行拷贝)
 *    d.构造拷贝与赋值拷贝的区别是否有新对象产生
 *    e.explicit关键字禁止单参数构造函数隐式转换
 *
 * 8.友元函数(类)
 *    a.使用关键字friend，其声明可以放在类的私有部分，也可放在共有部分
 *    b.友元函数不是类的成员函数，友元函数的定义在类体外实现，不需要加类限定
 *    c.友元函数可以访问类中的所有成员，但是没有this
 * */

class Person{
private:
    int a;
public:
    Person(); //默认构造函数
    Person(const Person &p); //拷贝构造函数
    friend int getAge(Person &p); //友元函数
    friend class Student; //友元类
};

Person::Person():a(1){

}
Person::Person(const Person &p){
    this->a=p.a;
}
int getAge(Person &p){
    return p.a;
}

class Student{
public:
    int getAge(Person &p){
        return p.a;
    }
};

int main(){
    Person p1; //普通对象
    Student s; //友元类
    cout<<getAge(p1)<<endl; //调用友元函数
    Person p2(p1); //构造拷贝对象
    cout<<s.getAge(p2)<<endl;//调用友元函数
    return 0;
}

class Student{
public:
    Student(int size) {
        cout<<"size:"<<size<<endl;
    }

    explicit Student(char a) {
    	cout<<"char:"<<a<<endl;
    }
};

//默认可以隐式转换
Student stu1 = 10; //size: 10
//禁止隐式转换
Student stu2 = 'a'; //error

/*
 * 9.继承
 *    a.继承限定词
 *    	public:子类继承的控制限定符与父类相同
 *    	protected:父类中public在子类降为protected，其他都一样
 *    	private:父类中所有控制限定符在子类都为private，默认为private
 *    b.构造函数的继承
 *    	a).先执行父类的构造函数，在执行子类的构造函数
 *	    b).调用父类有参构造函数，需要在子类的初始化参数列表中初始化
 *	    c).子类可以调用指定父类的构造函数
 *    c.析构函数的继承
 *	    a).先执行子类的析构函数，在执行父类的析构函数
 *    d.重定义
 *	    a).当子类出现与父类同名(只要同名即可)的成员，采用子类重定义父类成员方式
 *	    b).调用父类成员，可以使用类名作用域指定需要调用的成员
 *    e.静态成员，友元，构造函数，析构函数不能被继承
 *    f.C++支持多继承
 * */

class Person{
public:
	Person();
	Person(int a);
	void show(int a,int b);
	~Person();
};

Person::Person(){
	cout<<"Person"<<endl;
}
Person::Person(int a){
	cout<<"Person1"<<endl;
}
void Person::show(int a,int b){
	cout<<"Person("<<a<<","<<b<<")"<<endl;
}
Person::~Person(){
	cout<<"Person destory"<<endl;
}

class Student : public Person{
public:
	Student();
	Student(int a);
	void show(int a);
	~Student();
};

Student::Student(){
	cout<<"Student"<<endl;
}
Student::Student(int a):Person(a){
	cout<<"Student1"<<endl;
}
void Student::show(int a){
	cout<<"Student("<<a<<")"<<endl;
}
Student::~Student(){
	cout<<"Student destroy"<<endl;
}

int main(){
	//Person => Student => Student destroy => Person destory
	Student stu;
	//Person1 => Student1 => Student destroy => Person destory
	Student stu1(1);
	stu.show(1);//Student(1)
	stu.Person::show(1,2); //Person(1,2)
	stu.show(1,2);//error
	return 0;
}


/*
 * 10.多态
 *   a.只针对于堆区指针对象
 *   b.形如:"Person* p=new Student"，默认只会调用Person类中的成员，Student类所
 *  增加的成员失效
 *   c.覆盖:虚函数保证调用子类同名(参数列表相同，返回值相同)成员函数
 *   d.当使用虚函数时，对应的父类需要指定虚析构函数，否则子类的析构函数不会被调用
 *   e.构造函数不能是虚函数
 *   f.虚表:存储虚函数地址的表，在对象的前四个字节为虚表首地址
 *	 g.虚继承:解决复杂的继承链关系，如继承关系链为菱形时，子类调用祖父类的成员，会
 *  发生冲突，则可以在两个父类的继承限定词前加virtual关键字，即可在子类去除重复，不
 *  建议使用，内存开销大
 *
 *    静态联编是在编译阶段完成的，静态联编对函数的选择是基于对象的声明类型。
 *    动态联编是在运行阶段完成的，动态联编对函数的选择是基于对象的实例类型。
 * */

class Person{
public:
	vitrual void show(int a);
	vitrual ~Person();
};

void Person::show(int a){
	cout<<"Person("<<a<<")"<<endl;
}
Person::~Person(){
	cout<<"Person is destroy"<<endl;
}

class Student : public Person{
public:
	void show(int a);
	~Student();
};

void Student::show(int a){
	cout<<"Student("<<a<<")"<<endl;
}
Student::~Student(){
	cout<<"Student is destroy"<<endl;
}

int main(){
	Person* p=new Student;
	p->show(1); //Student(1)
	delete p;
	return 0;
}


/*
 * 11.纯虚函数(类似抽象函数)
 * 	 a.没有函数实现
 * 	 b.父类中含有纯虚函数则父类不能实例化，子类必须实现纯虚函数才可以实例化
 * 	 b.抽象类:包含纯虚函数的类
 * 	 c.接口:成员函数全是纯虚函数，除构造函数
 *
 * */

class Person{
public:
	virtual void fun()=0; //纯虚函数
	virtual ~Person()=0;//纯虚函数
};

Person::~Person(){
	cout<<"Person is destroy"<<endl;
}

class Student : public Person{
public:
	void fun();
	~Student();
};

void Student::fun(){
	cout<<"I am Student"<<endl;
}
Student::~Student(){
	cout<<"Student is destroy"<<endl;
}

int main(){
	Student s;
	s.fun();
	return 0;
}


/*
 * 12.C++11新增构造
 *	1).委托构造:使得构造函数可以在同一个类中一个构造函数调用另一个构造函数，不能同时使用委派构造函数和初始化列表
 *  2).继承构造:将基类中的构造函数全继承到派生类，派生类的构造默认与基类一样,即派生类不需要构造函数
 **/

class Base {
public:
    Base();
    Base(int value);
};

Base::Base(){
    cout<<"Base1"<<endl;
}
//委托构造
Base::Base(int value):Base() {
    cout<<"Base2"<<endl;
}

class Subclass : public Base {
public:
    //继承构造
    using Base::Base;
};

int main(){
  Subclass str1(1); //Base1 Base2
  return 0;
}


/*
 * 13.C++新增关键字
 *   1.override:显式的告知编译器进行重载，不是重载则保错
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
    Magic() = delete; // 显式声明不用编译器生成的构造
    Magic(int magic_number);
};

等价于

class Magic {
public:
    Magic(int magic_number);
};