# ES6

**一.let与const**

```
#1.let块级作用域，var为函数作用域
for(var a=0;a<10;a++){}
console.log(a); //10
for(let b=0;b<10;b++){}
console.log(b); //报错ReferenceError

#2.let变量不存在变量提升
console.log(foo); //输出undefined
var foo = 2;
console.log(bar); //报错ReferenceError
let bar = 2;

#3.let不允许在相同作用域内，重复声明同一个变量。
//报错
function func() {
  let a = 10;
  var a = 1;
}
//报错
function func() {
  let a = 10;
  let a = 1;
}

#4.const定义常量;只在声明所在的块级作用域内有效;声明的常量也是不提升;不可重复声明
const c=3.14;
c=6.28; //TypeError

#5.暂时性死区,TDZ（如果区块中存在let和const命令，这个区块对这些命令声明的变量，从一开始就形成了封闭作用域,凡是在声明之前就使用这些变量，就会报错）
if (true) {
    tmp = 'abc'; // ReferenceError
    console.log(tmp); // ReferenceError
    let tmp; // TDZ结束
    console.log(tmp); // undefined
    tmp = 123;
    console.log(tmp); // 123
}
```

<br>

**二.字符串的扩展**

```
#1.模板字符串
let a='love';
let text1="I "+a+" you";
let text2=`I ${a} you`;
console.log(text1);
console.log(text2);

#2.字符串的遍历
for (let a of 'foo') {
  console.log(a); //f o o
}

#3.字符串方法
/*
* includes()：返回布尔值，表示是否找到了参数字符串。
* startsWith()：返回布尔值，表示参数字符串是否在原字符串的头部。
* endsWith()：返回布尔值，表示参数字符串是否在原字符串的尾部。
* repeat();方法返回一个新字符串，表示将原字符串重复n次。
* padStart()用于头部补全。
* padEnd()用于尾部补全。
* */

let s = 'Hello world!';
console.log(s.startsWith('Hello')); // true
console.log(s.endsWith('!')); // true
console.log(s.includes('o')); // true
console.log(s.repeat(2)); // Hello world!Hello world!
console.log('x'.padStart(5, 'ab')); // 'ababx'
console.log('x'.padStart(4, 'ab')); // 'abax'
console.log('x'.padEnd(5, 'ab')); // 'xabab'
console.log('x'.padEnd(4, 'ab')); // 'xaba'
```

<br>

**三.数值的扩展**

```
#1.Math函数
/*
* Math.trunc()方法用于去除一个数的小数部分，返回整数部分,对于非数值，Math.trunc()内部使用Number方法将其先转为数值;
* Math.sign()方法用来判断一个数到底是正数、负数、还是零,正数(+1)；负数(-1)；0(0)；-0(-0)；其他值(NaN)
* Math.cbrt()方法用于计算一个数的立方根。
*
*     true --> 1 ; '12' --> 1 ;
*     false --> 0 ; '' --> 0 ; null --> 0 ;
*     '12s' --> NaN ; undefined --> NaN ; 'foo' --> NaN ; NaN --> NaN ; 什么都不写 --> NaN
* */

#2.指数运算符

console.log(2 ** 2); // 4
let a = 2;
a **= 2; // 等同于 a = a * a;
console.log(a);
```

<br>

**四.函数扩展**

```
#1.默认参数

function  show1(a,b) {
      b=b||8;
      return a*b;
}
function show2(a,b=8) {
      return a*b;
}
console.log(show1(1));
console.log(show2(1));

#2.rest 参数;rest 参数之后不能再有其他参数;rest 参数是一个数组
function add() {
    let sum =0;
    for(var val of Array.prototype.slice.call(arguments)){
        sum += val;
    }
    return sum;
}
console.log(add(1,3)); // 4

function add(...values) {
    let sum = 0;
    for (var val of values) {
         sum += val;
     }
     return sum;
}
console.log(add(2, 5, 3)); // 10
console.log(add(2,4)); // 6

#3.箭头函数;不可以当作构造函数;不可以使用arguments对象;不可以使用yield命令

//单行代码
function  show1(a,b) {
    return a*b;
}
var show2=(a,b)=>a*b;
console.log(show1(1,2));
console.log(show2(1,2));

//多行代码
function show3(a,b) {
   console.log(a);
   return a*b;
}
var show4=(a,b)=>{
    console.log(a);
    return a*b;
}
console.log(show3(1,2));
console.log(show4(1,2));

//箭头函数的this指向父函数
var a=3;
var obj={
   fun:()=>{
       console.log(this.a);
    }
};
obj.fun(); //3
```

