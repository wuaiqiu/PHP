# bootstrapComponent

**一.图标组件**

(1).图标列表

```
图标位置 "../fonts/"
http://www.runoob.com/try/demo_source/bootstrap3-glyph-icons.htm
```

(2).使用方式
	
```
bs3-icon:glyphicon

<button type="button" class="btn btn-primary" >
  <span class="glyphicon glyphicon-align-left" ></span>
</button>

<button type="button" class="btn btn-primary btn-lg">
  <span class="glyphicon glyphicon-star" ></span> Star
</button>
```

(4).font-awessome

```
bs3-icon

http://fontawesome.io/icons/

<!--反转颜色-->
<i class="fa fa-twitter  fa-inverse"></i>

<!--不同大小-->
<i class="fa fa-car fa-lg"></i>
<i class="fa fa-car fa-2x"></i>
<i class="fa fa-car fa-3x"></i>
<i class="fa fa-car fa-4x"></i>
<i class="fa fa-car fa-5x"></i>

<!--列表图标-->
<ul class="fa-ul">
  <li><i class="fa-li fa fa-square"></i>List icons</li>
  <li><i class="fa-li fa fa-square"></i>List icons</li>
  <li><i class="fa-li fa fa-square"></i>List icons</li>
</ul>

<!--边界和浮动-->
<i class="fa fa-car fa-border"></i>
<i class="fa fa-car fa-pull-right"></i>

<!--动态图标-->
<i class="fa fa-spinner fa-spin"></i>
<i class="fa fa-spinner fa-pulse"></i>

<!--旋转和翻转-->
<i class="fa fa-shield fa-rotate-90"></i>
<i class="fa fa-shield fa-rotate-180"></i>
<i class="fa fa-shield fa-flip-horizontal"></i>
<i class="fa fa-shield fa-flip-vertical"></i>

<!--堆叠的图标-->
<span class="fa-stack">
  <i class="fa fa-circle-thin fa-stack-2x"></i>
  <i class="fa fa-twitter fa-stack-1x"></i>
</span>

<!--固定宽度-->
<div class="list-group">
  <a href="#" class="list-group-item"><i class="fa fa-home fa-fw"></i> Home</a>
  <a href="#" class="list-group-item"><i class="fa fa-book fa-fw"></i> Library</a>
  <a href="#" class="list-group-item"><i class="fa fa-pencil fa-fw"></i> Applications</a>
  <a href="#" class="list-group-item"><i class="fa fa-cog fa-fw"></i> Settings</a>
</div>
```

<br/>

**二.按钮组组件**

(1).水平按钮组

```
bs3-button-toolbar

<div class="btn-toolbar" role="toolbar">
<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-default">按钮 1</button>
    <button type="button" class="btn btn-default">按钮 2</button>
    <button type="button" class="btn btn-default">按钮 3</button>
 </div>
<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-default">按钮 4</button>
    <button type="button" class="btn btn-default">按钮 5</button>
    <button type="button" class="btn btn-default">按钮 6</button>
</div>
<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-default">按钮 7</button>
    <button type="button" class="btn btn-default">按钮 8</button>
    <button type="button" class="btn btn-default">按钮 9</button>
</div>
</div>
```

(2).垂直的按钮组

```
<div class="btn-toolbar" role="toolbar">
<div class="btn-group-vertical btn-group-sm">
    <button type="button" class="btn btn-default">按钮 1</button>
    <button type="button" class="btn btn-default">按钮 2</button>
    <button type="button" class="btn btn-default">按钮 3</button>
 </div>
<div class="btn-group-vertical btn-group-sm">
    <button type="button" class="btn btn-default">按钮 4</button>
    <button type="button" class="btn btn-default">按钮 5</button>
    <button type="button" class="btn btn-default">按钮 6</button>
</div>
<div class="btn-group-vertical btn-group-sm">
    <button type="button" class="btn btn-default">按钮 7</button>
    <button type="button" class="btn btn-default">按钮 8</button>
    <button type="button" class="btn btn-default">按钮 9</button>
</div>
</div>
```

(3).按钮下拉菜单组件

```
bs3-button-group:vertical

<div class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown">
		默认 <span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li class="dropdown-header">菜单标题</li>
		<li><a href="#">option 1</a></li>
		<li><a href="#">option 2</a></li>
		<li><a href="#">option 3</a></li>
		<li class="divider"></li>
		<li class="dropdown-header">菜单标题</li>
		<li><a href="#">option 4</a></li>
		<li><a href="#">option 4</a></li>
	</ul>
</div>
```
	
