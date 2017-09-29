/*
一.DOM

	当网页被加载时，浏览器会创建页面的文档对象模型（Document Object Model）。
	
	(1)查找 HTML 元素
	
		a.通过 id 查找 HTML 元素
			var x=document.getElementById("intro");
		b.通过标签名查找 HTML 元素,返回数组
			var y=document.getElementsByTagName("p");
		c.通过类名找到 HTML 元素，返回数组
			var x=document.getElementsByClassName("intro");
		
	(2)改变 HTML 属性
		document.getElementById(id).attribute="新属性值";
	
	(3)改变 HTML 内容
		document.getElementById(id).innerHTML="新的 HTML";
		
	(4)改变 HTML 样式
		document.getElementById(id).style.property="新样式";
		
二.BOM

	(1)Window对象
		所有 JavaScript 全局对象、函数以及变量均自动成为 window 对象的成员。全局变量是 window 对象的属
性。全局函数是 window 对象的方法。甚至 HTML DOM 的 document 也是 window 对象的属性之一：

	window.document.getElementById("header");
	
	(2)Window Screen
		window.screen对象在编写时可以不使用 window 这个前缀。
			screen.availWidth - 可用的屏幕宽度		
			screen.availHeight - 可用的屏幕高度
		
	(3)Window Location
		window.location 对象在编写时可不使用 window 这个前缀。 
			location.hostname 返回 web 主机的域名
			location.pathname 返回当前页面的路径和文件名
			location.port 返回 web 主机的端口 （80 或 443）
			location.protocol 返回所使用的 web 协议（http:// 或 https://）
			
	(4)Window History
		window.history对象在编写时可不使用 window 这个前缀。为了保护用户隐私，对 JavaScript 访问该
	对象的方法做出了限制。
			history.back() - 与在浏览器点击后退按钮相同
			history.forward() - 与在浏览器中点击按钮向前相同
			
	(5)Window Navigator
		window.navigator 对象在编写时可不使用 window 这个前缀。window.navigator对象包含有关访问者浏
	览器的信息。来自navigator对象的信息具有误导性，不应该被用于检测浏览器版本
		
三.事件流

	（1）两种事件流模型

		冒泡型事件流：事件的传播是从最特定的事件目标到最不特定的事件目标。即从DOM树的叶子到根。

		捕获型事件流：事件的传播是从最不特定的事件目标到最特定的事件目标。即从DOM树的根到叶子。

	（2）DOM事件流

		DOM标准采用捕获+冒泡。两种事件流都会触发DOM的所有对象，从document对象开始，也在document对象结束。

		DOM标准规定事件流包括三个阶段：事件捕获阶段、处于目标阶段和事件冒泡阶段。
			事件捕获阶段：实际目标在捕获阶段不会接收事件。但是实际中都会在捕获阶段触发事件对象上的事件。
			处于目标阶段：事件在目标上发生并处理。事件处理会被看成是冒泡阶段的一部分。
			冒泡阶段：事件又传播回文档。

		======================================================================
			<div id="outer">
			    <div id="middle">
        			<div id="inner">
            				click me!
        			</div>
    			    </div>
			</div>


		当点击时:
		outer -> middle -> inner -> inner -> middle -> outer
		
		======================================================================

	(3)事件处理程序

		=======================================================================
		
		1.html事件处理程序

		<button onclick="fun1()">点击</button>
		<script>
			function fun1(){
				console.log(event);	//返回事件对象	
			}
		</script>
		
		=======================================================================
		
		2.DOM0级事件处理程序
		
			只能为一个元素添加一个事件处理函数

		<button id="btn">点击</button>
		<script>
	   		 var myBtn=document.getElementById("btn");
    			 myBtn.onclick=function(){
        			console.log(event);
    			 }
		
			 myBtn.onclick=null; //删除事件
		</script>

		===========================================================================
		
		3.DOM2级事件处理程序

			可以为一个元素天剑多个事件

			<button id="btn">点击</button>
			<script>
    				var myBtn=document.getElementById("btn");
    				
				myBtn.addEventListener("click",function(){
        				alert("hello");	
    				},false);
    				
				myBtn.addEventListener("click",function(){
				        alert("world");
    				},false);
			</script>

		
			addEventListener()和removeEventListener()。
		
			这两个方法都需要3个参数：事件名，事件处理函数，布尔值。
	
			true,在捕获阶段处理事件，
			false，在冒泡阶段处理事件，默认为false。


			通过addEventListener添加的事件处理程序必须通过removeEventListener删除，且参数一致。
			且不能是匿名函数，如下
			
				 myBtn.removeEventListener("click",function(){
				        alert("world");
				  },false);
		=========================================================================
		
		4.event对象
		
		属性:
		type属性，用于获取事件类型
		target属性，用户获取事件目标 事件加在哪个元素上。（更具体target.nodeName）
		currentTarget属性，其事件处理程序当前正在处理事件的那个元素（currentTarget始终===this,即处理事件的元素）

		方法：
		stopPropagation()方法 用于阻止事件冒泡
		preventDefault()方法 阻止事件的默认行为 移动端用的多
		stopImmediatePropagation()可以阻止之后事件处理程序被调用。
*/