# HTML

**一.全局属性**

属性|描述
---|---
class|规定元素的一个或多个类名（引用样式表中的类）
id|规定元素的唯一 id
data-*|用于存储页面或应用程序的私有定制数据
hidden|规定元素仍未或不再相关
style|规定元素的行内 CSS 样式

<br/>

**二.全局事件**

1).window事件(body标签)

属性|描述
--|--
onerror|在错误发生时运行的脚本
onload|页面结束加载之后触发
onunload|一旦页面已下载时触发（或者浏览器窗口已被关闭）

2).Form事件

属性|描述
--|--
onblur|元素失去焦点时运行的脚本
onfocus|当元素获得焦点时运行的脚本
onchange|在元素值被改变时运行的脚本；select，textarea，input
onselect|在元素中文本被选中后触发；file，password，text，textarea
onsubmit|在提交表单时触发；form

3).Mouse事件

属性|描述
--|--
onclick|元素上发生鼠标点击时触发
ondblclick|元素上发生鼠标双击时触发

4).Keyboard事件

属性|描述
--|--
onkeydown|在用户按下按键时触发

```
var x;
if(window.event){//IE8 以及更早版本
    x=event.keyCode;
}else if(event.which){ // IE9/Firefox/Chrome/Opera/Safari
    x=event.which;
}
var keychar=String.fromCharCode(x);
alert("按键 " + keychar + " 被按下");
```

<br/>

**三.布局**

1).frameset属性

属性|值|描述
--|--|--
cols|pixels，%，*（其余所有的空间）|定义框架集中列的数目和尺寸
rows|pixels，%，*（其余所有的空间）|定义框架集中行的数目和尺寸

2).frame属性

属性|值|描述
--|--|--
frameborder|0，1|规定是否显示框架周围的边框
src|URL|规定在框架中显示的文档的 URL
marginheight|pixels|定义框架的内容与上方和下方的边距
marginwidth|pixels|定义框架的内容与左侧和右侧的边距
noresize|noresize|规定无法调整框架的大小
scrolling|yes，no，auto|规定是否在框架中显示滚动条

```
<html>
<frameset cols="25%,50%,25%">
	<noframes>
  		Your browser does not handle frames!
 	</noframes>
  	<frame src="frame_a.htm" />
  	<frame src="frame_b.htm" />
  	<frame src="frame_c.htm" />
</frameset>
</html>
```

>frameset不能与body标签一起使用

3).iframe属性

属性|值|描述
--|--|--
frameborder|1，0|规定是否显示框架周围的边框
height|pixels，%|规定iframe的高度
width|pixels，%|定义iframe的宽度
marginheight|pixels|定义iframe的内容与顶部和底部的边距
marginwidth|pixels|定义iframe的内容与左侧和右侧的边距
sandbox|""（应用所有的限制），allow-forms，allow-scripts|启用一系列对 iframe中内容的额外限制
scrolling|yes，no，auto|规定是否在iframe中显示滚动条
src|URL|规定在iframe中显示的文档的URL

```
<iframe src ="/index.html" frameborder="0">
	<p>Your browser does not support iframes.</p>
</iframe>
```

4).排版

```
<header>
	<section>
		<h1>PRC</h1>
		<p>The People's Republic of China was born in 1949...</p>
	</section>
</header>
<main>
	<section>
		<h1>Web Browsers</h1>
		<p>Google Chrome、Firefox 以及 Internet Explorer 是目前最流行的浏览器。</p>
	</section>
</main>
<footer>
	<section>
 		<p>Posted by: W3School</p>
	 	<p>Contact information: someone@example.com</p>
	</section>
</footer>
```

5).文章

```
<article>
	<h1>html5</h1>
	<figure>
		<figcaption>html5图标</figcaption>
		<img src="html5.jpg" width="350" height="234" />
	</figure>
	<p>标准通用标记语言下的一个应用HTML标准自1999年12月发布的HTML4.01</p>
	<aside>
		<h4>前端培训</h4>
		<p>全球最大的中文 Web 技术教程</p>
	</aside>
</article>
```

<br/>

**四.链接**

1).标签为页面上的所有链接规定默认地址

属性|值|描述
---|---|---
target|_blank，_parent，_self，_top|规定在何处打开链接文档

```
<head>
	<base href="http://www.w3school.com/" />
	<base target="_blank" />
</head>
<a href="index.html">W3School</a>
```

>base标签必须位于head元素内部

2).css伪类

```
a:link {color: #FF0000}		/* 未访问的链接 */
a:visited {color: #00FF00}	/* 已访问的链接 */
a:hover {color: #FF00FF}	/* 鼠标移动到链接上 */
a:active {color: #0000FF}	/* 选定的链接 */
```

3).导航条

```
<nav>
	<a href="index.asp">Home</a>
	<a href="html5_meter.asp">Previous</a>
	<a href="html5_noscript.asp">Next</a>
</nav>
```

4).链接

