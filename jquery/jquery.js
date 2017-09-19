(function(window,undefined){
//整体采用函数表达式自执行，传入参数window对象
	
	//jQuery构造函数
	var jQuery = function() {
		return new jQuery.fn.init();
	};
	

	//jQuery.fn对象，jQuery函数的prototype
	jQuery.fn = jQuery.prototype = {
			
			//改变构造器
			constructor: jQuery,
			
			//jQuery初始化函数
			init:function() {
				
			},
			//其他属性方法
			name:"zhangsan"
	 };
	
	//改变初始化函数的原型链
	jQuery.fn.init.prototype = jQuery.fn;
	
	
	//向jQuery函数（或者jQuery.fn对象）中添加扩展属性
	//jQuery.extend(object) 为扩展 jQuery 类本身，为类添加新的方法。
	//jQuery.fn.extend(object) 给 jQuery 对象添加方法
	jQuery.extend = jQuery.fn.extend =function(){
			var obj=arguments[0];
			for(var p in obj){
				this[p]=obj[p];
			}
			return this;
	};

	//向jQuery类添加属性
	jQuery.extend({
		age:12,
		run:function(){}
	 });

	
	//回调函数队列。
	jQuery.Callbacks = function( options ) {
		self={
			add:function(){
				console.log("this is add function");
			}	
		};
		return self;
	}
	
})(window)	