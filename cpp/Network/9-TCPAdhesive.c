#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <strings.h>
#include <arpa/inet.h>
#include <unistd.h>


//模拟TCP粘包

void tcpServer(){
	int sockfd,client_fd,i=0;
	char buf[5];
	ssize_t size;
	struct sockaddr_in my_addr,client_addr;
	sockfd=socket(AF_INET,SOCK_STREAM,0);
	my_addr.sin_family=AF_INET;
	my_addr.sin_port=htons(10000);
	my_addr.sin_addr.s_addr=INADDR_ANY;
	bzero(&(my_addr.sin_zero),8);
	bind(sockfd,(struct sockaddr*)&my_addr,sizeof(struct sockaddr));
	listen(sockfd,3);
	unsigned int sin_size =sizeof(struct sockaddr_in);
	while(1){
		client_fd=accept(sockfd,(struct sockaddr*)&client_addr,&sin_size);

		//读取数据
		while((size=recv(client_fd,buf,sizeof(buf)-1,0))>0){
			i++;
			buf[size]='\0';
			printf("%s,%d\n",buf,i);
		}

		close(client_fd);
	}
	close(sockfd);
}


void tcpClient(){
	int sockfd;
	struct sockaddr_in server_addr;
	sockfd=socket(AF_INET,SOCK_STREAM,0);
	server_addr.sin_family=AF_INET;
	server_addr.sin_port=htons(10000);
	server_addr.sin_addr.s_addr=inet_addr("127.0.0.1");
	bzero(&(server_addr.sin_zero),8);
	connect(sockfd,(struct sockaddr*)&server_addr,sizeof(struct sockaddr));
	
	char str[10];
	for(int i=0;i<7;i++)str[i]='a';
	send(sockfd,str,sizeof(str)-3,0);
	for(int i=0;i<5;i++)str[i]='b';
	send(sockfd,str,sizeof(str)-5,0);
	
	close(sockfd);
}


//解决方法：添加首部长度

void tcpServer(){
	int sockfd,client_fd,len,i=0;
	char buf[5],c;
	ssize_t size;
	struct sockaddr_in my_addr,client_addr;
	sockfd=socket(AF_INET,SOCK_STREAM,0);
	my_addr.sin_family=AF_INET;
	my_addr.sin_port=htons(10000);
	my_addr.sin_addr.s_addr=INADDR_ANY;
	bzero(&(my_addr.sin_zero),8);
	bind(sockfd,(struct sockaddr*)&my_addr,sizeof(struct sockaddr));
	listen(sockfd,3);
	unsigned int sin_size =sizeof(struct sockaddr_in);
	while(1){
		client_fd=accept(sockfd,(struct sockaddr*)&client_addr,&sin_size);
		
		while((recv(client_fd,&c,1,0))>0){
			len=c;
			while(len>0){
				int tmp=(sizeof(buf)-1>len)?len:sizeof(buf)-1;
				size=recv(client_fd,buf,tmp,0);
				i++;
				buf[size]='\0';
				printf("%s,%d\n",buf,i);
				len-=tmp;
			}
		}
		
		close(client_fd);
	}
	close(sockfd);
}

void tcpClient(){
	int sockfd;
	struct sockaddr_in server_addr;
	sockfd=socket(AF_INET,SOCK_STREAM,0);
	server_addr.sin_family=AF_INET;
	server_addr.sin_port=htons(10000);
	server_addr.sin_addr.s_addr=inet_addr("127.0.0.1"); //表示任何地址0.0.0.0
	bzero(&(server_addr.sin_zero),8);
	connect(sockfd,(struct sockaddr*)&server_addr,sizeof(struct sockaddr));
	
	char str[10];
	str[0]=7;
	for(int i=1;i<8;i++)str[i]='a';
	send(sockfd,str,sizeof(str)-2,0);
	str[0]=5;
	for(int i=1;i<6;i++)str[i]='b';
	send(sockfd,str,sizeof(str)-4,0);
	
	close(sockfd);
}