# bootstrapCss
							

**一.基本模板**
	
```
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="jquery.min.js"></script>
     <script src="bootstrap.min.js"></script>
  </head>
  <body>
   
   
   
  </body>
</html>
```

<br/>

**二.栅格系统**

(1).固定宽度

```	
<div class="container">
   <div class="row">
      <div class="col-md-4">col-md-4</div>
      <div class="col-md-4">col-md-4</div>
      <div class="col-md-4">col-md-4</div>
   </div>
</div>
```

(2).100%宽度

```
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">col-md-4</div>
	<div class="col-md-4">col-md-4</div>
	<div class="col-md-4">col-md-4</div>
    </div>
</div>
```
				
(3).列重置

```
<div class="row">
	<div class="col-md-3">col-md-3</div>
	<div class="col-md-3">col-md-3</div>
	
	<div class="clearfix visible-xs-block"></div>
	
	<div class="col-md-3">col-md-3</div>
	<div class="col-md-3">col-md-3</div>
</div>
```

(4).列偏移

```
<div class="container">	
    <div class="row">	
	 <div class="col-xs-8">8</div>	
	 <div class="col-md-3 col-xs-offset-1">3</div> 
    </div>
</div>
```

(5).列嵌套

```	
<div class="container">	
   <div class="row">	
	<div class="col-md-8">
	  <div class="row">
	     <div class="col-md-8">8</div>	
	     <div class="col-md-4">4</div>
	  </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
```
		
(6).列排序

```
<div class="container">	
	<div class="row">	
		<div class="col-md-9 col-md-push-3">9</div>	
		<div class="col-md-3 col-md-pull-9">3</div>
	</div>
</div>
```

<br/>

**三.文档**

(1).标题

```
<h1>主标题<small>副标题</small></h1>
<h2>主标题<small>副标题</small></h2>
<h3>主标题<small>副标题</small></h3>
<h4>主标题<small>副标题</small></h4>
<h5>主标题<small>副标题</small></h5>
<h6>主标题<small>副标题</small></h6>

<!--页面标题-->
<div class="page-header">
    <h1>页面标题实例<small>子标题</small></h1>
</div>
```

(2).内联文本元素

```
<mark>高亮</mark>
<del>删除线</del>
<u>下划线</u>
<small>小号字体</small>
<strong>粗体</strong>
<em>斜体</em>
```

(3).文本样式

```
<!--文本格式-->
<p class="text-left">左对齐</p>
<p class="text-center">中间对齐</p>
<p class="text-right">右对齐</p>
<p class="text-nowrap">不换行</p>
<p class="text-lowercase">小写字母</p>
<p class="text-uppercase">大写字母</p>
<p class="text-capitalize">首字母大写</p>
<p class="hidden">隐藏(不占空间)</p>
<p class="sr-only">隐藏(不占空间,阅读器显示)</p>
<p class="center-block">块级中间对齐</p>

<!--文本颜色-->
<p class="text-muted">text-muted</p>
<p class="text-primary">text-primary</p>
<p class="text-success">text-success</p>
<p class="text-info">text-info</p>
<p class="text-warning">text-warning</p>
<p class="text-danger">text-danger</p>

<!--背景-->
<p class="bg-primary">bg-primary</p>
<p class="bg-success">bg-success</p>
<p class="bg-info">bg-info</p>
<p class="bg-warning">bg-warning</p>
<p class="bg-danger">bg-danger</p>
```

(4).缩写

```
<abbr title="World Wide Web">WWW</abbr><br>
<abbr title="Real Simple Syndication" class="initialism">RSS（更小的字体）</abbr>
```

(5).地址

```
<address>
  <strong>Some Company, Inc.</strong><br>
  007 street<br>
  Some City, State XXXXX<br>
  <abbr title="Phone">P:</abbr> (123) 456-7890
</address>
```

(6).引用文本

```
<!--基本格式-->
<blockquote>
 	百度拥有数万名研发工程师，这是中国乃至全球最为优秀的技术团队。
<small><cite title="www.baidu.com">Baidu</cite></small>
</blockquote>

<!--右对齐-->
<blockquote class="blockquote-reverse">
 	百度拥有数万名研发工程师，这是中国乃至全球最为优秀的技术团队。
<small><cite title="www.baidu.com">Baidu</cite></small>
</blockquote>
```

(7).代码

```
<code>内联代码</code>
<pre>块级代码</pre>
<pre class="pre-scrollable">带有滚动条的块级代码大于340px</pre>
```

<br/>

**四.表单**

(1).垂直表单

```
<form>
	<div class="form-group">
		<label for="name">名称</label>
		<input type="text" class="form-control" id="name"  placeholder="请输入名称">
	</div>
	<div class="form-group">
		 <label for="pass">密码:</label>
	       <input type="password" class="form-control" id="pass" placeholder="Password"/>
	</div>
	<button type="submit" class="btn btn-default">提交</button>
</form>
```

(2).内联表单

