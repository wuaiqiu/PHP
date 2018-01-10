# WeUI

```
<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
```


九宫格

```
<div class="weui-grids">
    <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
            <img src="add.png" alt="">
        </div>
        <p class="weui-grid__label">Button</p>
    </a>
    <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
            <img src="add.png" alt="">
        </div>
        <p class="weui-grid__label">List</p>
    </a>
    <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
            <img src="add.png" alt="">
        </div>
        <p class="weui-grid__label">List</p>
    </a>
</div>
```


flex

```
<div class="weui-flex">
    <div class="weui-flex__item">weui1</div>
    <div class="weui-flex__item">weui2</div>
    <div class="weui-flex__item">weui3</div>
</div>
```


button

```
<a href="javascript:;" class="weui-btn weui-btn_default">默认</a>
<a href="javascript:;" class="weui-btn weui-btn_primary">普通</a>
<a href="javascript:;" class="weui-btn weui-btn_warn">警告</a>
<a href="javascript:;" class="weui-btn weui-btn_primary weui-btn_disabled">禁用</a>
<a href="javascript:;" class="weui-btn weui-btn_plain-primary">镂空按钮</a>
```

list

```
#普通列表
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>标题文字</p>
        </div>
        <div class="weui-cell__ft">说明文字</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>标题文字</p>
        </div>
        <div class="weui-cell__ft">说明文字</div>
    </div>
</div>

#带图标
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__hd"><img src="add.png"></div>
        <div class="weui-cell__bd">
            <p>标题文字</p>
        </div>
        <div class="weui-cell__ft">说明文字</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><img src="add.png"></div>
        <div class="weui-cell__bd">
            <p>标题文字</p>
        </div>
        <div class="weui-cell__ft">说明文字</div>
    </div>
</div>

#带链接的列表
<div class="weui-cells">
    <a class="weui-cell weui-cell_access" href="https://www.baidu.com">
        <div class="weui-cell__bd">
            <p>cell standard</p>
        </div>
        <div class="weui-cell__ft">
        </div>
    </a>
    <a class="weui-cell weui-cell_access" href="https://www.baidu.com">
        <div class="weui-cell__bd">
            <p>cell standard</p>
        </div>
        <div class="weui-cell__ft">
        </div>
    </a>
</div>

#单选列表
<div class="weui-cells weui-cells_radio">
    <label class="weui-cell weui-check__label" for="x11">
        <div class="weui-cell__bd">
            <p>cell standard</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" class="weui-check" name="radio1" id="x11">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x12">
        <div class="weui-cell__bd">
            <p>cell standard</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" id="x12" checked="checked">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
</div>

#复选列表
<div class="weui-cells weui-cells_checkbox">
    <label class="weui-cell weui-check__label" for="s11">
        <div class="weui-cell__hd">
            <input type="checkbox" class="weui-check" name="checkbox1" id="s11" checked="checked">
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p>standard is dealt for u.</p>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="s12">
        <div class="weui-cell__hd">
            <input type="checkbox" name="checkbox1" class="weui-check" id="s12">
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p>standard is dealicient for u.</p>
        </div>
    </label>
</div>
```


滑动删除

```
<div class="weui-cells">
<div class="weui-cell weui-cell_swiped">
    <div class="weui-cell__bd">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>左滑列表</p>
            </div>
            <div class="weui-cell__ft">向左滑动试试</div>
        </div>
    </div>
    <div class="weui-cell__ft">
        <a class="weui-swiped-btn weui-swiped-btn_warn delete-swipeout" href="javascript:">删除</a>
        <a class="weui-swiped-btn weui-swiped-btn_default close-swipeout" href="javascript:">关闭</a>
    </div>
</div>
</div>

 $(document).on('swipeout-open',function () {
        console.log('open');
 });
 $(document).on('swipeout-close',function () {
        console.log('close');
 });
```


表单

```
#整体布局
<div class="weui-cells__title">表单</div>
<div class="weui-cells weui-cells_form">
  组件
</div>
<div class="weui-cells__tips">底部说明文字底部说明文字</div>

#普通表单
<div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">qq</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入qq号">
        </div>
</div>

#带按钮
<div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd">
            <label class="weui-label">手机号</label>
        </div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="tel" placeholder="请输入手机号">
        </div>
        <div class="weui-cell__ft">
            <button class="weui-vcode-btn">获取验证码</button>
        </div>
</div>

#带验证码
<div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" placeholder="请输入验证码">
        </div>
        <div class="weui-cell__ft">
            <img class="weui-vcode-img" src="vcode.jpg">
        </div>
</div>

#错误输入
<div class="weui-cell weui-cell_warn">
        <div class="weui-cell__hd"><label for="" class="weui-label">卡号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入卡号">
        </div>
        <div class="weui-cell__ft">
            <i class="weui-icon-warn"></i>
        </div>
</div>

#带开关
<div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">标题文字</div>
        <div class="weui-cell__ft">
            <input class="weui-switch" type="checkbox">
        </div>
</div>

<div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">兼容IE Edge的版本</div>
        <div class="weui-cell__ft">
            <label for="switchCP" class="weui-switch-cp">
                <input id="switchCP" class="weui-switch-cp__input" type="checkbox" checked="checked">
                <div class="weui-switch-cp__box"></div>
            </label>
        </div>
</div>

#文本框
<div class="weui-cell">
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" placeholder="请输入文本">
        </div>
</div>

#文本域
<div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" placeholder="请输入文本" rows="3"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
        </div>
</div>
```


