/*
 * BOM
 * 
 * 	Window
 * 		所有 JavaScript 全局对象、函数以及变量均自动成为 window 对象的成员。
 * 		
 * 		document	对 Document 对象的只读引用
 * 		history		对 History 对象的只读引用
 * 		location	用于窗口或框架的 Location 对象
 * 		navigator	对 Navigator 对象的只读引用
 * 		screen		对 Screen 对象的只读引用
 * 	
 * 		alert()					显示带有一段消息和一个确认按钮的警告框
 * 		setInterval(fun(),50)	按照指定的周期（以毫秒计）来调用函数或计算表达式,并返回id
 * 		clearInterval(id)		取消 setInterval()
 * 		setTimeout(fun(),50)	在指定的毫秒数后调用函数或计算表达式,并返回id
 * 		clearTimeout(id)			取消 setTimeout() 
 *		js是运行于单线程环境中，定时器作用是在规定时间内将事件加入执行队列，而加入的前提是当前事件队列没有任何东西
 * 	
 * 	Navigator
 * 		Navigator 对象包含有关浏览器的信息。
 * 
 * 		appName				返回浏览器的名称。
 * 		appVersion			返回浏览器的平台和版本信息。
 * 		browserLanguage		返回当前浏览器的语言。
 * 		cookieEnabled		返回指明浏览器中是否启用 cookie 的布尔值。
 * 		platform			返回运行浏览器的操作系统平台。
 * 		systemLanguage		返回 OS 使用的默认语言。
 * 		userAgent			返回由客户机发送服务器的 user-agent 头部的值。
 * 
 * 	Screen
 * 		Screen 对象包含有关客户端显示屏幕的信息
 * 		
 * 		availWidth 			可用的屏幕宽度		
 * 		availHeight 		可用的屏幕高度
 * 		height				返回显示屏幕的高度
 * 		width				返回显示器屏幕的宽度。
 * 
 * 	History
 * 		History 对象包含用户（在浏览器窗口中）访问过的 URL。
 * 		
 * 		length			返回浏览器历史列表中的 URL 数量。
 * 
 * 		back()			加载 history 列表中的前一个 URL。
 * 		forward()		加载 history 列表中的下一个 URL。
 * 		go(n)			加载 history 列表中的某个具体页面。go(-1)=>back() go(1)=>forward()
 * 	
 * 	Location
 * 		Location 对象包含有关当前 URL 的信息
 * 		
 * 		 href		设置或返回完整的 URL。
 * 		 protocol	设置或返回当前 URL 的协议。
 *     host   设置或返回主机名和当前 URL 的端口号。 
 *      pathname 设置或返回当前页面的路径和文件名。
 * 		 search		设置或返回从问号 (?) 开始的 URL（查询部分）。
 *      hash   设置或返回从井号 (#) 开始的 URL（锚）。
 */