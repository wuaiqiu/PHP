# AUI

**一.基本格式**

```
<meta charset="UTF-8">
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
<title>Title</title>
<link rel="stylesheet" href="aui.css">
```

<br>

**二.文本样式**

```
<div class="aui-text-default">aui-text-default</div>
<div class="aui-text-primary">aui-text-primary</div>
<div class="aui-text-success">aui-text-success</div>
<div class="aui-text-info">aui-text-info</div>
<div class="aui-text-warning">aui-text-waring</div>
<div class="aui-text-danger">aui-text-danger</div>
<div class="aui-text-pink">aui-text-pink</div>
<div class="aui-text-purple">aui-text-purple</div>
<div class="aui-text-indigo">aui-text-indigo</div>
<div class="aui-content">内容区域，AUI 2.0色彩及尺寸按照Material Design标准设计</div>
```

<br>

**三.导航栏**

```
<header class="aui-bar aui-bar-nav">
    <a class="aui-pull-left aui-btn">
        <span class="aui-iconfont aui-icon-left"></span>
    </a>
    <div class="aui-title">Title</div>
</header>

<header class="aui-bar aui-bar-nav aui-bar-light">
    <a class="aui-pull-left aui-btn">
        <span class="aui-iconfont aui-icon-left"></span>
    </a>
    <div class="aui-title">Title</div>
</header>
<script type="text/javascript" src="aui-tab.js"></script>
<script type="text/javascript">
    var tab = new auiTab({
        element: document.getElementById("header"),
        index: 1,
        repeatClick: false
    }, function (ret) {
        console.log(ret);
    });
</script>
```

<br>

**四.底部工具栏**

```
<footer class="aui-bar aui-bar-tab" id="footer">
    <div class="aui-bar-tab-item aui-active" tapmode>
        <i class="aui-iconfont aui-icon-home"></i>
        <div class="aui-bar-tab-label">首页</div>
    </div>
    <div class="aui-bar-tab-item" tapmode>
        <i class="aui-iconfont aui-icon-star"></i>
        <div class="aui-bar-tab-label">收藏</div>
    </div>
    <div class="aui-bar-tab-item" tapmode>
        <div class="aui-badge">99</div>
        <i class="aui-iconfont aui-icon-cart"></i>
        <div class="aui-bar-tab-label">购物车</div>
    </div>
    <div class="aui-bar-tab-item" tapmode>
        <div class="aui-dot"></div>
        <i class="aui-iconfont aui-icon-my"></i>
        <div class="aui-bar-tab-label">我的</div>
    </div>
</footer>
<script type="text/javascript" src="aui-tab.js"></script>
<script type="text/javascript">
    var tab = new auiTab({
        element: document.getElementById("footer"),
        index: 1,
        repeatClick: false
    }, function (ret) {
        console.log(ret);
    });
</script>
```

<br>

**五.按钮组工具栏**

```
<div class="aui-bar aui-bar-btn" style="width:80%;">
    <div class="aui-bar-btn-item aui-active">Item1</div>
    <div class="aui-bar-btn-item">Item2</div>
    <div class="aui-bar-btn-item">Item3</div>
</div>
<div class="aui-bar aui-bar-btn aui-bar-btn-full">
    <div class="aui-bar-btn-item aui-active">Item1</div>
    <div class="aui-bar-btn-item">Item2</div>
    <div class="aui-bar-btn-item">Item3</div>
</div>
<div class="aui-bar aui-bar-btn aui-bar-btn-sm">
    <div class="aui-bar-btn-item aui-active">Item1</div>
    <div class="aui-bar-btn-item">Item2</div>
    <div class="aui-bar-btn-item">Item3</div>
</div>

<div class="aui-bar aui-bar-btn aui-bar-btn-round">
    <div class="aui-bar-btn-item aui-active">Item1</div>
    <div class="aui-bar-btn-item">Item2</div>
    <div class="aui-bar-btn-item">Item3</div>
</div>
```

