//闭包:避免全局变量的泛滥.
(function(window,undefined) {

    //每次用jQuery调用的时候,将直接返回一个jQuery的实例.达到无new调用的效果
    var jQuery = function(selector) {
        return new jQuery.fn.init(selector);
    };

    //jQuery原型
    jQuery.fn = jQuery.prototype = {
        //实例化jQuery对象
        init : function(selector) {
            //字符串类型
            if (typeof selector == 'string') {
                var nodeList = document.querySelectorAll(selector);
                this.selector = selector;
                this.length = nodeList.length;
                for (var i = 0; i < this.length; i++) {
                    this[i] = nodeList[i];
                }
                return this;
                //函数类型
            }else if(typeof selector == 'function'){
                jQuery.ready(selector);
                return;
            }
        },
        //添加类
        addClass : function(cls) {
            var reg = new RegExp('(\s|^)' + cls + '(\s|$)'); //(_|^)cls(_|$)
            for (var i = 0; i < this.length; i++) {
                if(!this[i].className.match(reg))
                    this[i].className += ' ' + cls;
            }
            return this;
        },
        //移除类
        removeClass : function(cls) {
            var reg = new RegExp('(\s|^)' + cls + '(\s|$)');
            for (var i = 0; i < this.length; i++) {
                if (this[i].className.match(reg))
                    this[i].className = this[i].className.replace(cls,'');
            }
            return this;
        },
        //设置style样式
        css : function(attr,val) {
            for(var i = 0;i < this.length; i++) {
                if(arguments.length == 1) {
                    return getComputedStyle(this[i],null)[attr];
                }
                this[i].style[attr] = val;
            }
            return this;
        }
    };

    //ready事件实现
    jQuery.ready = function(fn) {
        window.document.addEventListener('DOMContentLoaded',function() {
            fn && fn();
        },false);
        window.document.removeEventListener('DOMContentLoaded',fn,true);
    };

    //each实现
    jQuery.each = function(obj,callback) {
        if(Array.isArray(obj)) {
            for (var i = 0; i < obj.length; i++) {
                callback.call(this, i, obj[i]);
            }
        }else{
            for(var i in obj){
                callback.call(this,i,obj[i]);
            }
        }
    };

    jQuery.fn.init.prototype = jQuery.fn;

    //extend扩建（简单实现）
    jQuery.fn.extend = jQuery.extend = function() {
        var options = arguments[0];
        for( var i in options) {
            this[i] = options[i];
        }
    };

    //扩展静态方法
    jQuery.extend({
        fun1 : function(msg) {
            alert(msg)
        }
    });

    //扩展实例方法
    jQuery.fn.extend({
        fun2 : function(msg) {
            alert(msg)
        }
    });

    window.jQuery = window.$ = jQuery;

})(window,document);