<br>

**五.数组的扩展**

```
#1.扩展运算符;将一个数组转为用逗号分隔的参数序列;该运算符主要用于函数调用
console.log(...[1, 2, 3]); // 1 2 3
console.log(1, ...[2, 3, 4], 5); // 1 2 3 4 5

#2.数组方法
/*
* Array.from():用于将两类对象转为真正的数组：类似数组的对象（array-like object）和可遍历（iterable）的对象
* Array.of()方法用于将一组值，转换为数组。
* copyWithin()方法，在当前数组内部，将指定位置的成员复制到其他位置（会覆盖原有成员），然后返回当前数组
* find()方法，用于找出第一个符合条件的数组成员,直到找出第一个返回值为true的成员，然后返回该成员。如果没有符合条件的成员，则返回undefined
* findIndex()方法的用法与find方法非常类似，返回第一个符合条件的数组成员的位置，如果所有成员都不符合条件，则返回-1。
* fill()方法使用给定值，填充一个数组。
* includes()方法返回一个布尔值，表示某个数组是否包含给定的值
* */

let obj = {'0': 'a', '1': 'b', '2': 'c',length:3};
// ES5的写法
var arr1 = [].slice.call(obj); // ['a', 'b', 'c']
// ES6的写法
let arr2 = Array.from(obj); // ['a', 'b', 'c']
console.log(arr1);
console.log(arr2);
console.log(Array.of(1,2));
// 将3号位复制到0号位
[1, 2, 3, 4, 5].copyWithin(0, 3, 4);// [4, 2, 3, 4, 5]
// -2相当于3号位，-1相当于4号位
[1, 2, 3, 4, 5].copyWithin(0, -2, -1);// [4, 2, 3, 4, 5]
//找出第一个符合回调函数的元素
[1, 4, -5, 10].find((n) => n < 0);// -5
//从 1 号位开始，向原数组填充 7，到 2 号位之前结束
['a', 'b', 'c'].fill(7, 1, 2);// ['a', 7, 'c']
//次数组是否包含2
console.log([1, 2, 3].includes(2));     // true

#3.遍历数组
for (let index of ['a', 'b'].keys()) {
    console.log(index);
}
// 0  1
for (let elem of ['a', 'b'].values()) {
    console.log(elem);
}
// 'a'  'b'
for (let [index, elem] of ['a', 'b'].entries()) {
    console.log(index, elem);
}
// 0 "a" 1 "b"
```

<br>

**六.对象扩展**

```
#1.简写
//属性简写:当外面变量与对象属性同名时，可以简写
var a=3;
var obj1={a}; //{a:3}

//方法简写
var obj2={
    show(){
        console.log('show');
    }
};
obj2.show();

#2.属性名表达式;属性名表达式与简洁表示法，不能同时使用
let a = 'a';
let fun ='fun';
let obj = {
    'b': 'B',
    [a]:'A', //[a]简写会报错
    [fun](){}
};
console.log(obj);

#3.对象方法
/*
* Object.is():与严格比较运算符（===）的行为基本一致。
* Object.assign():合并对象;实行的是浅拷贝，而不是深拷贝;一旦遇到同名属性，Object.assign的处理方法是替换，而不是添加。
* Object.getOwnPropertyDescriptor()方法可以获取该属性的描述对象。
* Object.getOwnPropertyDescriptors()方法，返回指定对象所有自身属性（非继承属性）的描述对象
* Object.defineProperty()方法用于定义属性
* Object.setPrototypeOf()方法的作用与__proto__相同，用来设置一个对象的prototype对象，返回参数对象本身
* Object.getPrototypeOf()用于读取一个对象的原型对象
* */

console.log(Object.is('foo', 'foo')); //true
console.log(Object.is({}, {})); // false
console.log(Object.assign({a:'A'},{b:'B'}));//{a:'A',b:'B'} {b:'B'}
const target = { a: { b: 'c', d: 'e' } };
const source = { a: { b: 'hello' } };
Object.assign(target, source);// { a: { b: 'hello' } }
let obj = { foo: 123 ,name:'chang'};
console.log(Object.getOwnPropertyDescriptor(obj, 'foo'));//{value: 123, writable: true, enumerable: true, configurable: true}
console.log(Object.getOwnPropertyDescriptors(obj));//{foo: {…}, name: {…}}
Object.defineProperty(obj,'b',{
    value:'B',
    writable:true, //默认为fasle
    enumerable:true //默认为false
});
//setter与getter
Object.defineProperty(obj,'c',{
    set(newValue){
        console.log('设置');
        c=newValue;
    },
    get(){
        console.log('获取');
        return c;
    }
});
//原型相关设置
let proto = {};
let obj1 = { x: 10 };
Object.setPrototypeOf(obj1, proto);
console.log(Object.getPrototypeOf(obj1));

#4.遍历
let obj = { a: 1, b: 2, c: 3 };
for (let key of Object.keys(obj)) {
    console.log(key); // 'a', 'b', 'c'
}

for (let value of Object.values(obj)) {
    console.log(value); // 1, 2, 3
}

for (let [key, value] of Object.entries(obj)) {
    console.log([key, value]); // ['a', 1], ['b', 2], ['c', 3]
}
```

