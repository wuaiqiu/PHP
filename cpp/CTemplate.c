/*
 *   泛型编程与面向对象编程(OOP)一样，都依赖于某种形式的多态性（面向对象编程所依赖的多态性
 * 称为运行时多态性，泛型编程所依赖的多态性称为运行时参数式多态性）
 * */

/*
 * C++模板
 *    1.函数模板:用一个模板函数完成函数重载功能
 * 	 a.作用域:仅对下面挨着的代码段有效
 * 	 b.具体化:指定某个类型需要单独处理
 * 	 c.调用顺序:普通函数>具体化>模板
 *       d.C++11可以设定默认值
 * */

//函数模板
template <typename T=double>
void fun(T a){
   cout<<"template"<<endl;
}
//函数模板具体化
template<> 
void fun<char>(char a){
   cout<<"char"<<endl;
}
//普通函数
void fun(int a){
   cout<<"int"<<endl;
}

int main(){
   fun(1); //int
   fun('a'); //char
   fun(1.1); //template
   return 0;
}


/*
 *  2.类模板
 *	 a.作用域:仅对下面挨着的代码段有效
 * 	 b.可以设定默认值
 *	 c.定义在外部的类名之前必须加上template的相关声明
 * 	 d.创建对象时，需要传递模板参数列表
 *	 e.特化与偏特化
 **/
 
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
	auto p = new Person<int>(1,'a');
	return 0;
}


//普通类模板
template <typename T>
class Student{
public:
  void info() {
       printf("普通类模板\n");
   }
};
//特化类模板
template <>
class Student<char>{
public:
  void info() {
       printf("特化类模板\n");
   }
};
//偏特化类模板
template <typename T>
class Student<T*>{
public:
  void info() {
       printf("偏特化类模板\n");
   }
};

int main(){
	auto p1 = new Student<char*>();
	auto p2 = new Student<char>();
	auto p3 = new Student<int>();
	p1->info();//偏特化类模板
	p2->info();//特化类模板
	p3->info();//普通类模板
	return 0;
}

/*
 * 3.声明为嵌套类型
 * 4.using定义类型
 **/
template <typename T>
struct Student{
  typedef T value_type;
}

//声明为嵌套类型而非静态成员
typename Student<int>::value_type a;
等价于
int a;

//定义类型
using a = Student<int>::value_type;
等价于
Student<int>::value_type a;
