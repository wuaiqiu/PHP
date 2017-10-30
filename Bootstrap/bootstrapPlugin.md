# bootstrapPlugin


**一.模态框（Modal）插件,弹出框**

```
<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">模态框</button>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
	<div class="modal-content">
            <div class="modal-header">  <!--内容头-->
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">标题</h4>
             </div>
            				
	     <div class="modal-body">	<!--内容体-->
				 在这里添加一些文本
	     </div>
            				
	      <div class="modal-footer">	<!--内容尾-->
                   <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                   <button type="button" class="btn btn-primary">提交</button>
               </div>
         </div>
    </div>
</div>

<script>
$('#myModal').on('show.bs.modal', function () {
  	console.log("打了Modal前");
});
$('#myModal').on('shown.bs.modal', function () {
	console.log("打开Modal后");
});
$('#myModal').on('hide.bs.modal', function () {
	console.log("关闭Modal前");
});
$('#myModal').on('hidden.bs.modal', function () {
	console.log("关闭Modal后");
});
</script>
```

<br/>
		
**二.滚动监听（Scrollspy）插件，自动更新导航栏**
	
```
<nav id="navbar-example" class="navbar navbar-default">
	<div class="navbar-header">
            <a class="navbar-brand" href="#">教程名称</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#ios">iOS</a></li>
            <li><a href="#svn">SVN</a></li>
        </ul>
</nav>

<div data-spy="scroll" data-target="#navbar-example" data-offset="0"  style="height:100px;overflow:auto; position: relative;">
  <div class="section">
    <h4 id="ios">iOS</h4>
      <small><a href="#" onclick="removeSection(this);">&times; 删除该部分</a></small>
      <p>
         iOS是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple
         TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本
         iOS是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple
         TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。
         iOS是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple
         TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。。
      </p>
  </div>
  <div class="section">
    <h4 id="svn">SVN</h4>
      <small><a href="#" onclick="removeSection(this);">&times; 删除该部分</a></small>
      <p>
       Apache Subversion，通常缩写为 SVN，是一款开源的版本控制系统软件。Subversion 由 CollabNet 公司在 2000
       年创建。但是现在它已经发展为 Apache Software Foundation 的一个项目，因此拥有丰富的开发人员和用户社区。
        Apache Subversion，通常缩写为 SVN，是一款开源的版本控制系统软件。Subversion 由 CollabNet 公司在 2000
       年创建。但是现在它已经发展为 Apache Software Foundation 的一个项目，因此拥有丰富的开发人员和用户社区
        Apache Subversion，通常缩写为 SVN，是一款开源的版本控制系统软件。Subversion 由 CollabNet 公司在 2000
       年创建。但是现在它已经发展为 Apache Software Foundation 的一个项目，因此拥有丰富的开发人员和用户社区
      </p>
   </div>
</div>

<script>
    $(function(){
    	removeSection = function(e) {
            $(e).parents(".section").remove();
            $('[data-spy="scroll"]').each(function () {
                var $spy = $(this).scrollspy('refresh');
            });
        };
    });
</script>
```

<br/>
	
**三.标签页（Tab）插件,导航组件**


```
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">菜鸟教程</a></li>
   <li><a href="#ios" data-toggle="tab">iOS</a></li>
</ul>
	
<div class="tab-content">
    <div class="tab-pane fade active in" id="home">
	<p>
	  菜鸟教程是一个提供最新的web技术站点，本站免费提供了建站相关的技术文档，帮助广大web技术爱好者快速入门并建立自己的网站。
	  菜鸟先飞早入行——学的不仅是技术，更是梦想。
	</p>
    </div>
    <div class="tab-pane fade" id="ios">
	<p>
	 iOS是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和
	  Apple TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。
	</p>
    </div>
</div>

<script>
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
	console.log("切换前");
	console.log(e.target); // 激活的标签页
	console.log(e.relatedTarget); //前一个激活的标签页
});
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	console.log("切换后");
	console.log(e.target); // 激活的标签页
	console.log(e.relatedTarget); //前一个激活的标签页
});
</script>
```

<br/>
				
**四.提示工具（Tooltip）插件**

```
<h4>工具提示（Tooltip）插件 - 锚</h4>
<a href="#" data-toggle="tooltip" data-placement="left" title="左侧的 Tooltip"> 左侧的 Tooltip </a>.
<a href="#" data-toggle="tooltip" data-placement="top"  title="顶部的 Tooltip"> 顶部的 Tooltip </a>.
<a href="#" data-toggle="tooltip" data-placement="bottom" title="底部的 Tooltip"> 底部的 Tooltip </a>.
<a href="#" data-toggle="tooltip" data-placement="right" title="右侧的 Tooltip"> 右侧的 Tooltip </a>

<script>
    $(function () { $("[data-toggle='tooltip']").tooltip(); });
    $('a').on('show.bs.tooltip', function () {
      	console.log("提示开启前");
    });
    $('a').on('shown.bs.tooltip', function () {
        console.log("提示开启后");
    });
    $('a').on('hide.bs.tooltip', function () {
        console.log("提示关闭前");
    });
    $('a').on('hidden.bs.tooltip', function () {
        console.log("提示关闭后");
    });
</script>
```
	
