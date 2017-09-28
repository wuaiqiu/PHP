//---------------------直接定义对象-----------------------------//
var person = {
				firstName:"John",
				lastName:"Doe",	
				run:function(a){
					console.log(a);
				},
				eat(a){
					console.log(e);
				}
			};
console.log(person);
//==>Object{firstName: "John", lastName: "Doe", run: ƒ, eat: ƒ}
/*
 * 本质：
 * 		var person=new Object();
 * 		person.fristName="John";
 * 		person.lastName="Doe";
 * 		person.run=function(a){console.log(a)};
 **/


//------------------------构造方法--------------------------------//
function Human(firstname,lastname){
		this.firstname=firstname;
		this.lastname=lastname;
		this.fun=fun;
		function fun(){
           console.log("this is fun");
		}
}
console.log(new Human("John","Doe"));
//==>Human {firstname: "John", lastname: "Doe", fun: ƒ}


//------------------------Object.create()-------------------------//
/*
 * Object.create(proto[,propertiesObject]): 方法会使用指定的原型对象及其属性去创建一个新的对象。
 * 	propertiesObject对象:
 * 		数据属性
 * 			writable:是否可任意写
 * 			configurable：是否能够删除，是否能够被修改
 * 			enumerable：是否能用 for in 枚举
 * 			value：值
 * */
var obj=Object.create(Object.prototype,{
	firstName:{value:"John"},
	lastName:{value:"Doe"},	
	run:{value:function(){console.log("ok")}}
	}
);
console.log(obj);
//==>Object{firstName: "John", lastName: "Doe" ,run: ƒ}


//-----------------------获取属性与方法--------------------------//
person.lastName;		//Doe
person["lastName"];		//Doe
person.run(1);			//1
person.run;			//function(a){console.log(a)};


//--------------------添加属性与方法---------------------------//
function Human(){}
var obj1=new Human();
var obj2=new Human();
obj1.name="zhangsan";	//给特定对象添加，只在此对象有作用
obj.arr1=[1,2];			//添加引用类型
Human.prototype.age=12;			//给原型链添加，对此构造函数实例化的所有对象有用
Human.prototype.arr2=[1,2];		//添加引用类型
console.log(obj1);	//==>Human {name: "zhangsan"}
console.log(obj2);	//==>Human {}

//原型链引用类型共享
obj1.age=11;  	//	obj1.age=11			obj2.age=12
obj1.arr2[0]=3; //	obj1.arr2=[3,2]		obj2.arr2=[3,2]


//------------------------原型链------------------------------------//
/*
 * JavaScript 基于 prototype，而不是基于类的
 * 		1.prototype(函数独有)
 * 			每个函数都有一个属性叫做prototype。这个prototype的属性值是一个对象,此对象(function.prototype)
 * 		有一个构造方法指向原构造函数
 * 			可以在自己自定义的函数的prototype中新增自己的属性,则所有实例对象都有此属性，并且节省内存
 * 
 * 		2.__proto__(函数与对象都有)
 * 			每个对象都有一个__proto__属性，可成为隐式原型，这个属性引用了创建这个对象的函数的prototype。
 * 		即：fn.__proto__ === Fn.prototype;每个函数也有一个__proto__属性，即fun.__proto__===Function.prototype	
 * 			Object.prototype的__proto__指向的是null;	
 * 
 * 		3.javascript中的继承是通过原型链来体现的.访问一个对象的属性时，先在基本属性中查找，如果没有，再沿
 * 		着__proto__这条链向上找，这就是原型链。
 * 
 * */


//-------------------------------------继承---------------------------------//

/*
 * 原型链继承
 * 	a.无法实现多继承
 * 	b.来自原型对象的引用属性（Array等）是共享的
 * 	c.创建子类实例时，无法向父类构造函数传参	
 * */
function Animal(){}
function Cat(){}
Cat.prototype=new Animal();
Cat.prototype.constructor=Cat;//默认为function Cat(){}
var obj=new Cat();
console.log(obj instanceof Cat);//true
console.log(obj instanceof Animal);//true


/*
 * 构造继承（复制实例属性与方法）
 * 	a.不能继承父类的原型属性与方法
 * */
function Animal(name){
	this.name=name;
	this.fun=function (){};
}
function Animals(){
	
}
function Cat(name){
	Animal.call(this,name);
	Animals.call(this);
}
var cat = new Cat("zhangsan");
console.log(cat instanceof Cat);//true
console.log(cat instanceof Animal);//false


/*
 * 组合继承(原型链继承+构造继承)
 * 	a.两份实例属性与方法
 * */
