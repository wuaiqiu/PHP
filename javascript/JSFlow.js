/*
一.条件语句
	
=============================================================================

	(1)If 语句
		if (condition)
		{
			当条件为 true 时执行的代码
		}
		
	(2)If...else 语句
		if (condition)
		{
			当条件为 true 时执行的代码
		}
		else
		{
			当条件不为 true 时执行的代码
		}
	
	(3)If...else if...else 语句
		if (condition1)
		{
			当条件 1 为 true 时执行的代码
		}
		else if (condition2)
		{
			当条件 2 为 true 时执行的代码
		}
		else
		{	
			当条件 1 和 条件 2 都不为 true 时执行的代码
		}
		
=================================================================================
		
	(4)JavaScript switch 语句
		switch(n)
		{
			case 1:
				执行代码块 1
			break;
			case 2:
				执行代码块 2
			break;
			default:
				与 case 1 和 case 2 不同时执行的代码
		}
		
	(5)条件运算符
		variablename=(condition)?value1:value2 
============================================================================		
	
	
二.JavaScript 循环

============================================================================
	(1)For 循环
		for (语句 1; 语句 2; 语句 3)
		{
			被执行的代码块
		}
	
	(2)For/In 循环,只能用obj[x]
		for..in循环会把某个类型的原型(prototype)中方法与属性给遍历出来
		每个实例对象都有一个hasOwnProperty()方法，用来判断某一个属性到底是本地属性，还是继承自prototype对象的属性。
 
		function fun(){
			this.name="zhangsan";
		}
		
		fun.prototype.sex="男";
		var obj=new fun();
		for (var x in obj){
			if(obj.hasOwnProperty(x)){
				console.log(x+"==>"+obj[x]);
			}
		}
		
		//name==>zhangsan

	(3)While 循环
		while (条件)
		{
			需要执行的代码
		}
	
	(4)do/while 循环
		do
		{
			需要执行的代码
		}
		while (条件);
	
	(5)break 语句用于跳出循环。（不带标签引用），只能用在循环或 switch 中
		通过标签引用，break 语句可用于跳出任何 JavaScript 代码块：
		list: 
		{
			document.write(cars[0] + "<br>"); 
			document.write(cars[1] + "<br>"); 
			document.write(cars[2] + "<br>"); 
			break list;
			document.write(cars[3] + "<br>"); 
			document.write(cars[4] + "<br>"); 
			document.write(cars[5] + "<br>"); 
		}
	
	(6)continue 用于跳过循环中的一个迭代。（带有或不带标签引用）只能用在循环中。
*/