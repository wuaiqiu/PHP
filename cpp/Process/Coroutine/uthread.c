#include <stdlib.h>
#include <ucontext.h>
#include "uthread.h"

//协程状态
enum ThreadState {
	FREE, RUNNING, SUSPEND
};

//协程的结构体
typedef struct uthread_t {
	ucontext_t ctx;
	Function func;
	void *args;
	enum ThreadState state;
	char stack[DEFAULT_STACK_SZIE];
} uthread_t;

//调度器的结构体
typedef struct schedule_t {
	ucontext_t main;
	int running_thread_id;
	uthread_t threads[MAX_UTHREAD_SIZE];
	int max_index;
} schedule_t;

//调度器全局变量
schedule_t* schedule;

//初始化调度器
void uthread_init() {
	schedule = (schedule_t*) malloc(sizeof(schedule_t));
	schedule->running_thread_id = -1;
	schedule->max_index = 0;
	for (int i = 0; i < MAX_UTHREAD_SIZE; i++)
		schedule->threads[i].state = FREE;
}

//执行上下文
void uthread_exec() {
	int id = schedule->running_thread_id;
	if (id != -1) {
		uthread_t *t = &(schedule->threads[id]);
		t->func(t->args);
		t->state = FREE;
		schedule->running_thread_id = -1;
	}
}

//创建一个协程
int uthread_create(Function func, void *args) {
	int id = 0;
	for (; id < schedule->max_index; ++id) {
		if (schedule->threads[id].state == FREE) {
			break;
		}
	}
	if (id == MAX_UTHREAD_SIZE)
		return -1;
	if (id == schedule->max_index) {
		schedule->max_index++;
	}
	uthread_t *t = &(schedule->threads[id]);
	t->func = func;
	t->args = args;
	t->state = RUNNING;
	getcontext(&(t->ctx));
	t->ctx.uc_stack.ss_sp = t->stack;
	t->ctx.uc_stack.ss_size = DEFAULT_STACK_SZIE;
	t->ctx.uc_stack.ss_flags = 0;
	t->ctx.uc_link = &(schedule->main);
	schedule->running_thread_id = id;
	makecontext(&(t->ctx), (void *) uthread_exec, 0);
	swapcontext(&(schedule->main), &(t->ctx));
	return id;
}

//挂起一个协程，并切换到主进程中
void uthread_yield() {
	if (schedule->running_thread_id != -1) {
		uthread_t *t = &(schedule->threads[schedule->running_thread_id]);
		t->state = SUSPEND;
		schedule->running_thread_id = -1;
		swapcontext(&(t->ctx), &(schedule->main));
	}
}

//恢复运行一个协程
void uthread_resume(int id) {
	if (id < 0 || id >= schedule->max_index) {
		return;
	}
	uthread_t *t = &(schedule->threads[id]);
	if (t->state == SUSPEND) {
		swapcontext(&(schedule->main), &(t->ctx));
	}
}

//判断调度器中的协程是否全部运行完毕
int schedule_finished() {
	if (schedule->running_thread_id != -1) {
		return 0;
	} else {
		for (int i = 0; i < schedule->max_index; ++i) {
			if (schedule->threads[i].state != FREE) {
				return 0;
			}
		}
	}
	return 1;
}

//销毁调度器
void uthread_destory() {
	free(schedule);
	schedule = NULL;
}
