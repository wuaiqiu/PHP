#include <stdio.h>
#include <sys/epoll.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <strings.h>
#include <arpa/inet.h>
#include <unistd.h>

/*
 *  I/O复用之Epoll函数
 *
 *	 int epoll_create(int size):生成一个epoll专用的文件描述符
 *	 int epoll_ctl(int epfd,int op,int fd,struct epoll_event *event):注册要监听的事件
 *	 int epoll_wait(int epfd,struct epoll_event *events,int maxevents,int timeout):等待事件的产生
 *	 int close(int epfd):关闭这个创建出来的epoll句柄
 * */

int main(void){
		int fd1,fd2,epfd;
		struct sockaddr_in saddr1,saddr2,caddr;
		struct epoll_event event1,event2,wait_event;

		saddr1.sin_family = AF_INET;
		saddr1.sin_port   = htons(8000);
		saddr1.sin_addr.s_addr = INADDR_ANY;
		bzero(&(saddr1.sin_zero),8);
		fd1 = socket(AF_INET,SOCK_DGRAM, 0);

		saddr2.sin_family = AF_INET;
		saddr2.sin_port   = htons(8001);
		saddr2.sin_addr.s_addr = INADDR_ANY;
		bzero(&(saddr2.sin_zero),8);
		fd2 = socket(AF_INET,SOCK_DGRAM, 0);

		bind(fd1, (struct sockaddr*)&saddr1, sizeof(saddr1));
		bind(fd2, (struct sockaddr*)&saddr2, sizeof(saddr2));

		epfd = epoll_create(2);
		event1.data.fd = fd1;
		event1.events = EPOLLIN;
		event2.data.fd=fd2;
		event2.events=EPOLLIN;
		epoll_ctl(epfd, EPOLL_CTL_ADD, fd1, &event1);
		epoll_ctl(epfd, EPOLL_CTL_ADD, fd2, &event2);

		while(1){
		   char buf[20];
		   unsigned int size=sizeof(struct sockaddr);
		   if(epoll_wait(epfd, &wait_event, 2, -1)){
			   if((wait_event.data.fd==fd1)
			            &&(wait_event.events&EPOLLIN == EPOLLIN)){
				   recvfrom(fd1, buf, sizeof(buf), 0, (struct sockaddr*)&caddr,&size);
				   printf("[%d]%s :%s",fd1,inet_ntoa(caddr.sin_addr),buf);
			   	}
			   	if((wait_event.data.fd==fd2)
			   			&&(wait_event.events&EPOLLIN == EPOLLIN)){
			   		recvfrom(fd2, buf, sizeof(buf), 0, (struct sockaddr*)&caddr,&size);
			   		printf("[%d]%s :%s",fd2,inet_ntoa(caddr.sin_addr),buf);
			    }
		   }
		}
		close(fd1);
		close(fd2);
		close(epfd);
		return 0;
}


/*
 *  size:用来告诉内核这个监听的数目，它并不是限制epoll所能监听的描述符最大个数，只是对内核初
 * 始分配内部数据结构的一个建议。现在没有意义
 *
 *	epfd:epoll专用的文件描述符。
 *	op:表示动作，用三个宏来表示:
 *			EPOLL_CTL_ADD：注册新的fd到epfd中
 *			EPOLL_CTL_MOD：修改已经注册的fd的监听事件
 *			EPOLL_CTL_DEL：从epfd中删除一个fd
 *	fd:需要监听的文件描述符。
 *	event:要监听事件。
 *
 *	epfd:epoll专用的文件描述符。
 *	events:epoll_event结构体数组，epoll将会把发生的事件赋值到events数组中。
 *	maxevents:events数组大小。
 *	timeout:超时时间，-1表示函数为阻塞
 *
 *
 *  struct epoll_event {
 *  	__uint32_t events; 	//epoll事件
 *  	epoll_data_t data;
 *  };
 *
 *  typedef union epoll_data {
 *     void *ptr;
 *     int fd;  //文件描述符
 *     __uint32_t u32;
 *     __uint64_t u64;
 *  } epoll_data_t;
 *
 *  events:
 *    	EPOLLIN ：表示对应的文件描述符可以读；
 *    	EPOLLOUT：表示对应的文件描述符可以写；
 *    	EPOLLPRI：表示对应的文件描述符有紧急的数据可读；
 *    	EPOLLERR：表示对应的文件描述符发生错误；
 *    	EPOLLHUP：表示对应的文件描述符被挂断；
 *    	EPOLLET ：将EPOLL设为边缘触发模式，默认为水平触发；
 *    	EPOLLONESHOT：只监听一次事件，当监听完这次事件之后，如果还需要继续监听这个socket的话，需要再次把这个socket加入到EPOLL队列里；
 * */