/*
javascript数组

		(1)JavaScript 不支持使用名字来索引数组，只允许使用数字索引。
				var person = [];
				person[0] = "John";
				person[1] = "Doe";
				person[2] = 46;
				var x = person.length;         // person.length 返回 3
				var y = person[0];             // person[0] 返回 "John
		(2)如果你使用名字作为索引，当访问数组时，JavaScript会把数组重新定义为标准对象。
				var person = [];
				person["firstName"] = "John";
				person["lastName"] = "Doe";
				person["age"] = 46;
				var x = person.length;         // person.length 返回 0
				var y = person[0];             // person[0] 返回 undefined
 */