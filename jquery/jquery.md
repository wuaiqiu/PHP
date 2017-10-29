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
$("parent > child")|在给定的父元素下匹配所有的子元素（一层）
$("ancestor descendant")|在给定的祖先元素下匹配所有的后代元素
$("prev + next")|匹配所有紧接在 prev 元素后的 next 元素(所有的后面同级)
$("prev ~ siblings")|兄弟元素选择器（所有同级）
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
$(":input")|匹配所有 input, textarea, select 和 button 元素
$(":text")|所有的单行文本框，$(":text") 等价于$("[type=text]")，推荐使用$("input:text")效率更高，下同
$(":password")|所有密码框
$(":radio")|所有单选按钮
$(":checkbox")|所有复选框
$(":submit")|所有提交按钮
$(":reset")|所有重置按钮
$(":button")|所有button按钮
$(":file")|所有文件域

<br/>

**二.事件**

1).简易事件

事件|描述
--|--
**window事件**|
$(window).error(function)|触发或将函数绑定到指定元素的error事件
$(window).load(function)|触发或将函数绑定到指定元素的load事件
$(window).unload(function)|触发或将函数绑定到指定元素的unload事件
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

2).bind绑定事件

```
//绑定单个事件
$("button").bind("click",function(){
	console.log("hello");
});

//绑定多个事件
$("button").bind({
	click:function(){console.log("hello");},
	mouseover:function(){console.log("hello");},
	mouseout:function(){console.log("hello");}
});
```

3).unbind移除事件

```
//移除所有p元素的事件处理器
$("p").unbind();

//移除p元素指定的事件（可以包括多个事件处理器）
$("p").unbind("click");

//移除p元素指定的事件处理器
$("p").unbind("click",functionName);


//删除自身的所有事件处理器
$(this).unbind();

//删除自身的指定的事件处理器
$(this).unbind(event);
```

4).one只会触发一次

```
$("p").one("click",function(){
	console.log("hello");
});
```

5).live在当前或未创建的元素绑定事件

```
$("button").live("click",function(){
	console.log("hello");
});
```

6).die在当前或未创建的元素移除事件

```
//移除所有p元素的事件处理器
$("p").die();

//移除p元素指定的事件（可以包括多个事件处理器）
$("p").die("click");

//移除p元素指定的事件处理器
$("p").die("click",functionName);
```

7).toggle以不同事件处理器相应click事件

```
$("p").toggle(
	function(){console.log("one");},
	function(){console.log("two");},
	function(){console.log("three");}
);
```

8).触发事件

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
>3).callback既可以是函数名，也可以是匿名函数

2).淡入淡出

```
$(selector).fadeIn(speed,callback); 	//用于淡入已隐藏的元素
$(selector).fadeOut(speed,callback);	//用于淡出可见元素
$(selector).fadeToggle(speed,callback);	//可以在 fadeIn() 与 fadeOut() 方法之间进行切换
$(selector).fadeTo(speed,opacity,callback);//允许渐变为给定的不透明度（值介于 0 与 1 之间）
```

3).滑动
	
```
$(selector).slideDown(speed,callback); //用于向下滑动元素
$(selector).slideUp(speed,callback);	//用于向上滑动元素
$(selector).slideToggle(speed,callback);	//可以在 slideDown() 与 slideUp() 方法之间进行切换
```

4).动画

```
$("div").animate({
	left:'250px',
	height	:'+=150px',
	width	:'+=150px'
},speed,easing|linear,callback);
```

5).效果停止

```
$(selector).stop(stopAll,goToEnd);
$$selector.stop():结束本次动画，进行队列后动画
$selector.stop(true):停止于当前动画
$selector.stop(true,true):在当前动画完成后停止动画队列
```

<br/>

**四.DOM操作**

