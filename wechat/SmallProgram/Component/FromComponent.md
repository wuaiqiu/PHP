# 表单组件

**一.button**

属性名|类型|默认值|描述
--|--|--|--
size|String|default|按钮的大小,(default,mini)
type|String|default|按钮的样式类型(primary,default,warn)
plain|Boolean|false|按钮是否镂空，背景色透明
disabled|Boolean|false|是否禁用
loading|Boolean|false|名称前是否带 loading 图标
form-type|String||用于form组件(submit,reset)

<br>

**二.checkbox**

属性名|类型|默认值|描述
--|--|--|--
value|String||value值
disabled|Boolean|false|是否禁用
checked|Boolean|false	|当前是否选中，可用来设置默认选中
checkbox-group|||
bindchange|EventHandle||选中项发生改变是触发change事件

<br>

**三.form**

属性名|类型|默认值|描述
--|--|--|--
bindsubmit|EventHandle||携带form中的数据触发submit事件
bindreset|EventHandle	||表单重置时会触发reset事件

<br>

**四.input**

属性名|类型|默认值|描述
--|--|--|--
value|String||输入框的初始内容
type	|String|"text"|input 的类型(text,number,idcard,digit)
password|Boolean|false|是否是密码类型
placeholder|String||输入框为空时占位符
disabled|Boolean|false|是否禁用
maxlength|Number|140|最大输入长度，设置为 -1 的时候不限制最大长度
focus|Boolean|false|获取焦点
confirm-type|String|"done"|设置键盘右下角按钮的文字(send,search,next	,go,done)
bindfocus|EventHandle||输入框聚焦时触发
bindblur|EventHandle||输入框失去焦点时触发

<br>

**五.label**

属性名|类型|默认值|描述
--|--|--|--
for|String||绑定控件的id

<br>

**六.picker**

mode = selector

属性名|类型|默认值|描述
--|--|--|--
range|Array|[]|范围
value|Number|0|value 的值表示选择了 range 中的第几个（下标从 0 开始）
bindchange|EventHandle||value 改变时触发 change 事件
disabled|Boolean|false|是否禁用

mode = multiSelector

属性名|类型|默认值|描述
--|--|--|--
range|Array|[[]]|范围
value|Array|[0]|value 的值表示选择了 range 中的第几个（下标从 0 开始）
bindchange|EventHandle||value 改变时触发 change 事件
disabled|Boolean|false|是否禁用

mode = time

属性名|类型|默认值|描述
--|--|--|--
value|String||表示选中的时间，格式为"hh:mm"
start|String||表示有效时间范围的开始，字符串格式为"hh:mm"
end|String||表示有效时间范围的结束，字符串格式为"hh:mm"
bindchange|EventHandle||value 改变时触发 change 事件
disabled|Boolean|false|是否禁用

mode = date

属性名|类型|默认值|描述
--|--|--|--
value|String|0|表示选中的日期，格式为"YYYY-MM-DD"
start|String||表示有效日期范围的开始，字符串格式为"YYYY-MM-DD"
end|String||表示有效日期范围的结束，字符串格式为"YYYY-MM-DD"
fields|String||day有效值 year,month,day，表示选择器的粒度
bindchange|EventHandle||value改变时触发 change 事件
disabled|Boolean|false|是否禁用

mode = region

属性名|类型|默认值|描述
--|--|--|--
value|Array|[]|表示选中的省市区，默认选中每一列的第一个值
custom-item|String||每列的标题
bindchange|EventHandle||value改变时触发 change 事件
disabled|Boolean|false|是否禁用

<br>

**七.radio**

属性名|类型|默认值|描述
--|--|--|--
value|String||value
checked|Boolean|false|当前是否选中
disabled|Boolean|false|是否禁用
radio-group|||
bindchange|EventHandle||选中项发生变化时触发change事件

<br>

**八.slider**

属性名|类型|默认值|描述
--|--|--|--
min|Number|0|最小值
max|Number|100|最大值
step|Number|1|步长，取值必须大于 0，并且可被(max - min)整除	
disabled|Boolean|false|是否禁用
value|Number|0|当前取值
show-value|Boolean|false|是否显示当前 value
bindchange|EventHandle||完成一次拖动后触发的事件

<br>

**九.switch**

属性名|类型|默认值|描述
--|--|--|--
checked|Boolean|false|是否选中
bindchange|EventHandle||checked改变时触发change事件

<br>

**十.textarea**

属性名|类型|默认值|描述
--|--|--|--
value|String||输入框的内容
placeholder|String||输入框为空时占位符
focus|Boolean|false|获取焦点
disabled|Boolean|false|是否禁用
maxlength|Number|140|最大输入长度，设置为 -1 的时候不限制最大长度
bindfocus|EventHandle	||输入框聚焦时触发
bindblur|EventHandle||输入框失去焦点时触发