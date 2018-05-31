#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/wait.h>

/*
 * 进程池:
 * 	 主进程通过管道与进程池各个子进程进行通信，并分发任务
 * */

#define PROCESS_MAX_NUM 3 //进程池中子进程数量

//进程结构体
typedef struct process{
	pid_t pid;  //进程PID
    int pipefd[2]; //通信管道
} process_t;

//进程池
typedef struct instance{
     int process_idx;        //当前子进程号
     struct process *proc;   //子进程列队
} instance_t;

//子进程循环执行函数
void worker(instance_t *pinst)  {
	int fd=pinst->proc[pinst->process_idx].pipefd[0];
    char buffer[10];
    printf("Worker#%d is Loop\n", pinst->process_idx);
    while(1){
    	int size=read(fd,buffer,sizeof(buffer));
    	if(size<=0)continue;
    	for(int i=0;i<size;i++){
    		switch(buffer[i]){
    			case 'A':
    				printf("This is A\n");
    				break;
    			case 'B':
    				printf("This is B\n");
    				break;
    			case 'Q':
    				goto END;
    		}
    	}
    }
    END:
		close(fd);
		printf("Worker#%d is shutdown\n", pinst->process_idx);
		exit(0);
}

//主进程执行函数，分发任务
void master(instance_t *pinst){
   int roll = 0;
   printf("Master#%u setup\n", pinst->process_idx);
   while(1){
	   int fd=pinst->proc[roll % PROCESS_MAX_NUM + 1].pipefd[1];
	   char c='A'+roll%2;
	   write(fd, &c, 1);
	   sleep(1);
	   if(roll==10)break;
	   roll++;
   }
   printf("Master#%u shutdown\n", pinst->process_idx);
   for(int i=1;i<=PROCESS_MAX_NUM;i++){
	   char c='Q';
	   int fd=pinst->proc[i].pipefd[1];
	   write(fd, &c, 1);
	   close(fd);
   }
}

//初始化进程池
void process_pool(instance_t *pinst){
	pinst->process_idx=0; //主进程0
    pinst->proc = (process_t *)calloc(PROCESS_MAX_NUM+1, sizeof(process_t));
    for (int i = 1; i <= PROCESS_MAX_NUM; i++ ) {
        pipe(pinst->proc[i].pipefd);
        printf("Setup worker#%d\n", i);
        pinst->proc[i].pid = fork();
        if ( pinst->proc[i].pid > 0 ) { //父进程
            close(pinst->proc[i].pipefd[0]);
            continue;
        }else { //子进程
            close(pinst->proc[i].pipefd[1]);
            pinst->process_idx = i;
            worker(pinst);
            goto EXIT;
        }
    }
    master(pinst);
    int status;
    for(int i = 1; i <= PROCESS_MAX_NUM; i++ ) {
        wait(&status);
    }
    EXIT:
	  exit(0);
}

int main(){
	instance_t* pinst=(instance_t*)calloc(1, sizeof(instance_t));
	process_pool(pinst);
	return 0;
}
