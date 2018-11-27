# gcc


### 一.gcc编译流程

```cpp
//1.c
#include <stdio.h>
int main(){
	int a,b,sum;
	printf("input a:\n");
	scanf("%d",&a);
	printf("input b:\n");
	scanf("%d",&b);
	sum=a+b;
	printf("sum:%d",sum);
	return 0;
}
```

>预处理阶段:该阶段编译器将上述代码中的"stdio.h"编译进来

```
gcc -E 1.c -o 1.i
```

>编译阶段:该阶段将源代码编译成汇编代码

```
gcc -S 1.i -o 1.s
```

>汇编阶段:该阶段将汇编代码转化成目标文件

```
gcc -c 1.s -o 1.o
```

>链接阶段:该阶段链接目标文件所需的库文件

```
gcc 1.o -o 1
```

<br>

### 二.函数库

>静态库:这类库的名字一般是libxxx.a；利用静态函数库编译成的文件比较大，因为整个函数库的所有数据都会被整合进目标代码中，他的优点就显而易见了，即编译后的执行程序不需要外部的函数库支持，因为所有使用的函数都已经被编译进去了。当然这也会成为他的缺点，因为如果静态函数库改变了，那么你的程序必须重新编译。

```cpp
//1.创建源文件pro.c
#include <stdio.h>
int pro(int arg){
    printf("hello:%d",arg);
    return 0;
}
```

```
//2.编译pro.c为目标文件
gcc -c pro.c -o pro.o
```

```
//3.利用归档命令ar建立静态链接库libfoo.a
ar crv libfoo.a pro.o
```

```cpp
//4.创建一个源文件2.c,此文件包含pro函数原型
int pro(int);
int main(){
    pro(2);
    return 0;
}
```

```
//5.链接文件
gcc 2.c -o 2 -L. -lfoo
```

>动态库:这类库的名字一般是libxxx.so;相对于静态函数库，动态函数库在编译的时候并没有被编译进目标代码中，你的程序执行到相关函数时才调用该函数库里的相应函数，因此动态函数库所产生的可执行文件比较小。由于函数库没有被整合进你的程序，而是程序运行时动态的申请并调用，所以程序的运行环境中必须提供相应的库。动态函数库的改变并不影响你的程序，所以动态函数库的升级比较方便。

```cpp
//1.创建源文件pro.c
#include <stdio.h>
int pro(int arg){
    printf("hello:%d",arg);
    return 0;
}
```

```
//2.建立动态链接库libfoo.so
gcc -fpic -shared pro.c -o libfoo.so

-fpic:表示编译为位置独立的代码
-shared:指定生成动态链接库
```

```cpp
//3.创建一个源文件2.c,此文件包含pro函数原型
int pro(int);
int main(){
    pro(2);
    return 0;
}
```

```
//4.将libfoo.so放到/lib或/usr/lib下
//5.链接文件
gcc 2.c -o 2 -lfoo
```

<br>

### 三.make工程文件

>make工程管理器是一个"自动编译管理器"，这里的"自动"是指它能够根据文件时间戳自动发现更新过的文件而减少编译的工作量，make默认文件名为GNUmakefile,makefile和Makefile;

```
#1.创建3-1.c与3-2.c

//3-1.c
int sum(int a,int b){
	return a+b;
}

//3-2.c
int avg(int a,int b){
	return (a+b)/2;
}
```

```
#2.创建主程序3.c

#include <stdio.h>

int sum(int,int);
int avg(int,int);

int main(){
	int a,b,c,d;
	printf("input a,b:");
	scanf("%d %d",&a,&b);
	c=sum(a,b);
	d=avg(a,b);
	printf("sum=%d,avg=%d\n",c,d);
}

```

```
#3.编写Makefile

3:3.o 3-1.o 3-2.o
	gcc 3.o 3-1.o 3-2.o -o 3
3.o:3.c
	gcc -c 3.c -o 3.o
3-1.o:3-1.c
	gcc -c 3-1.c -o 3-1.o
3-2.o:3-2.c
	gcc -c 3-2.c -o 3-2.o
clean:
	rm -f *.o
```

```
#4.执行make

make
make clean:如果不指定clean，则默认执行第一条
```

>makefile中的变量

```
#自定义变量

VARNAME=string
$(VARNAME)或${VARNAME}
```

```
#环境变量

$(PWD)或${PWD}
```

```
#预定义变量

$(AR) $(AS) $(CC)
$(CPP) $(RM)
```

```
#自动变量

$<  第一个依赖文件的名称
$@  目标文件的完整名称
$^  所有不重复的依赖文件，以空格分开
$?  所有时间戳比目标文件晚的依赖文件，以空格分开
```

<br>

### 四.CMake配置工具

>CMake是一个比Make工具更高级的编译配置工具，是一个跨平台的、开源的构建系统。CMake允许开发者编写一种平台无关的CMakeList.txt文件来定制整个编译流程，然后再根据目标用户的平台进一步生成所需的本地化Makefile工程文件，如：为Unix平台生成Makefile文件(使用GCC编译)，为Windows MSVC生成projects/workspaces(使用VS IDE编译)或Makefile文件(使用nmake编译)。

CMakeLists.txt

```
#CMake最低版本号要求
cmake_minimum_required(VERSION 3.12)
#项目信息
project(Demo)
#将src目录下的源文件名保存到path变量中
aux_source_directory(./src path)
#添加当前目录下的math子目录(含有CMakeLists.txt)
add_subdirectory(math)
#将名为main.cpp的源文件编译成一个名称为demo的可执行文件
add_executable(Demo main.cpp)
add_executable(Demo ${path})
#添加第三方库文件
find_package(Lua REQUIRED)
include_directories(${LUA_INCLUDE_DIR})
target_link_libraries(Demo ${LUA_LIBRARIES})
```

<br>

### 五.GDB调试工具

```
#1.编写源程序4.c

#include <stdio.h>
int main(){
	int a,b,sum;
	printf("input a b:");
	scanf("%d %d",&a,&b);
	sum=a+b;
	printf("sum:%d\n",sum);
	return 0;
}
```

```
#2.编译4.c

gcc -g 4.c -o 4

-g:编译出的可执行代码中包含调试信息
```

```
#3.gdb调试

gdb 4

>l(list):查看源代码
>b(break) n:在第n行设置断点
>d(delete) n:删除第n行的断点(默认全部删除)
>info b(info break):查看断点信息
>info local:查看当前的所有局部变量
>r(run):运行程序
>p a(print a):查看a变量的值
>set a=10:改变a变量的值
>n(next):单步执行(不进入函数)
>s(step):单步执行(进入函数)
>c(continue):继续运行程序
>q(quit):退出gdb
```

<br>

### 六.头文件

>头文件:一般写类的声明（包括类里面的成员变量和成员方法的声明）、函数原型、#define常数等

```
//test.h
#ifndef TEST_H_
#define TEST_H_
	int sum(int,int);
#endif


//test.c
#include "test.h"
int sum(int a,int b){
	return a+b;
}
```

```
//编写主程序5.c
#include <stdio.h>
#include "test.h"

int main() {
    int a=sum(3,4);
	printf("%d",a);
	return 0;
}
```
