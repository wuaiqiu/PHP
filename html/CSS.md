# CSS

**一.选择器**

选择器|例子|例子描述
----|----|----
.class|.intro|选择 class="intro" 的所有元素
#id|#firstname|选择 id="firstname" 的所有元素
\* | \* |选择所有元素
element|p|选择所有p元素
element,element|div,p|选择所有div元素和所有p元素
element element|div p|选择div元素内部的所有p元素
element>element|div>p|选择父元素为div元素的所有p元素
element+element|div+p|选择紧接在div元素之后的所有p元素
element1~element2|p~ul|选择前面有p元素的每个ul元素
[attribute]|[target]|选择带有 target 属性所有元素
[attribute=value]|[target=_blank]|选择 target="_blank" 的所有元素
[attribute~=value]|[title~=flower]|选择 title 属性包含单词 "flower" 的所有元素
[attribute^=value]|a[src^="https"]|选择其 src 属性值以 "https" 开头的每个a元素
[attribute$=value]|a[src$=".pdf"]|选择其 src 属性以 ".pdf" 结尾的所有a元素
[attribute\*=value]|a[src\*="abc"]|选择其 src 属性中包含 "abc" 子串的每个a元素
:only-child|p:only-child|选择属于其父元素的唯一子元素的每个p元素
:nth-child(n)|p:nth-child(2)|选择属于其父元素的第二个子元素的每个p元素
:root|:root|选择文档的根元素html
:empty|p:empty|选择没有子元素的每个p元素（包括文本节点）
:disabled|input:disabled|选择每个禁用的input元素
:checked|input:checked|选择每个被选中的input元素
:before|p:before|在每个 p 元素的内容之前插入内容
:after|p:after|在每个 p 元素的内容之后插入内容

<br/>

**二.单位**

1).尺寸

单位|描述
--|--
%|百分比
em|1em 等于当前的字体尺寸。2em 等于当前字体尺寸的两倍。
px|像素 (计算机屏幕上的一个点)

2).颜色

单位|描述
--|--
(颜色名)|颜色名称 (比如 red)
rgb(x,x,x)|RGB 值 (比如 rgb(255,0,0))
#rrggbb|十六进制数 (比如 #ff0000)

<br/>

**三.文本**

1).字体属性（Font）

属性|值|描述
--|--|--
font-style|normal，italic|规定文本的字体样式
font-weight|normal，bold，bolder，lighter,100～900|规定字体的粗细
font-size|xx-small，x-small，small，medium，large，x-large，xx-large，%（基于父元素）|规定文本的字体尺寸
font-family|family-name|规定文本的字体系列
font|font-style font-weight font-size font-family|在一个声明中设置所有字体属性

```
//Internet Explorer 9+, Firefox, Chrome, Safari, 和 Opera 支持 WOFF (Web Open Font Format) 字体.
//Firefox, Chrome, Safari, 和 Opera 支持 .ttf(True Type字体)和.otf(OpenType)字体字体类型）。

@font-face{
    font-family: myFirstFont;
    src: url(sansation_light.woff);
}
 
div{
    font-family:myFirstFont;
}
```

2).文本属性（Text）

属性|值|描述|
--|--|--
color|颜色|设置文本的颜色
direction|ltr（从左到右），rtl（从右到左）|规定文本的方向 / 书写方向
letter-spacing|normal，length|设置字符间距
word-spacing|length|设置单词间距
line-height|length，%（基于当前字体大小）|设置行高
text-align|left，right，center,justify|规定文本的水平对齐方式
text-decoration|underline，overline，line-through，none|规定添加到文本的装饰效果
text-indent|length，%（基于父元素）|规定文本块首行的缩进
text-transform|none，capitalize（每个单词以大写字母开头），uppercase，lowercase|控制文本的大小写
white-space|normal，pre（相当于pre标签），nowrap|规定如何处理元素中的空白
text-overflow|clip（修剪文本），ellipsis（显示省略符号来代表被修剪的文本）|规定当文本溢出包含元素时发生的事情
text-shadow|h-shadow（水平阴影的位置） v-shadow（垂直阴影的位置） blur（模糊的距离） color|向文本添加阴影
word-wrap|normal，break-word|允许对长的不可分割的单词进行分割并换行到下一行

