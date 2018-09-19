# JQuery

**一.选择器**

选择器|描述
--|--
**基本选择器**|
$("#id")|ID选择器
$("div")|元素选择器
$(".classname")|类选择器
$("*")|选择所有
$(".classname,.classname,#id")|组合选择器
**层次选择器**|
$("parent > child")|选择父元素为parent元素的所有child元素
$("ancestor descendant")|选择ancestor元素内部的所有descendant元素
$("prev + next")|选择紧接在prev元素之后的所有next元素
$("prev ~ siblings")|选择前面有prev元素的每个siblings元素
**过滤选择器**|
$("li:first")|第一个li
$("li:last")|最后一个li
$("li:even")|挑选下标为偶数的li
$("li:odd")|挑选下标为奇数的li
$("li:eq(4)")|下标等于4的li
$("li:gt(2)")|下标大于2的li
$("li:lt(2)")|下标小于2的li
$("li:not(#runoob)")|挑选除 id="runoob" 以外的所有li
$("li:hidden")|匹配所有不可见元素，或type为hidden的元素
$("li:visible")|匹配所有可见元素
**属性选择器**|
$("div[id]")|所有含有 id 属性的 div 元素
$("div[id='123']")|id属性值为123的div 元素
$("div[id!='123']")|id属性值不等于123的div 元素
$("div[id^='qq']")|id属性值以qq开头的div 元素
$("div[id$='zz']")|id属性值以zz结尾的div 元素
$("div[id*='bb']")|id属性值包含bb的div 元素
$("input[id][name$='man']")|多属性选过滤，同时满足两个属性的条件的元素
**表单选择器**|
$(":text")|所有的单行文本框，$(":text") 等价于$("[type=text]")，推荐使用$("input:text")效率更高，下同
$(":password")|所有密码框
$(":radio")|所有单选按钮
$(":checkbox")|所有复选框
$(":submit")|所有提交按钮
$(":reset")|所有重置按钮
$(":button")|所有button按钮
$(":file")|所有文件域
**混淆选择器**|
$.escapeSelector( "#target" )|转义类选择器或者ID选择器中的一些CSS特殊字符

<br/>

**二.事件**

1).简易事件

事件|描述
--|--
**window事件**|
$(document).ready(function)|在文档加载后激活函数
$().ready(function)|在文档加载后激活函数
$(function)|在文档加载后激活函数
**Form事件**|
$(selector).focus(function)|触发或将函数绑定到被选元素的获得焦点事件
$(selector).blur(function)|触发或将函数绑定到被选元素的失去焦点事件
$(selector).change(function)|触发或将函数绑定到指定元素的change事件
$(selector).select(function)|触发或将函数绑定到指定元素的select事件
$(form).submit(function)|触发或将函数绑定到指定元素的submit事件
**Mouse事件**|
$(selector).click(function)|触发或将函数绑定到被选元素的点击事件
$(selector).dblclick(function)|触发或将函数绑定到被选元素的双击事件
**Keyboard事件**|
$(selector).keydown(function)|触发或将函数绑定到指定元素的keydown事件

2).one只会触发一次

```
$("p").one("click",function(){
	console.log("hello");
});
```

3).on在当前或未创建的元素绑定事件

```
$(document).on("focus","a",function(){
  this.blur();
});

$("p.test1").on("click",function(){
    $(this).css("background-color","pink");
});
```

4).off在当前或未创建的元素移除事件

```
//移除所有p元素的事件处理器
$("p").off();

//移除p元素指定的事件（可以包括多个事件处理器）
$("p").off("click");

//移除p元素指定的事件处理器
$("p").off("click",functionName);
```

5).toggle以不同事件处理器相应click事件

```
$("p").toggle(
	function(){console.log("one");},
	function(){console.log("two");},
	function(){console.log("three");}
);
```

6).触发事件

```
//触发input元素的select事件
$("input").trigger("select");
```
<br/>

**三.效果**

1).隐藏和显示

```
$(selector).hide(speed,callback);	//隐藏HTML元素
$(selector).show(speed,callback);	//显示HTML元素
$(selector).toggle(speed,callback);	//切换hide()和show()方法
```

>1).$(selector)选中的元素的个数为n个，则callback函数会执行n次

