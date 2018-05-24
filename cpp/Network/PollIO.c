#include <stdio.h>
#include <poll.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <strings.h>
#include <arpa/inet.h>
#include <unistd.h>


/*
 *  I/O复用之Poll函数
 *
 * 	 int poll(struct pollfd *fds, nfds_t nfds, int timeout):监视并等待多个文件描述符的
 *  属性变化
 *
 * */


int main(void){
		int fd1,fd2;
		struct sockaddr_in saddr1,saddr2,caddr;
		struct pollfd fds[2];

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

		fds[0].fd=fd1;
		fds[0].events=POLLIN;
		fds[1].fd=fd2;
		fds[1].events=POLLIN;

		while(1){
		   char buf[20];
		   unsigned int size=sizeof(struct sockaddr);
		   if(poll(fds, 2, -1)){
			  if((fds[0].revents & POLLIN ) ==  POLLIN){
				recvfrom(fd1, buf, sizeof(buf), 0, (struct sockaddr*)&caddr,&size);
				printf("[%d]%s :%s",fd1,inet_ntoa(caddr.sin_addr),buf);
			  }
			  if((fds[1].revents & POLLIN ) ==  POLLIN){
				 recvfrom(fd2, buf, sizeof(buf), 0, (struct sockaddr*)&caddr,&size);
				 printf("[%d]%s :%s",fd2,inet_ntoa(caddr.sin_addr),buf);
			  }
		   }
		}
		close(fd1);
		close(fd2);
		return 0;
}

/*
 * fds:指向一个结构体数组的指针，每个数组元素都是一个pollfd结构
 * nfds:数组元素个数
 * timeout: 指定等待的毫秒数，-1表示阻塞
 *
 *  struct pollfd{
 *  	int fd;         //文件描述符
 *  	short events;   //指定监测fd的事件,用户设置
 *  	short revents;  //实际发生的事件,由内核返回
 *   };
 *
 *	 event(revents):
 *	  POLLIN		#有普通或优先带数据可读
 *	  POLLRDNORM	#有普通数据可读
 *	  POLLRDBAND	#有优先级带数据可读
 *	  POLLPRI		#有高优先级数据可读
 *
 *	  POLLOUT		#有普通或优先带数据可写
 *	  POLLWRNORM	#有普通数据可写
 *	  POLLWRBAND	#有优先级带数据可写
 *
 *	 revents:
 *	  POLLERR		#发生错误
 *	  POLLHIP		#发生挂起
 *	  POLLNVAL		#描述文件符打不开
 * */