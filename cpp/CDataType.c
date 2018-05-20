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
 *
 *
 *3.变量
 *	  auto : 默认存储类型，动态数据区
 *	  static : 静态数据区（只在本源文件起作用）
 *	  extern : 导出非静态全局变量
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
 * C++新式类型转换(更加细致，更加安全)
 * 	 1.static_cast:
 * 	 	a.用于类层次结构中父子类之间指针或引用的转换。向上安全；向下不安全。
 * 	 	b.用于基本数据类型之间的转换，如把int转换成char。
 * 	 	c.把空指针转换成目标类型的空指针。
 * 	 	d.把任何类型的表达式转换成void类型。
 *		e.static_cast不能转换掉expression的const，volatile属性。
 *
 *	 2.dynamic_cast:
 *	 	a.用于类层次结构中父子类之间指针或引用的转换。向上安全；向下安全。
 *
 * 	 3.const_cast:
 *		a.常量指针被转化成非常量的指针，并且仍然指向原来的对象；
 *		b.常量引用被转换成非常量的引用，并且仍然指向原来的对象；
 *		
 * 	 4.reinterpret_cast:
 * 	 	a.new_type必须是一个指针、引用、算术类型、函数指针或者成员指针。
 * 	 	b.它可以把一个指针转换成一个整数，也可以把一个整数转换成一个指针。
 * */