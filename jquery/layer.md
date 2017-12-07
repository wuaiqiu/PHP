# Layer

**一.基本配置**

属性名|描述|取值
--|---|---
title|标题|String
content|内容|String
icon|图标|0~6
offset|坐标|['top','left'] 't'(顶部) 'r'(右边) 'b'(底部) 'l'(左边) 'lt'(左上) 'lb'(左下) 'rt'(右上) 'rb'(右下)
shade|遮罩|0~1
shadeClose|是否点击遮罩关闭|true,false
time|自动关闭所需毫秒|int
anim|弹出动画| 0(平滑放大)  1(从上掉落)  2 (从底部往上) 3	(从左滑入) 4 (从左翻滚) 5 (渐显) 6(抖动)

<br/>

**二.内置函数**

```
#警告框
layer.alert('只想简单的提示');

#回调函数
layeralert('有了回调', function(index){
  //do something
  layer.close(index);
});
```

```
#确认框
layer.confirm('is not?', {icon: 3, title:'提示'}, function(index){
  //do something
  layer.close(index);
});
```

```
#信息框
layer.msg('同上', {
   icon: 1,
   time: 2000 //2秒关闭（如果不配置，默认是3秒）
}, function(){
  //消失后执行
});
```

```
#加载框
layer.load(0, {time: 1000}) 
layer.load(1, {time: 1000})
layer.load(2, {time: 1000})
```