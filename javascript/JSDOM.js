/*
 * Document(表示HTML文档,继承于Node)
 * 		cookie		设置或返回与当前文档有关的所有 cookie
 * 		domain		返回当前文档的域名。
 *		referrer	返回载入当前文档的文档的 URL。
 *		title		返回当前文档的标题。
 *		URL			返回当前文档的 URL。
 *		
 *		getElementById(id)				返回对拥有指定 id 的第一个Element对象的引用。
 *		getElementsByName(name)			返回带有指定名称的Element对象集合。
 *		getElementsByTagName(TagName)	返回带有指定标签名的Element对象集合。
 *		createElement()					用给定的标签名创建一个新的元素
 *		createAttribute(String name)	创建一个新的 Attr 对象并返回.
 *		createTextNode()					创建一个文字节点
 *		
 * Element(表示HTML元素,继承于Node)
 * 		innerHTML				设置或返回元素的内容(标签与文本)
 * 		attributes				返回元素属性的集合（NamedNodeMap）
 * 		childNodes				返回元素子节点的集合（NodeList）
 *		firstChild				返回元素的首个子元素
 * 		lastChild				返回元素的最后一个子元素。
 * 		nextSibling				返回位于相同节点树层级的下一个节点。
 * 		previousSibling			返回位于相同节点树层级的前一个元素。
 *		parentNode				返回元素的父节点。
 * 		nodeName				返回元素的名称。	 【元素节点==>元素名 , 属性节点==>属性名 , 文本节点==>#text 】
 * 		nodeType				返回元素的节点类型。【元素节点==>1 , 属性节点==>2 , 文本节点==>3 】
 * 		nodeValue				设置或返回元素值。	 【元素节点==>null , 属性节点==>属性值 , 文本节点==>文本内容 】
 * 		ownerDocument			返回元素的根元素（文档对象）。 
 * 		
 * 		getAttribute(name)				返回元素节点的指定属性值。
 *  	removeAttribute(name)			从元素中移除指定属性。
 * 		setAttribute(name)				把指定属性设置或更改为指定值。
 * 		hasAttribute(name)				如果元素拥有指定属性，则返回true，否则返回 false。
 * 		hasAttributes()					如果元素拥有属性，则返回 true，否则返回 false。
 * 		appendChild(Node)				向元素添加新的子节点，作为最后一个子节点
 * 		insertBefore(Node)				在指定的已有的子节点之前插入新节点。
 * 		removeChild(Node)				从元素中移除子节点。
 * 		hasChildNodes()					如果元素拥有子节点，则返回 true，否则 false。
 * 		replaceChild(newNode,oldNode)	替换元素中的子节点。
 * 	
 * 	
 * Attr（属性对象）
 * 		name 		返回属性名
 * 		value 		返回属性值
 * 
 * 
 * NamedNodeMap（属性集合）
 * 		length 							 返回映射(map)中对象的数量。
 * 		
 * 		getNamedItem(AttrName)			 返回一个给定名字对应的属性节点（Attr）。
 * 		setNamedItem(AttrName,AttrValue) 替换或添加一个属性节点（Attr）到映射（map）中。
 * 		removeNamedItem(AttrName)		 移除一个属性节点（Attr）。
 * 
 * NodeList（节点集合）
 * 		length							返回 NodeList 中的节点数。
 * 		
 * 		item(index)						返回 NodeList 中位于指定下标的节点。
 * 		
 * 		
 */

//Cookie操作
document.cookie="name=zhangsan"; 
document.cookie="age=12";
console.log(document.cookie); //=>name=zhangsan; age=12

document.cookie="age=13";
console.log(document.cookie);//=>name=zhangsan; age=13

var date=new Date();
date.setTime(date.getTime()-1000);
document.cookie="age=13; expires="+date.toGMTString();
console.log(document.cookie);//=>name=zhangsan



/*
 * 
 *事件流
 *	（1）两种事件流模型
 *		 冒泡型事件流：事件的传播是从最特定的事件目标到最不特定的事件目标。即从DOM树的叶子到根。
 *		 捕获型事件流：事件的传播是从最不特定的事件目标到最特定的事件目标。即从DOM树的根到叶子。
 *
 *	（2）DOM事件流
 *		DOM标准采用捕获+冒泡。两种事件流都会触发DOM的所有对象，从document对象开始，也在document
 *		对象结束。
 *		
 *		DOM标准规定事件流包括三个阶段：
 *			事件捕获阶段：实际目标在捕获阶段不会接收事件。但是实际中都会在捕获阶段触发事件对象上的事件。
 *			处于目标阶段：事件在目标上发生并处理。事件处理会被看成是冒泡阶段的一部分。
 *			冒泡阶段：事件又传播回文档。
 *
 *======================================================================
 *		<div id="outer">
 *				<div id="middle">
 *						<div id="inner">
 *							click me!
 *						</div>
 *				</div>
 *		</div>
 *		
 *		当点击时:
 *		outer -> middle -> inner -> inner -> middle -> outer
 *======================================================================
 *	
 *
 *	（3）事件处理程序
 *=======================================================================
 *	1.html事件处理程序
 *			<button onclick="fun1()">点击</button>
 *				<script>
 *					function fun1(){
 *						console.log(event);	//返回事件对象	
 *					}
 *			</script>
 *======================================================================
 *	2.DOM0级事件处理程序；只能为一个元素添加一个事件处理函数
 *			<button id="btn">点击</button>
 *				<script>
 *					var myBtn=document.getElementById("btn");
 *					myBtn.onclick=function(){
 *							console.log(event);
 *					}
 *					myBtn.onclick=null; //删除事件
 *				</script>
 *===========================================================================
 *	3.DOM2级事件处理程序
 *			1)可以为一个元素天剑多个事件
 *				<button id="btn">点击</button>
 *				<script>
 *					var myBtn=document.getElementById("btn");	
 *					myBtn.addEventListener("click",function(){
 *						alert("hello");	
 *					},false);
 *					myBtn.addEventListener("click",function(){
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
 *				myBtn.removeEventListener("click",function(){
 *						alert("world");
 *				},false);
 *========================================================================
 *		4.Event对象
 *			
 *			type			用于获取事件类型
 *			target			用户获取事件目标 事件加在哪个元素上。（更具体target.nodeName）
 *			currentTarget	其事件处理程序当前正在处理事件的那个元素（currentTarget始终===this,即处理事件的元素）
 *
 *			stopPropagation()	 		用于阻止事件冒泡
 *			preventDefault()	 		阻止事件的默认行为
 *			stopImmediatePropagation()	可以阻止之后事件处理程序被调用。
 */