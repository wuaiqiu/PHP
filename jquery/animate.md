# animate

一.使用方式

http://www.jq22.com/yanshi819


```
#基本使用
<div class="animated bounceOutLeft"></div>

#完成后触发的事件
$('#yourElement').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(event));

#修改一些属性
#jq22{
    animate-duration: 2s;    //动画持续时间
    animate-delay: 1s;    //动画延迟时间
    animate-iteration-count: 2;    //动画执行次数
}
```
