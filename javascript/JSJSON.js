/*
JavaScript JSON(JavaScript Object Notation)

	(1)它是一种严格的js对象的格式，JSON的属性名必须有双引号,值不能是方法函数

	{"name":"Runoob", "url":"www.runoob.com"}
	

	(2)JSON 字符串转换为 JavaScript 对象
	
	var text = '{"name":"Runoob", "url":"www.runoob.com"}';
	var obj = JSON.parse(text);
	console.log(obj);
	
	>{name: "Runoob", url: "www.runoob.com"}

	(3)javascript对象转化为json字符串
	
	var obj={name:"zhangsan",id:10};
	var str=JSON.stringify(obj);
	console.log(str);
	
	>{"name":"zhangsan","id":10}

 */