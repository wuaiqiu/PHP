# ES6

**一.let与const**

```
//let块级作用域，var为函数作用域
  for(var a=0;a<10;a++){}
  console.log(a); //10
  for(let b=0;b<10;b++){}
  console.log(b); //undefined

//const定义常量
   const c=3.14;
   c=6.28; //error
```

<br>

**二.模板字符串**

```
let a='love';
let text1="I "+a+" you";
let text2=`I ${a} you`;
console.log(text1);
console.log(text2);
```

<br>

**三.函数扩展**

```
#默认参数

function  show1(a,b) {
      b=b||8;
      return a*b;
}
function show2(a,b=8) {
      return a*b;
}
console.log(show1(1));
console.log(show2(1));


#箭头函数

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

**四.对象扩展**

```
//属性简写:当外面变量与对象属性同名时，可以简写
var a=3;
var obj1={
   a
};
console.log(obj1.a);

//方法简写
var obj2={
   show(){
       console.log('show');
    }
};
obj2.show();

//对象方法
var obj3={
    a:'a',
    show(){
       console.log('show')
     }
};
//返回对象所有key
console.log(Object.keys(obj3)); //["a", "show"]
//合并对象
Object.assign(obj1,obj2);//obj1:[a,show],obj2[show]

//属性定义
var obj4={};
Object.defineProperty(obj4,'b',{
     value:'B',
     writable:true, //默认为fasle
     enumerable:true //默认为false
});
console.log(obj4.b);

//setter与getter
var obj5={};
Object.defineProperty(obj5,'c',{
    set(newValue){
        console.log('设置');
        c=newValue;
     },
     get(){
       console.log('获取');
        return c;
      }
});
obj5.c=4;
console.log(obj5.c);
```

<br>

**五.class扩展**

```
//ES5写法
function  PersonA() {
     this.name='zhangsan';
     this.show=function () {
         console.log('showA');
      }
}
function StudentA() {
     PersonA.call(this);
     this.age=12;
}
var studentA=new StudentA();
console.log(studentA);

//ES6写法
class PersonB{
    constructor(){
       this.name='zhangsan';
    }
    show(){
        console.log('show');
    }
}
class StudentB extends PersonB{
     constructor(){
         super();
         this.age=12;
     }
}
var studentB=new StudentB();
console.log(studentB);

//静态方法（不能被继承）
class Person{
    static fun(){
         console.log('fun');
     }
}
Person.fun();
```

<br>

**六.解构赋值**

```
//数组
let a1=1;
let b1=2;
let c1=3;
let [a2,b2,c2]=[1,2,3];
//嵌套数组 a3=1;b3=2;c3=3;d3=4
let [a3,[b3,c3],d3]=[1,[2,3],4];
//空缺变量 a4=1;c4=3
let [a4,,c4]=[1,2,3];
//多余变量 a5=1;b5=2;c5=undefined
let [a5,b5,c5]=[1,2];
//默认值 a6=1;b6=2;c6=3
let [a6,b6,c6=3]=[1,2];

//对象解构
var obj={name:'zhangsan',age:12};
//同名可简写 let {name:name,age:ages} = obj
let {name,age:ages}=obj;
console.log(name);//zhangsan
console.log(ages);//12

//字符串解构
let [a7,b7,c7] = "abc";
console.log(a7);//a

//函数解构
function show({name}) {
     console.log(name);
}
show({name:'zhangsan',age:12});
```

<br>

**七.模块**

```
import {a,add} from './common';
console.log(a);
console.log(add(1,2));

common
/*
* 导出模块
*  1.可以是变量与函数与类
*  2.不能导出值
*  3.导入模块需要同名除默认模块export default fun(){}
* */
export var a=12;
export function add(x,y) {
    return x+y;
}
```

<br>

**八.es6转es5**

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