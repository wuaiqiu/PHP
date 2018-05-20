/*
 * 1.函数原型(函数声明)
 * 		若被调函数代码在调用者代码的后方，则需要提前声明被调函数
 * 			void fun(int a,int b);
 * 			void fun(int,int);
 * */

void fun(int a,int b);

int main(){
	fun(1,2);
	return 0;
}

void fun(int a,int b){
	printf("%d %d\n",a,b);
}

/*
 * 1.C++带默认值的函数
 * 	 a.直接定义(注意部分有默认值一定从右到左)
 *	   void fun(int a,int b=3){}
 *
 *	 b.当使用使用函数原型(在函数原型中定义)
 *		void fun(int a,int b=3);
 *		void fun(int a,int b){}
 *
 * 2.C++函数重载
 *	 a.函数在同一个作用域
 *	 b.函数参数列表不同(参数类型，参数个数)
 *	 c.默认参数与重载结合使用，可能造成调用不明确
 *	 	void fun(int a,int b,int c=12){}
 *	 	void fun(int a,int b){}
 *	 	fun(1,2);//编译正常，运行报错
 *
 * 3.C++内联函数(将调用函数的代码直接拷贝进调用者中)
 *		a.函数原型必须写inline
 *		b.函数定义必须写inline
 *		c.一般用在循环语句函数调用
 *		d.类中的成员函数默认都是内联函数
 * */

inline void fun(){
	cout<<"fun1: Hello world !!!"<<endl;
}

inline void fun2();

int main(){
	fun();
	fun2();
	return 0;
}

void fun2(){
	cout<<"fun2: Hello world !!!"<<endl;
}
