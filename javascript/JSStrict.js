/*
JavaScript严格模式(use strict)
	
	(1)"use strict" 指令在 JavaScript 1.8.5 (ECMAScript5) 中新增。它不是一条语句，但是是一个字面量
	表达式，在 JavaScript 旧版本中会被忽略。"use strict" 的目的是指定代码在严格条件下执行。

	<script>
		"use strict";
		x = 3.14;       // 报错 (x 未定义)
	</script>
	
	(1)严格模式的限制
		a.不允许使用未声明的变量,对象也是一个变量。
			"use strict";
			x = {p1:10, p2:20};      // 报错 (x 未定义)
		
		b.不允许删除变量或对象。
			"use strict";
			 var x = 3.14;
			 delete x;                // 报错
		
		c.不允许删除函数。
			"use strict";
			function x(p1, p2) {}; 
			delete x;                // 报错 
			
		d.不允许变量重名:
			"use strict";
			function x(p1, p1) {};   // 报错
			
		e.不允许使用转义字符:
			"use strict";
			var x = \010;            // 报错
		
		f.不允许使用八进制:
			"use strict";
			var x = 010;             // 报错
		
		h.不允许对只读属性赋值
		
		i.不允许对一个使用getter方法读取的属性进行赋值
		
		j.不允许删除一个不允许删除的属性
		
		k.由于一些安全原因，在作用域 eval() 创建的变量不能被调用
			"use strict";
			eval ("var x = 2");
			alert (x);               // 报错
		
		l.禁止this关键字指向全局对象。
			function f(){
				return this;
			} 
		// 返回false，因为"this"指向全局对象，"this"就是false

			function f(){ 
				"use strict";
				return !this;
			} 
		// 返回true，因为严格模式下，this的值为undefined，所以"!this"为true。
		因此，使用构造函数时，如果忘了加new，this不再指向全局对象，而是报错。
			function f(){
				"use strict";
				this.a = 1;
			};
			f();// 报错，this未定义

*/