<br/>

**三.导航组件**

(1).表格导航

```
bs3-tabs:justified

<!--水平-->
 <ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#">option 1</a></li>
  <li><a href="#">option 2</a></li>
  <li><a href="#">option 3</a></li>
  <li><a href="#">option 4</a></li>
  <li><a href="#">option 5</a></li>
  <li><a href="#">option 6</a></li>
</ul>

<!--垂直-->
 <ul class="nav nav-tabs  nav-stacked">
  <li class="active"><a href="#">option 1</a></li>
  <li><a href="#">option 2</a></li>
  <li><a href="#">option 3</a></li>
  <li><a href="#">option 4</a></li>
  <li><a href="#">option 5</a></li>
  <li><a href="#">option 6</a></li>
</ul>
```

(2).胶囊式导航

```
bs3-pills:justified

<!--水平-->
<ul class="nav nav-pills nav-justified">
  <li class="active"><a href="#">option 1</a></li>
  <li><a href="#">option 2</a></li>
  <li><a href="#">option 3</a></li>
  <li><a href="#">option 4</a></li>
  <li><a href="#">option 5</a></li>
  <li><a href="#">option 6</a></li>
</ul>

bs3-pills:vertical

<!--垂直-->
 <ul class="nav nav-pills  nav-stacked">
  <li class="active"><a href="#">option 1</a></li>
  <li><a href="#">option 2</a></li>
  <li><a href="#">option 3</a></li>
  <li><a href="#">option 4</a></li>
  <li><a href="#">option 5</a></li>
  <li><a href="#">option 6</a></li>
</ul>
```

(3).下拉菜单

```
bs3-pills:dropdown	

 <li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">option 6 
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li><a href="#">option 7</a></li>
		<li><a href="#">option 8</a></li>
		<li><a href="#">option 9</a></li>
	</ul>
</li>
```

<br/>

**四.导航栏组件**

(1).普通表单

```
bs3-navbar:basic
bs3-navbar:inverse

<nav class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Home</a>
    </div>
    <ul class="nav navbar-nav">
            <li class="active"><a href="#">option 1</a></li>
            <li><a href="#">option 2</a></li>
            <li><a href="#">option 3</a></li>
            <li><a href="#">option 4</a></li>
            <li><a href="#">option 5</a></li>
            <li><a href="#">option 6</a></li>
    </ul>
</nav>
```

(2).响应式导航栏

```
bs3-navbar

//白黑色
<nav class="navbar navbar-default">
   <div class="navbar-header">
	<button class="navbar-toggle" data-toggle="collapse"  data-target="#navs"> 
                <span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
        </button>
	<a class="navbar-brand" href="#">Home</a>
    </div>
				
    <div class="collapse navbar-collapse" id="navs">
	 <ul class="nav navbar-nav">
	    <li class="active"><a href="#">option 1</a></li>
  	    <li><a href="#">option 2</a></li>
  	    <li><a href="#">option 3</a></li>
  	    <li><a href="#">option 4</a></li>
  	    <li><a href="#">option 5</a></li>
  	    <li><a href="#">option 6</a></li>
	</ul>
   </div>
</nav>

//黑白色
<nav class="navbar navbar-inverse">
   <div class="navbar-header">
	<button class="navbar-toggle" data-toggle="collapse"  data-target="#navs"> 
                <span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
        </button>
	<a class="navbar-brand" href="#">Home</a>
    </div>
				
    <div class="collapse navbar-collapse" id="navs">
	 <ul class="nav navbar-nav">
	    <li class="active"><a href="#">option 1</a></li>
  	    <li><a href="#">option 2</a></li>
  	    <li><a href="#">option 3</a></li>
  	    <li><a href="#">option 4</a></li>
  	    <li><a href="#">option 5</a></li>
  	    <li><a href="#">option 6</a></li>
	</ul>
   </div>
</nav>
```

(3).在导航条中使用表单

```
<nav class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Home</a>
    </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">option 1</a></li>
            <li><a href="#">option 2</a></li>
            <li><a href="#">option 3</a></li>
            <li><a href="#">option 4</a></li>
            <li><a href="#">option 5</a></li>
            <li><a href="#">option 6</a></li>
        </ul>
        <form class="navbar-form navbar-left">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
</nav>
```

(4).表单浮动

```
<p class="navbar-text navbar-right">向右对齐-文本</p>
<p class="navbar-text navbar-leftt">向左对齐-文本</p>
```

