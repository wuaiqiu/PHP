#include <stdio.h>
#include <math.h>

/*
 *Math(math.h)
 *
 * M_PI:圆周率
 * double cos(double x):返回弧度角 x 的余弦.
 * double sin(double x):返回弧度角 x 的正弦.
 * double tan(double x):返回弧度角 x 的正切.
 * double pow(double x, double y):返回 x 的 y 次幂.
 * double sqrt(double x):返回 x 的平方根.
 * double ceil(double x):向上舍入.
 * double floor(double x):向下舍入.
 * double round(double x):四舍五入.
 * double fabs(double x):返回 x 的绝对值.
 * */

int main() {
	   printf("60度的正弦是%lf\n",sin(60.0/180.0*3.14));
	   printf("60度的余弦是%lf\n",cos(60.0/180.0*3.14));
	   printf("60度的正切是%lf\n",tan(60.0/180.0*3.14));
	   return EXIT_SUCCESS;
}

/*
 * 利用函数rand产生10个(1-10)的随机数
 *
 * 		int rand(void)
 * 		void srand(unsigned int seed)
 * */


int main(){
	int j;
	//设置随机种子，如果srand每次输入的数值一样，那么运行产生的随机数也是一样的
	srand((unsigned)time(0));
	for(int i=0;i<10;i++){
		j=rand()%10+1;
		printf("%d ",j);
	}
	return 0;
}


/*
 * time_t time(time_t *t):返回时间戳
 * tm* gmtime(time_t *t):将时间戳转化成格林尼治时间
 * char* asctime(tm* tm):将日期和时间格式化为字符串
 * tm* localtime(time_t *timep):取得当地的时间和日期
 * */

int main(){
	time_t timep;
	struct tm *p;
	time(&timep);
	printf("%s",asctime(gmtime(&timep)));
	p=localtime(&timep);
	printf("%d年%d月%d日",(1900+p->tm_year),(1+p->tm_mon),p->tm_mday);
	printf("%d:%d:%d",p->tm_hour,p->tm_min,p->tm_sec);
	return 0;
}

/*
 * time_t:为一个long int
 *
 * struct tm{
 * 		int tm_sec;  //秒数(0-59)
 * 		int tm_min;  //分钟(0-59)
 * 		int tm_hour; //小时(0-23)
 * 		int tm_mday; //日数(1-31)
 * 		int tm_mon;  //月份(0-11)
 * 		int tm_year; //从1900年起至今的年数
 * 		int tm_wday; //星期(0-6)
 * 		int tm_yday; //天数(0-365)
 * 		int tm_isdst; //夏时制时间
 * }
 * */