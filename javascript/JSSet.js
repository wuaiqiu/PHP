/*
 一.Map（映射）

	一个Map对象就是一个简单的键值对映射集合，可以按照数据插入时的顺序遍历所有的元素。
	
	a.简单实例
	========================================================================
	var sayings = new Map();
	sayings.set("dog", "woof");
	sayings.set("cat", "meow");
	sayings.set("elephant", "toot");
	sayings.size; // 3
	sayings.get("fox"); // undefined
	sayings.has("bird"); // false
	sayings.delete("dog");

	for (var [key, value] of sayings) {
	  console.log(key + " goes " + value);
	}
	// "cat goes meow"
	// "elephant goes toot"
	========================================================================
	b.与对象的区别
		
	   （1）Object的键均为Strings类型，在Map里键可以是任意类型
	   （2）必须手动计算Object的尺寸，但是可以很容易地获取使用Map的尺寸(size)
	   （3）Map的遍历遵循元素的插入顺序

	========================================================================


二.Set（集合）

	Set对象是一组值的集合，这些值是不重复的，可以按照添加顺序来遍历。
	
	a.简单实例
	=====================================================================
	var mySet = new Set();
	mySet.add(1);
	mySet.add("some text");
	mySet.add("foo");

	mySet.has(1); // true
	mySet.delete("foo");
	mySet.size; // 2

	for (let item of mySet) console.log(item);
	// 1
	// "some text"
	=====================================================================
	b.数组（Array）和集合（Set）的转换
	
	//Set==>Array
	var arr=Array.from(mySet);	
	var arr=[...mySet2];

	//Array=>Set
	mySet2 = new Set([1,2,3,4]);
	==================================================================== 
 */