#include <stdio.h>

void add(int,int); //声明函数

int main() {
	add(1,2); //调用函数
	return 1;
}

void add(int a,int b){ //定义函数
	printf("%d+%d=%d",a,b,a+b);
}