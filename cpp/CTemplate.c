/*
 *   泛型编程与面向对象编程(OOP)一样，都依赖于某种形式的多态性（面向对象编程所依赖的多态性
 * 称为运行时对象多态性，泛型编程所依赖的多态性称为运行时参数多态性）
 * */

/*
 * C++模板
 *  1.函数模板:用一个模板函数完成函数重载功能
 * 	 a.作用域:仅对下面挨着的代码段有效
 * 	 b.具体化:指定某个类型需要单独处理
 * 	 c.调用顺序:普通函数>具体化>模板
 *   d.C++11可以设定默认值
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
 *  3.模板需要编译2次:在声明的地方对模板代码本身进行编译，在调用的地方对参数替换后的
 *代码进行编译。
 *
 *  4.模板和实现不能分离:因为在编译时模板并不能生成真正的二进制代码，而是在调用模板类
 *或函数时才会生成相应的模板类或函数的二进制代码，因为调用的文件只知道模板类或函数的声
 *明而找不到实现，结果在链接阶段找不到地址只好报错了。
 * */