<br/>

**四.动画**

1).动画属性（Animation）

属性|值|描述
--|--|--
animation-name|keyframename|规定 @keyframes 动画的名称
animation-duration|time|规定动画完成一个周期所花费的秒或毫秒
animation-timing-function|linear（从头到尾的速度是相同的），ease（以低速开始，然后加快，在结束前变慢），ease-in（以低速开始），ease-out（以低速结束），ease-in-out（以低速开始和结束）|规定动画的速度曲线
animation-delay|time|规定动画何时开始
animation-iteration-count|n|规定动画被播放的次数
animation-direction|normal（动画应该正常播放），alternate（动画应该轮流反向播放）|规定动画是否在下一周期逆向地播放
animation|animation-name animation-duration animation-timing-function animation-delay animation-iteration-count animation-direction|所有动画属性的简写属性

```
@-moz-keyframes mymove /* Firefox */
{
	from {top:0px;}
	to {top:200px;}
}

@-webkit-keyframes mymove /* Safari 和 Chrome */
{
	0% {top:0px;}
	100% {top:200px;}
}

@-o-keyframes mymove /* Opera */
{
	from {top:0px;}
	to {top:200px;}
}
@keyframes mymove /*W3C*/
{
	from {top:0px;}
	to {top:200px;}
}

animation:mymove 5s infinite;
-webkit-animation:mymove 5s infinite; /* Safari 和 Chrome */
```

2).过渡属性（Transition）

属性|值|描述
--|--|--
transition-property|all，property|规定应用过渡的 CSS 属性的名称
transition-duration|time|定义过渡效果花费的时间
transition-timing-function|linear，ease，ease-in，ease-out，ease-in-out|规定过渡效果的时间曲
transition-delay|time|规定过渡效果何时开始。
transition|transition-property transition-duration transition-timing-function transition-delay|简写属性，用于在一个属性中设置四个过渡属性

```
-moz-transition: width 2s; /* Firefox 4 */
-webkit-transition: width 2s; /* Safari 和 Chrome */
-o-transition: width 2s; /* Opera */
transition:width 2s; /*W3C*/
```


3).2d转换

```
//平移
transform: translate(50px,100px);
-ms-transform: translate(50px,100px); /* IE 9 */
-webkit-transform: translate(50px,100px); /* Safari and Chrome */

//中心旋转
transform: rotate(30deg);
-ms-transform: rotate(30deg); /* IE 9 */
-webkit-transform: rotate(30deg); /* Safari and Chrome */

//放大倍数
-ms-transform:scale(2,3); /* IE 9 */
-webkit-transform: scale(2,3); /* Safari */
transform: scale(2,3); /* 标准语法 */

//倾斜角度
transform: skew(30deg,20deg);
-ms-transform: skew(30deg,20deg); /* IE 9 */
-webkit-transform: skew(30deg,20deg); /* Safari and Chrome */
```

<br/>

**五.背景**

