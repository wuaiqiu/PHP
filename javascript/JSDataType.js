/*
 * (1)基本数据类型，基本数据类型是按值访问的，因为可以直接操作保存在变量中的实际值。
 * 		字符串(String)、数字(Number)、布尔(Boolean)、未定义（Undefined，undefined 是一个没有设置值的变量）、空(Null，null表示一个空对象引用，一般用来清空对象)
 * 
 * (2)引用数据类型，存储在变量处的值是一个指针（point），指向存储对象的内存地址。
 * 		对象(Object)
 * 
 * (3)JavaScript 拥有动态类型。这意味着相同的变量可用作不同的类型：
 * 		var x;               // x 为 undefined
 * 		var x = 5;           // 现在 x 为数字
 * 		var x = "John";      // 现在 x 为字符串
 * 
 * (4)类型判断
 * 		typeof:判断基本数据类型（string/number/boolean）
 * 		instanceof:判断引用类型
 *     obj.constructor:利用构造函数来判断类型
 *     ==== :为绝对等（值与类型）
 *     ==:为值相等
 * 
 * (5)JavaScript类型转换
 * 
 * --------------------------(Number|Boolean|Null|Undefined)=>String------------------------
 * 		a.String()全局方法;【boolean,null,undefined】
 * 				String(123)      	//"123"
 * 				String(false)     	//"false"
 * 				String(null)	 	//"null"
 * 				String(undefined) 	//"undefined"
 * 		b.toString()方法;【number,boolean】
 * 				(123).toString()     //"123"
 * 				false.toString()   	 //"false"
 * 		c.当加号“+”作为二元操作符并且其中一个操作数为字符串类型时，另一个操作数将会被无条件转为字符串类型
 * 				5+"null"    //"5null"
 * 				3+" "       //"3 "
 * 
 * -----------------------(String|Boolean|Null|Undefined)=>Number------------------------
 * 		a.Number()全局方法；【string,boolean,null,undefined】
 * 					Number("3.14")     //3.14
 * 					Number(" ")        //0 
 * 					Number("str")      //NaN
 * 					Number(true)	   //1
 * 					Number(null)	   //0
 * 					Number(undefined)  //NaN
 *
 *		b.一元运算符+将变量转换为数字：
 *			var y = "5";      // y 是一个字符串
 *			var x = + y;      // x 是一个数字
 *		如果变量不能转换它仍然会是一个数字，但值为 NaN (不是一个数字):
 *			var y = "John";   // y 是一个字符串
 *			var x = + y;      // x 是一个数字 (NaN)
 *
 *	--------------------------(Number|String|null|undefined)=>Boolean---------------------
 *		a.在boolean环境中，0和NaN会自动转为false，其余数字都被认为是true
 *		b.在boolean环境中，空字符串会被转为false，其它字符串都会转为true
 *		c.在boolean环境中，undefined和null在逻辑环境中执行时，都被认为是false
 *
 * (6)值传递与共享传递
 * 		
 * 		JS中的基本类型按值传递，引用数据类型按共享传递的
 * 		共享传递：
 * 			(a).如果传递给函数的参数是对象，并且修改了这个对象的属性(某些字段的值)，那么原参数就被修改了。
 * 			(b).如果传递给函数的参数是对象，并且没有修改这个对象的属性的值，而是把对象作为一个整体来操作的话。原参数就没有被修改。
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