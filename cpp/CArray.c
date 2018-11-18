/*
 * 数组
 *
 *	1.声明与定义
 *		int arr[5]; //声明
 *		arr[1]=1; 	//赋值
 *		int arr2[2][3];
 *		arr2[1][1]=1;
 *
 *		int arr[5]={1,2,3,4,5}; //声明并赋值
 *		int arr2[2][3]={{1,2,3},{4,5,6}};
 *
 *		int arr[]={1,2,3,4,5}; //省略长度
 *		int arr2[][3]={1,2,3,4,5,6}; //第二维长度不可省略
 *
 *		int arr[5]={1}; //部分赋值，其他默认值0
 *		int arr2[2][3]={1};//部分赋值，其他默认值0
 *
 *
 *  2.指针与数组
 *    一维数组(&a == a == &a[0]):
 *      a数组的地址             &a
 * 		a[0]元素的地址          a,&a[0]
 * 		a[i]元素的地址          a+i,&a[i]
 *	  二维数组(&a == a == a[0] == &a[0][0]):
 *      a数组的地址             &a
 *      a数组第0行子数组的地址	a,a[0]
 *      a数组第i行子数组的地址  a+i,a[i]
 *      a[0][0]元素的地址 	    &a[0][0]
 *		a[i][j]元素的地址		*(a+i)+j,&a[i][j],a[i]+j
 *
 *  3.函数参数==>数组指针
 *     void fun1(int arr[]){
 *         cout<<sizeof(arr)<<endl;
 *         cout<<arr[1]<<endl;
 *         cout<<*(arr+1)<<endl;
 *     }
 *
 *     void fun2(int* arr){
 *         cout<<sizeof(arr)<<endl;
 *         cout<<arr[1]<<endl;
 *         cout<<*(arr+1)<<endl;
 *     }
 *     
 *     void fun3(int arr[][2]){
 *         cout<<sizeof(arr)<<endl;
 *         cout<<arr[1][1]<<endl;
 *         cout<<*(*(arr+1)+1)<<endl;
 *     }
 *
 *     void fun2(int (*arr)[2]){
 *          cout<<sizeof(arr)<<endl;
 *          cout<<arr[1][1]<<endl;
 *          cout<<*(*(arr+1)+1)<<endl;
 *     }  
 *
 *  4.typedef定义数组数据类型
 *      typedef int A[4]; //一维数组
 *      typedef int (*B)[4]; //二维数组
 *      A a={1,2,3,4};
 *      B b=&a;
 *      int (*c)[4]=&a;
 *      cout<<*(a+1)<<endl; //2
 *      cout<<*(*b+1)<<endl; //2
 *      cout<<*(*c+1)<<endl; //2
 * */