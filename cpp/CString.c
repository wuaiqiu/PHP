/*
 * 字符串
 *
 * 1.表示方式
 *		char str[]="Hello"; //字符指针指向的栈区，末尾以'\0'结束，可以改变内容
 *		char* str="Hello";  //字符指针指向的只读全局区，末尾以'\0'结束，不可以改变内容(c++11建议使用const char*)
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
 *		size_t strlen(const char *str):计算长度，遇见'\0'才结束
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

/*
*  5.C++中的string
*    str.insert(str.begin(),'a'):插入字符
*    str.push_back('a'):向后插入字符
*    str.erase(str.begin(),str.begin()+1):删除字符串
*    str.clear():清空字符串
*    str.replace(str.begin(),str.end(),'d','e'):替换字符
*    str[1]，str.at(1):获取指定位置的字符
*    str.front()，str.back():返回str首字符，尾字符
*    str.size()，str.length():返回字符数量
*    str.empty():判断字符串是否为空
*    str+="Hello"，str.append("Hello"):追加字符串
*    str.substr(from,count):返回从from开始后count个数的子字符串
*    str.c_str()，str.data():将内容以const char*形式返回
*    str.copy(arr,count,pos):将str以pos开始后count个数复制到arr字符数组中
* */