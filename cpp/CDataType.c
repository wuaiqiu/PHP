/*
 * 数据类型
 *
 *1.基本数据类型
 * [unsigned] short(2字节)  [unsigned] int(4字节)  [unsigned] long(8字节) long long(8字节)
 * float(4字节)  double(8字节)  long double(16字节)
 * char(1字节)
 *
 *
 *2.常量
 *	const int a=3;
 *	与define预处理区别:
 *	  a.编译器处理方式不同:define宏是在预处理阶段展开。const常量是编译运行阶段使用。
 *	  b.类型和安全检查不同:define宏没有类型，不做任何类型检查。const常量有具体的类型，在编
 *	 译阶段会执行类型检查。
 *	  c.存储方式不同:const常量在程序运行过程中只有一份拷贝，而define定义的常量在内存中有若
 *	 干个拷贝。
 *
 *
 *3.变量
 *	  auto : 默认存储类型，动态数据区 ,C++11变成自动推导类型,不能用于推导数组元素类型;
 *	  static : 静态数据区（只在本源文件起作用）
 *	  extern : 导出非静态全局变量与函数，注意只需声明即可,函数默认是extern属性
 *	  register : C++11被弃用，可以使用但不再具备任何实际含义
 *
 * */

//2.cpp
int num = 5;

void func()
{
   cout<<"This is func"<<endl;
}

//1.cpp
int main(){
	extern int num;
	extern void func();
	cout<<"num: "<<num<<endl;
	func();
	return 0;
}


/*
 *4.C++引用变量(给已定义的变量取一个别名，而typedef是给类型取一个别名):
 *	  a.基本变量引用(定义时必须初始化):
 *			int a=12;
 *			int &b=a; 
 *	  b.数组变量引用(定义时必须初始化):
 *			int a[2];
 *			int (&b)[2]=a;
 *			int a[2][3];
 *			int (&b)[2][3]=a;
 *	  c.结构体引用(定义时必须初始化):
 *			Node a;
 *			Node &b=a;
 *	  d.指针引用(定义时必须初始化):
 *			int* a;
 *			int* &b=a;
 *	  e.做函数参数
 *			void fun(int &b){}
 *	  f.做函数返回值
 *			int& fun(int &b){
 *				return b;
 *			}
 * */


/*
 * 5.C++新式类型转换(更加细致，更加安全),C++11不在使用传统的类型转换
 * 	 1.static_cast:
 *	    a.编译时检查
 * 	    b.用于类层次结构中父子类之间指针或引用的转换,向下转不安全
 * 	    c.用于基本数据类型之间的转换
 * 	    d.把void指针与目标类型指针相互转换。
 *
 *	 2.dynamic_cast:
 *	    a.运行时检查，基本必须含有虚函数
 *	    b.目标必须时一个有效的指针(引用)
 *	    c.向下转安全
 *	   
 * 	 3.const_cast:
 *	    a.常量指针(引用)被转化成非常量的指针(引用)；
 *
 * 	 4.reinterpret_cast:
 * 	    a.它可以将任何指针转换为任何其他指针类型。
 * 	    b.它可以把一个指针转换成一个整数，也可以把一个整数转换成一个指针。
 * */

int main(){
	//1.将char型数据转换成int型数据
	char a = 'a';
	int b = static_cast<int>(a);
	//2.将double指针转换成void指针
	double* c = new double;
	void* d = static_cast<void*>(c);
	//3.将int型数据转换成const int型数据，但不能逆过来
	int e = 10;
	const int f = static_cast<const int>(e);
	//4.将Son指针转换成Father指针
	Son* s = new Son;
	Father* f = static_cast<Father*>(s);
	return 0;
}

int main(){
	//1.将Son指针转换成Father指针
	Son* a = new Son;
	Father* b = dynamic_cast<Father*>(a);
	//2.d将会等于NULL
	Father* c = new Father;
	Son* d = dynamic_cast<Son*>(c);
	//3.将Father指针转换成Son指针
	Father* e = new Son;
	Son* f = dynamic_cast<Son*>(a);
	return 0;
}

int main(){
	//1.将const Student型数据转换成Student型数据
	const Student* a = new Student;
	Student* b = const_cast<Student*>(a);
	return 0;
}


/*
 * 6.C++11右值引用
 *	1.左值是可以出现=左侧者
 *	2.右值是只能出现=右侧者
 *	3.当右值赋值的过程中，执行拷贝内存与释放内存，而右值引用则直接移动内存
 **/

//a.移动语义:将左值转换成右值
void process(int& i){
    cout << "右值引用"  << endl;
}
void process(int&& i){
    cout << "左值引用"  << endl;
}

int main(){
  int a = 0;
  process(a); // 右值引用
  process(move(a)); // 左值引用
  return 0;
}

//b.完美转发:避免转发过程右值变成左值
void process(int& i){
    cout << "右值引用"  << endl;
}
void process(int&& i){
    cout << "左值引用"  << endl;
}
void not_forward(int&& i){
    cout << "非完美转发"  << endl;
    process(i);
}
void per_forward(int&& i){
    cout << "完美转发"  << endl;
    process(forward<int>(i));
}

int main(){
  int a = 0;
  not_forward(move(a)); // 右值引用
  per_forward(move(a)); // 左值引用
  return 0;
}
