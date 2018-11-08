#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <strings.h>
#include <arpa/inet.h>
#include <unistd.h>

/*
 *	TCP:
 *		int socket(int domain,int type,int protocol):创建socket
 *		int bind(int sockfd,struct sockaddr* addr,int addrlen):绑定socket
 *		int listen(int socketfd,int backlog):使socket处于监听状态，并初始化一个大小为
 *	backlog的请求列队(SYN_REVD)
 *		int accept(int sockfd,void* addr,int* addrlen):阻塞处理客户端的请求消息
 *		int connect(int sockfd,struct sockaddr* ser_addr,int addrlen):连接服务器
 *		int send(int sockfd,void* msg,int len,int flags):发送数据
 *		int recv(int sockfd,void* msg,int len,int flags):接受数据
 *		int close(int sockfd):销毁socket
 *		uint16_t htons(uint16_t port):将本机字节序列(地址的低位存储值的低位)转换成网
 *	络字节序列(地址的低位存储值的高位)
 *		uint16_t ntohs(uint16_t port):将网络字节转换本机字节序列
 *		void bzero(void *s, int n):置字节字符串s的前n个字节为零
 *		in_addr inet_addr(char* cp):将字符串转换为in_addr类型
 *		char *inet_ntoa(struct in_addr addr):将in_addr类型转换为字符串
 * */

void tcpServer(){
	int sockfd,client_fd;
	struct sockaddr_in my_addr,client_addr;
	sockfd=socket(AF_INET,SOCK_STREAM,0);
	my_addr.sin_family=AF_INET;
	my_addr.sin_port=htons(10000);
	my_addr.sin_addr.s_addr=INADDR_ANY; //表示任何地址0.0.0.0
	bzero(&(my_addr.sin_zero),8);
	bind(sockfd,(struct sockaddr*)&my_addr,sizeof(struct sockaddr));
	listen(sockfd,128);
	unsigned int sin_size =sizeof(struct sockaddr_in);
	while(1){
		client_fd=accept(sockfd,(struct sockaddr*)&client_addr,&sin_size);
		printf("收到一个请求: %s \n",inet_ntoa(client_addr.sin_addr));
		send(client_fd,"Hello I am Server\n",20,0);
		close(client_fd);
	}
	colse(sockfd);
}

void tcpClient(){
	int sockfd,revsize;
	char buf[20];
	struct sockaddr_in server_addr;
	sockfd=socket(AF_INET,SOCK_STREAM,0);
	server_addr.sin_family=AF_INET;
	server_addr.sin_port=htons(10000);
	server_addr.sin_addr.s_addr=inet_addr("127.0.0.1"); //表示任何地址0.0.0.0
	bzero(&(server_addr.sin_zero),8);
	connect(sockfd,(struct sockaddr*)&server_addr,sizeof(struct sockaddr));
	revsize=recv(sockfd,buf,20,0);
	close(sockfd);
	printf("%d :%s",revsize,buf);
}

/*
 * UDP:
 *	 int sendto(int sockfd,void* buf,int len,unsigned flags,struct socketaddr* to,int tolen):
 *	发送数据
 *	 int recvfrom(int sockfd,void* buf,int len,unsigned flags,struct socketaddr* from,int* fromlen)
 *	接受数据
 * */

void udpServer(){
	int sockfd,revsize;
	char buf[20];
	struct sockaddr_in my_addr,client_addr;
	sockfd=socket(AF_INET,SOCK_DGRAM,0);
	my_addr.sin_family=AF_INET;
	my_addr.sin_port=htons(10000);
	my_addr.sin_addr.s_addr=INADDR_ANY;
	bzero(&(my_addr.sin_zero),8);
	bind(sockfd,(struct sockaddr*)&my_addr,sizeof(struct sockaddr));
	unsigned int sin_size =sizeof(struct sockaddr_in);
	while(1){
		revsize=recvfrom(sockfd,buf,sizeof(buf),0,(struct sockaddr*)&client_addr,&sin_size);
		printf("%d :%s",revsize,buf);
	}
	close(sockfd);
}

void udpClient(){
	int sockfd;
	struct sockaddr_in server_addr;
	sockfd=socket(AF_INET,SOCK_DGRAM,0);
	server_addr.sin_family=AF_INET;
	server_addr.sin_port=htons(10000);
	server_addr.sin_addr.s_addr=inet_addr("127.0.0.1");
	bzero(&(server_addr.sin_zero),8);
	sendto(sockfd,"Hello I am Client\n",20,0,(struct sockaddr*)&server_addr,sizeof(struct sockaddr));
	close(sockfd);
}


/*
 * int getsockopt(int sock, int level, int optname, void *optval, socklen_t *optlen):
 * 获取与某个套接字关联的选项
 * int setsockopt(int sock, int level, int optname, const void *optval, socklen_t optlen):
 * 设置与某个套接字关联的选项
 * */