文件上传

```
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <div class="weui-uploader">
                <div class="weui-uploader__hd">
                    <p class="weui-uploader__title">图片上传</p>
                    <div class="weui-uploader__info">0/2</div>
                </div>
                <div class="weui-uploader__bd">
                    <ul class="weui-uploader__files" id="uploaderFiles">
                        <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
                        <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
                        <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
                        <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                            <div class="weui-uploader__file-content">
                                <i class="weui-icon-warn"></i>
                            </div>
                        </li>
                        <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                            <div class="weui-uploader__file-content">50%</div>
                        </li>
                    </ul>
                    <div class="weui-uploader__input-box">
                        <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
```


全屏预览图片

```
<div class="weui-gallery" style="display: block">
    <span class="weui-gallery__img" style="background-image: url('add.png');"></span>
    <div class="weui-gallery__opr">
        <a href="javascript:" class="weui-gallery__del">
            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
        </a>
    </div>
</div>
```


滑动条

```
<div class="weui-slider-box" id="slider1">
    <div class="weui-slider">
        <div id="sliderInner" class="weui-slider__inner">
            <div id="sliderTrack" style="width: 75%;" class="weui-slider__track"></div>
            <div id="sliderHandler" style="left: 75%;" class="weui-slider__handler"></div>
        </div>
    </div>
    <div id="sliderValue" class="weui-slider-box__value">75</div>
</div>

$('#slider1').slider(function (percent) {
        console.log(percent)
})
```


消息页面

```
<div class="weui-msg">
    <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">操作成功</h2>
        <p class="weui-msg__desc">内容详情，可根据实际需要安排，如果换行则不超过规定长度，居中展现<a href="javascript:void(0);">文字链接</a></p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="javascript:;" class="weui-btn weui-btn_primary">推荐操作</a>
            <a href="javascript:;" class="weui-btn weui-btn_default">辅助操作</a>
        </p>
    </div>
    <div class="weui-msg__extra-area">
        <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="javascript:void(0);" class="weui-footer__link">底部链接文本</a>
            </p>
            <p class="weui-footer__text">Copyright © 2008-2016 weui.io</p>
        </div>
    </div>
</div>
```


进度条

```
<div class="weui-progress">
    <div class="weui-progress__bar">
        <div class="weui-progress__inner-bar js_progress" style="width: 80%;"></div>
    </div>
    <a href="javascript:;" class="weui-progress__opr">
        <i class="weui-icon-cancel"></i>
    </a>
</div>
```


对话框

```
#Alert
$.alert({
  title: '标题',
  text: '内容文案',
  onOK: function () {
    //点击确认
  }
});


#Confirm
$.confirm({
  title: '标题',
  text: '内容文案',
  onOK: function () {
    //点击确认
  },
  onCancel: function () {
  }
});

#Prompt
$.prompt({
  title: '标题',
  text: '内容文案',
  input: '输入框默认值',
  empty: false, // 是否允许为空
  onOK: function (input) {
    //点击确认
  },
  onCancel: function () {
    //点击取消
  }
});

#Login
$.login({
  title: '标题',
  text: '内容文案',
  username: 'tom',  // 默认用户名
  password: 'tom',  // 默认密码
  onOK: function (username, password) {
    //点击确认
  },
  onCancel: function () {
    //点击取消
  }
});
```


Loading

```
<div class="weui-loadmore">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">正在加载</span>
</div>
<div class="weui-loadmore weui-loadmore_line">
    <span class="weui-loadmore__tips">暂无数据</span>
</div>
<div class="weui-loadmore weui-loadmore_line weui-loadmore_dot">
    <span class="weui-loadmore__tips"></span>
</div>
```


ActionSheet

```
 $.actions({
        actions: [{
            text: "编辑",
            className: "color-primary",
            onClick: function() {
                //do something
            }
        },{
            text: "删除",
            onClick: function() {
                //do something
            }
        }]
});
//color-primary	color-success	color-danger	color-warning
//bg-primary	bg-success	bg-danger	bg-warning
```


Toast

