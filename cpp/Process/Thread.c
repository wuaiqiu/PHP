#include <stdio.h>
#include <pthread.h>
#include <unistd.h>
#include <semaphore.h>
#include <stdlib.h>

/*
 * 线程操作:
 *
 *	 int pthread_create(phtread_t* thread,pthread_attr_t* attr,void* (*start_routine)(void*),void* arg):
 * 创建一个线程(产生线程的标识符；所产生线程的属性通常为NULL；新的线程所执行的代码；新的线程
 * 的参数)
 *	 pthread_t pthread_self():获得线程自身的ID
 *	 int pthread_join(pthread_t thread,void** vlaue_ptr):等待线程结束(指定等待线程ID，被
 * 等待线程的返回值地址)
 * 	 void pthread_exit(void* value_ptr):终止一个线程(用来存储被等待线程的返回值地址)
 * 	 int pthread_cancel(pthread_t thread):取消一个非分离线程
 *	 int pthread_detach(pthread_t thread):分离一个线程
 * */

void* deal1(){
	printf("%lu: This is Thread1 starting\n",pthread_self());
	sleep(5);
	printf("%lu: This is Thread1 stoping\n",pthread_self());
	pthread_exit((void*)1);
}

void* deal2(){
	printf("%lu: This is Thread2 starting\n",pthread_self());
	sleep(5);
	printf("%lu: This is Thread2 stoping\n",pthread_self());
	pthread_exit((void*)1);
}

void fun1(){
	pthread_t tid1,tid2;
	pthread_create(&tid1,NULL,deal1,NULL);
	pthread_create(&tid2,NULL,deal2,NULL);
	printf("detach Thread2...\n");
	pthread_detach(tid2);
	printf("join Thread1...\n");
	pthread_join(tid1,NULL);
	printf("Parent Thread stop\n");
}

/*
 * 互斥锁:
 * 	 int pthread_mutex_init(pthread_mutex_t* mutex,pthread_mutexattr_t* attr):初始化互斥锁
 *	 int pthread_mutex_lock(pthread_mutex_t* mutex):加互斥锁
 *	 int pthread_mutex_unlock(pthread_mutex_t* mutex):释放互斥锁
 *	 int pthread_mutex_destroy(pthread_mutex_t* mutex):销毁互斥锁
 * */

pthread_mutex_t mutex;
int lock_var;

void* deal3(){
	for(int i=0;i<10;i++){
		pthread_mutex_lock(&mutex);
		lock_var++;
		printf("%lu: lock_var=%d\n",pthread_self(),lock_var);
		pthread_mutex_unlock(&mutex);
	}
	pthread_exit((void*)1);
}

void* deal4(){
	for(int i=0;i<10;i++){
		pthread_mutex_lock(&mutex);
		lock_var++;
		printf("%lu: lock_var=%d\n",pthread_self(),lock_var);
		pthread_mutex_unlock(&mutex);
	}
	pthread_exit((void*)1);
}

void fun2(){
	pthread_mutex_init(&mutex,NULL);
	pthread_t tid1,tid2;
	pthread_create(&tid1,NULL,deal3,NULL);
	pthread_create(&tid2,NULL,deal4,NULL);
	pthread_join(tid1,NULL);
	pthread_join(tid2,NULL);
	pthread_mutex_destroy(&mutex);
}

/*
 * 条件变量:
 *	int pthread_cond_init(pthread_cond_t *cond,pthread_condattr_t* cond_attr):初始化条件变量
 *	int pthread_cond_wait(pthread_cond_t *cond,pthread_mutex_t* mutex):检查条件，判端是否阻塞
 *  int pthread_cond_signal(pthread_cond_t *cond):唤醒一个阻塞的线程
 *	int pthread_cond_destroy(pthread_cont_t *cond):销毁一个条件变量
 * */

pthread_mutex_t count_lock;
pthread_cond_t count_nonzero;
int count=0;

void* deal5(){
	pthread_mutex_lock(&count_lock);
	printf("Thread1 get lock \n");
	if(count==0){
		printf("Thread1 is wating \n");
		pthread_cond_wait(&count_nonzero,&count_lock);
		printf("Thread1 get lock again \n");
	}
	count--;
	pthread_mutex_unlock(&count_lock);
	printf("Thread1 unlock\n");
	pthread_exit((void*)1);
}

void* deal6(){
	pthread_mutex_lock(&count_lock);
	printf("Thread2 get lock \n");
	if(count==0){
		printf("Thread2 is signal \n");
		pthread_cond_signal(&count_nonzero);
	}
	count++;
	pthread_mutex_unlock(&count_lock);
	printf("Thread2 unlock\n");
	pthread_exit((void*)1);
}

void fun3(){
	pthread_mutex_init(&count_lock,NULL);
	pthread_cond_init(&count_nonzero,NULL);
	pthread_t tid1,tid2;
	pthread_create(&tid1,NULL,deal5,NULL);
	pthread_create(&tid2,NULL,deal6,NULL);
	pthread_join(tid1,NULL);
	pthread_join(tid2,NULL);
	pthread_cond_destroy(&count_nonzero);
	pthread_mutex_destroy(&count_lock);
}

/*
 * 信号量:
 *  int sem_init(sem_t* sem,int pshared,unsigned int val):初始化一个信号量(pshared:0为
 *  线程间共享;val:信号量初始值)
 *  int sem_wait(sem_t* sem):判断当前信号量是否等于0，若等于则阻塞，否则信号量减1(P操作)
 *  int sem_post(sem_t* sem):增加信号量的值(V操作)
 *  int sem_destroy(sem_t* sem):释放信号量的资源
 * */