<br>

**六.TAB切换工具栏**

```
<div class="aui-tab" id="tab">
    <div class="aui-tab-item aui-active">Item1</div>
    <div class="aui-tab-item">Item2</div>
    <div class="aui-tab-item">Item3</div>
    <div class="aui-tab-item">Item4</div>
</div>
```

<br>

**七.信息条**

```
<div class="aui-info">
    <div class="aui-info-item">
        <img src="demo2.png" style="width:1.5rem" class="aui-img-round"/><span class="aui-margin-l-5">AUI</span>
    </div>
    <div class="aui-info-item">2015-07-13 22:31</div>
</div>

<div class="aui-info">
    <div class="aui-info-item">
        <img src="demo2.png" style="width:1.5rem" class="aui-img-round"/><span class="aui-margin-l-5">AUI</span>
    </div>
    <div class="aui-info-item">2015-07-13 22:31</div>
</div>

<div class="aui-info">
    <div class="aui-info-item">
        <img src="demo2.png" style="width:1.5rem" class="aui-img-round"/><span class="aui-margin-l-5">AUI</span>
    </div>
    <div class="aui-info-item">2015-07-13 22:31</div>
</div>
```

<br>

**八.按钮**

```
<div class="aui-btn">默认按钮(default)</div>
<div class="aui-btn aui-btn-primary">默认按钮(primary)</div>
<div class="aui-btn aui-btn-success">默认按钮(success)</div>
<div class="aui-btn aui-btn-info">默认按钮(info)</div>
<div class="aui-btn aui-btn-warning">默认按钮(warning)</div>
<div class="aui-btn aui-btn-danger">默认按钮(danger)</div>
<div class="aui-btn aui-btn-block">块级按钮(default)</div>
<div class="aui-btn aui-btn-outlined">边框按钮(default)</div>
<div class="aui-btn aui-btn-sm">小号按钮(default)</div>
```

<br>

**九.标签/角标/圆点**

```
<div class="aui-label">标签</div>
<div class="aui-label aui-label-info">标签</div>
<div class="aui-label aui-label-primary">标签</div>
<div class="aui-label aui-label-danger">标签</div>
<div class="aui-label aui-label-success">标签</div>
<div class="aui-label aui-label-warning">标签</div>
<div class="aui-label aui-label-outlined">边框标签</div>
<div class="aui-badge">角标</div>
<div class="aui-dot">红点</div>
```

<br>

**十.列表布局**

```
<ul class="aui-list aui-list-in">
    <li class="aui-list-header">
        简单的列表布局
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-title">Item1</div>
        </div>
    </li>
</ul>


<ul class="aui-list aui-list-in">
    <li class="aui-list-header">
        带有右侧箭头
    </li>
    <li class="aui-list-item aui-list-item-middle">
        <div class="aui-list-item-inner aui-list-item-arrow">
            <div class="aui-list-item-title">Item1</div>
    </li>
</ul>


<ul class="aui-list aui-list-in">
    <li class="aui-list-header">
        带有其他元素的列表
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-title">text</div>
            <div class="aui-list-item-right">信息</div>
        </div>
    </li>
</ul>

<ul class="aui-list aui-list-in">
    <li class="aui-list-header">带有图标</li>
    <li class="aui-list-item">
        <div class="aui-list-item-label-icon">
            <i class="aui-iconfont aui-icon-home"></i>
        </div>
        <div class="aui-list-item-inner">
            这是一个列表项
        </div>
    </li>
</ul>
```

<br>

**十一.媒体列表**

