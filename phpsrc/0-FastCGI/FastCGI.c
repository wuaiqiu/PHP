#include <sys/socket.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <netinet/in.h>
#include <unistd.h>
#include <fcntl.h>

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

//服务器希望FastCGI程序充当的角色
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

//protocolStatus
enum protocolStatus {
    FCGI_REQUEST_COMPLETE = 0,
    FCGI_CANT_MPX_CONN = 1,
    FCGI_OVERLOADED = 2,
    FCGI_UNKNOWN_ROLE = 3
};

//存储键值对的结构体
struct paramNameValue {
    char **pname;
    char **pvalue;
    int maxLen;
    int curLen;
};

//初始化一个键值结构体
void init_paramNV(struct paramNameValue *nv){
    nv->maxLen = 16;
    nv->curLen = 0;
    nv->pname = (char **)malloc(nv->maxLen * sizeof(char *));
    nv->pvalue = (char **)malloc(nv->maxLen * sizeof(char *));
}

//扩充一个结键值构体的容量为之前的两倍
void extend_paramNV(struct paramNameValue *nv){
    nv->maxLen *= 2;
    nv->pname = realloc(nv->pname, nv->maxLen * sizeof(char *));
    nv->pvalue = realloc(nv->pvalue, nv->maxLen * sizeof(char *));
}

//释放一个键值结构体
void free_paramNV(struct paramNameValue *nv){
    int i;
    for(i = 0; i < nv->curLen; i++){
        free(nv->pname[i]);
        free(nv->pvalue[i]);
    }
    free(nv->pname);
    free(nv->pvalue);
}

//获取指定键的值
char *getParamValue(struct paramNameValue *nv, char *paramName){
    int i;
    for(i = 0; i < nv->curLen; i++){
        if (strncmp(paramName, nv->pname[i], strlen(paramName)) == 0){
            return nv->pvalue[i];
        }
    }
    return NULL;
}

int main(){
	int servfd, connfd;
	struct sockaddr_in servaddr, cliaddr;

	struct paramNameValue  paramNV;
	struct fcgi_header header, headerBuf;
	int requestId, contentLen,paddingLen;
	struct FCGI_BeginRequestBody brBody;
	struct FCGI_EndRequestBody erBody;

	int paramNameLen, paramValueLen;
    char *paramName, *paramValue;

    unsigned char c;
    unsigned char lenbuf[3];

    char buf[BUFLEN];
    char *htmlHead, *htmlBody;

    servfd = socket(AF_INET, SOCK_STREAM, 0);
    bzero(&servaddr, sizeof(struct sockaddr_in));
    servaddr.sin_family = AF_INET;
    servaddr.sin_port = htons(9000);
    servaddr.sin_addr.s_addr = INADDR_ANY;
    bind(servfd, (struct sockaddr *)&servaddr, sizeof(struct sockaddr_in));
    listen(servfd, 128);
    unsigned int connsize =sizeof(struct sockaddr_in);
    while (1){
        connfd = accept(servfd, (struct sockaddr *)&cliaddr, &connsize);
        fcntl(connfd, F_SETFL, O_NONBLOCK); // 设置socket为非阻塞
        init_paramNV(&paramNV);
        //读取消息头
        while (1) {
        	ssize_t rdlen = read(connfd, &header, HEAD_LEN);
            if (rdlen == 0) break; //消息读取结束
            headerBuf = header;
            requestId = (header.requestIdB1 << 8) + header.requestIdB0;
            contentLen = (header.contentLengthB1 << 8) + header.contentLengthB0;
            paddingLen = header.paddingLength;
            printf("version = %d, type = %d, requestId = %d, contentLen = %d, paddingLength = %d\n",
                   header.version, header.type, requestId, contentLen, paddingLen);
            switch (header.type) {
                case FCGI_BEGIN_REQUEST:
                    bzero(&brBody, sizeof(brBody));
                    read(connfd, &brBody, sizeof(brBody));
                    printf("role = %d, flags = %d\n", (brBody.roleB1 << 8) + brBody.roleB0, brBody.flags);
                    break;
                case FCGI_PARAMS:
                    if (contentLen == 0)printf("read params end...\n");
                    //循环读取键值对
                    while (contentLen > 0){
                      //获取paramName的长度
                       rdlen = read(connfd, &c, 1);
                       contentLen -= rdlen;
                       if ((c & 0x80) != 0){//如果 c 的值大于128，则该paramName的长度用四个字节表示
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
                        // 如果键值结构体已满则把容量扩充一倍
                        if (paramNV.curLen == paramNV.maxLen)extend_paramNV(&paramNV);
                        paramNV.pname[paramNV.curLen] = paramName;
                        paramNV.pvalue[paramNV.curLen] = paramValue;
                        paramNV.curLen++;
                    }

                    if (paddingLen > 0){
                        rdlen = read(connfd, buf, paddingLen);
                        contentLen -= rdlen;
                    }
                    break;
                case FCGI_STDIN:
                	if(contentLen == 0)printf("read post end....\n");
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
                        printf("\n");
                    }

                    if (paddingLen > 0){
                        rdlen = read(connfd, buf, paddingLen);
                        contentLen -= rdlen;
                    }
                    break;
            }
        }

        //向web服务器返回数据
        headerBuf.version = FCGI_VERSION_1;
        headerBuf.type = FCGI_STDOUT;
        htmlHead = "Content-type: text/html\r\n\r\n";  //响应头
        htmlBody = getParamValue(&paramNV, "SCRIPT_FILENAME");  // 把请求文件路径作为响应体返回
        printf("html: %s%s\n",htmlHead, htmlBody);
        contentLen = strlen(htmlHead) + strlen(htmlBody);
        headerBuf.contentLengthB1 = (contentLen >> 8) & 0xff;
        headerBuf.contentLengthB0 = contentLen & 0xff;
        headerBuf.paddingLength = (contentLen % 8) > 0 ? 8 - (contentLen % 8) : 0;
        write(connfd, &headerBuf, HEAD_LEN);
        write(connfd, htmlHead, strlen(htmlHead));
        write(connfd, htmlBody, strlen(htmlBody));
        if (headerBuf.paddingLength > 0)write(connfd, buf, headerBuf.paddingLength);  //填充数据随便写什么，数据会被服务器忽略
        free_paramNV(&paramNV);

        //回写一个空的 FCGI_STDOUT 表明 该类型消息已发送结束
        headerBuf.type = FCGI_STDOUT;
        headerBuf.contentLengthB1 = 0;
        headerBuf.contentLengthB0 = 0;
        headerBuf.paddingLength = 0;
        write(connfd, &headerBuf, HEAD_LEN);

        //发送结束请求消息头
        headerBuf.type = FCGI_END_REQUEST;
        headerBuf.contentLengthB1 = 0;
        headerBuf.contentLengthB0 = 8;
        headerBuf.paddingLength = 0;
        bzero(&erBody, sizeof(erBody));
        erBody.protocolStatus = FCGI_REQUEST_COMPLETE;
        write(connfd, &headerBuf, HEAD_LEN);
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