属性|值|描述
--|--|--
background-color|颜色|规定要使用的背景颜色
background-position|x% y%，xpos ypos，（top\|center\|bottom） （right\|center\|left)|规定背景图像的位置
background-size|wpx hpx，x% y%，cover（覆盖整个区域），contain（包含完整图片）|规定背景图片的尺寸
background-repeat|repeat（在垂直方向和水平方向重复,默认），repeat-x（在水平方向重复），repeat-y（在垂直方向重复），no-repeat（仅显示一次）|规定如何重复背景图像
background-origin|padding-box（背景图像相对于内边距框来定位），border-box（背景图像相对于边框盒来定位），content-box（背景图像相对于内容框来定位）|规定背景图片的定位区域
background-clip|border-box（背景被裁剪到边框盒），padding-box（背景被裁剪到内边距框—），content-box（背景被裁剪到内容框）|规定背景的绘制区域
background-attachment|scroll（背景图像会随着页面其余部分的滚动而移动），fixed（背景图像不会移动）|规定背景图像是否固定或者随着页面的其余部分滚动
background-image|url|规定要使用的背景图像
background|bg-color bg-image  bg-repeat bg-attachment bg-position|在一个声明中设置所有的背景属性
opacity|从 0.0 （完全透明）到 1.0（完全不透明）|规定颜色透明度。

```
//线性渐变 - 从上到下（默认情况下）
background: -webkit-linear-gradient(red, blue); /* Safari 5.1 - 6.0 */
background: -o-linear-gradient(red, blue); /* Opera 11.1 - 12.0 */
background: -moz-linear-gradient(red, blue); /* Firefox 3.6 - 15 */
background: linear-gradient(red, blue); /* 标准的语法 */

//线性渐变 - 从左到右
background: -webkit-linear-gradient(left, red , blue); /* Safari 5.1 - 6.0 */
background: -o-linear-gradient(right, red, blue); /* Opera 11.1 - 12.0 */
background: -moz-linear-gradient(right, red, blue); /* Firefox 3.6 - 15 */
background: linear-gradient(to right, red , blue); /* 标准的语法 */

//线性渐变 - 对角
background: -webkit-linear-gradient(left top, red , blue); /* Safari 5.1 - 6.0 */
background: -o-linear-gradient(bottom right, red, blue); /* Opera 11.1 - 12.0 */
background: -moz-linear-gradient(bottom right, red, blue); /* Firefox 3.6 - 15 */
background: linear-gradient(to bottom right, red , blue); /* 标准的语法 */

//0deg 将创建一个从下到上的渐变，90deg 将创建一个从左到右的渐变
//换算公式 90 - x = y 其中 x 为标准角度，y为非标准角度
background: -webkit-linear-gradient(180deg, red, blue); /* Safari 5.1 - 6.0 */
background: -o-linear-gradient(180deg, red, blue); /* Opera 11.1 - 12.0 */
background: -moz-linear-gradient(180deg, red, blue); /* Firefox 3.6 - 15 */
background  : linear-gradient(180deg, red, blue); /* 标准的语法 */
  
//径向渐变 - 颜色结点均匀分布（默认情况下）
background: -webkit-radial-gradient(red, green, blue); /* Safari 5.1 - 6.0 */
background: -o-radial-gradient(red, green, blue); /* Opera 11.6 - 12.0 */
background: -moz-radial-gradient(red, green, blue); /* Firefox 3.6 - 15 */
background: radial-gradient(red, green, blue); /* 标准的语法 */

//径向渐变 - 颜色结点不均匀分布
background: -webkit-radial-gradient(red 5%, green 15%, blue 60%); /* Safari 5.1 - 6.0 */
background: -o-radial-gradient(red 5%, green 15%, blue 60%); /* Opera 11.6 - 12.0 */
background: -moz-radial-gradient(red 5%, green 15%, blue 60%); /* Firefox 3.6 - 15 */
background: radial-gradient(red 5%, green 15%, blue 60%); /* 标准的语法 */

//设置形状,circle 表示圆形，ellipse 表示椭圆形。默认值是 ellipse
background: -webkit-radial-gradient(circle, red, yellow, green); /* Safari 5.1 - 6.0 */
background: -o-radial-gradient(circle, red, yellow, green); /* Opera 11.6 - 12.0 */
background: -moz-radial-gradient(circle, red, yellow, green); /* Firefox 3.6 - 15 */
background: radial-gradient(circle, red, yellow, green); /* 标准的语法 */


```

<br/>

**六.边框**