(5).导航条位置（注意位置重叠，请向 body 标签添加至少 50 像素的内边距）

```
bs3-navbar:fixed-top
bs3-navbar:static-top
<!--固定在顶部-->
<nav class="navbar navbar-default navbar-fixed-top">
<!--随着页面一起滚动-->
<nav class="navbar navbar-default navbar-static-top">
```

<br/>

**五.路径组件（面包屑导航）**

```
bs3-breadcrumbs

<ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">2013</a></li>
    <li class="active">十一月</li>
</ol>
```

<br/>

**六.分页组件**

(1).分页

```
bs3-pagination:large

<ul class="pagination pagination-lg">
    <li><a href="#">&laquo;</a></li>
    <li class="active"><a href="#">1</a></li>
    <li class="disabled"><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>

bs3-pagination

<ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li class="active"><a href="#">1</a></li>
    <li class="disabled"><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>

bs3-pagination:small
<ul class="pagination pagination-sm">
    <li><a href="#">&laquo;</a></li>
    <li class="active"><a href="#">1</a></li>
    <li class="disabled"><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>
```

(2).翻页

```
bs3-pager
bs3-pager:aligned

<!--中间对齐-->
<ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="#">Next</a></li>
</ul>

<!--两边对齐-->
<ul class="pager">
    <li class="previous disabled"><a href="#">Previous</a></li>
    <li class="next"><a href="#">Next</a></li>
</ul>
```

<br/>

**七.标签与徽章**

(1).标签

```
bs3-label:danger

<span class="label label-default">默认标签</span>
<span class="label label-primary">主要标签</span>
<span class="label label-success">成功标签</span>
<span class="label label-info">信息标签</span>
<span class="label label-warning">警告标签</span>
<span class="label label-danger">危险标签</span>
```

(2).徽章

```
bs3-badge

<!--未读信息数量徽章-->
<a href="#">未读信息<span class="badge">10</span></a>
```

<br>

**八.巨幕组件，主要展示网站的关键性区域**

```
bs3-jumbotron	

<!--在固定的范围内有圆角-->
<div class="container">
	<div class="jumbotron">
		<h1>欢迎登陆页面！</h1>
		<p>这是一个超大屏幕（Jumbotron）的实例。</p>
	</div>
</div>

<!--100%全屏，没有圆角-->
<div class="jumbotron">
	<div class="container">
		<h2>欢迎登陆页面！</h2>
		<p>这是一个超大屏幕（Jumbotron）的实例。</p>
	</div>
</div>
```

<br/>

**九.警告框组件**

```
bs3-alert:danger

<div class="alert alert-success">成功！很好地完成了提交。</div>
<div class="alert alert-info">信息！请注意这个信息。</div>
<div class="alert alert-warning">警告！请不要提交。</div>
<div class="alert alert-danger">错误！请进行一些更改。</div>


<!--带取消-->
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         信息！请注意这个信息。
</div>
```

<br/>

**十.媒体组件，图文对齐**

(1).基本格式

```
<div class="media">
 	<!--图片左对齐 -->
	<a class="media-left" href="#">
		<img class="media-object" src="1.jpg" alt="image"/>
	</a>
	<!-- 文字部分 -->
	<div class="media-body">
		<h4 class="media-heading">媒体标题</h4>
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
	</div>
</div>
```

(2).媒体列表

```
bs3-media-object

<ul class="media-list">
	<li class="media">
	<a class="media-left" href="#">
		<img class="media-object" src="1.jpg" alt="image"/>
	</a>
	<div class="media-body">
		<h4 class="media-heading">媒体标题</h4>
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
	</div>
	</li>
	
	
	<li class="media">
	<a class="media-left" href="#">
		<img class="media-object" src="1.jpg" alt="image"/>
	</a>
	<div class="media-body">
		<h4 class="media-heading">媒体标题</h4>
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
        这是一些示例文本。这是一些示例文本。
	</div>
	</li>
</ul>
```

<br/>

**十一.面板**	

```
bs3-panel:danger

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">面板标题</h3>
	</div>
	<div class="panel-body">
		面板内容
	</div>
	<div class="panel-footer">
		面板脚注
	</div>
 </div>
```

<br/>

**十二.Well**

```
bs3-well
bs3-well:large
bs3-well:small

<div class="well well-lg">您好，我在大的 Well 中！</div>
<div class="well">您好，我在 Well 中！</div>
<div class="well well-sm">您好，我在小的 Well 中！</div>
```