方法|函数|描述
---|--|---
**class属性**||
$selector.addClass("intro")|function(index,oldclass)|向匹配的元素添加指定的类名；如需添加多个类，请使用空格分隔类名
$selector.removeClass("intro")|function(index,oldclass)|从所有匹配的元素中删除全部或者指定的类
$selector.toggleClass("intro")|function(index,currentClass)|从匹配的元素中添加或删除一个类
$selector.hasClass("intro")||检查匹配的元素是否拥有指定的类
**插入元素**||
$selector.before("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|在匹配元素的外部前面内容；可包含HTML标签
$selector.after("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|在匹配元素的外部后面内容；可包含HTML标签
$selector.prepend("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|向匹配元素的内部前面内容；可包含HTML标签
$selector.append("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index)|向匹配元素的内部后面内容；可包含HTML标签
$selector.wrap("&lt;p&gt;&lt;/p&gt;")|function()|把匹配的元素用指定的内容或元素包裹起来
**删除元素**||
$selector.empty()||移除所有匹配的元素，不可恢复
$selector.remove()||移除所有匹配的元素，不可恢复
$selector.detach()||移除所有匹配的元素，可恢复
$selector.unwrap()||移除并替换指定元素的父元素
**innerHTML**||
$selector.html("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index,oldcontent)|设置或返回匹配的元素集合中的HTML内容；会覆盖
$selector.text("&lt;p&gt;Hello world!&lt;/p&gt;")|function(index,oldcontent)|设置或返回匹配元素的内容；特殊字符会被编码；会覆盖
**操作属性**||
$selector.attr(key,value)|key,function(index,oldvalue)|设置或返回匹配元素的属性和值
$selector.removeAttr(key)||从所有匹配的元素中移除指定的属性
$selector.val("hello")|function(index,oldvalue)|设置或返回匹配元素的值
**元素其他操作**||
$selector.clone(true or false)||创建匹配元素集合的副本
$selector.replaceWith($newSelector)|function()|用匹配的元素替换所有匹配到的元素
$selector.get(index)|获得由选择器指定的DOM元素
$selector.index()|返回指定元素相对于其他指定元素的index位置
$selector.size()|返回被jQuery选择器匹配的元素的数量
$selector.toArray()|以数组的形式返回jQuery选择器匹配的元素
**CSS操作**||
$selector.css(key,value)|name,function(index,oldValue)|设置或返回匹配元素的样式属性
$selector.height(value)|function(index,oldHeight)|设置或返回匹配元素的高度
$selector.width(value)|function(index,oldWidth)|设置或返回匹配元素的宽度
$selector.offsetParent()||返回最近的定位祖先元素

<br/>

**五.Ajax**

```
$.ajax({
    url:'/comm/test1.php',
    type:'POST', 
    async:true, 
    timeout:5000,    	//超时时间(毫秒)
    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
    data:{
       name:'yang',age:25
    },
    success:function(result,textStatus,XMLHttpRequest)){
       //请求成功时处理
    },
    error:function(XMLHttpRequest, textStatus, errorThrown){
       //请求出错处理
       //textStatus的值：null, timeout, error, abort, parsererror
       //errorThrown的值：收到http出错文本，如 Not Found 或 Internal Server Error
    },
    complete:function(XMLHttpRequest, textStatus){
       //请求完成的处理；不管成功还是失败
       //textStatus的值：success,notmodified,nocontent,error,timeout,abort,parsererror
    }
})
```

<br/>

**六.遍历**

函数|描述
--|--
**子元素**|
$selector.children(selector)|返回被选元素的所有直接子元素；不返回文本节点
$selector.contents()|返回被选元素的所有直接子元素；包括文本节点
$selector.find(selector)|返回被选元素的所有后代元素；不返回文本节点
**父元素**|
$selector.parent(selector)|返回被选元素的直接父元素
$selector.parents(selector)|返回被选元素的所有祖先元素，它一路向上直到文档的根元素 (&lt;html&gt;)
$selector.parentsUntil($selector1,selector)|返回介于两个给定元素之间的所有元素(不包括selector1)
**兄弟元素**|
$selector.siblings(selector)|返回被选元素的所有同胞元素
$selector.next(selector)|返回被选元素的下一个同胞元素
$selector.nextAll(selector)|返回被选元素的所有跟随的同胞元素
$selector.nextUntil($selector1,selector)|返回介于两个给定参数之间的同胞元素
prev(), prevAll() 以及 prevUntil()|方法的工作方式与上面的方法类似
**索引元素**|
$selector.first()|返回被选元素的首个元素
$selector.last()|返回被选元素的最后一个元素
$selector.eq(n)|返回被选元素中带有指定索引号的元素。索引号从 0 开始
$selector.filter(selector)|返回被匹配的元素
$selector.not(selector)|方法返回不匹配标准的所有元素
**遍历**|
$selector.each(function(index,element))|对 jQuery 对象进行迭代，为每个匹配元素执行函数。
$selector.end()|结束当前链中最近的一次筛选操作，并将匹配元素集合返回到前一次的状态。

<br/>

**七.数据**

函数|描述
---|---
$selector.data(key,value)|存储与匹配元素相关的任意数据
$selector.removeData(key)|删除之前通过data()方法设置的数据
jQuery.hasData($selector)|检测元素是否拥有与之相关的任何 jQuery 数据

```
//添加列队
$("div").animate({left:'+=200'},2000);
$("div").queue(function () {
	$(this).addClass("newcolor");
   	$(this).dequeue();
});
$("div").animate({left:'-=200'},500);
$("div").slideUp();

//清空列队
$("div").queue("fx", []);

//从列队中删除仍未运行的所有项目。
$("div").clearQueue();
```