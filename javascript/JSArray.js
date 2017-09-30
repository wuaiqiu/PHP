/*
 * javascript数组
 * 		JavaScript在同一个数组中可以存放多种类型的元素，而且是长度也是可以动态调整的
 * 	
 *  (1)创建方式
 *  		var arr1=new Array();
 *  		var arr2=new Array(1,2,3); 如果传入一个数字参数，则会创建一个长度为参数的数组
 *  		var arr3=[1,2,3];
 *  
 *  (2)多维数组
 *  		var arr = new array(new array(1,2),new array("a","b"));
 *  		var arr = [[1,2,4,6],[2,4,7,8],[8,9,10,11],[9,12,13,15]];
 *  
 *  (3)如果你使用字符与负数作为索引，当访问数组时，JavaScript会把数组重新定义为标准对象。
 *  
 *  (4)数组可以作为函数的参数,数组可以作为函数的返回值
 *  
 *  (5)数组遍历for(var item in arr){}
 *  
 *  (6)Array方法
 *  	concat(arr1,arr2):连接两个或更多的数组，并返回结果
 *  	join(","):元素通过指定的分隔符进行分隔。并返回一个字符串		
 *  	pop():删除并返回数组的最后一个元素
 *  	push(element,...):向数组的末尾添加一个或更多元素，并返回新的长度
 *  	shift():删除并返回数组的第一个元素
 *  	unshift(element,...):向数组的开头添加一个或更多元素，并返回新的长度
 *  	reverse():颠倒数组中元素的顺序
 *  	sort():对数组的元素进行排序
 *  	slice(start,end):返回选定范围的元素
 *  	toString():把数组转换为字符串，并返回结果。
 *  	
 */

//当字符与负数作为索引
var person = [];
person["firstName"] = "John";
person["lastName"] = "Doe";
person[-10] = 46;
console.log(person);//[firstName: "John", lastName: "Doe", -10: 46]

//数组作为参数与返回类型
arr1=[1,2,3];
function fun(arr){
	for(var i in arr){
		console.log(i);
	}
	return arr;
}
arr=fun(arr1);	//arr=[1,2,3]

//数组方法
arr2=[2,3,4];
arr1.concat(arr2);	//[1, 2, 3, 2, 3, 4];arr1=[1,2,3]
arr1.join(",");//"1,2,3"
arr1.pop();//3 ;arr1=[1,2]
arr1.push(4);//4;arr1=[1,2,3,4]
arr1.shift();//1;arr1=[2,3]
arr1.unshift(4);//4;arr1=[4,1,2,3]