# JSElement

**一.布局**

1).Frame对象，IFrame对象

属性|值|描述
--|--|--
frameBorder|0，1|设置或返回是否显示框架周围的边框
marginHeight|length|设置或返回框架的顶部和底部页空白
marginWidth|length|设置或返回框架的左边缘和右边缘的空白
scrolling|auto，yes，no|设置或返回框架是否可拥有滚动条
src|URL|设置或返回应被加载到框架中的文档的URL
noResize|true，false|设置或返回框架是否可调整大小

<br/>

**二.链接**

1).Base对象

属性|值|描述
--|--|--
href|URL|设置或返回针对页面中所有链接的基准 URL
target|_blank，_self，_parent，_top|设置或返回针对页面中所有链接的默认目标框架

2).Anchor对象

属性|值|描述
--|--|--
href|URL|设置或返回被链接资源的 URL
innerHTML|string|设置或返回一个链接的内容
target|_blank，_self，_parent，_top|设置或返回在何处打开链接
blur()||把焦点从链接上移开
focus()||给链接应用焦点

<br/>

**三.媒体**

1).Source对象

属性|值|描述
--|--|--
src|URL|设置或返回source元素中 src 属性的值。
type|MIME|设置或返回source元素中 type 属性的值。

2).Audio对象，Video对象

属性|值|描述
--|--|--
autoplay|true，false|设置或返回是否在就绪（加载完成）后随即播放音频（视频）
controls|true，false|设置或返回音频（视频）是否应该显示控件（比如播放/暂停等）
currentTime|time|设置或返回音频（视频）中的当前播放位置（以秒计）
duration|time|返回音频（视频）的长度（以秒计）
ended|true，false|返回音频（视频）的播放是否已结束
loop|true，false|设置或返回音频（视频）是否应在结束时再次播放
muted|true，false|设置或返回是否关闭声音
paused|true，false|设置或返回音频（视频）是否暂停
playbackRate|int|设置或返回音频（视频）播放的速度
preload|auto（指示一旦页面加载，则开始加载音频（视频）），metadata（指示当页面加载后仅加载音频（视频）的元数据），none（指示页面加载后不应加载音频（视频））|设置或返回音频（视频）的 preload 属性的值
src|URL|设置或返回音频（视频）的 src 属性的值
volume|0.0 (静音) 到 1.0 (最大声)|设置或返回音频的音量
load()||重新加载音频（视频）元素
play()||开始播放音频（视频）
pause()||暂停当前播放的音频（视频）
height|length|设置或返回视频的height属性的值
width|length|设置或返回视频的width属性的值
poster|url|设置或返回视频的poster属性的值

3).Embed对象

属性|值|描述
--|--|--
height|length|设置或返回embed元素中height属性的值
width|length|设置或返回embed元素中width属性的值
src|url|设置或返回embed元素中src属性的值
type|MIME|设置或返回embed元素中type属性的值

<br/>

**四.表单**

1).Form对象

属性|值|描述
--|--|--
action|URL|设置或返回表单的 action 属性
enctype|application/x-www-form-urlencoded（默认），multipart/form-data（上传文件）|设置或返回表单用来编码内容的 MIME 类型
length|int|返回表单中的元素数目
method|get，post|设置或返回将数据发送到服务器的 HTTP 方法
elements[]|input对象等|包含表单中所有元素的数组
reset()||把表单的所有输入元素重置为它们的默认值
submit()||提交表单

2).Text对象，FileUpload对象，Hidden对象，Password对象

属性|值|描述
--|--|--
maxLength|length|设置或返回文本(密码)域中的最大字符数
size|length|设置或返回文本（密码）域的尺寸
disabled|true，false|设置或返回输入框是否应被禁用
name|string|设置或返回输入框的名称
value|string|设置或返回输入框的value属性的值
blur()||从输入框对象上移开焦点
focus()||为输入框对象赋予焦点
select()||选取输入框对象

3).Button对象

属性|值|描述
--|--|--
disabled|true，false|设置或返回是否禁用按钮
name|string|设置或返回按钮的名称
value|string|设置或返回在按钮上显示的文本
blur()||把焦点从元素上移开
click()||在某个按钮上模拟一次鼠标单击
focus()||为某个按钮赋予焦点

4).Radio对象，Checkbox对象

属性|值|描述
--|--|--
checked|true，false|设置或返回单选按钮的状态
disabled|true，false|设置或返回是否禁用单选按钮
name|string|设置或返回单选按钮的名称
value|string|设置或返回单选按钮的 value 属性的值
blur()||从单选按钮移开焦点
click()||在单选按钮上模拟一次鼠标点击
focus()||为单选按钮赋予焦点

