#include <stdio.h>
#include <sys/types.h>
#include <dirent.h>
#include <unistd.h>

/*
 * 	DIR* opendir(char* paht):打开目录
 * 	struct dirent* readdir(DIR* dir):读取目录
 * 	int closedir(DIR* dir):关闭目录
 * */

int main(){
	DIR* dir=opendir("/home/wu");
	struct dirent* ptr;
	while((ptr=readdir(dir))!=NULL){
		printf("%s\n",ptr->d_name);
	}
	closedir(dir);
	return 0;
}

/*
 * struct dirent{
 * 		long d_ino; 				//索引节点号
 * 		off_t d_off; 				//在目录文件中的偏移
 * 		unsigned short d_reclen; 	//文件名长 
 * 		unsigned char d_type; 		//文件类型
 * 		char d_name [NAME_MAX+1];  	//文件名 
 * }
 * */