```
<ul class="aui-list aui-media-list">
            <li class="aui-list-header">
                图文列表
            </li>
            <li class="aui-list-item">
                <div class="aui-media-list-item-inner">
                    <div class="aui-list-item-media">
                        <img src="demo2.png">
                    </div>
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title">媒体列表标题</div>
                            <div class="aui-list-item-right">08:00</div>
                        </div>
                        <div class="aui-list-item-text">
                            相关信息
                        </div>
                    </div>
                </div>
            </li>
        </ul>



 <ul class="aui-list aui-media-list">
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-title">多张图片列表</div>
                    <div class="aui-row aui-row-padded">
                        <div class="aui-col-xs-4">
                            <img src="demo2.png"/>
                        </div>
                        <div class="aui-col-xs-4">
                            <img src="demo2.png" />
                        </div>
                        <div class="aui-col-xs-4">
                            <img src="demo2.png" />
                        </div>
                    </div>
                </div>
            </li>
        </ul>

<ul class="aui-list aui-media-list">
            <li class="aui-list-header">
                通讯录样式列表
            </li>
            <li class="aui-list-item aui-list-item-middle">
                <div class="aui-media-list-item-inner">
                    <div class="aui-list-item-media" style="width: 3rem;">
                        <img src="demo2.png" class="aui-img-round aui-list-img-sm">
                    </div>
                    <div class="aui-list-item-inner aui-list-item-arrow">
                        流浪男
                    </div>
                </div>
            </li>
        </ul>
```

<br>

**十二.表单**

```
<ul class="aui-list aui-form-list">
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Text
            </div>
            <div class="aui-list-item-input">
                <input type="text" placeholder="Name">
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Password
            </div>
            <div class="aui-list-item-input">
                <input type="password" placeholder="Password">
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Radio
            </div>
            <div class="aui-list-item-input">
                <label><input class="aui-radio" type="radio" name="demo1" checked> 选项一</label>
                <label><input class="aui-radio" type="radio" name="demo1"> 选项二</label>
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                CheckBox
            </div>
            <div class="aui-list-item-input">
                <label><input class="aui-checkbox" type="checkbox" name="demo1" checked> 选项一</label>
                <label><input class="aui-checkbox" type="checkbox" name="demo1"> 选项二</label>
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Select
            </div>
            <div class="aui-list-item-input">
                <select>
                    <option>Option1</option>
                    <option>Option2</option>
                    <option>Option3</option>
                </select>
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Switch
            </div>
            <div class="aui-list-item-input">
                <input type="checkbox" class="aui-switch" checked>
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Range
            </div>
            <div class="aui-list-item-input">
                <div class="aui-range">
                    <input type="range" class="aui-range" value="30" max="100" min="1" step="1" id="range"/>
                </div>
            </div>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-label">
                Textarea
            </div>
            <div class="aui-list-item-input">
                    <textarea placeholder="Textarea">
                    </textarea>
            </div>
        </div>
    </li>
</ul>
<script src="aui-range.js"></script>
<script>
    var range = new auiRange({
        element: document.getElementById("range")//滑块容器
    }, function (ret) {
        console.log(ret);
    })
</script>
```

<br>

**十三.选择器列表**

```
<ul class="aui-list aui-select-list">
    <li class="aui-list-header">带有单选或多选框的列表</li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <label><input class="aui-radio" type="radio" name="radio" checked> 这是一个列表项</label>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <label><input class="aui-radio" type="radio" name="radio"> 这是一个列表项</label>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <label><input class="aui-checkbox" type="checkbox" name="checkbox" checked> 这是一个列表项</label>
        </div>
    </li>
    <li class="aui-list-item">
        <div class="aui-list-item-inner">
            <label><input class="aui-checkbox" type="checkbox" name="checkbox"> 这是一个列表项</label>
        </div>
    </li>
</ul>
```

<br>

**十四.卡片列表**

```
<div class="aui-card-list">
    <div class="aui-card-list-header">
        卡片布局头部区域
    </div>
    <div class="aui-card-list-content-padded">
        内容区域，卡片列表布局样式可以实现APP中常见的各类样式
    </div>
    <div class="aui-card-list-footer">
        底部区域
    </div>
</div>

<div class="aui-card-list">
    <div class="aui-card-list-header">
        卡片布局头部区域
    </div>
    <div class="aui-card-list-content">
        <img src="demo2.png" />
    </div>
    <div class="aui-card-list-footer">
        <div><i class="aui-iconfont aui-icon-star"></i></div>
        <div><i class="aui-iconfont aui-icon-laud"></i></div>
        <div><i class="aui-iconfont aui-icon-note"></i></div>
    </div>
</div>
```