<br/>

**五.弹出框（Popover）插件**

```
<div class="container" style="padding: 100px 50px 10px;">
	<button type="button" class="btn btn-default" title="Popover title"
	data-container="body" data-toggle="popover" data-placement="left"
	data-content="左侧的 Popover 中的一些内容">左侧的 Popover</button>
	<button type="button" class="btn btn-primary" title="Popover title"
	data-container="body" data-toggle="popover" data-placement="top"
	data-content="顶部的 Popover 中的一些内容">顶部的 Popover</button>
	<button type="button" class="btn btn-success" title="Popover title"
	data-container="body" data-toggle="popover" data-placement="bottom"
	data-content="底部的 Popover 中的一些内容">底部的 Popover</button>
	<button type="button" class="btn btn-warning" title="Popover title"
	data-container="body" data-toggle="popover" data-placement="right"
	data-content="右侧的 Popover 中的一些内容">右侧的 Popover</button>
</div>

<script>
    $(function (){$("[data-toggle='popover']").popover()});
    
    $('button').on('show.bs.popover', function () {
    	 console.log("开启前");
    });
    $('button').on('shown.bs.popover', function () {
   	 console.log("开启后");
   }); 
    $('button').on('hide.bs.popover', function () {
  	 console.log("关闭前");
   }); 
    $('button').on('hidden.bs.popover', function () {
  	 console.log("关闭后");
   });
</script>
```

<br/>

**六.折叠（Collapse）插件，面板折叠**

```
<div class="panel-group" id="accordion">
   <div class="panel panel-default">
	<div class="panel-heading">
	  <h4 class="panel-title">
	   <a data-toggle="collapse" data-target="#collapseOne" data-parent="#accordion"> 第 1 部分 </a>
	  </h4>
	</div>
    <div id="collapseOne" class="panel-collapse collapse in">
	<div class="panel-body">
		Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapienteea 
		proident. Advegan excepteur butcher vice lomo.</div>
	</div>
    </div>
    
    <div class="panel panel-default">
	<div class="panel-heading">
	  <h4 class="panel-title">
	   <a data-toggle="collapse" data-target="#collapseTwo" data-parent="#accordion"> 第 2 部分 </a>
	  </h4>
	</div>
    <div id="collapseTwo" class="panel-collapse collapse in">
	<div class="panel-body">
		Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapienteea 
		proident. Advegan excepteur butcher vice lomo.</div>
	</div>
    </div>
    
    <div class="panel panel-default">
	<div class="panel-heading">
	  <h4 class="panel-title">
	   <a data-toggle="collapse" data-target="#collapseThree" data-parent="#accordion"> 第 3 部分 </a>
	  </h4>
	</div>
    <div id="collapseThree" class="panel-collapse collapse in">
	<div class="panel-body">
		Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapienteea 
		proident. Advegan excepteur butcher vice lomo.</div>
	</div>
    </div>
</div>

<script>
$('div[class="panel-collapse collapse"]').on('show.bs.collapse', function () {
    console.log("打开前");
});
$('div[class="panel-collapse collapse"]').on('shown.bs.collapse', function () {
    console.log("打开后");
});
$('div[class="panel-collapse collapse"]').on('hide.bs.collapse', function () {
    console.log("关闭前");
});
$('div[class="panel-collapse collapse"]').on('hidden.bs.collapse', function () {
    console.log("关闭后");
});
</script>
```

<br/>

**七.轮播插件**

```
<div class="col-md-5">
   <div id="myCarousel" class="carousel slide">
	<ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
		
         <div class="carousel-inner">
	     <div class="item active">
	        <img src="1.png" alt="First slide">
	        <div class="carousel-caption">标题 1</div>
             </div>
	     <div class="item">
		 <img src="2.png" alt="Second slide">
		 <div class="carousel-caption">标题 2</div>
	     </div>
	     <div class="item">
		 <img src="3.png" alt="Third slide">
		 <div class="carousel-caption">标题 3</div>
	    </div>
	</div>

        <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
    </div>
</div>

<script> 
$(document).ready(function(){ 
   $('#myCarousel').carousel({interval:5000});//每隔5秒自动轮播 
}); 
</script>
```