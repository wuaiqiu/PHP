# 视图组件

**一.view**

属性名|类型|默认值|描述
--|--|--|--
hover-class|String|none|指定按下去的样式类。当 hover-class="none" 时，没有点击态效果
hover-stop-propagation|Boolean|false|指定是否阻止本节点的祖先节点出现点击态

<br>

**二.scroll-view**

属性名|类型|默认值|描述
--|--|--|--
scroll-x|Boolean|false|允许横向滚动
scroll-y|Boolean|false|允许纵向滚动
enable-back-to-top|Boolean|false|iOS点击顶部状态栏、安卓双击标题栏时，滚动条返回顶部，只支持竖向
bindscrolltoupper|EventHandle||滚动到顶部/左边，会触发 scrolltoupper 事件
bindscrolltolower	|EventHandle||滚动到底部/右边，会触发 scrolltolower 事件

<br>

**三.swiper**

属性名|类型|默认值|描述
--|--|--|--
indicator-dots|Boolean|false|是否显示面板指示点
autoplay|Boolean|false|是否自动切换
current|Number|0|当前所在滑块的 index
interval|Number|5000|自动切换时间间隔
duration|Number|500|滑动动画时长
circular|Boolean|false|是否采用衔接滑动
vertical|Boolean|false|滑动方向是否为纵向
swiper-item|||
item-id|String|""|该 swiper-item 的标识符

<br>

**四.movable-view**

属性名|类型|默认值|描述
--|--|--|--
direction|String|none|movable-view的移动方向，属性值有all、vertical、horizontal、none
inertia|Boolean|false|movable-view是否带有惯性
out-of-bounds|Boolean|false|超过可移动区域后，movable-view是否还可以移动
x|Number||定义x轴方向的偏移
y|Number||定义y轴方向的偏移
movable-area|||
widht|Number|10px|移动区域宽度
height|Number|10px|移动区域高度