>2).callback函数名后加括号，会立刻执行函数体，而不是等到显示/隐藏完成后才执行

>3).callback既可以是函数名，也可以是匿名函数（等于不加括号的函数）

2).淡入淡出

```
$(selector).fadeOut(speed,callback);	//隐藏HTML元素
$(selector).fadeIn(speed,callback); 	//显示HTML元素
$(selector).fadeToggle(speed,callback);	//可以在 fadeIn() 与 fadeOut() 方法之间进行切换
$(selector).fadeTo(speed,opacity,callback);//允许渐变为给定的不透明度（值介于 0 与 1 之间）
```

3).滑动
	
```
$(selector).slideUp(speed,callback);	//隐藏HTML元素
$(selector).slideDown(speed,callback); //显示HTML元素
$(selector).slideToggle(speed,callback);	//可以在 slideDown() 与 slideUp() 方法之间进行切换
```

4).动画(不支持颜色变化，需要jquery-color.js)

```
$("div").animate({
	left:'250px',
	height	:'+=150px',
	width	:'+=150px'
},speed,easing|linear,callback);
```

5).效果停止

```
$(selector).stop():停止本次动画，进行队列后动画
$(selector).stop(true):停止所有动画
$(selector).stop(true,true):在当前动画完成后停止所有动画
```

<br/>

**四.DOM操作**

