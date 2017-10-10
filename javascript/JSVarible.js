/*
 * 
 *JavaScript 变量
 *
 *	(1)如果重新声明 JavaScript 变量，该变量的值不会丢失：在以下两条语句执行后，
 *	变量 carname 的值依然是 "Volvo"：
 *		var carname="Volvo"; 
 *		var carname;
 *
 *
 *	(2)您可以在一条语句中声明很多变量。该语句以 var 开头，并使用逗号分隔变量即可;
 *		var lastname="Doe", age=30, job="carpenter";
 *
 *
 *	(3)局部变量
 *		a.在JavaScript【函数】内部声明的变量(使用 var)是局部变量，所以只能在函数内部访问它。
 *		b.如果变量在函数内声明（没有使用 var 关键字），该变量为全局变量
 *
 *		function fun1(){
 *				var a=1;
 *				b=4;
 *		}
 *		fun1();	
 *		console.log(b);		//4
 *
 *
 *	(4)全局变量
 *		a.在函数外声明的变量是全局变量，网页上的所有脚本和函数都能访问它。
 *			var c=5;
 *			function fun1(){
 *				console.log(c); //5
 *			}
 *			fun1();
 *			console.log(c);		//5
 *
 *		b.在每个语句代码块的作用域都是全局的
 *		for (var i=0;i<10;i++){}
 *		console.log(i);			//10
 *
 *
 *  (5)块级作用域的局部变量let
 *	 	a.let声明的变量只在其声明的块或子块中可用,在全局中没有作用
 *		function varTest() {
 *			var x = 1;
 *			if (true) {
 *				var x = 2;  // 同样的变量!
 *				console.log(x);  // 2
 *			}
 *			console.log(x);  // 2
 *		}
 *
 *		function letTest() {
 *			let x = 1;
 *			if (true) {
 *					let x = 2;  // 不同的变量
 *					console.log(x);  // 2
 *			}
 *  		console.log(x);  // 1
 *  	}
 *  
 *	 	b.let不会hoisting(变量提升)，当在同一个函数或同一个作用域中用let重复定义一个变量将引起TypeError
 *		if (x) {
 *			let foo;
 *			let foo; // TypeError throw
 *		}
 *		function do_something() {
 *				console.log(foo); // error
 *				let foo = 2;
 *		}
 *	
 *
 *	(6)常量
 *		常量必须被初始化；常量拥有块级作用域
 *		const FUN=1;
 *		console.log(FUN);//1
 *		if(true){
 *			const FUN1=2;
 *			console.log(FUN1);//2
 *			console.log(FUN);//1
 *		}
 *		console.log(FUN1);//FUN1 is not defined
 *	
 *
 *	(7)变量提升(hoisting)
 *		a.JavaScript 中，【函数及变量】的声明都将被提升到函数的最顶部。JavaScript 中，变量可以在使用后声明，
 *	也就是变量可以先使用再声明。以下两个实例将获得相同的结果：
 *	<a>		x = 5; // 变量 x 设置为 5
 *			console.log(x);		//5
 *			var x; // 声明 x	
 *	<b>		var x; // 声明 x
 *			x = 5; // 变量 x 设置为 5
 *			console.log(x);		//5
 *	
 *		b.JavaScript 只有声明的变量会提升，初始化的不会。以下两个实例结果结果不相同：
 *	<a>		var x = 5; // 初始化 x
 *			console.log(x);		//5
 *	<b>		console.log(x);		//undefined
 *			var x = 5; // 初始化 x
 *		这是因为变量声明 (var x) 提升了，但是初始化(x = 5) 并不会提升，所以 x 变量是一个未定义的变量。
 *
 */