#ifndef UTHREAD_H_
#define UTHREAD_H_
	//每个协程所需的栈空间大小
	#define DEFAULT_STACK_SZIE (1024*4)
	//协程个数
	#define MAX_UTHREAD_SIZE  10
	//函数类型
	typedef void* (*Function)(void *args);
	//初始化调度器
	void uthread_init();
	//创建一个协程
	int uthread_create(Function func, void *args);
	//挂起一个协程，并切换到主进程中
	void uthread_yield();
	//恢复运行一个协程
	void uthread_resume(int id);
	//判断调度器中的协程是否全部运行完毕
	int schedule_finished();
	//销毁调度器
	void uthread_destory();
#endif