1).边框属性（Border 和 Outline）

属性|值|描述
--|--|--
border-width|thin（细的边框），medium，thick（粗的边框），length|设置四条边框的宽度
border-style|dotted（点状边框），dashed（虚线），solid（实线），double（双线）|设置四条边框的样式
border-color|颜色|设置四条边框的颜色
border|border-width border-style border-color|在一个声明中设置所有的边框属性
border-top-width，border-right-width，border-bottom-width，border-left-width|border-width|设置宽度
border-top-style，border-right-style，border-bottom-style，border-left-style|border-style|设置样式
border-top-color，border-right-color，border-bottom-color，border-left-color|border-color|设置颜色
border-top，border-right，border-bottom，border-left|border|设置边框
outline-color|border-color|设置轮廓的颜色
outline-style|border-style|设置轮廓的样式
outline-width|border-width|设置轮廓的宽度
outline|outline-color outline-style outline-width|在一个声明中设置所有的轮廓属性
border-top-left-radius|length，%|定义边框左上角的形状
border-top-right-radius|length，%|定义边框右下角的形状
border-bottom-right-radius|length，%|定义边框右下角的形状
border-bottom-left-radius|length，%|定义边框左下角的形状
border-radius|top-left top-right bottom-right bottom-left|简写属性
box-shadow|h-shadow（水平阴影的位置） v-shadow（垂直阴影的位置） blur（模糊距离） color（阴影的颜色）|向方框添加一个或多个阴影

2).表格属性（Table）

属性|值|描述
--|--|--
border-spacing|length（水平） length（垂直）|规定相邻单元格边框之间的距离
empty-cells|show，hide|规定是否显示表格中的空单元格上的边框和背景
border-collapse|separate，collapse（会忽略border-spacing和empty-cells）|规定是否合并表格边框
caption-side|top，bottom|规定表格标题的位置

<br/>

**七.布局**

1).可伸缩框属性（Flexible Box）

box

属性|值|描述
--|--|--
flex-direction| row \| row-reverse \| column \| column-reverse|指定了弹性子元素在父容器中的位置
justify-content| flex-start \| flex-end \| center \| space-between \| space-around|沿着弹性容器的横轴对齐
align-items| flex-start \| flex-end \| center \| baseline \| stretch|沿着弹性容器的纵轴对齐
flex-wrap|nowrap \| wrap \| wrap-reverse | 指定弹性盒子的子元素换行方式
align-content|flex-start \| flex-end \| center \| space-between \| space-around \| stretch|类似于 align-items,但是各个行的对齐

box-item

属性|值|描述
--|--|--
order|int|排序,数值小的排在前面
align-self| auto \| flex-start \| flex-end \| center \| baseline \| stretch|设置弹性元素自身在侧轴（纵轴）方向上的对齐方式
flex|int|属性用于指定弹性子元素如何分配空间

```
.flex-container {
    display: -webkit-flex;
    display: flex;
    width: 400px;
    height: 250px;
    background-color: lightgrey;
}
 
.flex-item {
    background-color: cornflowerblue;
    width: 100px;
    height: 100px;
    margin: 10px;
}
```

```
<div class="flex-container">
  <div class="flex-item">flex item 1</div>
  <div class="flex-item">flex item 2</div>
  <div class="flex-item">flex item 3</div> 
</div>
```

2).外边距属性（Margin）

属性|值|描述
--|--|--
margin-top|length，%|设置元素的上外边距
margin-right|length，%|设置元素的右外边距
margin-bottom|length，%|设置元素的下外边距
margin-left|length，%|设置元素的左外边距
margin|margin-top margin-right margin-bottom margin-left|在一个声明中设置所有外边距属性

3).内边距属性（Padding）

属性|值|描述
--|--|--
padding-top|length，%|设置元素的上内边距
padding-right|length，%|设置元素的右内边距
padding-bottom|length，%|设置元素的下内边距
padding-left|length，%|设置元素的左内边距
padding|padding-top padding-right padding-bottom padding-left|在一个声明中设置所有内边距属性