5).Select对象

属性|值|描述
--|--|--
disabled|true，false|设置或返回是否应禁用下拉列表
length|int|返回下拉列表中的选项数目
size|int|设置或返回下拉列表中的可见行数
name|string|设置或返回下拉列表的名称
selectedIndex|int|设置或返回下拉列表中被选项目的索引号
options[]||返回包含下拉列表中的所有选项的一个数组
add(option,before|null)|option:添加选项元素，before|null:选项数组的该元素之前增加新的元素，null为追加|向下拉列表添加一个选项
blur()||从下拉列表移开焦点
focus()||在下拉列表上设置焦点
remove(index)|index:要删除的选项的索引号|从下拉列表中删除一个选项

6).Option对象

属性|值|描述
--|--|--
index|int|返回下拉列表中某个选项的索引位置
selected|true，false|设置或返回 selected 属性的值
value|string|设置或返回被送往服务器的值

7).Textarea对象

属性|值|描述
--|--|--
cols|length|设置或返回 textarea 的宽度
rows|length|设置或返回 textarea 的高度
disabled|true，false|设置或返回 textarea 是否应当被禁用
name|string|设置或返回 textarea 的名称
value|string|设置或返回在 textarea 中的文本
blur()||从 textarea 移开焦点
focus()||在 textarea 上设置焦点
select()||选择 textarea 中的文本

<br/>

**五.表格**

1).Table对象

属性|值|描述
--|--|--
border|pixels|设置或返回表格边框的宽度
caption||对表格的caption元素的引用
cellpadding|pixels，%|规定单元边沿与其内容之间的空白
cellspacing|pixels，%|规定单元格之间的空白
width|%，pixels|规定表格的宽度
frame|void（四周没有边)，above（上边），below（下边)，hsides（上下边），lhs（左边），rhs（右边），vsides（左右边），box（四周边）|规定外侧边框的哪个部分是可见的
rules|none（行列没有)，rows（行)，cols（列），all（行列）|规定内侧边框的哪个部分是可见的
cells[]||返回包含表格中所有单元格的一个数组
rows[]||返回包含表格中所有行的一个数组
createCaption()||为表格创建一个 caption 元素
deleteCaption()||从表格删除 caption 元素以及其内容
deleteRow(index)||从表格删除一行
insertRow(index)||在表格中插入一个新行

2).TableRow对象

属性|值|描述
--|--|--
align|right，left，center|定义表格行的内容对齐方式
VAlign|top，middle，bottom，baseline|规定表格行中内容的垂直对齐方式
rowIndex|int|返回该行在表中的位置
deleteCell(index)||删除行中的指定的单元格
insertCell(index)||在一行中的指定位置插入一个空的td元素

3).TableCell对象

属性|值|描述
--|--|--
align|left（左对齐)，right（右对齐），center（中对齐）|规定单元格内容的水平对齐方式
VAlign|top（上对齐），middle（中对齐），bottom（下对齐)|规定单元格内容的垂直排列方式
cellIndex|int|返回单元格在某行的单元格集合中的位置
colSpan|int|单元格横跨的列数
rowSpan|int|设置或返回单元格可横跨的行数
innerHTML|stinrg|设置或返回单元格的开始标签和结束标签之间的 HTML

<br/>

**六.序列**

1).Ol对象

属性|值|描述
--|--|--
reversed|reversed|规定列表顺序为降序(9,8,7...)
start|number|规定有序列表的起始值
type|1，A，a，I，i|规定在列表中使用的标记类型

2).Li对象

属性|值|描述
--|--|--
value|string|设置或返回列表项的 value 属性值

<br/>

**七.图片**

1).Image对象

属性|值|描述
--|--|--
alt|string|设置或返回无法显示图像时的替代文本
complete|true，false|返回浏览器是否已完成对图像的加载
height|pixels，%|设置或返回图像的高度
width|pixels，%|设置或返回图像的宽度
src|url|设置或返回图像的 URL
useMap|string|设置或返回客户端图像映射的 usemap 属性的值

2).Area对象

属性|值|描述
--|--|--
alt|string|它规定在图像无法显示时的替代文本
coords|坐标值|定义可点击区域（对鼠标敏感的区域）的坐标
href|URL|定义此区域的目标
shape|rect，circ，poly|定义区域的形状
target|_blank，_parent，_self，_top|规定在何处打开 href 属性指定的目标 URL

<br/>

**八.进度**

1).Progress对象

属性|值|描述
--|--|--
max|number|设置或返回进度条的 max 属性值
value|number|设置或返回进度条的 value 属性值
