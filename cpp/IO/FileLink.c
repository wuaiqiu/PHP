#include <stdio.h>
#include <unistd.h>


/*
 * int symlink(char* oldpath,char* newpath):创建软链接
 * int link(char* oldpath,char* newpath):创建硬链接
 * */

int main(){
	symlink("/home/wu/wifi","/home/wu/symlink");
	link("/home/wu/wifi","/home/wu/link");
	return 0;
}

/*
 * 硬链接:指多个文件指向一个inode,权限相同
 *      a.只能对文件创建,不能对目录创建
 *      b.不能跨文件系统
 *      c.创建硬链接会增加文件被连接的次数(-rw-r--r--.  1(硬链接次数) root root)
 * 
 * 软链接:指一个文件指向另一个文件的路径,权限全是7,但最终取决于最终指向的文件
 *      a.可应用于目录,可跨文件系统
 *      b.其大小为文件路径的字符个数
 * 
 * */
