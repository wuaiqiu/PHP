/*
(1)基本数据类型，基本数据类型是按值访问的，因为可以直接操作保存在变量中的实际值。
	字符串(String)、数字(Number)、布尔(Boolean)、未定义（Undefined）
		a.字符串(String)字面量可以使用单引号或双引号;'John Doe'
		b.数字(Number)字面量可以是整数或者是小数，或者是科学计数;123e5
				
(2)引用数据类型，存储在变量处的值是一个指针（point），指向存储对象的内存地址。
	数组(Array)、对象(Object)、空(Null)、日期(Date),函数(Function)
		a.数组(Array)字面量定义一个数组;[40, 100, 1, 5, 25, 10]
		b.对象(Object)字面量 定义一个对象;{firstName:"John", lastName:"Doe", age:50}
		c.函数(Function)字面量定义一个函数;function myFunction(a, b) { return a * b;}

(3)JavaScript 拥有动态类型。这意味着相同的变量可用作不同的类型：
	
		var x;               // x 为 undefined
		var x = 5;           // 现在 x 为数字
		var x = "John";      // 现在 x 为字符串

(4)类型判断
		typeof:对于值类型，你可以通过typeof判断，string/number/boolean都很清楚，但是typeof在判断到
		引用类型的时候，返回值只有object/function，你不知道它到底是一个object对象，还是数组，还是
		new Number等等。
	
		instanceof:运算符的第一个变量A；第二个变量B。instanceof的判断队则是：沿着A的__proto__这条线来
		找，如果两条线能找到同一个constructor，即同一个对象，那么就返回true。如果找到终点还未重合，则返
		回false。

(5)JavaScript类型转换
		------------------------------------Number=>String--------------------------------
		a.将数字转换为字符串
			全局方法String()可以将数字转换为字符串。该方法可用于任何类型的数字，字母，变量，表达式
				String(123)       // 将数字 123 转换为字符串并返回
		
		b.将布尔值转换为字符串
			全局方法String()可以将布尔值转换为字符串。
				String(false)        // 返回 "false"
	
			
		c.将日期转换为字符串
			全局方法String()可以将日期转换为字符串。
				String(Date()) 
		

		-----------------------------------------String=>Number-------------------------------
		a.将字符串转换为数字
			全局方法 Number() 可以将字符串转换为数字。字符串包含数字(如 "3.14") 转换为数字 (如 3.14).
		空字符串转换为 0。其他的字符串会转换为 NaN (不是个数字)。
			Number("3.14")    // 返回 3.14
			Number(" ")       // 返回 0 
			Number("99 88")   // 返回 NaN
	
		b.一元运算符+将变量转换为数字：
			var y = "5";      // y 是一个字符串
			var x = + y;      // x 是一个数字
		如果变量不能转换它仍然会是一个数字，但值为 NaN (不是一个数字):
			var y = "John";   // y 是一个字符串
			var x = + y;      // x 是一个数字 (NaN)

		c.将布尔值转换为数字
			全局方法 Number() 可将布尔值转换为数字。
				Number(false)     // 返回 0
				Number(true)      // 返回 1
			
		d.将日期转换为数字
			全局方法 Number() 可将日期转换为数字。
				d = new Date();
				Number(d)          // 返回 1404568027739
			日期方法 getTime() 也有相同的效果。
				d = new Date();
				d.getTime()        // 返回 1404568027739
				
(6)值传递与共享传递
	JS中的基本类型按值传递，引用数据类型按共享传递的
	共享传递：
		(a).如果传递给函数的参数是对象，并且修改了这个对象的属性(某些字段的值)，那么原参数就被修改了。
		(b).如果传递给函数的参数是对象，并且没有修改这个对象的属性的值，而是把对象作为一个整体来操作的话。原参数就没有被修改。
	
*/

//共享传递
var obj={"name":"zhangsan"};
function fun1(o){
	o.name="lisi";//操作属性
}
function fun2(o){
	o="zhangsan";//操作整体
}

fun1(obj); //{"name":"lisi"}
fun2(obj); //{"name":"zhangsan"}