```
<form class="form-inline">
  
  <div class="form-group">
     <label for="name">名称:</label>
       <input type="text" class="form-control" id="name" placeholder="Name"/>
  </div>
  
  <div class="form-group">
     <label for="pass">密码:</label>
       <input type="password" class="form-control" id="pass" placeholder="Password"/>
  </div>
  
  <button type="submit" class="btn btn-default">提交</button>	
  
</form>
```

(3).水平表单

```
<form class="form-horizontal">

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email:</label>
        <p class="form-control-static col-sm-2" id="email">email@example.com</p>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">名称:</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="name" placeholder="Name"/>
        </div>
    </div>

    <div class="form-group">
        <label for="pass" class="col-sm-2 control-label">密码:</label>
        <div class="col-sm-2">
        <input type="password" class="form-control" id="pass" placeholder="Password"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-2">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>

</form>
```

(4).按钮

```
<!--按钮颜色-->
<button type="button" class="btn btn-default">默认按钮</button>
<button type="button" class="btn btn-primary">原始按钮</button>
<button type="button" class="btn btn-success">成功按钮</button>
<button type="button" class="btn btn-info">信息按钮</button>
<button type="button" class="btn btn-warning">警告按钮</button>
<button type="button" class="btn btn-danger">危险按钮</button>
<button type="button" class="btn btn-link">链接按钮</button>

<!--按钮大小-->
<button type="button" class="btn  btn-primary btn-lg">大的按钮</button>
<button type="button" class="btn  btn-primary btn-sm">小的按钮</button>
<button type="button" class="btn  btn-primary btn-xs">特别小的按钮</button>

<!--按钮样式-->
<button type="button" class="btn btn-primary active">激活按钮</button>
<button type="button" class="btn btn-primary disabled">禁用的按钮</button>
<button type="button" class="btn  btn-primary btn-block">块级的按钮（拉伸至父元素100%的宽度）</button>
```

(5).单选框

```
<div class="form-group">
  <div class="col-md-offset-2 col-md-2">
     <div class="radio">
    	<label><input type="radio" value="" name="radio" checked>选项 1</label>
     </div>
     <div class="radio">
    	<label><input type="radio" value="" name="radio">选项 2</label>
     </div>
  </div>
</div>

<!--显示在同一行上-->
<div class="form-group">
  <div class="col-md-offset-2 col-md-2">
     <label class="radio-inline">
	<input type="radio" value="" name="radio" checked>选项 1
     </label>
     <label class="radio-inline">
	<input type="radio" value="" name="radio">选项 2
     </label>
  </div>
</div>
```

(6).复选框

```
<div class="form-group">
  <div class="col-md-offset-2 col-md-2">
      <div class="checkbox">
	  <label><input type="checkbox" value="" name="checkbox" checked>选项 1</label>
      </div>
      <div class="checkbox">
    	  <label><input type="checkbox" value="" name="checkbox">选项 2</label>
      </div>
  </div>
</div>

<!--显示在同一行-->
<div class="form-group">
  <div class="col-md-offset-2 col-md-2">
	<label class="checkbox-inline">
		<input type="checkbox" value="" name="checkbox" checked>选项 1
	</label>
	<label class="checkbox-inline">
    		<input type="checkbox" value="" name="checkbox">选项 2
	</label>
  </div>
</div>
```

(7).下拉列表

```
<div class="form-group">
   <label for="name" class="col-md-2 control-label">选择列表:</label> 
   <div class="col-md-2">
	  <select class="form-control">
		  <option>1</option>
      		  <option>2</option>
      		  <option>3</option>
    	  </select>
   </div>
</div>
```

(8).文本框

```
<div class="form-group">
    <label for="name" class="col-md-2 control-label">文本框:</label>
    <div class="col-md-2">
      <textarea class="form-control" rows="3" id="name"></textarea>
    </div>
</div>
```	

(9).输入框组件

```
<div class="form-group">
   <div class=" col-md-offset-2 col-md-2">
       <div class="input-group input-group-lg">
	  <span class="input-group-addon">$</span>
	  <input type="text" class="form-control" placeholder="Money"/>
	  <span class="input-group-addon">.00</span>
	</div> 
   </div>
</div>
```

(10).验证状态

```
<div class="form-group has-success">
	<label class="col-sm-2 control-label" for="inputSuccess">输入成功</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inputSuccess">
    	</div>
</div>

<div class="form-group has-warning">
	<label class="col-sm-2 control-label" for="inputSuccess">输入警告</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inputSuccess">
    	</div>
</div>

<div class="form-group has-error">
	<label class="col-sm-2 control-label" for="inputSuccess">输入错误</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="inputSuccess">
    	</div>
</div>
```

(11).输入框行高

```
<input class="form-control input-lg" type="text" placeholder=".input-lg">
<input class="form-control" type="text" placeholder="默认输入">
<input class="form-control input-sm" type="text" placeholder=".input-sm">
```

<br/>

**五.表格**

(1).基本表格