<br>

**七.class扩展**

```
#1.类的定义;类的所有方法都定义在类的prototype属性上面;类的内部所有定义的方法，都是不可枚举的
class PersonA {
    constructor() {
       this.name='zhangsan';
       this.eat=function () {
           console.log('this is eat');
       }
    }
    run() {
        console.log('this is run');
    }
}
function PersonB() {
    this.name='zhangsan';
    this.eat=function(){
        console.log('this is eat');
    }
}
PersonB.prototype.run=function () {
    console.log('this is run');
};
console.log(new PersonA());
console.log(new PersonB());

#2.Class 表达式
let person = new class {
    constructor(name) {
        this.name = name;
    }
    sayName() {
        console.log(this.name);
    }
}('张三');
person.sayName(); // "张三"

#3.静态方法（能继承）;如果静态方法包含this关键字，这个this指的是类，而不是实例;ES6没有静态属性
class Person{
    static fun(){
        console.log('fun');
    }
}
Person.fun();
class Student extends Person{}
Student.fun();

#4.getter与setter
class Person {
    constructor(name) {
        this._name=name;
    }
    get name() {
        console.log('getter');
        return this._name;
    }
    set name(value) {
        console.log('setter');
        this._name=value;
    }
}
let obj=new Person('a');
obj.name='aa';
console.log(obj.name);

#5.类的继承
class Person{
    constructor(){
        this.name='zhangsan';
    }
    show(){
        console.log('show');
    }
}
class Student extends Person{
    constructor(){
        super();
        this.age=12;
    }
}
console.log(new Student());
```

<br>

**八.解构赋值**

```
#数组
let a1=1;
let b1=2;
let c1=3;
let [a2,b2,c2]=[1,2,3];
#嵌套数组 a3=1;b3=2;c3=3;d3=4
let [a3,[b3,c3],d3]=[1,[2,3],4];
#空缺变量 a4=1;c4=3
let [a4,,c4]=[1,2,3];
#多余变量 a5=1;b5=2;c5=undefined
let [a5,b5,c5]=[1,2];
#默认值 a6=1;b6=2;c6=3
let [a6,b6,c6=3]=[1,2];

#对象解构
var obj={name:'zhangsan',age:12};
#同名可简写 let {name:name,age:ages} = obj
let {name,age:ages}=obj;
console.log(name);//zhangsan
console.log(ages);//12

#字符串解构
let [a7,b7,c7] = "abc";
console.log(a7);//a

#函数解构
function show({name}) {
  console.log(name);
}
show({name:'zhangsan',age:12});
```

<br>

**九.Symbol数据类型**

```
#1.定义:表示独一无二的值;Symbol函数前不能使用new命令;可以接受一个字符串参数作为描述;
let s1 = Symbol('foo');
let s2 = Symbol('foo');
console.log(s1 === s2); //false

#2.方法
/*
* Symbol.for()它接受一个字符串作为参数，然后搜索有没有以该参数作为名称的Symbol值。如果有，就返回这个Symbol值，
*       否则就新建并返回一个以该字符串为名称的Symbol值。
* Symbol.keyFor()方法返回一个Symbol.for定义的key
* */

let s1 = Symbol.for('foo');
let s2 = Symbol.for('foo');
let s3 = Symbol('foo');
console.log(s1 === s2); //true
console.log(Symbol.keyFor(s1)); //foo
console.log(Symbol.keyFor(s3)); //undefined
```