4).多列属性（Multi-column）

属性|值|描述
--|--|--
column-count|int|规定元素应该被分隔的列数
column-gap|length|规定列之间的间隔
column-rule-width|thin，medium，thick，length|规定列之间线条的宽度
column-rule-style|none，hidden，dotted，dashed，solid，double|规定列之间线条的样式
column-rule-color|颜色|规定列之间规则的颜色
column-rule|column-rule-width column-rule-style column-rule-color|设置所有 column-rule-* 属性的简写属性
column-span|all|跨越所有列，一般为标题

```
-moz-column-count:3; /* Firefox */
-webkit-column-count:3; /* Safari and Chrome */
column-count:3;

-moz-column-gap:40px; /* Firefox */
-webkit-column-gap:40px; /* Safari and Chrome */
column-gap:40px;

-moz-column-rule:4px outset #ff0000; /* Firefox */
-webkit-column-rule:4px outset #ff0000; /* Safari and Chrome */
column-rule:4px outset #ff0000;

column-span:all;
-webkit-column-span:all; /* Safari and Chrome */
-moz-column-span:all; /* Firefox */
```

5).定位属性（Positioning）

属性|值|描述
--|--|--
top|length，%|设置定位元素的上外边距边界与其包含块上边界之间的偏移
right|length，%|设置定位元素右外边距边界与其包含块右边界之间的偏移
bottom|length，%|设置定位元素下外边距边界与其包含块下边界之间的偏移
left|length，%|设置定位元素左外边距边界与其包含块左边界之间的偏移
position|absolute，relative，fixed|规定元素的定位类型
float|left（元素向左浮动），right（元素向右浮动），none（元素不浮动）|规定框是否应该浮动
clear|left，right，both|规定元素的哪一侧不允许其他浮动元素
cursor|url，default（箭头），crosshair（十字线），pointer（一只手），auto（默认），wait（通常是一只表或沙漏），help（通常是一个问号或一个气球）|规定要显示的光标的类型（形状）
display|block，inline，inline-block，none(不占据空间)|规定元素应该生成的框的类型
overflow-x|visible，hidden，scroll，auto|如果内容溢出了元素内容区域，是否对内容的左/右边缘进行裁剪
overflow-y|visible，hidden，scroll，auto|如果内容溢出了元素内容区域，是否对内容的上/下边缘进行裁剪
overflow|visible，hidden，scroll，auto|规定当内容溢出元素框时发生的事情
vertical-align|top，middle，bottom|设置元素的垂直对齐方式
visibility|visible，hidden（占据空间）|规定元素是否可见
z-index|int(如果为正数，则离用户更近，为负数则表示离用户更远)|设置元素的堆叠顺序
box-sizing|border-box|元素的 width 和 height 中包含 padding(内边距) 和 border(边框),自动调节

<br/>

**八.列表**

属性|值|描述
--|--|--
list-style-type|none（无标记），disc（实心圆），circle（空心圆），square（实心方块），decimal（数字），lower-alpha（小写字母），upper-alpha（大写字母）|设置列表项标记的类型
list-style-position|inside，outside|设置列表项标记的放置位置
list-style-image|url|将图象设置为列表项标记
list-style|list-style-type list-style-position list-style-image|在一个声明中设置所有的列表属性

<br/>

**九.多媒体查询**

值|描述
--|--
all|用于所有多媒体类型设备
print|用于打印机
screen|用于电脑屏幕，平板，智能手机等。
speech|用于屏幕阅读器

```
@media not|only mediatype and (expressions) {
       CSS 代码...;
}

<link rel="stylesheet" media="mediatype and|not|only (expressions)" href="print.css">
```

```
@media screen and (min-width: 480px) {
    body {
        background-color: lightgreen;
    }
}
```