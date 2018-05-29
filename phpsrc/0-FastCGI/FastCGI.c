#include <sys/socket.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <netinet/in.h>
#include <unistd.h>

#define HEAD_LEN                8  		//消息头长度固定为8个字节
#define BUFLEN                  4096 	//读取字节缓冲区大小
#define FCGI_VERSION_1           1  	//版本号

//消息类型
enum fcgi_request_type {
    FCGI_BEGIN_REQUEST      = 1,
    FCGI_ABORT_REQUEST      = 2,
    FCGI_END_REQUEST        = 3,
    FCGI_PARAMS             = 4,
    FCGI_STDIN              = 5,
    FCGI_STDOUT             = 6,
    FCGI_STDERR             = 7,
    FCGI_DATA               = 8,
    FCGI_GET_VALUES         = 9,
    FCGI_GET_VALUES_RESULT  = 10,
    FCGI_UNKOWN_TYPE        = 11
};

//FastCGI程序角色类型
enum fcgi_role {
    FCGI_RESPONDER      = 1,
    FCGI_AUTHORIZER     = 2,
    FCGI_FILTER         = 3
};

//消息头
struct fcgi_header {
    unsigned char version;
    unsigned char type;
    unsigned char requestIdB1;
    unsigned char requestIdB0;
    unsigned char contentLengthB1;
    unsigned char contentLengthB0;
    unsigned char paddingLength;
    unsigned char reserved;
};

//请求开始发送的消息体
struct FCGI_BeginRequestBody {
    unsigned char roleB1;
    unsigned char roleB0;
    unsigned char flags;
    unsigned char reserved[5];
};

//请求结束发送的消息体
struct FCGI_EndRequestBody {
    unsigned char appStatusB3;
    unsigned char appStatusB2;
    unsigned char appStatusB1;
    unsigned char appStatusB0;
    unsigned char protocolStatus;
    unsigned char reserved[3];
};

//协议级别的状态码
enum protocolStatus {
    FCGI_REQUEST_COMPLETE = 0,
    FCGI_CANT_MPX_CONN = 1,
    FCGI_OVERLOADED = 2,
    FCGI_UNKNOWN_ROLE = 3
};

int main(){

	int servfd, connfd, requestId, contentLen;
	struct sockaddr_in servaddr, cliaddr;
	struct fcgi_header header;
	struct FCGI_BeginRequestBody brBody;
	struct FCGI_EndRequestBody erBody;

	int paramNameLen, paramValueLen;
	char *paramName, *paramValue;
	char buf[BUFLEN];

	//建立TCP连接socket(0.0.0.0:9000)
    servfd = socket(AF_INET, SOCK_STREAM, 0);
    bzero(&servaddr, sizeof(struct sockaddr_in));
    servaddr.sin_family = AF_INET;
    servaddr.sin_port = htons(9000);
    servaddr.sin_addr.s_addr = INADDR_ANY;
    bind(servfd, (struct sockaddr *)&servaddr, sizeof(struct sockaddr_in));
    listen(servfd, 128);
    while (1){
    	unsigned int size =sizeof(struct sockaddr_in);
        connfd = accept(servfd, (struct sockaddr *)&cliaddr, &size);
        ssize_t rdlen = read(connfd, &header, HEAD_LEN);
        if (rdlen == 0) break;
        requestId = (header.requestIdB1 << 8) + header.requestIdB0;
        contentLen = (header.contentLengthB1 << 8) + header.contentLengthB0;
        printf("version = %d, type = %d, requestId = %d, contentLen = %d, paddingLength = %d\n",
                   header.version, header.type, requestId, contentLen, header.paddingLength);
        switch (header.type) {
             case FCGI_BEGIN_REQUEST:
                  read(connfd, &brBody, sizeof(brBody));
                  printf("role = %d, flags = %d\n", (brBody.roleB1 << 8) + brBody.roleB0, brBody.flags);
                  break;
              case FCGI_PARAMS:
                  while (contentLen > 0){
                     unsigned char c;
                     unsigned char lenbuf[3];
                     //获取paramName的长度
                     rdlen = read(connfd, &c, 1);
                     contentLen -= rdlen;
                     if ((c & 0x80) != 0){//如果c的值大于128，则该paramName的长度用四个字节表示
                         rdlen = read(connfd, lenbuf, 3);
                         contentLen -= rdlen;
                         paramNameLen = ((c & 0x7f) << 24) + (lenbuf[0] << 16) + (lenbuf[1] << 8) + lenbuf[2];
                      } else{
                         paramNameLen = c;
                      }
                      //获取paramValue的长度
                      rdlen = read(connfd, &c, 1);
                      contentLen -= rdlen;
                      if ((c & 0x80) != 0){
                          rdlen = read(connfd, lenbuf, 3);
                          contentLen -= rdlen;
                          paramValueLen = ((c & 0x7f) << 24) + (lenbuf[0] << 16) + (lenbuf[1] << 8) + lenbuf[2];
                      }else{
                          paramValueLen = c;
                      }
                      //读取paramName
                      paramName = (char *)calloc(paramNameLen + 1, sizeof(char));
                      rdlen = read(connfd, paramName, paramNameLen);
                      contentLen -= rdlen;
                      //读取paramValue
                      paramValue = (char *)calloc(paramValueLen + 1, sizeof(char));
                      rdlen = read(connfd, paramValue, paramValueLen);
                      contentLen -= rdlen;
                      printf("read param: %s=%s\n", paramName, paramValue);
                  }
                  break;
                case FCGI_STDIN:
                	if (contentLen > 0){
                        while (contentLen > 0){
                            if (contentLen > BUFLEN){
                                rdlen = read(connfd, buf, BUFLEN);
                            }else{
                                rdlen = read(connfd, buf, contentLen);
                            }
                            contentLen -= rdlen;
                            fwrite(buf, sizeof(char), rdlen, stdout);
                        }
                    }
                    break;
            }

        //回写一个空的FCGI_STDOUT表明该类型消息已发送结束
        header.version=FCGI_VERSION_1;
        header.type = FCGI_STDOUT;
        header.contentLengthB1 = 0;
        header.contentLengthB0 = 0;
        header.paddingLength = 0;
        write(connfd, &header, HEAD_LEN);

        //发送结束请求消息头
        header.version=FCGI_VERSION_1;
        header.type = FCGI_END_REQUEST;
        header.contentLengthB1 = 0;
        header.contentLengthB0 = 8;
        header.paddingLength = 0;
        bzero(&erBody, sizeof(erBody));
        erBody.protocolStatus = FCGI_REQUEST_COMPLETE;
        write(connfd, &header, HEAD_LEN);
        write(connfd, &erBody, sizeof(erBody));
        close(connfd);
   }
    	close(servfd);
    	return 0;
}

