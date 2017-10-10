/*
 * 
 *Map（映射）
 *	
 *	一个Map对象就是一个简单的键值对映射集合
 *	
 *	a.常见属性与方法
 *		size				返回Map对象的键/值对的数量。
 *		
 *		clear()				移除Map对象的所有键/值对 
 *		delete(key)			移除任何与键相关联的值，并且返回该值
 *		get(key)			返回键对应的值，如果不存在，则返回undefined
 *		has(key)			返回一个布尔值，表示Map实例是否包含键对应的值
 *		set(key, value)		设置Map对象中键的值。返回该Map对象
 *		entries()			返回一个新的 Iterator 对象，它按插入顺序包含了Map对象中每个元素的 [key, value] 数组。
 *		keys()				返回一个新的 Iterator对象， 它按插入顺序包含了Map对象中每个元素的键 。
 *		values()			返回一个新的Iterator对象，它按插入顺序包含了Map对象中每个元素的值 。
 *		forEach(callbackFn)	按插入顺序，为 Map对象里的每一键值对调用一次callbackFn函数。
 *
 *	b.与对象的区别
 *		（1）Object的键均为String类型，在Map里键可以是任意类型
 *		（2）必须手动计算Object的尺寸，但是可以很容易地获取使用Map的尺寸(size)
 *		（3）Map的遍历遵循元素的插入顺序		
 *
 */
	
	var map=new Map();
	map.set(1,"zhangsan");
	map.set("class",4);
	//for-of遍历
	for(var [key,value] of map){
		console.log(key+":"+value);
	}
	
	for(var key of map.keys()){
		console.log(key);
	}
	
	for(var value of map.values()){
		console.log(value);
	}
	
	for(var [key,value] of map.entries()){
		console.log(key+":"+value);
	} 

	//forEach遍历
	map.forEach(function(key,value){
		console.log(key+":"+value);
	})

	
/*
 * Set
 *
 *	Set对象是一组值的集合，这些值是不重复的，可以按照添加顺序来遍历。
 *
 *	a.常见属性与方法
 *		size				返回Set对象的值的个数。
 *		
 *		add(value)			在Set对象尾部添加一个元素。
 *		clear()				移除Set对象内的所有元素。
 *		delete(value)		移除Set的中与这个值相等的元素，
 *		entries()			返回一个新的迭代器对象，该对象包含Set对象中的按插入顺序排列的所有元素的值的[value, value]数组。
 *		forEach(callbackFn）按照插入顺序，为Set对象中的每一个值调用一次callBackFn
 *		has(value)			返回一个布尔值，表示该值在Set中存在与否。
 *		keys()				返回一个新的迭代器对象，该对象包含Set对象中的按插入顺序排列的所有元素的值。
 *		values()			返回一个新的迭代器对象，该对象包含Set对象中的按插入顺序排列的所有元素的值。
 *
 *
 *	b.Set与Array
 *		//Set==>Array
 *		var arr=Array.from(mySet);	
 *		var arr=[...mySet2];
 *		
 *		//Array=>Set
 *		mySet2 = new Set([1,2,3,4]);
 */
	
		var set=new Set();
		set.add("zhangsan");
		set.add(1);
		
		//for-of遍历
		for(var value of set){
			console.log(value);
		}
		
		for(var key of set.keys()){
			console.log(key);  
		}
		
		for(var value of set.values()){
			console.log(value);
		}
		
		for(var [key,value] of set.entries()){
			console.log(key+":"+value);
		}
		
		//forEach遍历
		set.forEach(function(value){
			console.log(value);
		})