<br>

**十.Set和Map数据结构**

```
#1.Set:它类似于数组，但是成员的值都是唯一的，没有重复的值。
let s1=new Set([1, 2, 3, 4, 4]); //Set(4) {1, 2, 3, 4}
console.log(s1.size); //返回Set实例的成员总数 true
s1.add(5);  //添加某个值，返回 Set 结构本身。 Set(5) {1, 2, 3, 4, 5}
s1.delete(1); //删除某个值，返回一个布尔值，表示删除是否成功。 Set(4) {2, 3, 4, 5}
console.log(s1.has(4)); //返回一个布尔值，表示该值是否为Set的成员。 true
s1.clear(); //清除所有成员，没有返回值。 Set(0){}

#2.Set遍历
let set = new Set(['red', 'green', 'blue']);
for (let item of set.keys()) {
    console.log(item);
}
// red green blue
for (let item of set.values()) {
    console.log(item);
}
// red green blue
for (let item of set.entries()) {
    console.log(item);
}
// ["red", "red"] ["green", "green"]  ["blue", "blue"]
set.forEach((value, key) => console.log(key + ' : ' + value));
// red : red green : green blue : blue

#3.Map 本质上是键值对的集合（Hash 结构）；“键”的范围不限于字符串，各种类型的值（包括对象）都可以当作键
const map = new Map([['name', '张三'], ['title', 'Author']]);
console.log(map.size); // 2
console.log(map.has('name')); // true
console.log(map.get('name')); // "张三"
console.log(map.has('title')); // true
console.log(map.get('title')); // "Author"
map.set('age',12); //Map(3) {"name" => "张三", "title" => "Author", "age" => 12}
map.delete('age'); //Map(2) {"name" => "张三", "title" => "Author"}
map.clear(); //Map(0) {}

#4.Map遍历
const map = new Map([['F', 'no'], ['T',  'yes'],]);

for (let key of map.keys()) {
    console.log(key);
}
// "F" "T"
for (let value of map.values()) {
    console.log(value);
}
// "no" "yes"
for (let [key, value] of map.entries()) {
    console.log(key, value);
}
//等同于使用map.entries()
for (let [key, value] of map) {
    console.log(key, value);
}
// "F" "no" "T" "yes"
map.forEach(function(value, key) {
    console.log(key, value);
});
// "F" "no" "T" "yes"

#5.转为数组
let set = new Set([1,2,3,3]);
console.log([...set]);
let map = new Map([['a','A'],['b','B']]);
console.log([...map]);
```

<br>

**十一.Proxy**

```
var target = {
    name: 'target'
};
var handler = {
    get: function(target, key) {
        console.log(`${key} 被读取`);
        return target[key];
    },
    set: function(target, key, value) {
        console.log(`${key} 被设置为 ${value}`);
        target[key] = value;
    }
}
var proxy = new Proxy(target, handler);
console.log(proxy.name); // 控制台输出：name 被读取
proxy.name = 'proxy'; // 控制台输出：name 被设置为 proxy
console.log(target.name); // 控制台输出: proxy
```

<br>

**十二.Reflect**

