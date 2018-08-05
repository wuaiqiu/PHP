/*
 * 字符串
 *
 * 1.表示方式(C++11需要加const)
 *		const char str[]="Hello"; //字符数组它存放了一个字符串，末尾以'\0'结束，可以改变内容
 *		const char* str="Hello";  //字符指针指向的是一个字符串常量，末尾以'\0'结束，不可以改变内容
 *		auto str = "Hello"; //C++11新增类型
 *
 * 2.操作函数(string.h)
 *		int memcmp(void *s1,void *s2,size_t n):比较
 *		int strcmp(const char *str1, const char *str2):比较
 *		int strncmp(const char *str1, const char *str2, size_t n):比较
 *	    void memcpy(void *dest,void *src ,int n):拷贝
 *	    char *strcpy(char *dest, const char *src):拷贝
 *	    char *strncpy(char *dest, const char *src, size_t n):拷贝
 *	    void *memmove(void *dest,const void *src,size_t n):移动，解决内存重叠问题
 *		void *memset(void *s ,int c, size_t n):设置
 *		char *strcat(char *dest, const char *src):追加
 *		char *strncat(char *dest, const char *src, size_t n):追加
 *		size_t strlen(const char *str):计算长度
 *
 * 3.str与mem区别:
 *	  a.复制的内容不同:strcpy只能复制字符串，而memcpy可以复制任意内容
 *	  b.复制的方法不同:strcpy不需要指定长度，它遇到被复制字符的串结束符"\0"才结束，所以容易溢出。
 *	memcpy则是根据其第3个参数决定复制的长度。
 *	  c.用途不同:通常在复制字符串时用strcpy，而需要复制其他类型数据时则一般用memcpy
 *
 * 4.内存重叠:拷贝的目的地址在源地址范围内。所谓内存重叠就是拷贝的目的地址和源地址有重叠。
 *
 * */