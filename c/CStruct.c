/*
 * 1.结构体
 *		struct 结构体名{
 *			类型	  类型名;
 *			...
 *		};
 *
 *		struct student a={"wu",20};
 *		a.类型名;
 *		struct student* p=&a;
 *		p->类型名  ===  (*p).类型名  === a.类型名
 *
 *
 *2.共用体
 *		union 共用体名{
 *			类型  类型名;
 *			...
 *		};
 *
 *		union student a={"wu",20};
 *		a.类型名;
 *		union student* p=&a;
 *		p->类型名  ===  (*p).类型名  === a.类型名
 *
 *		a.共用体任何时候只有一个成员存在
 *		b.共用体长度为最长成员的长度
 *
 *
 *3.typedof类型别名
 *		typedof 类型名 类型新名
 * */