```
/*
* Reflect.get()方法查找并返回target对象的name属性，如果没有该属性，则返回undefined
* Reflect.set()方法设置target对象的name属性等于value。
* Reflect.has()方法对应name in obj里面的in运算符。
* Reflect.deleteProperty()方法等同于delete obj[name]，用于删除对象的属性。
* Reflect.construct()方法等同于new target(...args)，这提供了一种不使用new，来调用构造函数的方法。
* Reflect.getPrototypeOf()方法用于读取对象的__proto__属性，对应Object.getPrototypeOf(obj)。
* Reflect.setPrototypeOf()方法用于设置对象的__proto__属性，返回第一个参数对象，对应Object.setPrototypeOf(obj, newProto)。
* Reflect.defineProperty()方法基本等同于Object.defineProperty，用来为对象定义属性。未来，后者会被逐渐废除，请从现在开始就使用Reflect.defineProperty代替它。
* Reflect.getOwnPropertyDescriptor()基本等同于Object.getOwnPropertyDescriptor，用于得到指定属性的描述对象，将来会替代掉后者。
* Reflect.ownKeys()方法用于返回对象的所有属性;基本等同于Object.getOwnPropertyNames与Object.getOwnPropertySymbols之和。
* */

var obj={
    name:'zhangsan',
    get age(){
        return this._age;
    },
    set age(value){
        this._age=value;
    },
    eat:function () {
        console.log(this.name+' is eat');
    }
};
console.log(Reflect.get(obj,'name')); // zhangsan
console.log(Reflect.get(obj,'age',{_age:12})); // lisi 当为getter属性时，可以用receiver对象指定this
Reflect.set(obj,'age', 12);  // obj {name: "zhangsan", eat: ƒ, _age: 12}
Reflect.set(obj,'age',12,{}); // obj {name: "lisi", eat: ƒ} 当为setter属性时，可以用receiver对象指定this
console.log(Reflect.has(obj,'name')); //true
Reflect.deleteProperty(obj,'name'); //obj {eat: ƒ}
console.log(Reflect.getPrototypeOf(obj)); // Object
Reflect.defineProperty(obj,'grade',{value:90}); //obj {eat: ƒ, grade: 90}
console.log(Reflect.getOwnPropertyDescriptor(obj,'grade')); //{value: 90, writable: false, enumerable: false, configurable: false}
console.log(Reflect.ownKeys(obj));//["age", "eat", "grade"]
```

<br>

**十三.Promise**

```
#1.基本格式；当status为true时，执行resolve；当status为false时，执行reject
function fun (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("执行成功");
        } else {
            reject("执行失败");
        }
    });
}
fun(true).then(function (message) {
    console.log(message);
}, function (error) {
    console.log(error);
}).finally(function () {
    console.log('不管是否成功与失败都执行');
});

#2.链式调用;Promise参数逐级返回
function fun (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("执行成功");
        } else {
            reject("执行失败");
        }
    });
}
fun(true).then(function (message) {
    console.log(message);
    return message;
}, function (error) {
    console.log(error);
    return error;
}).then(function(message){
    console.log(message);
},function (error) {
    console.log(error);
});

#3.catch使用
function fun (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("执行成功");
        } else {
            reject("执行失败");
        }
    });
}
fun(false).then(function (message) {
    console.log(message);
}).catch(function (error) {
    console.log(error);
});

#4.当所有Promise对象全为resolve时可以回调
function fun1 (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("fun1执行成功");
        } else {
            reject("fun1执行失败");
        }
    });
}
function fun2 (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("fun2执行成功");
        } else {
            reject("fun2执行失败");
        }
    });
}

Promise.all([fun1(true),fun2(true)]).then(function (message) {
    console.log(message);//["fun1执行成功", "fun2执行成功"]
    console.log("全部成功");
}).catch(function (error) {
    console.log(error); //fun1执行失败
});

#5.当所有Promise对象有一个状态改变时可以回调
function fun1 (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("fun1执行成功");
        } else {
            reject("fun1执行失败");
        }
    });
}
function fun2 (status) {
    return new Promise(function (resolve, reject) {
        if (status) {
            resolve("fun2执行成功");
        } else {
            reject("fun2执行失败");
        }
    });
}

Promise.race([fun1(false),fun2(true)]).then(function (message) {
    console.log(message);//["fun1执行成功"]
    console.log("全部成功");
}).catch(function (error) {
    console.log(error); //fun1执行失败
});
```

<br>

**十六.模块化**

```
#导入的变量名必须和导出的名称一致
export const PI=3.14;
export function add (x, y) {
    return x + y;
}
export let obj={
    a:'A',
    b:'B'
};

import {PI,add,obj} greeter from './greeter';
console.log(PI);
console.log(add(2,4));
console.log(obj.a);

import * as greeter from './greeter';
console.log(greeter.PI);
console.log(greeter.add(2,4));
console.log(greeter.obj.a);

#一个模块只能有一个默认导出
export default function(a,b) {
    return a+b;
};

import myFun from './greeter';
console.log(myFun(1,2));
```

<br>

**十五.ES6转ES5**

```
npm install --save-dev babel-cli babel-preset-env

#转码结果输出到标准输出
babel example.js

#转码结果写入一个文件
babel example.js -o compiled.js

# 整个目录转码
babel src -d lib

# -s 参数生成source map文件
babel src -d lib -s
```

```
.babelrc

{
   "presets": ["env"],
   "plugins": []
}
```