```
$.toast.prototype.defaults.duration=1000;
$.toast("操作成功", "success");
$.toast("取消操作", "cancel");
$.toast("禁止操作", "forbidden");
$.toast("纯文本", "text");
$.toast("禁止操作", "forbidden", function() {
  //do something
});
```


Toptip

```
$.toptip('操作成功', 2000, 'success');
$.toptip('操作失败', 2000, 'error');
$.toptip('警告', 2000, 'warning');
```


Tabbar

```
<div class="weui-tab">
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <h1>页面一</h1>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <h1>页面二</h1>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
            <h1>页面三</h1>
        </div>
        <div id="tab4" class="weui-tab__bd-item">
            <h1>页面四</h1>
        </div>
    </div>

    <div class="weui-tabbar">
        <a href="#tab1" class="weui-tabbar__item weui-bar__item--on">
            <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>
            <div class="weui-tabbar__icon">
                <img src="icon_nav_button.png" alt="">
            </div>
            <p class="weui-tabbar__label">微信</p>
        </a>
        <a href="#tab2" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="icon_nav_msg.png" alt="">
            </div>
            <p class="weui-tabbar__label">通讯录</p>
        </a>
        <a href="#tab3" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="icon_nav_article.png" alt="">
            </div>
            <p class="weui-tabbar__label">发现</p>
        </a>
        <a href="#tab4" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="icon_nav_cell.png" alt="">
            </div>
            <p class="weui-tabbar__label">我</p>
        </a>
    </div>
</div>
```


导航栏

```
<div class="weui-tab">
    <div class="weui-navbar">
        <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
            选项一
        </a>
        <a class="weui-navbar__item" href="#tab2">
            选项二
        </a>
    </div>
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <h1>页面一</h1>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <h1>页面二</h1>
        </div>
    </div>
</div>
```


面板

```
<div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">图文组合列表</div>
    <div class="weui-panel__bd">
        <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
                <img class="weui-media-box__thumb" src="">
            </div>
            <div class="weui-media-box__bd">
                <h4 class="weui-media-box__title">标题一</h4>
                <p class="weui-media-box__desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
            </div>
        </a>
        <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
                <img class="weui-media-box__thumb" src="">
            </div>
            <div class="weui-media-box__bd">
                <h4 class="weui-media-box__title">标题二</h4>
                <p class="weui-media-box__desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
            </div>
        </a>
    </div>
    <div class="weui-panel__ft">
        <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link">
            <div class="weui-cell__bd">查看更多</div>
            <span class="weui-cell__ft"></span>
        </a>
    </div>
</div>
```


Preview

```
<div class="weui-form-preview">
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">付款金额</label>
        <em class="weui-form-preview__value">¥2400.00</em>
    </div>
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">商品</label>
            <span class="weui-form-preview__value">电动打蛋机</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">标题标题</label>
            <span class="weui-form-preview__value">名字名字名字</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">标题标题</label>
            <span class="weui-form-preview__value">很长很长的名字很长很长的名字很长很长的名字很长很长的名字很长很长的名字</span>
        </div>
    </div>
    <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">辅助操作</a>
        <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">操作</button>
    </div>
</div>
```


搜索栏

```
<div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form">
        <div class="weui-search-bar__box">
            <i class="weui-icon-search"></i>
            <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="">
            <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
        </div>
        <label class="weui-search-bar__label" id="searchText">
            <i class="weui-icon-search"></i>
            <span>搜索</span>
        </label>
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
</div>
```


Footer

```
<div class="weui-footer weui-footer_fixed-bottom ">
    <p class="weui-footer__text">Copyright © 2008-2016 weui.io</p>
</div>

<div class="weui-footer weui-footer_fixed-bottom">
    <p class="weui-footer__links">
        <a href="javascript:void(0);" class="weui-footer__link">底部链接</a>
    </p>
    <p class="weui-footer__text">Copyright © 2008-2016 weui.io</p>
</div>

<div class="weui-footer weui-footer_fixed-bottom">
    <p class="weui-footer__links">
        <a href="javascript:void(0);" class="weui-footer__link">底部链接</a>
        <a href="javascript:void(0);" class="weui-footer__link">底部链接</a>
    </p>
    <p class="weui-footer__text">Copyright © 2008-2016 weui.io</p>
</div>
```


图标

```
<i class="weui-icon-success"></i>
<i class="weui-icon-info"></i>
<i class="weui-icon-warn"></i>
<i class="weui-icon-waiting"></i>
<i class="weui-icon-circle"></i>
<i class="weui-icon-download"></i>
<i class="weui-icon-cancel"></i>
<i class="weui-icon-search"></i>

<i class="weui-icon-success-no-circle"></i>没有背景
<i class="weui-icon-info-circle"></i>加上圆圈
<i class="weui-icon-success weui-icon_msg"></i>变大
```