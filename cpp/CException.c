#include <stdio.h>
#include <errno.h>
#include <string.h>

/*
 * 错误处理(errno.h)
 *
 * 1.全局变量错误码 						errno
 * 2.自定义输出错误 						perror("发生了错误")
 * 3.输出详细信息的指针(string.h) 			char* strerror(errno)
 *
 *
 * 断言(assert.h)
 * 	void assert(int expression):他是宏定义，如果expression为FALSE，assert会在标准错误stderr上显示错误
 * 消息，并中止程序执行。
 * */


int main() {
	 FILE *pf = fopen ("unexist.txt", "rb");
	 if (pf == NULL){
		fprintf(stderr, "错误号: %d\n", errno);
	  	perror("通过perror输出错误\n");
	  	fprintf(stderr, "打开文件错误: %s\n", strerror(errno));
	  	return EXIT_FAILURE;
	 }else{
	  	fclose (pf);
	 }
	 return EXIT_SUCCESS;
}


/*
 * C++异常处理
 *  1.abort():中止程序
 *  2.try-catch:捕获错误，并处理
 * */

void fun(int a){
	if(a==0)
		throw(a);
}

int main(){
	try{
		fun(0);
	}catch(int a){
		cout<<a<<endl;
	}catch(...){
		cout<<"default"<<endl;
	}
	return 0;
}

/*
 *C++11:
 *  noexcept关键字:表示其修饰的函数不会抛出异常,若抛出了异常直接终止程序的运行
 **/

void Throw() { throw 1; }
void NoBlockThrow() { Throw(); }
void BlockThrow() noexcept { Throw(); }

int main() {
    try {
        Throw();
    }
    catch(...) {
        cout << "Found throw." << endl;     // Found throw.
    }

    try {
        NoBlockThrow();
    }
    catch(...) {
        cout << "Throw is not blocked." << endl;    // Throw is not blocked.
    }

    try {
        BlockThrow();   // terminate called after throwing an instance of 'int'
    }
    catch(...) {
        cout << "Found throw 1." << endl;
    }
}