方法|函数|描述
---|--|---
**插入元素**||
$selector.before("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|在匹配元素的外部前面内容；可包含HTML标签
$selector.after("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|在匹配元素的外部后面内容；可包含HTML标签
$selector.prepend("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|向匹配元素的内部前面内容；可包含HTML标签
$selector.append("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|向匹配元素的内部后面内容；可包含HTML标签
$selector.wrap("&lt;p&gt;&lt;/p&gt;")|function()|把匹配的元素用指定的内容或元素包裹起来
**删除元素**||
$selector.empty()||删除被选元素的子元素
$selector.remove()||删除被选元素及其子元素，并返回被删除的元素，不可恢复事件
$selector.detach()||删除被选元素及其子元素,并返回被删除的元素，可恢复事件
**操作属性**||
$selector.attr(key,value)|key,function(index,oldvalue)|设置或返回匹配元素的属性和值，接受\{\}对象修改多个属性
$selector.removeAttr(key)||从所有匹配的元素中移除指定的属性
$selector.prop(key,value)||函数来设置或获取checked、selected、disabled等属性
$selector.removeProp(name)||从所有匹配的元素中移除指定的属性
**innerHTML**||
$selector.html("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index,oldcontent)|设置或返回匹配的元素集合中的HTML内容；会覆盖
$selector.text("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index,oldcontent)|设置或返回匹配元素的内容；特殊字符会被编码；会覆盖
$selector.val("hello")|function(index,oldvalue)|设置或返回匹配元素的值
**CSS操作**||
$selector.css(key,value)|name,function(index,oldValue)|设置或返回匹配元素的样式属性，接受\{\}对象修改多个属性
$selector.height(value)|function(index,oldHeight)|设置或返回匹配元素的高度,innerHeight(包括内边距),outerHeight(包括内边距和边框）
$selector.width(value)|function(index,oldWidth)|设置或返回匹配元素的宽度,innerWidth(包括内边距),outerWidth(包括内边距和边框)
**class属性**||
$selector.addClass("intro")|function(index,oldclass)|向匹配的元素添加指定的类名；如需添加多个类，请使用空格分隔类名
$selector.removeClass("intro")|function(index,oldclass)|从所有匹配的元素中删除全部或者指定的类
$selector.toggleClass("intro")|function(index,currentClass)|从匹配的元素中添加或删除一个类
$selector.hasClass("intro")||检查匹配的元素是否拥有指定的类
**元素其他操作**||
$selector.clone(true or false)||创建匹配元素集合的副本
$selector.replaceWith($newSelector)|function()|用匹配的元素替换所有匹配到的元素
$selector.get(index)||获得由选择器指定的DOM元素(不是jquery对象，则不能用jquery方法)
$selector.index()||返回指定元素相对于其他指定元素的index位置
$selector.size()||返回被jQuery选择器匹配的元素的数量
**创建元素**||
$("<div\>")||动态创建div元素
$("<div\>",\{"class": "test", text: "Click me!",click: function()\{\}\})||动态创建

<br/>

**五.遍历**

函数|描述
--|--
**父元素**|
$selector.parent(selector)|返回被选元素的直接父元素
$selector.parents(selector)|返回被选元素的所有祖先元素，它一路向上直到文档的根元素 (&lt;html&gt;)
$selector.parentsUntil(selector)|返回介于两个给定元素之间的所有元素(不包括selector)
**子元素**|
$selector.children(selector)|返回被选元素的直接子元素；
$selector.find(selector [\*] )|返回被选元素的后代元素，一路向下直到最后一个后代；
**兄弟元素**|
$selector.siblings(selector)|返回被选元素的所有同胞元素
$selector.next(selector)|返回被选元素的下一个同胞元素
$selector.nextAll(selector)|返回被选元素的所有跟随的同胞元素
$selector.nextUntil(selector)|返回介于两个给定参数之间的同胞元素
prev(), prevAll() 以及 prevUntil()|方法的工作方式与上面的方法类似
**索引元素**|
$selector.first()|返回被选元素的首个元素
$selector.last()|返回被选元素的最后一个元素
$selector.eq(n)|返回被选元素中带有指定索引号的元素。索引号从 0 开始
$selector.filter(selector)|返回被匹配的元素
$selector.not(selector)|方法返回不匹配标准的所有元素
**遍历函数**|
$selector.each(function(index))|为每个匹配元素规定运行的函数.返回 false 可用于及早停止循环
$.each(arr,function(index))|遍历一个数组

<br/>

**六.Ajax**

load方法（从服务器加载POST数据，并把返回的数据放入被选元素中）

```
$('span').load('index12.php', {name: 'zhangsan'}, function (res, status, xhr) {
        if (status == "success") {
             console.log(res);
         }
         if (status == "error") {
             console.log(xhr.status + "  " + xhr.statusText);
          }
})
```

请求

```
Get

$.get('index22.php', {name: 'zhangsan'}, function (res, status, xhr) {
        if (status == "success") {
            console.log(res);
    	}
})

POST

$.post('index12.php', {name: 'zhangsan'}, function (res, status, xhr) {
        if (status == "success") {
             console.log(res);
        }
})

AJax

 $.ajax({
         url: 'index132.php',
         type: 'POST',
         dataType: 'text',    //返回的数据格式：json/xml/html/script/jsonp/text
          data: {
              name: 'zhangsan'
          },
          success: function (res) {
              console.log(res);
          },
          error: function (xhr) {
              console.log(xhr.status + " " + xhr.statusText);
          }
})

JSONP(用于跨域获取数据)

$.ajax({
       url: 'http://www.runoob.com/try/ajax/jsonp.php',
       type: 'POST',
       dataType: 'jsonp',
       data: {
         jsoncallback:'callbackFunction'
      }
})
function callbackFunction(data) {
     console.log(data);
}

序列化表单
$('form').serialize() //single=Single&multiple=Multiple
$('form').serializeArray()  //[{name:"single",value:"Single"},{name:"multiple",value:"Mutiple"}]
```

<br/>

**七.其他**

```
#释放对 $ 标识符的控制,并返回jquery对象
var jq=$.noConflict();

#添加列队
$("div").animate({left:'+=200'},2000);
$("div").queue(function () {
	$(this).addClass("newcolor");
   	$(this).dequeue();
});
$("div").animate({left:'-=200'},500);
$("div").slideUp();

#清空列队
$("div").queue("fx", []);

#从列队中删除仍未运行的所有项目。
$("div").clearQueue();
```

<br>

**八.数据缓存**

```
//在元素上存放或读取数据,返回jQuery对象
<div data-test="this is test" ></div>
$("div").data("test"); //this is test!;

//在一个div上存取名/值对数据
<div></div>
$("div").data("test", { first: 16, last: "pizza!" });
$("div").data("test").first  //16;
$("div").data("test").last  //pizza!;

//在一个div上存取数据
$("div").data("blah");  // undefined
$("div").data("blah", "hello");  // blah设置为hello
$("div").data("blah");  // hello
$("div").removeData("blah");  //移除blah
$("div").data("blah");  // undefined
```

<br>

**九.延迟对象**

```
//当延迟成功时调用一个函数或者数组函数。
$.get("test.php").done(function() { 
  alert("succeeded"); 
});

//当延迟失败时调用一个函数或者数组函数。
$.get("test.php").fail(function(){ 
    alert("failed"); 
});

//当延迟对象是成功或失败时被调用添加处理程序。
$.get("test.php").always( function() { 
  alert("completed "); 
});

//when执行,多个请求
$.when($.ajax("test.php"),$.ajax("test1.php")).done(function() {}).fail(function(){})
$.when($.ajax( "test.php" ),$.ajax("test1.php")).then(successFunc, failureFunc );

//回调函数
var dtd = $.Deferred(); // 新建一个deferred对象
var wait = function(dtd){
　　var tasks = function(){
　　　　alert("执行完毕！");
　　　　dtd.resolve(); // 将deferred对象的运行状态为"已完成"，立即触发done()方法
                       //dtd.reject():将deferred对象的运行状态变为"已失败"，立即触发fail()方法
　　};
　　　  setTimeout(tasks,5000);
　　　　return dtd;
};
$.when(wait(dtd)).done(function(){ 
        alert("哈哈，成功了！"); 
    }).fail(function(){ 
        alert("出错啦！"); 
    });


//改进版
var dtd = $.Deferred(); // 新建一个Deferred对象
　　var wait = function(dtd){
　　　　var tasks = function(){
　　　　　　alert("执行完毕！");
　　　　　　dtd.resolve(); // 改变Deferred对象的执行状态
　　　　};

　　　　setTimeout(tasks,5000);
　　　　return dtd.promise(); //在原来的deferred对象上返回另一个deferred对象，避免全局dtd状态被改变
　　};
　　var d = wait(dtd); // 新建一个d对象，改为对这个对象进行操作
　　$.when(d).done(function(){ 
        alert("哈哈，成功了！"); 
    }).fail(function(){ 
        alert("出错啦！"); 
    });
　　d.resolve(); // 此时，这个语句是无效的

//改进版：$.Deferred()可以接受一个函数名（注意，是函数名）作为参数，$.Deferred()所生成的deferred对象将作为这个函数的默认参数。
var wait = function(dtd){
　　　　var tasks = function(){
　　　　　　alert("执行完毕！");
　　　　　　dtd.resolve(); // 改变Deferred对象的执行状态
　　　　};
　　　　setTimeout(tasks,5000);
　　　　return dtd.promise();
　　};

　　$.Deferred(wait).done(function(){ 
        alert("哈哈，成功了！"); 
    }).fail(function(){ 
        alert("出错啦！"); 
    });
```

<br>

**十.回调对象**

```
function fn1(v1,v2) {
    console.log("f1:"+v1);
    console.log("f1:"+v2);
}
function fn2(v1) {
    console.log("f2:"+v1);
}

//once:只执行一次
var call = $.Callbacks('once');
call.add(fn1);
call.add(fn2);
call.fire("a","b");
call.fire("c","d");//fire无效

//memory:记忆功能
var call = $.Callbacks('memory');
call.add(fn1);
call.fire("a","b");
call.add(fn2);
call.fire();
//相当于
call.add(fn1);
call.add(fn2);
call.fire("a","b");
call.fire();

//unique:去除重复的添加
var call = $.Callbacks('unique');
call.add(fn1);
call.add(fn1);
call.fire("a","b");

//stopOnFalse:当函数return false时候不执行
var call = $.Callbacks('stopOnFalse');
call.add(fn1);
call.add(function() {
     return false;
});
call.add(fn2);//不会执行
call.fire("a","b");

//remove:移除指定的函数
call.remove(fn2);

//empty:清空函数列表
call.empty() 

//lock:之后对call操作无效
call.lock();
```

<br>

**十一.数组操作**

```
//过滤元素大于0
var arr=$.grep( [0,1,2], function(n,i){
     return n > 0;
});

//过滤元素小于等于0
var arr=$.grep( [0,1,2], function(n,i){
    return n > 0;
},true);

//返回一个新数组（each不会）
var arr=$.map( [0,1,2], function(n,i){
     return n+1;
});

//查看对应元素的位置
var index=$.inArray( 1,[1,0,2]);

//合并数组
var arr=$.merge( [0,1,2], [2,3,4] )
```