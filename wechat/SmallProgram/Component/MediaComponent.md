# 媒体组件

**一.audio**

属性名|类型|默认值|描述
--|--|--|--
id|String||audio 组件的唯一标识符
src|String||要播放音频的资源地址
loop|Boolean|false|是否循环播放
controls|Boolean|false|是否显示默认控件
poster|String||默认控件上的音频封面的图片资源地址
name	|String|未知音频|默认控件上的音频名字
author|String|未知作者|默认控件上的作者名字
binderror|EventHandle	||当发生错误时触发 error 事件

<br>

**二.imgae**

属性名|类型|默认值|描述
--|--|--|--
src|String||图片资源地址
mode|String|'scaleToFill'|图片裁剪、缩放的模式(scaleToFill,aspectFit,aspectFill,top,bottom,center,right,left)
binderror|HandleEvent||当错误发生时

<br>

**三.video**

属性名|类型|默认值|描述
--|--|--|--
src|String||要播放视频的资源地址
initial-time|Number||指定视频初始播放位置
duration|Number||指定视频时长
autoplay|Boolean|false|是否自动播放
loop	|Boolean|false|是否循环播放
muted|Boolean|false|是否静音播放
controls|Boolean|true|是否显示默认播放控件（播放/暂停按钮、播放进度、时间）
poster|String||视频封面的图片网络资源地址
binderror|EventHandle||视频播放出错时触发
danmu-list|Array|[]|弹幕列表{text,time,color}
danmu-btn|Boolean	|false|是否显示弹幕按钮，只在初始化时有效，不能动态变更	
enable-danmu|Boolean|false|是否展示弹幕，只在初始化时有效，不能动态变更

<br>

**四.camera**

属性名|类型|默认值|描述
--|--|--|--
device-position|String|back|前置或后置，值为front, back
flash|String|auto|闪光灯，值为auto, on, off
bindstop|EventHandle||摄像头在非正常终止时触发，如退出后台等情况
binderror|EventHandle||用户不允许使用摄像头时触发