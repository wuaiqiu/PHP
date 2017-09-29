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

	
	(8)JavaScript 闭包闭包就是能够读取其他函数内部变量的函数。
		var add = (function () {
			var counter = 0;
			return function () {console.log(counter += 1);}
		})();

		add();
		add();
		add();

		// 计数器为 3
		
	变量 add 指定了函数自我调用的返回字值。自我调用函数只执行一次。设置计数器为 0。并返回函数表达式。
add变量可以作为一个函数使用。非常棒的部分是它可以访问函数上一层作用域的计数器。这个叫作 JavaScript 
闭包。它使得函数拥有私有变量变成可能。计数器受匿名函数的作用域保护，只能通过 add 方法修改。


	(9)函数参数数组
		function fun1(){
			console.log(arguments);
		}

		arguments为函数的属性
		
		
	(10)作为函数方法调用函数（function对象的方法）
			两个方法都使用了对象本身作为第一个参数。 两者的区别在于第二个参数： apply传入的是一个参数
		数组，也就是将多个参数组合成为一个数组传入，而call则作为call的参数传入（从第二个参数开始）。
			function myFunction(a, b) {
				return a * b;
			}
			myObject = myFunction.call(myObject, 10, 2);     // 返回 20
			
			function myFunction(a, b) {
				return a * b;
			}
			myArray = [10, 2];
			myObject = myFunction.apply(myObject, myArray);  // 返回 20
*/