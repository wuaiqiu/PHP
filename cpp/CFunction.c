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
 * 2.C++带默认值的函数
 * 	 a.直接定义(注意部分有默认值一定从右到左)
 *	   void fun(int a,int b=3){}
 *
 *	 b.当使用使用函数原型(在函数原型中定义)
 *		void fun(int a,int b=3);
 *		void fun(int a,int b){}
 *
 * 3.C++函数重载
 *	 a.函数在同一个作用域
 *	 b.函数参数列表不同(参数类型，参数个数)
 *	 c.默认参数与重载结合使用，可能造成调用不明确
 *	 	void fun(int a,int b,int c=12){}
 *	 	void fun(int a,int b){}
 *	 	fun(1,2);//编译正常，运行报错
 *
 * 4.C++内联函数(将调用函数中的代码直接拷贝进调用者中)
 *		a.函数定义必须写inline
 *		b.inline只适合函数体内代码简单(1-5行)的函数使用，不能是递归函数，
 *在内联函数内不允许使用循环语句和开关语句；
 *		c.在类内部定义的函数会默认声明为inline函数,若在类外定义需要
 *	用inline作显式声明
 *	    d.宏定义在预处理阶段进行文本替换，inline函数在编译阶段进行替换；
 *  inline函数有类型检查，相比宏定义比较安全
 * */

inline void fun(){
	cout<<"fun1: Hello world !!!"<<endl;
}

int main(){
	fun();
	return 0;
}


/*
 * 5.C++11新特性:
 *	 1).Lambda表达式的基本语法
 *		[捕获外部变量列表](形参列表) mutable 异常设定 -> 返回类型 {
 *			// 函数体
 *		}
 *   2).捕获外部变量
 *      a).值捕获:被捕获的变量在lambda表达式被创建时拷贝，而非调用时才拷贝
 *		b).引用捕获:被捕获的变量不在lambda表达式被创建时拷贝，而在调用时才拷贝
 *		c).隐式捕获:[=]表示以值捕获的方式捕获外部变量，[&]表示以引用捕获的方式捕获外部变量
 *	3).修改捕获变量mutable:默认不加mutable关键字则捕获外部变量为只读模式，否则为读写模式
 *	4).形参列表:a.不能有默认参数；b.所有参数必须有参数名
 **/

int main() {
    //值捕获
    int a = 123;
    auto f1 = [a]() { cout << a << endl; };
    auto f2 = [=]() { cout << a << endl; };
    a = 321;
    f1(); //输出:123
    f2(); //输出:123

    //引用捕获
    int b = 123;
    auto f3 = [&b]() { cout << b << endl; };
    auto f4 = [&]() { cout << b << endl; };
    b = 321;
    f3(); //输出:321
    f4(); //输出:321

    //修改捕获变量mutable
    auto f5 = [a]() { a++; }; //报错
    auto f6 = [a]()mutable { a++; };
}


/*
 * 6.函数对象包装器
 *  1).function是可调用对象的包装器
 *  2).bind是用来提前绑定函数调用的参数的
 *  3).placeholders::_n表示占位符
 **/

int fun1(int para) {
    return para;
}

struct Student{
    int fun2(int para){
	return para;
    }
};

void fun3(int a,int b,int c){
  cout<<a<<" "<<b<<" "<<c<<endl;
}

int main() {
    //function<返回值(参数列表)>
    function<int(int)> a = fun1;
    cout << a(10) << endl; //10
    function<int(int)> b = [](int para){ return para;};
    cout << b(10) <<endl; //10
    function<int(Student&,int)> c = &Student::fun2;
    Student s;
    cout<< c(s,10) <<endl;;
    //bind(function,args)
    auto d = bind(fun3,1,placeholders::_1,3);
    d(2);
    return 0;
}