<br>

**十五.弹出菜单**

```
<section class="aui-content-padded">
    <div class="aui-btn aui-btn-primary" aui-popup-for="top-left">左上角</div>
    <div class="aui-btn aui-btn-primary" aui-popup-for="top">顶部中间</div>
    <div class="aui-btn aui-btn-primary" aui-popup-for="top-right">右上角</div>
    <div class="aui-btn aui-btn-primary" aui-popup-for="bottom-left">左下角</div>
    <div class="aui-btn aui-btn-primary" aui-popup-for="bottom">底部中间</div>
    <div class="aui-btn aui-btn-primary" aui-popup-for="bottom-right">右下角</div>
</section>
<div class="aui-popup aui-popup-top-left" id="top-left">
    <div class="aui-popup-arrow"></div>
    <div class="aui-popup-content">
        <ul class="aui-list aui-list-noborder">
            <li class="aui-list-item">
                <div class="aui-list-item-label-icon">
                    <i class="aui-iconfont aui-icon-my aui-text-warning"></i>
                </div>
                <div class="aui-list-item-inner aui-list-item-middle">
                    会员中心
                </div>
            </li>
            <li class="aui-list-item">
                <div class="aui-list-item-label-icon">
                    <i class="aui-iconfont aui-icon-mail aui-text-info"></i>
                </div>
                <div class="aui-list-item-inner">
                    会话消息
                </div>
            </li>
            <li class="aui-list-item">
                <div class="aui-list-item-label-icon">
                    <i class="aui-iconfont aui-icon-star aui-text-danger"></i>
                </div>
                <div class="aui-list-item-inner">
                    我的收藏
                </div>
            </li>
        </ul>
    </div>
</div>
<script src="aui-popup.js"></script>
<script>
    var popup = new auiPopup();
    function showPopup() {
        popup.show(document.getElementById("top-right"))
    }
</script>
```

<br>

**十六.宫格布局**

```
<section class="aui-grid aui-margin-b-15">
    <div class="aui-row">
        <div class="aui-col-xs-4">
            <i class="aui-iconfont aui-icon-home"></i>
            <div class="aui-grid-label">首页</div>
        </div>
        <div class="aui-col-xs-4">
            <i class="aui-iconfont aui-icon-gear"></i>
            <div class="aui-grid-label">设置</div>
        </div>
        <div class="aui-col-xs-4">
            <i class="aui-iconfont aui-icon-map"></i>
            <div class="aui-grid-label">地图</div>
        </div>
        <div class="aui-col-xs-4">
            <i class="aui-iconfont aui-icon-calendar"></i>
            <div class="aui-grid-label">日历</div>
        </div>
        <div class="aui-col-xs-4">
            <div class="aui-badge"></div>
            <i class="aui-iconfont aui-icon-date"></i>
            <div class="aui-grid-label">日期</div>
        </div>
        <div class="aui-col-xs-4">
            <div class="aui-dot"></div>
            <i class="aui-iconfont aui-icon-cart"></i>
            <div class="aui-grid-label">购物车</div>
        </div>
    </div>
</section>
```

<br>

**十七.搜索框**

```
<div class="aui-searchbar" id="search">
    <div class="aui-searchbar-input aui-border-radius" tapmode>
    <i class="aui-iconfont aui-icon-search"></i>
    <form action="#">
        <input type="search" placeholder="请输入搜索内容" id="search-input">
    </form>
</div>
<div class="aui-searchbar-cancel" tapmod>取消</div>
</div>
```

<br>

**十八.进度条**