sem_t bin_sem;

void* deal7(){
	printf("Thread1 P starting... \n");
	sem_wait(&bin_sem);
	printf("Thread1 stop... \n");
	pthread_exit((void*)1);
}

void* deal8(){
	printf("Thread2 V starting... \n");
	sem_post(&bin_sem);
	printf("Thread2 stop... \n");
	pthread_exit((void*)1);
}

void fun4(){
	sem_init(&bin_sem,0,0);
	pthread_t tid1,tid2;
	pthread_create(&tid1,NULL,deal7,NULL);
	pthread_create(&tid2,NULL,deal8,NULL);
	pthread_join(tid1,NULL);
	pthread_join(tid2,NULL);
	sem_destroy(&bin_sem);
}

int main(){
	fun1();
	fun2();
	fun3();
	fun4();
	return 0;
}


/*
 *  1.线程:在Linux内核中，线程对应的结构和进程一样，都是对应task_struct结构，且进程创建
 * 和线程创建在底层的函数实现都是调用同一个API do_fork,区别就在于参数不同，线程创建不会
 * 分配资源，会共享某个进程的资源。而实际上CPU调度就是基于task_struct结构的。
 *
 *	2.非分离线程:非分离线程能够被其他线程收回其资源和杀死。在被其他线程回收之前，它的存储
 * 器资源（例如栈）是不释放的。 默认情况下，线程被创建成非分离的。需要调用pthread_join显示
 * 回收。
 *
 * 	3.分离线程:分离线程是不能被其他线程回收或杀死的，它的存储器资源在它终止时由系统自动释
 * 放。通过pthread_detach将其分离。
 *
 * 	4.线程同步:
 * 		a:互斥锁(Mutex):通过锁机制实现线程间的互斥，同一时刻只能一个线程可以加锁，其他线程
 * 	进入阻塞状态
 * 		b:条件变量(Cond):利用线程间共享的全局变量进行同步的一种机制，常与互斥锁一起使用，当
 * 	条件不满足时，线程会解开自身的互斥锁让给其他线程
 * 		c.信号量(Semaphore):可以实现PV操作（P表示通过的意思，V表示释放的意思）
 *
 *  5.线程模型
 *		a.用户级线程(1:N):内核没有线程的概念，对于内核来说，自己按照进程进行资源分配和调度。
 *	而用户程序在进程的基础上，实现了多线程。增加了用户程序的复杂度。在多核处理器，进程A的所
 *	有线程都必须在这个核上运行。因为内核以进程为单位进行调度的
 *		b.内核级线程(1:1):线程管理的所有工作由内核完成，应用程序没有进行线程管理的代码，只
 *	有一个到内核级线程的编程接口，内核为进程及其内部的每个线程维护上下文信息，调度也是在内核
 *	基于线程架构的基础上完成。充分利用多核处理器
 *
 * */

/*
 * 注意编译错误:gcc  pthread.c  -lpthread  -o pthread
 * eclipse:
 * 		Project->Properties->C/C++ Build->Settings->GCC C++ Linker->Libraries
 * 		在Libraries(-l)中添加pthread即可
 * 		在Libraries search path(-L)中添加crypto即可
 * */

/*
 * 单核(4个进程/线程)
 * DPJ:9.5365
 * DPZ:4.464
 * DTJ:8.9223
 * DTZ:4.5187
 *
 * 多核(4个进程/线程)
 * DPJ:4.9296
 * DPZ:3.0085
 * DTJ:4.6513
 * DTZ:3.0137
 * */

//创建多线程
int main(){
	pthread_t tid[4];
	for(int i=0;i<4;i++){
		if(i%2)
			pthread_create(&tid[i],NULL,fun,NULL);
		else
			pthread_create(&tid[i],NULL,fun1,NULL);
	}
	for(int i=0;i<4;i++){
		pthread_join(tid[i],NULL);
	}
	return 0;
}



/*
 * 线程局部存储（Thread Local Storage，TLS）
 * 	 int pthread_key_create(pthread_key_t *key,void (*destr_function) (void *)):
 * 	 创建一个类型为pthread_key_t类型的变量
 * 	 int pthread_setspecific(pthread_key_t key,void *pointer):存储值
 * 	 void *pthread_getspecific (pthread_key_t key):取出值
 * 	 int pthread_key_delete (pthread_key_t key):删除pthread_key_t类型的变量
 * */

pthread_key_t p_key;

void func1() {
      int *tmp = (int*)pthread_getspecific(p_key);
      printf("%d is runing in fun1\n",*tmp);
}

void *thread_func(void *args)  {
        pthread_setspecific(p_key,args);
        int *tmp = (int*)pthread_getspecific(p_key);
        printf("%d is runing in thread_fun\n",*tmp);
        *tmp = (*tmp)*100;//修改私有变量的值
        func1();
        return (void*)0;
}

int main(void) {
	pthread_t pa, pb;
	int a=1;
	int b=2;
	pthread_key_create(&p_key,NULL);
	pthread_create(&pa, NULL,thread_func,&a);
	pthread_create(&pb, NULL,thread_func,&b);
	pthread_join(pa, NULL);
	pthread_join(pb, NULL);
	pthread_key_delete(p_key);
	return 0;
}