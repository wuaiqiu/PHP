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
 *	  auto : 默认存储类型，动态数据区 ,C++11变成自动推导类型,但不能用于函数传参,可以用模板函数代替
 * 还不能用于推导数组类型;
 *	  static : 静态数据区（只在本源文件起作用）
 *	  extern : 导出非静态全局变量与函数，注意只需声明即可,函数默认是extern属性
 *	  register : C++11被弃用，可以使用但不再具备任何实际含义
 *
 *
 *4.类型转换
 *	整型 --> 实型 : 整数部分不变，增加小数部分
 *	实型 --> 整型 : 整数部分不变，去除小数部分
 *	字符 --> 整型 : 高位为0，低8位为ascii码
 *	整型 --> 字符 : 低8位填充
 *
 *
 *5.类型判断(ctype.h)
 *	int isalnum(int c):该函数检查所传的字符是否是字母和数字。
 *	int isalpha(int c):该函数检查所传的字符是否是字母。
 *	int isdigit(int c):该函数检查所传的字符是否是十进制数字。
 *
 *	int tolower(int c):该函数把大写字母转换为小写字母。
 *	int toupper(int c):该函数把小写字母转换为大写字母。
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
 * C++引用变量(给已定义的变量取一个别名，而typedef是给类型取一个别名):
 *	  a.基本变量引用(定义时必须初始化):
 *			int a=12;
 *			int &b=a; 
 *	  b.数组变量引用:
 *			int a[2];
 *			int (&b)[2]=a;
 *			int a[2][3];
 *			int (&b)[2][3]=a;
 *	  c.结构体引用:
 *			Node a;
 *			Node &b=a;
 *	  d.指针引用:
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
 * C++新式类型转换(更加细致，更加安全),C++11不在使用传统的类型转换
 * 	 1.static_cast(与传统的强制转换相同):
 * 	 	a.用于类层次结构中父子类之间指针或引用的转换。向上安全；向下不安全。
 * 	 	b.用于基本数据类型之间的转换，如把int转换成char。
 * 	 	c.把空指针转换成目标类型的空指针。
 * 	 	d.把任何类型的表达式转换成void类型。
 *
 *			Type A = static_cast<Type>(B)
 *
 *	 2.dynamic_cast:
 *	 	a.用于类层次结构中父子类之间指针或引用的转换。向上安全；向下安全。
 *
 *			Type A = dynamic_cast<Type>(B)
 *
 * 	 3.const_cast:
 *		a.常量指针被转化成非常量的指针，并且仍然指向原来的对象；
 *		b.常量引用被转换成非常量的引用，并且仍然指向原来的对象；
 *
 *			Type A = const_cast<Type>(B)
 *
 * 	 4.reinterpret_cast:
 * 	 	a.它可以将任何指针转换为任何其他指针类型。
 * 	 	b.它可以把一个指针转换成一个整数，也可以把一个整数转换成一个指针。
 *
 * 	 		Type A = reinterpret_cast<Type>(B)
 * */

/*
 * C++11右值引用
 *	1.左值是可以出现=左侧者
 *	2.右值是只能出现=右侧者
 *	3.当右值赋值的过程中，执行拷贝内存与释放内存，而右值引用则直接移动内存
 **/

//a.移动语义:将左值转换成右值
void process(int& i)
{
    cout << "右值引用"  << endl;
}
void process(int&& i)//
{
    cout << "左值引用"  << endl;
}

int main()
{
  int a = 0;
  process(a); // 右值引用
  process(move(a)); // 左值引用
  return 0;
}

//b.完美转发:避免转发过程右值变成左值
void process(int& i)
{
    cout << "右值引用"  << endl;
}
void process(int&& i)
{
    cout << "左值引用"  << endl;
}
void not_forward(int&& i) 
{
    cout << "非完美转发"  << endl;
    process(i);
}
void per_forward(int&& i) 
{
	cout << "完美转发"  << endl;
    process(forward<int>(i));
}

int main()
{
  int a = 0;
  not_forward(move(a)); // 右值引用
  per_forward(move(a)); // 左值引用
  return 0;
}