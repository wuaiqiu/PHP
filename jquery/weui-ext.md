# WeUI-EXT

下拉刷新

```
<body class="weui-pull-to-refresh">

    <div class="weui-pull-to-refresh__layer">
        <div class="weui-pull-to-refresh__arrow"></div>
        <div class="weui-pull-to-refresh__preloader"></div>
        <div class="down">下拉刷新</div>
        <div class="up">释放刷新</div>
        <div class="refresh">正在刷新</div>
    </div>

    <h1 class="demos-title">下拉刷新</h1>
    <p>Time: <span id="time">下拉我试试</span></p>

</body>

<script>
    $(document.body).pullToRefresh(function() {
        setTimeout(function() {
            $("#time").text(new Date);
            $(document.body).pullToRefreshDone();
        }, 2000);
    });
</script>
```


滚动加载

```
<div class="weui-loadmore">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">正在加载</span>
</div>

var loading = false;
$(document.body).infinite().on("infinite", function() {
        if(loading) return;
        loading = true;
        setTimeout(function() {
            $("#list").append("<p>Hello world</p>");
            loading = false;
        }, 2000);
});
```


计数器

```
<div class="weui-cell">
     <div class="weui-cell__bd">
            <p>优衣库轻薄羽绒服</p>
     </div>
     <div class="weui-cell__ft">
           <div class="weui-count">
                 <a class="weui-count__btn weui-count__decrease"></a>
                 <input class="weui-count__number" type="number" value="1">
                 <a class="weui-count__btn weui-count__increase"></a>
           </div>
     </div>
</div>

var MAX = 99, MIN = 1;
$('.weui-count__decrease').click(function (e) {
       var $input = $(e.currentTarget).parent().find('.weui-count__number');
       var number = parseInt($input.val() || "0") - 1
       if (number < MIN) number = MIN;
        $input.val(number)
})
$('.weui-count__increase').click(function (e) {
        var $input = $(e.currentTarget).parent().find('.weui-count__number');
        var number = parseInt($input.val() || "0") + 1
        if (number > MAX) number = MAX;
        $input.val(number)
})
```


幻灯片

```
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>

<div class="swiper-container swiper-container-horizontal">
    <div class="swiper-wrapper" style="transform: translate3d(-640px, 0px, 0px); transition-duration: 0ms;">
        <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 320px;"><img src="swiper-3.jpg"></div>
        <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="0" style="width: 320px;"><img src="swiper-1.jpg"></div>
        <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1" style="width: 320px;"><img src="swiper-2.jpg"></div>
        <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="2" style="width: 320px;"><img src="swiper-3.jpg"></div>
        <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 320px;"><img src="swiper-1.jpg"></div></div>
    <div class="swiper-pagination swiper-pagination-bullets">
        <span class="swiper-pagination-bullet"></span>
        <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
        <span class="swiper-pagination-bullet"></span>
    </div>
</div>

$(".swiper-container").swiper({
        loop: true,
        autoplay: 3000
});
```


查看图片

```
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>

<div class="demos-content-padded">
    <a href="javascript:;" class="weui-btn weui-btn_primary" id="pb2">带说明文案</a>
</div>

 var pb2 = $.photoBrowser({
        items: [
            {
                image: "swiper-1.jpg",
                caption: "尝试 Vue.js 最简单的方法是使用 JSFiddle Hello World 例子。在浏览器新标签页中打开它，跟着我们查看一些基础示例。如果你喜欢用包管理器下载/安装，查看安装教程。"
            },
            {
                image: "swiper-2.jpg",
                caption: "组件（Component）是 Vue.js 最强大的功能之一。"
            },
            {
                image: "swiper-3.jpg",
                caption: "组件可以扩展 HTML 元素，封装可重用的代码"
            }
        ],
        initIndex: 2
});
$("#pb2").click(function() {
     pb2.open();
});
```


日历