```
<head>
	<meta name="keywords"content="meta总结,html meta,meta属性,meta跳转"> 
	<meta name="description"content="meta是html语言head区的一个辅助性标签"> 
	<meta http-equiv="expires"content="Fri,12 Jan 2001 18:18:18 GMT">
	<meta http-equiv="Pragma"content="no-cache">
	<meta http-equiv="Refresh"content="2;URL=http://www.haorooms.com"> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta charset="utf-8"> 
	<link rel="stylesheet" type="text/css" href="theme.css" />
	<script src="demo.js" defer="defer"></script>
</head>
```

<br/>

**五.文档**

1).注释

```
<!--这是一段注释。注释不会在浏览器中显示。-->
```

2).标题

```
<h1>这是标题 1</h1>
<h2>这是标题 2</h2>
<h3>这是标题 3</h3>
<h4>这是标题 4</h4>
<h5>这是标题 5</h5>
<h6>这是标题 6</h6>
```

3).文本

```
<p>文本段落</p>
<span>行内文本</span>
<code>代码段落</code>
<pre>预留段落</pre>
<font size="3" color="red">普通文本</font>
<center>居中文本</center>
<i>斜体文本</i>
<em>斜体文本</em>
<b>粗体文本</b>
<strong>粗体文本</strong>
<big>大号文本</big>
<small>小号文本</small>
<del>删除线</del>
<ins>下划线</ins>
<u>下划线</u>
<mark>黄色凸显</mark>
<sub>下标</sub>
<sup>上标</sup>
<abbr title="People's Republic of China">PRC</abbr>
<address>联系文本</address>
```

4).分割

```
<hr/>水平线
<br/>换行符
```

5).引用

属性|描述
--|--
cite|规定引用的来源URL

```
<blockquote>段落引用</blockquote>
<q>行内引用</q>
```

<br/>

**六.媒体**

1).source属性

属性|值|描述
--|--|--
src|url|规定媒体文件的 URL
type|MIME|规定媒体资源的 MIME 类型

2).audio，video属性

属性|值|描述
--|--|--
autoplay|autoplay|如果出现该属性，则音频(视频)在就绪后马上播放
controls|controls|如果出现该属性，则向用户显示控件，比如播放按钮
loop|loop|如果出现该属性，则每当音频(视频)结束时重新开始播放
muted|muted|规定音频(视频)输出应该被静音
src|URL|要播放的音频(视频)的 URL
preload|preload|如果出现该属性，则音频(视频)在页面加载时进行加载，并预备播放。如果使用 "autoplay"，则忽略该属性
poster|URL|规定视频下载时显示的图像，或者在用户点击播放按钮前显示的图像
height|pixels|设置视频播放器的高度
width|pixels|设置视频播放器的宽度

```
<audio controls>
	<source src="horse.ogg" type="audio/ogg">
	<source src="horse.mp3" type="audio/mpeg">
	您的浏览器不支持 audio 标签
</audio>

<video  controls="controls">
	<source src="horse.ogg" type="audio/ogg">
	<source src="horse.mp3" type="audio/mpeg">
	您的浏览器不支持 video 标签
</video>
```

3).embed属性

属性|值|描述
---|---|---
height|pixels|设置嵌入内容的高度
width|pixels|设置嵌入内容的宽度
src|url|嵌入内容的 URL
type|mime_type|定义嵌入内容的类型

```
<embed src="helloworld.swf" />
```

<br/>

**七.表单**

1).form属性

属性|值|描述
--|--|--
action|URL|规定当提交表单时向何处发送表单数据
method|get，post|规定用于发送 form-data 的 HTTP 方法
enctype|application/x-www-form-urlencoded（默认），multipart/form-data（上传文件）|规定在发送表单数据之前如何对其进行编码

2).输入框

属性|值|描述
--|--|--
disabled|disabled|当 input 元素加载时禁用此元素
maxlength|number|规定文本（密码）输入字段中的字符的最大长度
size|number_of_char|定义文本（密码）显示的宽度
name|field_name|定义 input 元素的名称
placeholder|text|规定帮助用户填写输入字段的提示
type|file，hidden，password，text|规定input元素的类型
value|value|规定 input 元素的值

```
<form action="form_action.asp" method="get">
	<fieldset>
	<legend>标题</legend>
		<p>First name: <input type="text" name="fname" /></p>
		<p>Last name: <input type="text" name="lname" /></p>
		<input type="submit" value="Submit" />
	<fieldset>
</form>
```

3).按钮

属性|值|描述
--|--|--
disabled|disabled|规定禁用该下拉列表

```
<input type="button" value="Click Me!"/>
<button type="button">Click Me!</button>
```

4).单选框

属性|值|描述
--|--|--
disabled|disabled|规定禁用该下拉列表
checked|checked|单选按钮的状态

```
<label for="maleId">Male</label>
<input type="radio" name="sex" id="maleId" value="male"/>
<br />
<label for="femaleId">Female</label>
<input type="radio" name="sex" id="femaleId" value="female"/>
```

5).复选框

属性|值|描述
--|--|--
disabled|disabled|规定禁用该下拉列表
checked|checked|单选按钮的状态

