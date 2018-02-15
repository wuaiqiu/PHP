# Util

**一.常用工具类**

```
$api.trim('   abc  123   ');  // => "abc  123"
$api.trimAll('  abc 123  ');  // => "abc123"
$api.isArray([1,2,3]);  // => true

$api.setStorage('name','Tom');
$api.getStorage('name'); // => "Tom"
$api.rmStorage('name');
$api.clearStorage ();

var json = {a:111, b:222};
$api.jsonToStr(json); // => "{"a":111,"b":222}"
var a = '{"a":"111", "b":"222"}';
$api.strToJson(a); // => Object {a: "111", b: "222"}
```

<br>

**二.选择器**

```
$api.dom('#id');  //选择首个匹配的DOM元素
$api.domAll('.class'); //选择所有匹配的DOM元素
$api.first(el,'li'); //选择DOM元素的第一个li子元素
$api.first(el); //选择DOM元素的第一个子元素
$api.last(el,'li'); //选择DOM元素的最后一个li子元素
$api.last(el); //选择DOM元素的最后一个子元素
$api.eq(el, 2); //选择第几个子元素
$api.prev(el); //选择相邻的前一个元素
$api.next(el); //选择相邻的下一个元素
$api.closest(el, '.parent'); //根据选择器匹配最近的父元素

$api.prepend(el,'<li>hello</li>'); //在DOM元素内部，首个子元素前插入HTML字符串
$api.append(el,'<li>hello</li>'); //在DOM元素内部，最后一个子元素后面插入HTML字符串
$api.before(el,'<h1>world</h1>'); //在DOM元素前面插入HTML字符串
$api.after(el,'<h1>world</h1>'); //在DOM元素后面插入HTML字符串

$api.remove(el); //移除DOM元素

$api.attr(el,'data'); //设置DOM元素的属性
$api.attr(el,'data','123'); //获取DOM元素的属性
$api.removeAttr(el, 'data'); //移除DOM元素的属性
$api.hasCls(el, 'classname'); // => true
$api.addCls(el, 'newclass'); //为DOM元素增加className
$api.removeCls(el, 'newclass'); //移除指定的className
$api.toggleCls(el, 'display'); //切换指定的className
$api.css(el,'width:800px;border:1px solid red'); //设置css属性
$api.cssVal(el,'width'); // => 800px //获取css属性

$api.val(el,'123');
$api.val(el);
$api.html(el,'<h1>world</h1>');
$api.html(el);

$api.addEvt(element, 'click', function(){

});
$api.rmEvt(element, 'click', function(){

});
$api.one(element, 'click', function(){

});
``` 

<br>

**三.BOM属性**

```
var offset = $api.offset(el);
var left = offset.l;
var top = offset.t;
var width = offset.w;
var height = offset.h;
```