```
 <div class="weui-cell">
        <div class="weui-cell__hd"><label for="date" class="weui-label">日期</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="date" type="text" readonly="">
        </div>
 </div>

$("#date").calendar({
         multiple: true,//多选
         value: ['2016-12-12'],//默认值
         dateFormat: 'yyyy年mm月dd日',  // 自定义格式
         minDate:2015-06-01, //最小值
         maxDate:2015-08-01,//最大值
         closeOnSelect:true,//选择一个后关闭
         onChange: function (p, values, displayValues) {
             console.log(values, displayValues);
         }
});
```


日期时间选择器

```
<div class="weui-cell">
     <div class="weui-cell__hd"><label for="time" class="weui-label">时间</label></div>
     <div class="weui-cell__bd">
         <input class="weui-input" id="time" type="text" value="" readonly="">
     </div>
</div>

$("#time").datetimePicker({
        title: '出发时间',
        min: "1990-12-12",
        max: "2022-12-12 12:12",
        years: [2017, 2018], //限定年
        monthes: ['06', '07'],//限定月
        yearSplit: '年', //设置单位
        monthSplit: '月',
        dateSplit: '日',
        onChange: function (picker, values, displayValues) {
            console.log(values);
        }
});
```


picker

```
<div class="weui-cell">
      <div class="weui-cell__hd"><label for="name" class="weui-label">称呼</label></div>
      <div class="weui-cell__bd">
           <input class="weui-input" id="name" type="text" value="" readonly="">
      </div>
</div>

$("#name").picker({
        title: "怎么称呼您？",
        cols: [
            {
                textAlign: 'center',
                values: ['Mr', 'Ms']
            },
            {
                textAlign: 'center',
                values: ['Amy', 'Bob', 'Cat', 'Dog', 'Ella', 'Fox', 'Google']
            }
        ],
        onChange: function(p, v, dv) {
                console.log(p, v, dv);
        },
        onClose: function(p, v, d) {
                console.log("close");
        }
});
```


地址选择器

```
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

<div class="weui-cell">
      <div class="weui-cell__hd"><label for="start" class="weui-label">发出地</label></div>
      <div class="weui-cell__bd">
          <input class="weui-input" id="start" type="text" value="湖北省 武汉市 武昌区" readonly="" data-code="420106" data-codes="420000,420100,420106">
      </div>
</div>

$("#start").cityPicker({
        title: "选择出发地",
        onChange: function (picker, values, displayValues) {
            console.log(values, displayValues);
        }
});
```


Popup

```
<div class="demos-content-padded">
    <a href="javascript:;" class="weui-btn weui-btn_primary open-popup" data-target="#half">显示底部的Popup</a>
</div>

<div id="half" class="weui-popup__container popup-bottom">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal">
        <div class="toolbar">
            <div class="toolbar-inner">
                <a href="javascript:;" class="picker-button close-popup">关闭</a>
                <h1 class="title">标题</h1>
            </div>
        </div>
        <div class="modal-content">
            <div class="weui-grids">
                <a href="javascript:;" class="weui-grid js_grid" data-id="dialog">
                    <div class="weui-grid__icon">
                        <img src="icon_nav_dialog.png" alt="">
                    </div>
                    <p class="weui-grid__label">
                        发布
                    </p>
                </a>
                <a href="javascript:;" class="weui-grid js_grid" data-id="progress">
                    <div class="weui-grid__icon">
                        <img src="icon_nav_progress.png" alt="">
                    </div>
                    <p class="weui-grid__label">
                        编辑
                    </p>
                </a>
                <a href="javascript:;" class="weui-grid js_grid" data-id="msg">
                    <div class="weui-grid__icon">
                        <img src="icon_nav_msg.png" alt="">
                    </div>
                    <p class="weui-grid__label">
                        保存
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>

$(document).on("open", ".weui-popup-modal", function() {
        console.log("open popup");
}).on("close", ".weui-popup-modal", function() {
        console.log("close popup");
});
```