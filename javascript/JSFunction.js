/*
 *JavaScript 函数
 * 
 *(1)简单函数
 *		function functionname(){
 *			代码
 *		}
 *
 *(2)带参数的函数
 *		function myFunction(var1,var2){
 *			代码
 *		}
 *
 *(3)带有返回值的函数
 *		function myFunction(){
 *				var x=5;
 *				return x;
 *		}
 *
 *(4)函数表达式
 *		JavaScript 函数可以通过一个表达式定义。函数表达式可以存储在变量中：
 *	
 *			var x = function (a, b) {return a * b};
 *
 *		在函数表达式存储在变量后，变量也可作为一个函数使用：
 *
 *			var z = x(4, 3);
 *
 *(5)函数表达式自调用
 *
 *		如果表达式后面紧跟 () ，则会自动调用。自调函数在加载时就调用一次
 *		
 *		var myfun=function(a,b){return a+b}(1,2); //自调用
 *
 *		function myfun(){}();		//不能自调用声明的函数。
 *		
 *		或者匿名自我调用的函数
 *		
 *		(function(a,b){alert("ajdfk")})(1,2);
 *		(function(a,b){alert("ajdfk")}(1,2));
 *
 *(7)JavaScript 闭包,闭包就是能够读取其他函数内部变量的函数。
 *
 *		它的最大用处有两个，一个是可以读取函数内部的变量，另一个就是让这些变量的值始终保持在内存中。
 *======================================================================================
 *	function Person(){
 *			var a=10;
 *			function getA(){	//闭包：读取内部函数的参数
 *				return a;
 *			}
 *			return getA();
 *	}
 *	
 *	var a=Person();
 *	console.log(a);
 *
 *======================================================================================
 *	function Person(){
 *			var a=10;
 *			function getA(){		//闭包：让a变量始终留在内存中
 *				console.log(a++);
 *			}
 *			return getA;
 *	}
 *
 *	var a=Person();
 *	a();//10
 *	a();//11
 *	a();//12
 *======================================================================================	
 *	缺点：
 *	 a.由于闭包会使得函数中的变量都被保存在内存中，内存消耗很大，所以不能滥用闭包，否则会造成网页的性能问题，
 *   b.闭包会在父函数外部，改变父函数内部变量的值。
 *   
 *(8)作为函数方法调用函数
 *	
 *		两个方法都使用了对象本身作为第一个参数。 两者的区别在于第二个参数： apply传入的是一个参数
 *		数组，也就是将多个参数组合成为一个数组传入，而call则作为call的参数传入（从第二个参数开始）。
 *	
 *		function myFunction(a, b) {
 *				return a * b;	
 *		}
 *		myFunction.call(new Object(), 10, 2);     // 返回 20;让new Object()对象去调用myFunction方法
 *		
 *		function myFunction(a, b) {
 *				return a * b;
 *		}
 *		myArray = [10, 2];
 *		myFunction.apply(new Object(), myArray);  // 返回 20;让new Object()对象去调用myFunction方法
 *
 *
 *(9)javascript:void(0)
 *  操作符指定要计算一个表达式但是不返回
 *
 *  var a,b;
 *  a=void(b=3);
 *  console.log(a); //undefined
 *  console.log(b); //3
 *
 *
*/