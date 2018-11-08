#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/wait.h>


/*
 * 	pid_t getpid():取得当前进程的进程号
 * 	pid_t getppid():取得当前进程的父进程号
 * 	unsigned int sleep(unsigned int seconds):让进程暂停执行seconds秒
 * 	pid_t fork():建立子进程(在子进程中返回0，在父进程中返回子进程的PID)
 * 	pid_t vfork():建立子进程，并保证子进程一定优先于父进程
 *	pid_t wait(int* status):等待子进程中断或结束,status为子进程状态
 *	pid_t waitpid(pid_t pid,int* status,int options):等待指定的子进程中断或结束
 *	WIFEXITED(status):如果子进程正常结束，它就返回真；否则返回假。
 *	WEXITSTATUS(status):如果WIFEXITED(status)为真，则可以用该宏取得子进程exit()返回的结束代码。
 *	WIFSIGNALED(status):如果子进程因为一个捕获的信号而终止，它就返回真；否则返回假。
 *	WTERMSIG(status):如果WIFSIGNALED(status)为真，则可以用该宏获得导致子进程终止的信号代码。
 *	WIFSTOPPED(status):如果当前子进程被暂停了，则返回真；否则返回假。
 *	WSTOPSIG(status):如果WIFSTOPPED(status)为真，则可以使用该宏获得导致子进程暂停的信号代码。
 * 	void exit(int status):正常程序退出
 * */

void fun1(){
	char* message;
	int status;
	pid_t pid=fork();
	if(pid==0){
		message="This is child\n";
		printf("child: %d\n",getpid());
		sleep(10);
		exit(1);
	}else{
		message="This is parent\n";
		printf("parent: %d\n",getpid());
		wait(&status);
		if(WIFSIGNALED(status))
			printf("中断代码:%d\n",WTERMSIG(status));
		if(WIFEXITED(status))
			printf("终止代码:%d\n",WEXITSTATUS(status));
		sleep(5);
	}
}


int main(){
	fun1();
	return 0;
}

/*
 * options:
 * 		WNOHANG:如果指定PID的子进程没有结束，则马上返回，不予等待
 * 		WUNTRACED:如果子进程进入暂停执行则马上返回，不予等待
 * */


/*
 *   1.进程描述的是资源分配的单位，每个进程都有一个线程。创建撤销切换开销大，资源要重新分配
 * 和收回，进程间相互独立，互不影响。创建和撤销和切换的消耗高。主要解决通信问题。
 *
 * 	 2.线程可以理解为轻量级进程，是CPU调度的单位，一个逻辑CPU核心在某一时刻只能运行一个线程。
 * 基本上不拥有独立资源。线程共享一个进程下面的资源，可以互相影响(安全性低)。创建和撤销和切
 * 换的消耗低。主要解决同步问题。
 *
 *	 3.协程可以理解为纯用户态的轻量级线程，其通过协作而不是抢占来进行切换。相对于线程，协程
 * 所有的操作都可以在用户态完成，创建和撤销和切换(不是线程切换，因为它只有一条线程)的消耗更
 * 低。
 *
 * 	 4.上下文切换:从一个进程(线程)切换到另一个进程(线程)的过程，上下文切换时会消耗CPU时间。
 *  进程切换比线程切换更耗时
 *
 * 	 5.物理核:物理核数量=CPU数*每个CPU的核心数
 * 	 	CPU数:cat /proc/cpuinfo | grep "physical id" | sort | uniq | wc -l
 * 	 	CPU物理核数:cat /proc/cpuinfo | grep "core id" | sort | uniq | wc -l
 * 	 	CPU逻辑核数:cat /proc/cpuinfo | grep "processor" | sort | uniq | wc -l
 *
 * 	 6.虚拟核:所谓的4核8线程，4核指的是物理核心。在操作系统看来是8个核，但是实际上是4个物理
 * 	 核。通过超线程技术可以实现单个物理核实现线程级别的并行计算，但是比不上性能两个物理核。
 *
 * 	 7.单核CPU和多核CPU:都是一个CPU，不同的是每个CPU上的核心数，多核CPU是多个单核CPU的替代方
 * 案，多核CPU减小了体积，同时也减少了功耗。
 *
 * 	 8.计算密集型:程序主要为复杂的逻辑判断和复杂的运算。CPU的利用率高，不用开太多的进程(线程)，开
 * 太多进程(线程)反而会因为线程切换时切换上下文而浪费资源。
 *
 * 	 9.IO密集型:程序主要为IO操作，比如磁盘IO(读取文件)和网络IO(网络请求)。因为IO操作会阻塞
 * 线程，CPU利用率不高，可以开多点线程，阻塞时可以切换到其他就绪线程，提高CPU利用率。
 *
 * 	10.孤儿进程：一个父进程退出，而它的一个或多个子进程还在运行，那么那些子进程将成为孤儿进程。
 * 孤儿进程将被init进程(进程号为1)所收养，并由init进程对它们完成状态收集工作，init进程会wait()
 * 这些孤儿进程，释放它们占用的系统进程表中的资源。
 *
 * 	11.僵尸进程：一个进程使用fork创建子进程，如果子进程退出，而父进程并没有调用wait或
 * waitpid获取子进程的状态信息，那么子进程的进程描述符仍然保存在系统中。
 *
 * */


/*
 * 	1.用户空间就是用户进程所在的内存区域
 * 	2.系统空间就是操作系统占据的内存区域
 * 	3.处于用户态的程序只能访问用户空间，而处于内核态的程序可以访问用户空间和内核空间
 * 	4.CPU执行内核代码和执行用户程序代码没什么区别；但是注意到，内核代码对用户参数是充
 * 	分的不信任,每次都要进行检查
 * 	5.用户态切换到内核态的3种方式:
 * 		a. 系统调用:这是用户态进程主动要求切换到内核态的一种方式，用户态进程通过系统
 * 		调用申请使用操作系统提供的服务程序完成工作，比如fork()实际上就是执行了一个创
 * 		建新进程的系统调用。(进程控制,文件系统控制,内存管理,网络管理,用户管理)
 *
 * 		b. 异常:当CPU在执行运行在用户态下的程序时，发生了某些事先不可知的异常，这时
 * 		会触发由当前运行进程切换到处理此异常的内核相关程序中，也就转到了内核态，比如
 * 		缺页异常.(物理页不可写或不存在，需要内核态进行分配)
 *
 * 		c. 外围设备的中断:当外围设备完成用户请求的操作后，会向CPU发出相应的中断信号，
 * 		这时CPU会暂停执行下一条即将要执行的指令转而去执行与中断信号对应的处理程序，
 * 		如果先前执行的指令是用户态下的程序，那么这个转换的过程自然也就发生了由用户态
 * 		到内核态的切换。比如硬盘读写操作完成，系统会切换到硬盘读写的中断处理程序中执
 * 		行后续操作等。
 * */

//创造多进程
int main(){
	pid_t pid;
	for (int i = 0; i < 4; i++){
		pid = fork();
	  if (pid == 0) break;
	}
	if (pid == 0){
		if(getpid()%2)
			fun();
		else
			fun1();
	}else{
		while(wait(NULL)!=-1);
	}
	return 0;
}