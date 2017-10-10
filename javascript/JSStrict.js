/*
 * 
 *严格模式(use strict)
 *
 *	1.不允许使用未声明的变量,对象也是一个变量。
 *			"use strict";
 *			 x = {p1:10, p2:20};      // 报错 (x 未定义)
 *
 *	2.不允许删除变量或对象或函数。
 *			"use strict";
 *			 var x = 3.14;
 *			 delete x;                // 报错
 *
 *	3.不允许变量重名:
 *			"use strict";
 *			 function x(p1, p1) {};   // 报错
 *
 *	4.不允许使用转义字符:
 *			"use strict";
 *			 var x = \010;            // 报错
 *
 *	5.不允许使用八进制:
 *			"use strict";
 *			 var x = 010;             // 报错
 *	
 *	6.由于一些安全原因，在作用域 eval() 创建的变量不能被调用
 *			"use strict";
 *			eval ("var x = 2");
 *			alert (x);               // 报错
 */