void getSocket(){
	int tcpfd=socket(AF_INET,SOCK_STREAM,0);
	int udpfd=socket(AF_INET,SOCK_DGRAM,0);
	int rcvbuf,sndbuf,rcvlowat,sndlowat;
	socklen_t size=sizeof(int);
	getsockopt(tcpfd,SOL_SOCKET,SO_RCVBUF,&rcvbuf,&size);
	getsockopt(tcpfd,SOL_SOCKET,SO_SNDBUF,&sndbuf,&size);
	getsockopt(tcpfd,SOL_SOCKET,SO_RCVLOWAT,&rcvlowat,&size);
	getsockopt(tcpfd,SOL_SOCKET,SO_SNDLOWAT,&sndlowat,&size);
	printf("TCP: default_R=%d default_S=%d low_R=%d low_S=%d\n",rcvbuf,sndbuf,rcvlowat,sndlowat);
	getsockopt(udpfd,SOL_SOCKET,SO_RCVBUF,&rcvbuf,&size);
	getsockopt(udpfd,SOL_SOCKET,SO_SNDBUF,&sndbuf,&size);
	getsockopt(udpfd,SOL_SOCKET,SO_RCVLOWAT,&rcvlowat,&size);
	getsockopt(udpfd,SOL_SOCKET,SO_SNDLOWAT,&sndlowat,&size);
	printf("UDP: default_R=%d default_S=%d low_R=%d low_S=%d\n",rcvbuf,sndbuf,rcvlowat,sndlowat);
}


int main(){
	tcpServer();
	tcpClient();
	udpServer();
	udpClient();
	getSocket();
	return 0;
}

/*
 * domain:
 * 		AF_INET:IPv4	AF_INET6:IPv6
 * type:
 * 		SOCK_STREAM:TCP	SOCK_DGRAM:UDP
 * protocol:
 * 		0:自动选择
 * */

/*
 * 1.socketaddr_in结构:
 * 		struct socketaddr_in{
 * 			unsigned short int sin_family; //通信地址类型
 * 			unit16_t sin_port;	//端口号
 * 			struct in_addr sin_addr; //IP地址
 * 			unsigned char sin_zero[8]; //填充为0,为了与socketaddr结构体兼容
 * 		};
 * */


/*
 * sock： 将要被设置或者获取选项的套接字
 * level：选项所在的协议层
 * 			1:SOL_SOCKET:通用套接字选项.
 * 			2:IPPROTO_IP:IP选项.
 * 			3:IPPROTO_TCP:TCP选项.
 * optname：需要访问的选项名
 * optval：指向选项值的缓冲
 * optlen：选项的长度
 *
 *
 * SOL_SOCKET:
 * 		SO_KEEPALIVE(int):保持连接
 * 		SO_RCVBUF(int):接收缓冲区大小
 * 		SO_SNDBUF(int):发送缓冲区大小
 * 		SO_RCVLOWAT(int):接收缓冲区下限
 * 		SO_SNDLOWAT(int):发送缓冲区下限
 * 		SO_RCVTIMEO(struct timeval):接收超时
 * 		SO_SNDTIMEO(struct timeval):发送超时
 *
 * IPPROTO_IP:
 * 		IP_TTL(int):生存时间
 * */

/*
 * 1.TCP与UDP长度问题
 * 	 a.在普通的局域网中，以太网的MTU值为1500，所以局域网的网络编程时数据长度最好在
 * 1500-20-8=1472(UDP)，1500-20-20=1460(TCP)
 * 	 b.Internet上的标准MTU值为576，所以Internet的网络编程时数据长度最好在576-20-8＝
 * 548(UDP)，576-20-20=536(TCP)
 *
 * 2.TCP与UDP读取问题
 * 	 a.TCP可以分多次读取同一请求数据
 * 	 b.UDP只能一次读取请求数据，多余的请求数据将抛弃
 *
 * 3.IP分片与TCP分段问题
 * 	 a.当TCP数据段大于MSS(Maxitum Segment Size)，则会发生TCP分段
 * 	 b.当数据报文大于MTU(Maximum Transmission Unit)，则会发生IP分片
 *
 * 4.缓冲区大小
 * 	 a.TCP实际接收缓冲区(最小值/默认值/最大值) /proc/sys/net/ipv4/tcp_rmem
 * 	 b.TCP实际接收缓冲区(最小值/默认值/最大值) /proc/sys/net/ipv4/tcp_wmem
 * 	 c.UDP接收缓冲区的默认值保存在/proc/sys/net/core/rmem_default
 * 	   UDP接收缓冲区的最大值 /proc/sys/net/core/rmem_max
 * 	 d.UDP发送缓冲区默认值保存在/proc/sys/net/core/wmem_default
 * 	   UDP发送缓冲区的最大值 /proc/sys/net/core/wmem_max
 * 	 e.TCP和UDP都拥有套接口接收缓冲区。因为TCP具有流量控制，当接收到的数据报装不进套接口接
 *  收缓冲区时，该数据报就丢弃，等待下次重传，UDP是没有流量控制的，当接收到的数据报装不进套
 *  接口接收缓冲区时，新数据容易覆盖老数据，导致UDP错乱。
 *   f.TCP有发送缓冲区，可以用来进行分段，流量控制等，UDP没有发送缓存区，只要数据大小在缓存
 *  区大小之间才可以发送。
 * */