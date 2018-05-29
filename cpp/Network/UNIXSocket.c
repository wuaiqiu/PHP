#include <stdio.h>
#include <stdlib.h>
#include <sys/socket.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <sys/un.h>
#include <fcntl.h>

/*
 * UNIX未命名套接字(作用于有亲缘关系进程之间通信)
 * 	 int socketpari(int domain, int type, int protocol, int sockfd[2]);
 * */

void fun1(){
	  int fd[2],n,status;
	  char buf[10];
	  socketpair(AF_UNIX, SOCK_STREAM, 0, fd);
	  if(fork()==0){//child
	        close(fd[0]);
	        n=write(fd[1],"Hi Father",9);
	        n=read(fd[1],buf,9);
	        buf[n]='\0';
	        printf("Son read data from father: %s\n",buf);
	        exit(0);
	  }else{//parent
	        close(fd[1]);
	        n=read(fd[0],buf,9);
	        buf[n]='\0';
	        printf("Parent read data from son :%s\n",buf);
	        write(fd[0],"Hello Son",9);
	        wait(&status);
	        exit(0);
	  }
}

/*
 * UNIX命名套接字(作用于任何进程之间通信)
 * */

void tcpServer(){
	int sockfd,client_fd,revsize;
	char buf[20];
	struct sockaddr_un my_addr;
	sockfd=socket(AF_UNIX, SOCK_STREAM, 0);
	my_addr.sun_family = AF_UNIX;
	strcpy(my_addr.sun_path, "/home/wu/socket.sock\0");
	socklen_t size=SUN_LEN(&my_addr);
	bind(sockfd, (struct sockaddr *)&my_addr, size);
	listen(sockfd,128);
	while(1){
		client_fd=accept(sockfd,NULL,NULL);
		revsize=recv(client_fd,buf,20,0);
		buf[revsize]='\0';
		printf("%s\n",buf);
		close(client_fd);
	}
	close(sockfd);
}

void tcpClient(){
	int sockfd;
	struct sockaddr_un server_addr;
	sockfd=socket(AF_UNIX,SOCK_STREAM,0);
	server_addr.sun_family = AF_UNIX;
	strcpy(server_addr.sun_path, "/home/wu/socket.sock");
	int size=SUN_LEN(&server_addr);
	connect(sockfd,(struct sockaddr*)&server_addr,size);
	send(sockfd,"Hello Server",12,0);
	close(sockfd);
}


void udpServer(){
	int sockfd,revsize;
	char buf[20];
	struct sockaddr_un my_addr;
	sockfd=socket(AF_UNIX,SOCK_DGRAM,0);
	my_addr.sun_family = AF_UNIX;
	strcpy(my_addr.sun_path, "/home/wu/socket.sock\0");
	socklen_t size=SUN_LEN(&my_addr);
	bind(sockfd, (struct sockaddr *)&my_addr, size);
	while(1){
		revsize=recvfrom(sockfd,buf,20,0,NULL,NULL);
		buf[revsize]='\0';
		printf("%s\n",buf);
	}
	close(sockfd);
}

void udpClient(){
	int sockfd;
	struct sockaddr_un server_addr;
	sockfd=socket(AF_UNIX,SOCK_DGRAM,0);
	server_addr.sun_family = AF_UNIX;
	strcpy(server_addr.sun_path, "/home/wu/socket.sock\0");
	socklen_t size=SUN_LEN(&server_addr);
	sendto(sockfd,"Hello Server",12,0,(struct sockaddr*)&server_addr,size);
	close(sockfd);
}

/*
 * 	1.UNIX域套接字用于在同一台计算机上的进程间通信，虽然网络套接字可用于同一目的，但是UNIX
 * 域套接字的效率更高。UNIX域套接字并不进行协议处理，不需要添加或删除网络报头，无需计算校验
 * 和，不需要产生顺序号，无需发送确认报文。
 *
 *  2.UNIX域套接字是全双工的。管道是半双工的
 *
 *  3.UNIX有名套接字
 *  	struct sockaddr_un {
 *  		sa_family_t sun_family; //AF_UNIX或AF_LOCAL
 *  		char sun_path[108]; 	//路径名，文件必须不存在，路径最后需要'\0'
 *  	};
 * */