#include <stdio.h>
#include <ucontext.h>
#include <unistd.h>

/*
 *   int getcontext(ucontext_t* context):实例化context
 *   void makecontext(ucontext_t* context, void (*fun)(),int argc,...):绑定context
 *   int swapcontext(ucontext_t* scontext,ucontext_t* context):保存当前上下文scontext，
 *   并切换上下文context
 * */

void fun()  {
    printf("Hello world\n");
}

int main(){
	char stack[1024*128];
    ucontext_t child,parent;
    getcontext(&child);
    child.uc_stack.ss_sp = stack;
    child.uc_stack.ss_size = sizeof(stack);
    child.uc_stack.ss_flags = 0;
    child.uc_link = &parent;
    makecontext(&child,(void *)fun,0);
    swapcontext(&parent,&child);
    printf("This is parent\n");
	return 0;
}

/*
 *  ucontext:用于记录用户态执行"上下文"信息的结构体
 *
 *  typedef struct ucontext {
 *  	struct ucontext *uc_link;     //指向的上下文
 *  	stack_t uc_stack;
 *  } ucontext_t;
 *
 *  typedef struct{
 *  	void *ss_sp;  	//栈首地址
 *  	int ss_flags; 	//栈标记(通常为0)
 *  	size_t ss_size; //指定栈空间大小
 *  } stack_t;
 * */

/*
 * 	 协程是一个用户态的轻量级线程，但实际上多个协程同属一个线程。任意一个时刻，同一个线程不
 * 可能同时运行两个协程
 * */
