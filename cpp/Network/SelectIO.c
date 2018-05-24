#include <stdio.h>
#include <sys/select.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <strings.h>
#include <arpa/inet.h>
#include <unistd.h>


/*
 *	I/O复用之Select函数
 *
 *   int select(int maxfd,fd_set* readset,fd_set* writeset,fd_set* exceptset,
 * struct timeval *timeout):轮询扫描多个描述符中的任一描述符是否发生响应，或经过
 * 一段时间后唤醒.
 *	 void FD_ZERO(fd_set *fdset):初始化描述符集
 *	 void FD_SET(int fd, fd_set *fdset):将一个描述符添加到描述符集
 *	 void FD_CLR(int fd, fd_set *fdset):将一个描述符从描述符集中删除
 *	 int FD_ISSET(int fd, fd_set *fdset):检测指定的描述符是否有事件发生
 * */



int main(void){
	int fd1,fd2;
	struct sockaddr_in saddr1,saddr2,caddr;
	fd_set rset;

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

	while(1){
	   char buf[20];
	   FD_ZERO(&rset);
	   FD_SET(fd1, &rset);
	   FD_SET(fd2, &rset);
	   unsigned int size=sizeof(struct sockaddr);
	   if(select(fd2 + 1, &rset, NULL, NULL, NULL))  {
	         if(FD_ISSET(fd1, &rset)){
	            recvfrom(fd1, buf, sizeof(buf), 0, (struct sockaddr*)&caddr,&size);
	            printf("[%d]%s :%s",fd1,inet_ntoa(caddr.sin_addr),buf);
	         }
	         if(FD_ISSET(fd2, &rset)){
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
 * maxfd:指定要检测的描述符的大小范围，描述符最大值+1
 * readset:可读描述符集
 * writeset:可写描述符集
 * exceptset:异常描述符集
 * timeout:超时时间，超过规定时间后唤醒，NULL为阻塞
 *
 * struct timeval{
 * 		long tv_sec;//秒
 * 		long tv_usec;//微秒
 * };
 * */