/*
 *
 * 1.web服务器向FastCGI程序传输的消息类型
 *
 *		FCGI_BEGIN_REQUEST  表示一个请求的开始
 *		FCGI_ABORT_REQUEST  表示服务器希望终止一个请求
 *		FCGI_PARAMS     		对应于CGI程序的环境变量
 *		FCGI_STDIN    		对应CGI程序的标准输入
 *
 *
 * 2.由FastCGI程序返回给web服务器的消息类型
 *
 * 		FCGI_STDOUT    		对应CGI程序的标准输出
 * 		FCGI_STDERR    		对应CGI程序的标准错误输出
 * 		FCGI_END_REQUEST  	表示该请求处理完毕
 * 		FCGI_UNKNOWN_TYPE  	FastCGI程序无法解析该消息类型
 *
 *
 * 3.消息报文头
 *
 * 		struct FCGI_Header {
 * 			unsigned char version;	//表示协议版本
 * 			unsigned char type;  	//表示消息的类型
 * 			unsigned char requestIdB1;  //表示requestId，用于区分不同的请求
 * 			unsigned char requestIdB0;
 * 			unsigned char contentLengthB1; //表示消息体的长度
 * 			unsigned char contentLengthB0;
 * 			unsigned char paddingLength;  //填充数据，无效
 * 			unsigned char reserved;   //保留字段，暂时无用
 * 		}
 *
 *
 *  4.FCGI_BEGIN_REQUEST消息体
 *
 *  	struct FCGI_BeginRequestBody {
 *  		unsigned char roleB1;//FastCGI程序充当的角色(FCGI_RESPONDER:1;FCGI_AUTHORIZER:2;FCGI_FILTER:3)
 *  		unsigned char roleB0;
 *  		unsigned char flags; //1表示保持连接，0表示关闭连接
 *  		unsigned char reserved[5]; //保留字段，暂时无用
 *  	}
 *
 *
 *  5.FCGI_END_REQUEST消息体
 *
 *  	struct  FCGI_EndRequestBody {
 *  		unsigned char appStatusB3;  //应用级别的状态码，记录其对appStatus的使用情况
 *  		unsigned char appStatusB2;
 *  		unsigned char appStatusB1;
 *  		unsigned char appStatusB0;
 *  		unsigned char protocolStatus; //协议级别的状态码(0:正常结束;1:请求并发出错;2:资源耗尽;3:角色出错)
 *  		unsigned char reserved[3];   //保留字段，暂时无用
 *  	}
 *
 *
 *  6.执行流程
 *
 *  	a).web服务器向FastCGI程序发送一个8字节type=FCGI_BEGIN_REQUEST的消息头和
 *  一个8字节FCGI_BeginRequestBody结构的消息体，标志一个新请求的开始
 *  	b).web服务器向FastCGI程序发送一个8字节type=FCGI_PARAMS的消息头和一个消息头
 *  中指定长度的FCGI_PARAMS类型消息体
 *  	c).根据FCGI_PARAMS消息的长度可能重复步骤2多次，最终发送一个8字节type=FCGI_PARAMS
 *  并且contentLengthB1和contentLengthB0都为0的消息头，标志FCGI_PARAMS消息发送结束
 *  	d).以和步骤2、3相同的方式，发送FCGI_STDIN消息
 *  	e).FastCGI程序处理完请求后，以和步骤2、3相同的方式发送FCGI_STDOUT消息和FCGI_STDERR
 *  消息返回给服务器
 *  	f).FastCGI程序发送一个type=FCGI_END_REQUEST的消息头和一个8字节FCGI_EndRequestBody
 *  结构的消息体，标志此次请求结束
 * */