/*
 * C++模板(泛型编程思想)
 * 	 1.函数模板:用一个模板函数完成函数重载功能
 * 		a.作用域:仅对下面挨着的代码段有效
 * 		b.具体化:指定某个类型需要单独处理
 * 		c.实例化:生成指定类型的函数声明
 * 		d.调用顺序:普通函数>具体化>模板
 *
 * 	 2.类模板:
 * 	 	a.可以设定默认值
 * 	 	b.创建对象时，需要传递模板参数列表
 * 	 	c.作用域:仅对下面挨着的代码段有效
 *
 * */

struct Node{
	int a;
};

//函数模板<class T>或<typename T>
template <typename T>
void fun(T t){
	cout<<t<<endl;
}

//函数模板具体化
template<> void fun<Node>(Node node){
	cout<<node.a<<endl;
}

//函数模板实例化
template void fun<int>(int a);

//类模板
template <typename T,typename Z=char>
class Person{
public:
	Person(T t,Z z){
		cout<<t<<endl;
		cout<<z<<endl;
	}
};

int main(){
	Node node={2};
	fun(1);
	fun('a');
	fun(node);

	//创建类模板对象
	Person<int,char>* p=new Person<int,char>(1,'a');
	return 0;
}


/*
 * 3.继承模板
 * 	  a.直接在定义子类时指定固定类型
 * 	  b.通过子类模板参数列表传递
 * */

template <typename T>
class Person{
public:
	Person(T t){
		cout<<"Person: "<<t<<endl;
	}
};

//指定固定类型
class Student1:public Person<int>{
public:
	Student1():Person<int>(1){
		cout<<"Student: 1"<<endl;
	}
};

//通过子类模板参数列表传递
template <typename T>
class Student2:public Person<T>{
public:
	Student2():Person<T>(2){
		cout<<"Student: 2"<<endl;
	}
};

int main(){
	Student1 stu1;
	Student2<int> stu2;
	return 0;
}


/*
 * 4.多态模板:父类模板参数列表，由子类进行传递
 * */

template <typename T>
class Person{
public:
	virtual void show(){
		cout<<"This is Person"<<endl;
	}
	virtual ~Person(){}
};

template <typename X,typename Y>
class Student:public Person<X>{
public:
	void show(){
		cout<<"This is Student"<<endl;
	}
};

int main(){
	Person<int>* p=new Student<int,char>;
	p->show();
	return 0;
}