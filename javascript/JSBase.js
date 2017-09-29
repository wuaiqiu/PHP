/*
一.javascript输出
	
	javascript是解释型语言，动态语言

	(1)使用window.alert()弹出警告框。
	
	(2)使用document.write()方法将内容写到HTML文档中。注意：如果在文档已完成加载后执行
	document.write，整个 HTML 页面将被覆盖。

	=======================================================================	
		<p>我的第一个段落。</p>
		<button onclick="myFunction()">点我</button>

		<script>
			function myFunction() {
   				document.write(Date());
			}
		</script>
	=======================================================================
	
	(3)使用innerHTML写入到HTML元素。改变 HTML元素的内容

	=======================================================================
		<p id="p1">我的第一个段落。</p>
		
		<script>
   			document.getElementById('p1').innerHTML=Date();
		</script>		
	=======================================================================
	
	(4)使用console.log()写入到浏览器的控制台。
	
二.JavaScript注释
		
	(1)单行注释以 // 开头。
	
	(2)多行注释以 /* 开始，以 结尾
	
 */