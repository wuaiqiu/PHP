/*
 JavaScript 错误

	(1)JavaScript try 和 catch
		try 语句允许我们定义在执行时进行错误测试的代码块。
		catch 语句允许我们定义当 try 代码块发生错误时，所执行的代码块。
		
	try {
		//在这里运行代码
	} catch(err) {
		err.message;//错误信息
		err.name;//错误名称
		err.stack;//详细错误信息
	}finally{
	   //不管是否出错都会执行
	}
	
	(2)throw 语句允许我们创建自定义错误,异常可以是 JavaScript 字符串、数字、逻辑值或对象。	
			
			if(isNaN(x)) throw "不是数字";

	=============================================================================
		try{
			var x="str";
			if(isNaN(x)) throw "不是数字";
		}catch(err){
			console.log(err);
		}finally{
			console.log("this is over");
		}
		
		>不是数字
	=============================================================================

	(3)自定义错误；继承Error类
		
				class MyError extends Error{
					constructor(message) {
					    super(message); 
					    this.name = "MyError"; 
					  }
				}
				
				function test() {
					  throw new MyError("Whoops!");
				}
				
				try {
					 test();
				} catch(err) {
					console.log(err.message);	//Whoops!
					console.log(err.name);		//MyError
					console.log(err.stack);		//MyError: Whoops!
				}
 */