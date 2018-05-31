#include <stdio.h>
#include <pthread.h>
#include <unistd.h>
#include <semaphore.h>
#include <stdlib.h>

/*
 * 线程池:
 * 	将所有待处理的任务集中在队列，线程池中的线程轮流去取队列进行执行
 * */

#define MAX_THREAD_NUM 3 //线程池最大数量

//列队节点
struct list_node_t{
    struct list_node_t *next;
    void* data;
};

//列队
typedef struct queue{
    struct list_node_t *head;
    int used;
} queue_t;

//列队初始化
queue_t *queue_alloc(){
    queue_t *pqueue =(queue_t*)calloc(1, sizeof(queue_t));
    pqueue->head =(struct list_node_t*)calloc(1, sizeof(struct list_node_t));
    pqueue->head->next = NULL;
    pqueue->head->data = NULL;
    pqueue->used=0;
    return pqueue;
}
//进队
void queue_push(queue_t *pqueue, void* pdata){
    struct list_node_t *pnode = (struct list_node_t*)calloc(1, sizeof(struct list_node_t));
    pnode->data = pdata;
    pnode->next = NULL;
    struct list_node_t *tmp=pqueue->head;
    while(tmp->next!=NULL)tmp=tmp->next;
    tmp->next=pnode;
    pqueue->used++;
}

//出队
void* queue_pop(queue_t *pqueue){
	if(pqueue->used==0)return NULL;
    struct list_node_t *tmp = pqueue->head;
    while(tmp->next->next!=NULL)tmp=tmp->next;
    void* data=tmp->next->data;
    tmp->next=NULL;
    pqueue->used--;
    return data;
}

//线程池
typedef struct tpool{
    queue_t *queue; //工作列队
    pthread_mutex_t mutex; //互斥锁
    pthread_cond_t cond; //条件变量
    pthread_t tids[MAX_THREAD_NUM];//线程数组
} tpool_t;

//执行函数结构体
struct routine {
    void *args;
    void (*callback)(void *);
};

//执行函数
void worker_routine(tpool_t *phead){
    struct routine *prt = NULL;
    pthread_mutex_lock(&phead->mutex);
    if (phead->queue->used==0) {
        printf("Thread #%lu go sleep!\n",pthread_self());
        pthread_cond_wait(&phead->cond, &phead->mutex);
        printf("Thread #%lu wakeup!\n",pthread_self());
    }
    prt = (struct routine *)queue_pop(phead->queue);
    pthread_mutex_unlock(&phead->mutex);
    prt->callback(prt->args);
}

//线程循环执行体
void* worker(void *args)  {
    tpool_t *phead = (tpool_t *)args;
    while (1) {
       worker_routine(phead);
    }
    pthread_exit((void*)1);
}

//线程池初始化
tpool_t *tpool_alloc(){
    tpool_t *phead =(tpool_t *)calloc(1, sizeof(tpool_t));
    phead->queue = queue_alloc();
    pthread_mutex_init(&phead->mutex, NULL);
    pthread_cond_init(&phead->cond, NULL);
    for (int i = 0; i < MAX_THREAD_NUM; i++ ) {
        pthread_create(&phead->tids[i], NULL,worker,phead);
    }
    return phead;
}

//添加工作到列队
void tpool_routine_add(tpool_t *phead, void (*callback)(void *), void *args){
    struct routine *prt = (struct routine *)calloc(1, sizeof(struct routine));
    prt->callback = callback;
    prt->args = args;
    pthread_mutex_lock(&phead->mutex);
    queue_push(phead->queue, prt);
    pthread_cond_signal(&phead->cond);
    pthread_mutex_unlock(&phead->mutex);
}

//线程池销毁
void tpool_destory(tpool_t *phead){
    for (int i = 0; i < MAX_THREAD_NUM; i++ ){
        pthread_cancel(phead->tids[i]);
    }
    pthread_mutex_destroy(&phead->mutex);
    pthread_cond_destroy(&phead->cond);
}

void fun1(int a){
	printf("[%d]:I am fun1\n",a);
}

void fun2(int a){
	printf("[%d]:I am fun2\n",a);
}
int main(){
	tpool_t* phead=tpool_alloc();
	for(int i=0;i<10;i++){
		if(i%2)
			tpool_routine_add(phead, fun1,i);
		else
			tpool_routine_add(phead, fun2,i);
	}
	sleep(10);
	tpool_destory(phead);
	return 0;
}

/*
 * 	 惊群效应:当多个线程在等待同一资源时，每当资源可用，所有的线程都来竞争资源，造成的后果：
 * 系统对用户线程频繁的做无效的调度、上下文切换。对资源重复进行加锁保护，进一步加大了系统开销。
 * 	pthread_cond_signal不会有“惊群现象”产生，他最多只给一个线程发信号。
 * 	pthread_cond_broadcast，这个是广播给所有等待任务的消费者，会产生惊群效应。
 * */