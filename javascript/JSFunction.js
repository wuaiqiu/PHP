/*
JavaScript 函数

	(1)函数就是包裹在花括号中的代码块，前面使用了关键词 function：
		function functionname()
		{
			执行代码
		}
		
	(2)带参数的函数
		当您声明函数时，请把参数作为变量来声明：
		function myFunction(var1,var2)
		{
			代码
		}
	
	(3)带有返回值的函数
		通过使用 return 语句就可以实现。在使用 return 语句时，函数会停止执行，并返回指定的值。
		function myFunction()
		{
				var x=5;
				return x;
		}


	(4)局部 JavaScript 变量
		a.在JavaScript【函数】内部声明的变量(使用 var)是局部变量，所以只能在函数内部访问它。
		b.如果变量在函数内声明（没有使用 var 关键字），该变量为全局变量
		----------------------------------------------------------------------------
			function fun1(){
				var a=1;
				b=4;
			}
			
			fun1();	
			console.log(b);		//4
		-----------------------------------------------------------------------------

			
	
	(5)全局 JavaScript 变量
		a.在函数外声明的变量是全局变量，网页上的所有脚本和函数都能访问它。
		b.如果您把值赋给尚未声明的变量，该变量将被自动作为全局变量声明。
		-----------------------------------------------------------------------------
			c=5;
			function fun1(){
				console.log(c); //5
			}
			
			fun1();	
			console.log(c);		//5
		-----------------------------------------------------------------------------
		c.在每个语句代码块的作用域都是全局的。
	
		-------------------------------------------------------------------------------
		for (var i=0;i<10;i++){}
		console.log(i);			//10
		-------------------------------------------------------------------------------


	(6)函数表达式
	JavaScript 函数可以通过一个表达式定义。函数表达式可以存储在变量中：
		var x = function (a, b) {return a * b};
	在函数表达式存储在变量后，变量也可作为一个函数使用：
		var z = x(4, 3);
	
	
	(7)函数表达式自调用
		如果表达式后面紧跟 () ，则会自动调用。自调函数在加载时就调用一次
		
		var myfun=function(a,b){alert("haa")}(1,2); //自调用
		
		function myfun(){}();		//不能自调用声明的函数。
		
		或者匿名自我调用的函数。通过添加括号，因为JavaScript里括弧()里面不能包含语句，所以在这一点上，
		解析器在解析function关键字的时候，会将相应的代码解析成function表达式，而不是function声明。
		
		(function(a,b){alert("ajdfk")})(1,2);
		(function(a,b){alert("ajdfk")}(1,2));

	
	(8)JavaScript 闭包,闭包就是能够读取其他函数内部变量的函数。
		它的最大用处有两个，一个是可以读取函数内部的变量，另一个就是让这些变量的值始终保持在内存中。
	======================================================================================
		function Person(){
			var a=10;
			function getA(){	//闭包：读取内部函数的参数
				return a;
			}
			return getA();
		}
		var a=Person();
		console.log(a);
	======================================================================================
		function Person(){
			var a=10;
			function getA(){		//闭包：让a变量始终留在内存中
				console.log(a++);
			}
			return getA;
		}
		var a=Person();
		a();//10
		a();//11
		a();//12
	======================================================================================	
		缺点：
		  a.由于闭包会使得函数中的变量都被保存在内存中，内存消耗很大，所以不能滥用闭包，否则会造成网页的性能问题，
		  b.闭包会在父函数外部，改变父函数内部变量的值。


	(9)作为函数方法调用函数
			两个方法都使用了对象本身作为第一个参数。 两者的区别在于第二个参数： apply传入的是一个参数
		数组，也就是将多个参数组合成为一个数组传入，而call则作为call的参数传入（从第二个参数开始）。
			function myFunction(a, b) {
				return a * b;
			}
			myFunction.call(new Object(), 10, 2);     // 返回 20;让new Object()对象去调用myFunction方法
			
			function myFunction(a, b) {
				return a * b;
			}
			myArray = [10, 2];
			myFunction.apply(new Object(), myArray);  // 返回 20;让new Object()对象去调用myFunction方法
*/