function Animal(name){
	this.name=name;
	this.arr=[1,2];
}
function Cat(name){
	Animal.call(this,name);
}
Cat.prototype=new Animal();
Cat.prototype.constouctor=Cat;
var cat=new Cat("zh");
console.log(cat instanceof Cat);//true
console.log(cat instanceof Animal);//true


/*
 * 寄生组合继承(组合继承的优化)
 * 	Object.create()的实现原理
 * */
function Animal(){
	
}
function Cat(){
	
}
function beget(p){	//中介函数,生成原型链指向p的空白实例
	var f=function(){};
	f.prototype=p;
	return new f();
}
var F=beget(Animal.prototype);
F.constructor=Cat;//F对象只有一个constructor实例属性
Cat.prototype=F;
var cat=new Cat();
console.log(cat instanceof Cat);//true
console.log(cat instanceof Animal);//true


/*
 * 拷贝继承
 *  1.效率较低，内存占用高（因为要拷贝父类的属性）
 * */
function Animal(name){
	this.name=name;
}
function Cat(name){
	var a=new Animal(name);
	for(var p in a){
		this[p]=a[p];//复制到对象实例上，或Cat.prototype[p]=a[p]复制到原型链上
	}
}
var cat=new Cat("zhangsan");
console.log(cat instanceof Cat);//true
console.log(cat instanceof Animal);//false


//-------------------------多态（重写实现）--------------------------------------//
function Person(){
	this.get=function(){
		console.log("this is Person");
	}
}

function Student(){}
Student.prototype=new Person();
Student.prototype.get=function(){
	console.log("this is Student");
}

function Teacher(){}
Teacher.prototype=new Person();
Teacher.prototype.get=function(){
	console.log("this is Teacher");
}

function PFactory(name){
	switch (name) {
	case "Student":
		return new Student();
		break;
	case "Teacher":
		return new Teacher();
		break;
	default:
		return new Person();
		break;
	}	
}

var obj1=new PFactory("Student");
var obj2=new PFactory("Teacher");
var obj3=new PFactory(" ");
obj1.get();//this is Student
obj2.get();//this is Teacher
obj3.get();//this is Person

//-------------------------控制访问（实现封装）---------------------------------//
/*
 * 私有变量
 * 	1.构造函数模式
 * 	2.静态私有变量模式
 * 	3.模块模式
 * 	4.增强的模块模式
 * */


//1.构造函数模式
//缺点：每个实例上创建同样的一组新的特权方法
function Person(){
	var name;//私有变量
	
	function fun(){
		console.log("私有函数");
	}
	
	//特权方法:有权访问私有变量和私有函数的公有方法叫做特权方法。特权方法是一个闭包
	this.getName=function(){
		fun();
		return name;
	}
	
	//特权方法 
	this.setName=function(n){
		name=n;
	}
}
var obj=new Person();
obj.setName("zhangsan");
console.log(obj.name);//undefined
console.log(obj.getName());//私有函数,zhangsan


//2.静态私有变量模式
//缺点:私有变量和函数是实例之间共享的
(function(){
    //私有变量
    var name;
    
    //构造函数
    Person = function(){
    	
    };

    //特权方法
    Person.prototype.setName = function(n){
        name=n;
    };
    
    //特权方法
    Person.prototype.getName=function(){
    	return name;
    }
})();

var obj=new Person();
obj.setName("zhangsan");
console.log(obj.name);//undefined
console.log(obj.getName());//zhangsan

var obj2=new Person();
obj2.setName("lisi");
console.log(obj.getName());//lisi
console.log(obj2.getName());//lisi


//3.模块模式(单例创建私有变量和特权方法)
var person=function(){
	//私有变量
	var name;
	
	return {
		getName:function(){return name},
		setName:function(n){name=n}
	};
}();

person.setName("zhangsan");
console.log(person.name);//undefined
console.log(person.getName());//zhangsan


//4.4.增强的模块模式(指定对象类型)
function Person(){}

var obj=function(){
	//私有变量
	var name;
	
	//指定对象
	var o=new Person();
	o.setName=function(n){name=n};
	o.getName=function(){return name};
	return o;
}();

obj.setName("zhangsan");
console.log(obj.getName());//zhangsan
console.log(obj.name);//undefined


//------------------------重载----------------------------------//
/*
 * 重载
 * 	a.javascript不支持函数重载,最后的函数会覆盖前面的同名函数，但是javascript却可以通过自身属性
 * 去模拟函数重载。
 * */

//arguments对象
function fun(){
	if(arguments.length==1){
		console.log(arguments[0]);
	}else if(arguments.length==2){
		console.log(arguments[0]+"==>"+arguments[1]);
	}else{
		console.log(arguments);
	}
}

fun("张三");//张三
fun("李四",20);//李四==>20