```
<label for="bikeId">我喜欢自行车：</label>
<input type="checkbox" name="Bike" id="bikeId" value="bike"/>
<br />
<label for="carId">我喜欢汽车：</label>
<input type="checkbox" name="Car" id="carId" value="car"/>
```

6).下拉列表

属性|值|描述
--|--|--
disabled|disabled|规定禁用该下拉列表
name|name|规定下拉列表的名称
size|number|规定下拉列表中可见选项的数目


```
<select>
	<optgroup label="Swedish Cars">
		<option value ="volvo" selected>Volvo</option>
		<option value ="saab">Saab</option>
	</optgroup>
	<optgroup label="German Cars">
		<option value ="mercedes">Mercedes</option>
		<option value ="audi">Audi</option>
	</optgroup>
</select>
```

7).文本域

属性|值|描述
--|--|--
cols|number|规定文本区内的可见宽度
rows|number|规定文本区内的可见行数
disabled|disabled|规定禁用该文本区
maxlength|number|规定文本区域的最大字符数
name|name_of_textarea|规定文本区的名称
placeholder|text|规定描述文本区域预期值的简短提示

```
<textarea rows="10" cols="30">
	The cat was playing in the garden.
</textarea>
```

<br/>

**八.表格**

1).table属性

属性|值|描述
--|--|--
border|pixels|规定表格边框的宽度
cellpadding|pixels，%|规定单元边沿与其内容之间的空白
cellspacing|pixels，%|规定单元格之间的空白
width|%，pixels|规定表格的宽度
frame|void（四周没有边)，above（上边），below（下边)，hsides（上下边），lhs（左边），rhs（右边），vsides（左右边），box（四周边）|规定外侧边框的哪个部分是可见的
rules|none（行列没有)，rows（行)，cols（列），all（行列）|规定内侧边框的哪个部分是可见的

2).tr属性

属性|值|描述
--|--|--
align|right，left，center|定义表格行的内容对齐方式
valign|top，middle，bottom，baseline|规定表格行中内容的垂直对齐方式

3).td，th属性

属性|值|描述
--|--|---
colspan|number|规定单元格可横跨的列数
rowspan|number|规定单元格可横跨的行数
align|left（左对齐)，right（右对齐），center（中对齐）|规定单元格内容的水平对齐方式
valign|top（上对齐），middle（中对齐），bottom（下对齐）|规定单元格内容的垂直排列方式

```
<table border="1">
	<caption>我的标题</caption>
	<tr>
		<th>Month</th>
		<th>Savings</th>
	</tr>
	<tr>
      		<td>January</td>
		<td>$100</td>
    	</tr>
    	<tr>
      		<td>February</td>
		<td>$80</td>
    	</tr>
	<tr>
		<td>Sum</td>
		<td>$180</td>
	</tr>
</table>
```

<br/>

**九.序列**

1).自定义序列

```
<dl>
	<dt>计算机</dt>
		<dd>用来计算的仪器 ... ...</dd>
	<dt>显示器</dt>
   		<dd>以视觉方式显示信息的装置 ... ...</dd>
</dl>
```

2).有序

属性|值|描述
--|--|--
reversed|reversed|规定列表顺序为降序(9,8,7...)
start|number|规定有序列表的起始值
type|1，A，a，I，i|规定在列表中使用的标记类型

```
<ol>
	<li>Coffee</li>
	<li>Tea</li>
	<li>Milk</li>
</ol>
```

3).无序

```
<ul>
	<li>Coffee</li>
	<li>Tea</li>
	<li>Milk</li>
</ul>
```

<br/>

**十.图片**

1).img属性

属性|值|描述
--|--|--
height|pixels，%|定义图像的高度
width|pixels，%|设置图像的宽度
alt|text|规定图像的替代文本
src|URL|规定显示图像的 URL

```
<img src="/i/eg_tulip.jpg"  alt="上海鲜花港 - 郁金香" />
```

2).area属性

属性|值|描述
--|--|--
alt|string|它规定在图像无法显示时的替代文本
coords|坐标值|定义可点击区域（对鼠标敏感的区域）的坐标
href|URL|定义此区域的目标
shape|rect，circ，poly|定义区域的形状
target|_blank，_parent，_self，_top|规定在何处打开 href 属性指定的目标 URL

```
<img src="planets.jpg" border="0" usemap="#planetmap" alt="Planets" />
<map name="planetmap" id="planetmap">
	<area shape="circle" coords="180,139,14" href ="venus.html" alt="Venus" />
	<area shape="circle" coords="129,161,10" href ="mercur.html" alt="Mercury" />
	<area shape="rect" coords="0,0,110,260" href ="sun.html" alt="Sun" />
</map>
```

>img标签中的 usemap 属性与 map 元素 name 属性相关联，创建图像与映射之间的联系。

<br/>

**十一.进度**

属性|值|描述
--|--|--
max|number|规定任务一共需要多少工作。
value|number|规定已经完成多少任务。

```
<progress value="22" max="100"></progress> 
```
