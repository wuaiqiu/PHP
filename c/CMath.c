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