# jqueryPlugin

**(1).通过$.extend()来扩展jQuery**

```
给jQuery身上添加了一个静态方法而以。所以我们调用通过$.extend()添加的函数，而不需要选中DOM元素

$.extend({
    sayHello: function(name) {
        console.log('Hello,' + (name ? name : 'Dude') + '!');
    }
})
$.sayHello(); //调用
$.sayHello('Wayou'); //带参调用
```

<br>

**(2).通过$.fn 向jQuery添加新的方法**

```
<a href="http://www.baidu.com">百度</a>
<a href="http://www.sina.com">新浪</a>
<a href="http://wwww.tencent.com">腾讯</a>

$.fn.myPlugin = function() {
     //在这里面,this指的是用jQuery选中的元素$('a')
     this.css('color', 'red');
}
$('a').myPlugin();

#遍历每一个元素
$.fn.myPlugin = function() {
    this.css('color', 'red');
    this.each(function () {
        //这里的this指的是每一个Dom元素
        $(this).append($(this).attr('href'));
    });
}
$('a').myPlugin();

#支持链式调用
$.fn.myPlugin = function() {
     this.css('color', 'red');
     //返回this,即$('a')
     return this.each(function() {
         $(this).append($(this).attr('href'));
     });
}
$('a').myPlugin().css('textDecoration','none');

#让插件接收参数(保护好默认参数)
$.fn.myPlugin = function(options) {
      var defaults = {
          'color': 'red',
          'fontSize': '12px'
      };
      //将一个空对象做为第一个参数,defaults，options的共同属性会合并
      var settings = $.extend({},defaults, options);
      return this.css({
           'color': settings.color,
           'fontSize': settings.fontSize
      });
}
$('a').myPlugin({'color':'green'});

#面向对象的插件开发
//定义Beautifier的构造函数
var Beautifier = function(ele, opt) {
        this.element = ele,
        this.defaults = {
            'color': 'red',
             'fontSize': '12px'
        },
        this.options = $.extend({}, this.defaults, opt);
}
//定义Beautifier的方法(以后利用这个扩展方法)
Beautifier.prototype = {
     beautify: function() {
          return this.element.css({
              'color': this.options.color,
              'fontSize': this.options.fontSize
          });
     }
}
//在插件中使用Beautifier对象
$.fn.myPlugin = function(options) {
     //创建Beautifier的实体
     var beautifier = new Beautifier(this, options);
     //调用其方法
     return beautifier.beautify();
}
$('a').myPlugin({'color':'green'});

#用自调用匿名函数包裹你的代码（避免污染全局命名空间）
//；避免与前面没带；的代码融合，window，document避免内部修改对全局造成影响，undefined避免外界修改了
;(function($, window, document,undefined) {
       //定义Beautifier的构造函数
       var Beautifier = function(ele, opt) {
              this.element = ele, 
              this.defaults = {
                  'color': 'red',
                  'fontSize': '12px'
               },
              this.options = $.extend({}, this.defaults, opt)
        }
        //定义Beautifier的方法
        Beautifier.prototype = {
            beautify: function() {
                return this.element.css({
                    'color': this.options.color,
                    'fontSize': this.options.fontSize
                });
            }
        }
        //在插件中使用Beautifier对象
        $.fn.myPlugin = function(options) {
            //创建Beautifier的实体
            var beautifier = new Beautifier(this, options);
            //调用其方法
            return beautifier.beautify();
        }
})(jQuery, window, document);
$('a').myPlugin({'color':'green'});
```