```
<div class="aui-progress aui-progress">
    <div class="aui-progress-bar" style="width: 60%;"></div>
</div>
<div class="aui-progress aui-progress-sm">
    <div class="aui-progress-bar" style="width: 60%;"></div>
</div>
<div class="aui-progress aui-progress-xs">
    <div class="aui-progress-bar" style="width: 60%;"></div>
</div>
<div class="aui-progress aui-progress-xxs">
    <div class="aui-progress-bar" style="width: 60%;"></div>
</div>
```

<br>

**十九.Toast**

```
<div class="aui-content-padded">
    <div class="aui-btn  aui-btn-info" tapmode onclick="showDefault('success')">默认样式（toast）</div>
    <div class="aui-btn  aui-btn-success" tapmode onclick="showDefault('fail')">失败（toast）</div>
    <div class="aui-btn  aui-btn-success" tapmode onclick="showDefault('custom')">自定义</div>
    <div class="aui-btn  aui-btn-warning" tapmode onclick="showDefault('loading')">弹出loading样式（toast）</div>
</div>
<script type="text/javascript" src="aui-toast.js"></script>
<script type="text/javascript">
    var toast = new auiToast({});
    function showDefault(type) {
        switch (type) {
            case "success":
                toast.success({
                    title: "提交成功",
                    duration: 2000
                });
                break;
            case "fail":
                toast.fail({
                    title: "提交失败",
                    duration: 2000
                });
                break;
            case "custom":
                toast.custom({
                    title: "提交成功",
                    html: '<i class="aui-iconfont aui-icon-laud"></i>',
                    duration: 2000
                });
                break;
            case "loading":
                toast.loading({
                    title: "加载中",
                    duration: 2000
                }, function (ret) {
                    console.log(ret);
                    setTimeout(function () {
                        toast.hide();
                    }, 3000)
                });
                break;
            default:
                // statements_def
                break;
        }
    }
</script>
```

<br>

**二十.对话框**

```
<div class="aui-content-padded">
    <div class="aui-btn  aui-btn-info" tapmode onclick="openDialog('text')">基本dialog</div>
    <div class="aui-btn  aui-btn-primary" tapmode onclick="openDialog('callback')">带有回调的dialog</div>
    <div class="aui-btn  aui-btn-warning" tapmode onclick="openDialog('input')">带有输入框的dialog</div>
</div>
<script src="aui-dialog.js"></script>
<script type="text/javascript">
    var dialog = new auiDialog({});
    function openDialog(type) {
        switch (type) {
            case "text":
                dialog.alert({
                    title: "弹出提示",
                    msg: '这里是内容',
                    buttons: ['取消', '确定']
                }, function (ret) {
                    console.log(ret)
                });
                break;
            case "callback":
                dialog.alert({
                    title: "弹出提示",
                    msg: '这里是内容',
                    buttons: ['取消', '确定']
                }, function (ret) {
                    if (ret) {
                        dialog.alert({
                            title: "提示",
                            msg: "您点击了第" + ret.buttonIndex + "个按钮",
                            buttons: ['确定']
                        });
                    }
                });
                break;
            case "input":
                dialog.prompt({
                    title: "弹出提示",
                    text: '默认内容',
                    buttons: ['取消', '确定']
                }, function (ret) {
                    if (ret.buttonIndex == 2) {
                        dialog.alert({
                            title: "提示",
                            msg: "您输入的内容是：" + ret.text,
                            buttons: ['确定']
                        });
                    }
                });
                break;
            default:
                break;

        }
    }
</script>
```

<br>

**二十一.聊天气泡**

```
<section class="aui-chat">
    <div class="aui-chat-header">2016年7月13日</div>
    <div class="aui-chat-item aui-chat-left">
        <div class="aui-chat-media">
            <img src="demo2.png"/>
        </div>
        <div class="aui-chat-inner">
            <div class="aui-chat-name">AUI</div>
            <div class="aui-chat-content">
                <div class="aui-chat-arrow"></div>
                Hello AUI 2.0!
            </div>
        </div>
    </div>
    <div class="aui-chat-item aui-chat-right">
        <div class="aui-chat-media">
            <img src="demo2.png"/>
        </div>
        <div class="aui-chat-inner">
            <div class="aui-chat-name">流浪男</div>
            <div class="aui-chat-content">
                <div class="aui-chat-arrow"></div>
                你好！
            </div>
        </div>
    </div>
</section>
```

