# 基础组件

**一.icon**

属性名|类型|默认值|描述
--|--|--|--
type|String||icon的类型，有效值：success, success_no_circle, info, warn, waiting, cancel, download, search, clear
size	|Number|23|icon的大小，单位px
color|Color||icon的颜色，同css的color

<br>

**二.text**

属性名|类型|默认值|描述
--|--|--|--
selectable|Boolean|false|文本是否可选
space|String|nbsp|显示连续空格(ensp,emsp,nbsp)
decode|Boolean|false|是否解码(nbsp; lt; gt; amp; apos;)

<br>

**三.progress**

属性名|类型|默认值|描述
--|--|--|--
percent|Float|无|百分比0~100
show-info|Boolean|false|在进度条右侧显示百分比
stroke-width|Number|6|进度条线的宽度，单位px
activeColor|Color	||已选择的进度条的颜色
backgroundColor|Color	||未选择的进度条的颜色
active|Boolean|false|进度条从左往右的动画

<br>

**四.navigator**

属性名|类型|默认值|描述
--|--|--|--
url|String||应用内的跳转链接
open-type|String||navigate跳转方式	(navigate,redirect,switchTab,reLaunch,navigateBack)
delta|Number||当 open-type 为 'navigateBack' 时有效，表示回退的层数
hover-class|String|none|navigator-hover指定点击时的样式类，当hover-class="none"时，没有点击态效果
hover-stop-propagation|Boolean|false|指定是否阻止本节点的祖先节点出现点击态

<br>

**五.map**

属性名|类型|默认值|描述
--|--|--|--
longitude|Number||中心经度
latitude|Number||中心纬度
scale|Number|16|缩放级别，取值范围为5-18
markers|Array|[]|标记点{id,latitude,longitude,iconPath,width,height,alpha}
polyline|Array|[]|路线points([{latitude: 0, longitude: 0}]),color,width,dottedLine(false)
circles|Array|[]|圆(latitude,longitude,color,fillColor,radius,strokeWidth)