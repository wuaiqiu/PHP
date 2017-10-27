# CSS

<br/>
**一.选择器**

选择器|例子|例子描述
----|----|----
.class|.intro|选择 class="intro" 的所有元素
#id|#firstname|选择 id="firstname" 的所有元素
* | * |选择所有元素
element|p|选择所有p元素
element,element|div,p|选择所有div元素和所有p元素
element element|div p|选择div元素内部的所有p元素
element>element|div>p|选择父元素为div元素的所有p元素
element+element|div+p|选择紧接在div元素之后的所有p元素
element1~element2|p~ul|选择前面有p元素的每个ul元素
[attribute]|[target]|选择带有 target 属性所有元素
[attribute=value]|[target=_blank]|选择 target="_blank" 的所有元素
[attribute~=value]|[title~=flower]|选择 title 属性包含单词 "flower" 的所有元素
[attribute|=value]|[lang|=en]|选择 lang 属性值以 "en" 开头的所有元素
[attribute^=value]|a[src^="https"]|选择其 src 属性值以 "https" 开头的每个a元素
[attribute$=value]|a[src$=".pdf"]|选择其 src 属性以 ".pdf" 结尾的所有a元素
[attribute*=value]|a[src*="abc"]|选择其 src 属性中包含 "abc" 子串的每个a元素
:only-child|p:only-child|选择属于其父元素的唯一子元素的每个p元素
:nth-child(n)|p:nth-child(2)|选择属于其父元素的第二个子元素的每个p元素
:root|:root|选择文档的根元素html
:empty|p:empty|选择没有子元素的每个p元素（包括文本节点）
:disabled|input:disabled|选择每个禁用的input元素
:checked|input:checked|选择每个被选中的input元素

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