<br>

**二十二.下拉刷新**

```
<link rel="stylesheet" type="text/css" href="aui-pull-refresh.css"/>
<section class="aui-refresh-content">
    <div class="aui-content">
        <div id="demo">
            <div class="aui-card-list">
                <div class="aui-card-list-header">
                    卡片布局头部区域
                </div>
                <div class="aui-card-list-content-padded">
                    内容区域，卡片列表布局样式可以实现APP中常见的各类样式
                </div>
                <div class="aui-card-list-footer">
                    底部区域
                </div>
            </div>
        </div>
    </div>
</section>
<script src="aui-pull-refresh.js"></script>
<script type="text/javascript">
    var pullRefresh = new auiPullToRefresh({
        container: document.querySelector('.aui-refresh-content'),
        triggerDistance: 100
    }, function (ret) {
        if (ret.status == "success") {
            setTimeout(function () {
                var wrap = document.getElementById("demo")
                var lis = wrap.querySelectorAll('.aui-card-list');
                for (var i = lis.length, length = i + 10; i < length; i++) {
                    var html = '<div class="aui-card-list">' +
                        '<div class="aui-card-list-header">' +
                        '卡片布局头部区域' + (i + 1) + '' +
                        '</div>' +
                        '<div class="aui-card-list-content-padded">' +
                        '内容区域，卡片列表布局样式可以实现APP中常见的各类样式' +
                        '</div>' +
                        '<div class="aui-card-list-footer">' +
                        '底部区域' +
                        '</div>' +
                        '</div>';
                    wrap.insertAdjacentHTML('afterbegin', html);
                }
                pullRefresh.cancelLoading(); //刷新成功后调用此方法隐藏
            }, 1500)
        }
    })
</script>
```

<br>

**二十三.提示条**

```
<div class="aui-tips" id="tips-1">
    <i class="aui-iconfont aui-icon-info"></i>
    <div class="aui-tips-title">消息提示条消息提示条消息提示</div>
    <i class="aui-iconfont aui-icon-close"></i>
</div>
```

<br>

**二十四.轮播组件**

```
<link rel="stylesheet" type="text/css" href="aui-slide.css"/>
<div id="aui-slide">
    <div class="aui-slide-wrap">
        <div class="aui-slide-node bg-dark">
            <img src="demo2.png"/>
        </div>
        <div class="aui-slide-node bg-dark">
            <img src="demo2.png"/>
        </div>
        <div class="aui-slide-node bg-dark">
            <img src="demo2.png"/>
        </div>
    </div>
    <div class="aui-slide-page-wrap"><!--分页容器--></div>
</div>
<script type="text/javascript" src="aui-slide.js"></script>
<script type="text/javascript">
    var slide = new auiSlide({
        container: document.getElementById("aui-slide"),
        // "width":300,
        "height": 240,
        "speed": 500,
        "autoPlay": 3000, //自动播放
        "loop": true,
        "pageShow": true,
        "pageStyle": 'dot', //line
        'dotPosition': 'center'
    });
</script>
```

<br>

**二十五.控制皮肤主题**

```
<script src="aui-skin.js"></script>
<script>
    var skin = new auiSkin({
        name:"night", //皮肤样式名字，不能为中文
        skinPath:'aui-skin-night.css', //皮肤样式表路径
        default:false,//是否默认立即使用
        beginTime:"20:00",//开始时间
        endTime:"07:00"//结束时间
    });
    skin.setSkin(); //手动设置立即使用主题
    skin.removeSkin(); //手动设置取消当前主题
</script>
```