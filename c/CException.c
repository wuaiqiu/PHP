#include <stdio.h>
#include <errno.h>
#include <string.h>

/*
 * 错误处理(errno.h)
 *
 * 1.全局变量错误码 						errno
 * 2.自定义输出错误 						perror("发生了错误")
 * 3.输出详细信息的指针(string.h) 		char* strerror(errno)
 *
 *
 * 断言(assert.h)
 * 	void assert(int expression):如果expression为FALSE，assert会在标准错误stderr上显示错误
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