```
<table class="table table-striped table-bordered table-hover table-condensed">
	<caption class="text-center">基本的表格布局</caption>
	<thead>
    		<tr>
      		        <th>名称</th>
      			<th>城市</th>
    		</tr>
  	</thead>
	<tbody>
    		<tr>
      			<td>Tanmay</td>
      			<td>Bangalore</td>
    		</tr>
    		<tr>
      			<td>Sachin</td>
      			<td>Mumbai</td>
    		</tr>
    		<tr>
      			<td>Tanmay</td>
      			<td>Bangalore</td>
    		</tr>
    		<tr>
      			<td>Tanmay</td>
      			<td>Bangalore</td>
    		</tr>
  	</tbody>
</table>
```

(2).状态类

```
<!-- On rows -->
<tr class="active">...</tr>
<tr class="success">...</tr>
<tr class="warning">...</tr>
<tr class="danger">...</tr>
<tr class="info">...</tr>

<!-- On cells (`td` or `th`) -->
<tr>
  <td class="active">...</td>
  <td class="success">...</td>
  <td class="warning">...</td>
  <td class="danger">...</td>
  <td class="info">...</td>
</tr>
```

(3).响应式表格

```
<div class="table-responsive">
<table class="table">
	<caption class="text-center">悬停表格</caption>
	<thead>
    		<tr>
      			<th>名称</th>
      			<th>城市</th>
    		</tr>
  	</thead>
	<tbody>
    		<tr>
      			<td>Tanmay</td>
      			<td>Bangalore</td>
    		</tr>
    		<tr>
      			<td>Sachin</td>
      			<td>Mumbai</td>
    		</tr>
  	</tbody>
</table>
</div>
```

<br/>

**六.序列**

```
<!--有序列表-->
<ol>
  <li>Item 1</li>
  <li>Item 2</li>
  <li>Item 3</li>
  <li>Item 4</li>
</ol>

<!--无序列表-->
<ul>
  <li>Item 1</li>
  <li>Item 2</li>
  <li>Item 3</li>
  <li>Item 4</li>
</ul>

<!--未定义样式列表-->
<ul class="list-unstyled">
  <li>Item 1</li>
  <li>Item 2</li>
  <li>Item 3</li>
  <li>Item 4</li>
</ul>

<!--内联列表-->
<ul class="list-inline">
  <li>Item 1</li>
  <li>Item 2</li>
  <li>Item 3</li>
  <li>Item 4</li>
</ul>

<!--自定义列表-->
<dl>
  <dt>Description 1</dt>
  <dd>Item 1</dd>
  <dt>Description 2</dt>
  <dd>Item 2</dd>
</dl>

<!--水平的自定义列表-->
<dl class="dl-horizontal">
  <dt>Description 1</dt>
  <dd>Item 1</dd>
  <dt>Description 2</dt>
  <dd>Item 2</dd>
</dl>

<!--列表组-->
 <ul class="list-group">
    <li class="list-group-item active">
    	<h4 class="list-group-item-heading">
                option 1
        </h4>
        <p class="list-group-item-text">
            Baidu
        </p>
    </li>
    
    <li class="list-group-item">
    	<h4 class="list-group-item-heading">
            option 2
        </h4>
        <p class="list-group-item-text">
           Tencent
        </p>
    </li>
    
    <li class="list-group-item">
    	<h4 class="list-group-item-heading">
            option 3
        </h4>
        <p class="list-group-item-text">
            Alibaba
        </p>
    </li>
   
    <li class="list-group-item">option 4</li>
    <li class="list-group-item">option 5</li>
</ul>
```

<br/>

**七.图片**

```
<div class="container">
   <div class="row">
	<div class="col-xs-6">
	    <div class="thumbnail">
		<!--圆角矩形-->
		<img src="img.png" class="img-rounded" alt="image">
		<!-- 缩略图 -->
		<img src="img.png" class="img-thumbnail" alt="image">
		<!-- 圆形 -->
		<img src="img.png" class="img-circle" alt="image"> 
		<!--响应式-->
		<img src="img.png" class="img-responsive" alt="image">
	        <div class="caption">
		 <h3>主题</h3>
		 <p>段落</p>
		</div>
	     </div>
	</div>
   </div>
</div>

```

<br/>

**八.响应式实用工具**

```
<span class="hidden-xs">特别小型</span>
<span class="visible-xs">在特别小型设备上可见</span>

<span class="hidden-sm">小型</span>
<span class="visible-sm">在小型设备上可见</span>

<span class="hidden-md">中型</span>
<span class="visible-md">在中型设备上可见</span>

<span class="hidden-lg">大型</span>
<span class="visible-lg">在大型设备上可见</span>
```

<br/>

**九.进度条组件**
```
<div class="progress progress-striped active">
    <div class="progress-bar progress-bar-success" style="width:60%">60%</div>
</div>
```

<br/>

**十.辅助类**

```
<div class="pull-left">元素浮动到左侧</div>
<div class="pull-right">元素浮动到右侧</div>
```