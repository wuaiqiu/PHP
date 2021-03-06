/*
 * Document（文档对象）		
 *		getElementById(id)				返回对拥有指定 id 的第一个Element对象的引用
 *		getElementsByName(name)			返回带有指定名称的Element[]
 *		getElementsByTagName(TagName)	返回带有指定标签名的Element[]
 *		createElement(TagName)			用给定的标签名创建一个新的元素
 *  createAttribute(AttrName) 创建属性节点。
 *		
 *
 * Element（元素对象）
 * 		parentNode							返回元素的父元素
 *  	childNodes							返回元素子元素的集合Element[]
 *		firstChild							返回元素的首个子元素
 * 		lastChild							返回元素的最后一个子元素
 * 		previousSibling						返回位于相同节点树层级的前一个元素
 * 		nextSibling							返回位于相同节点树层级的下一个元素
 * 		insertBefore(Element)				在指定的已有的子元素之前插入新元素
 * 		appendChild(Element)				向元素添加新的子元素，作为最后一个子元素
 * 		removeChild(Element)				从元素中移除子元素
 * 		hasChildNodes()						如果元素拥有子元素，则返回 true，否则 false
 * 		replaceChild(newElement,oldElement)	替换元素中的子元素
 * 		cloneNode(true)						克隆元素，true为克隆所有后代
 * 		
 * 		getAttribute(name)					返回元素节点的指定属性值
 * 		setAttribute(name,value)			把指定属性设置或更改为指定值。
 *  	removeAttribute(name)				从元素中移除指定属性。
 * 		hasAttributes()						如果元素拥有属性，则返回 true，否则返回 false。
 * 		hasAttribute(name)					如果元素拥有指定属性，则返回true，否则返回 false。
 * 
 * 		innerHTML							设置或返回元素的内容(标签与文本)
 * 		
 *    style.property          设置或返回元素的样式
 * 		
 */


/*
 *	
 *事件流
 *
 *	（1）两种事件流模型
 *		 冒泡型事件流：事件的传播是从最特定的事件目标到最不特定的事件目标。即从DOM树的叶子到根。
 *		 捕获型事件流：事件的传播是从最不特定的事件目标到最特定的事件目标。即从DOM树的根到叶子。
 *	
 *	
 *	（2）事件处理程序
 *		1）.html事件处理程序（冒泡）
 *			<button onclick="fun1()">点击</button>
 *				<script>
 *					function fun1(e){
 *						console.log(e);	//返回事件对象	
 *					}
 *			</script>
 *		2）.DOM0级事件处理程序；只能为一个元素添加一个事件处理函数（冒泡）
 *			<button id="btn">点击</button>
 *				<script>
 *					var myBtn=document.getElementById("btn");
 *					myBtn.onclick=function(e){
 *							console.log(e);
 *					}
 *					myBtn.onclick=null; //删除事件
 *				</script>
 *		3）.DOM2级事件处理程序（冒泡或捕获）
 *			1)可以为一个元素添加多个相同的事件
 *				<button id="btn">点击</button>
 *				<script>
 *					var myBtn=document.getElementById("btn");	
 *					myBtn.addEventListener("click",function(e){
 *						alert("hello");	
 *					},false);
 *					myBtn.addEventListener("click",function(e){
 *						alert("world");
 *					},false);
 *				</script>
 *
 *			2)addEventListener()和removeEventListener()
 *				这两个方法都需要3个参数：事件名，事件处理函数，布尔值。
 *					true,在捕获阶段处理事件，
 *					false，在冒泡阶段处理事件，默认为false。
 *			
 *			3)通过addEventListener添加的事件处理程序必须通过removeEventListener删除，且参数一致。
 *			且不能是匿名函数，如下
 *				myBtn.removeEventListener("click",functione(){
 *						alert("world");
 *				},false);
 *
 *
 *	（3）Event对象	
 *			type			用于获取事件类型
 *			target			用户获取事件目标 事件加在哪个元素上。（更具体target.nodeName）
 *			currentTarget	其事件处理程序当前正在处理事件的那个元素（currentTarget始终===this,即处理事件的元素）
 *
 *			stopPropagation()	 		用于阻止事件冒泡
 *			preventDefault()	 		   阻止事件的默认行为
 *			stopImmediatePropagation()	立即阻止所有事件执行。
 */