# summernote

一.使用方式

引入依赖库

```
 <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link href="https://cdn.bootcss.com/summernote/0.8.8/summernote.css" rel="stylesheet">
 <script src="https://cdn.bootcss.com/summernote/0.8.8/summernote.min.js"></script>
 <script src="https://cdn.bootcss.com/summernote/0.8.8/lang/summernote-zh-CN.min.js"></script>
```

具体使用

```
<div id="summernote">Hello Summernote</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>
```

```
#获取内容
$('#summernote').summernote('code');

#设置内容
$('#summernote').summernote('code', "Hello world");
```

```
#设置属性
$("#summernote").summernote({ height: 300});

height: 300,
minHeight: null,
maxHeight: null,
focus: true,
placeholder: 'write here...',
dialogsFade: true,
disableDragAndDrop: true,
font:['bold', 'italic', 'underline', 'clear','color','fontsize','superscript','subscript','strikethrough']
paragraph:['style','ol','ul','paragraph','height']
insert:['picture','link','video','table','insert','hr']
misc:['fullscreen','codeview','undo','redo','help']
popover: {
  image: [
    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
    ['float', ['floatLeft', 'floatRight', 'floatNone']],
    ['remove', ['removeMedia']]
  ],
  link: [
    ['link', ['linkDialogShow', 'unlink']]
  ]
}
```

```
#设置方法
$('#summernote').summernote('insertText', 'hello world');//插入文本
$('#summernote').summernote('isEmpty');//判断是否为空
$('#summernote').summernote('reset');//重置
$('#summernote').summernote('bold');//加粗
$('#summernote').summernote('italic');//斜体
$('#summernote').summernote('underline');//下划线
$('#summernote').summernote('strikethrough');//删除线
$('#summernote').summernote('superscript');//上标
$('#summernote').summernote('subscript');//下标
$('#summernote').summernote('removeFormat');//去除格式
$('#summernote').summernote('backColor', 'red');//背景色
$('#summernote').summernote('foreColor', 'blue');//前景色
$('#summernote').summernote('fontSize', 20);//字体大小
$('#summernote').summernote('justifyLeft');//段落
$('#summernote').summernote('justifyRight');
$('#summernote').summernote('justifyCenter');
$('#summernote').summernote('justifyFull');
$('#summernote').summernote('insertParagraph');//插入段落
$('#summernote').summernote('insertOrderedList');//插入列表
$('#summernote').summernote('insertUnorderedList');
$('#summernote').summernote('indent');//缩进
$('#summernote').summernote('outdent');//凸排
$('#summernote').summernote('lineHeight', 20);//设置行高
$('#summernote').summernote('insertImage', url, filename);//插入图片
$('#summernote').summernote('insertImage', url, function ($image){
    $image.css('width', $image.width() / 3);        //对插入图片设置
    $image.attr('data-filename', 'retriever');
});
$('#summernote').summernote('createLink', {//创建链接
 text: 'This is the Summernote's Official Site',
  url: 'http://summernote.org',
  newWindow: true
});
$('#summernote').summernote('unlink');//取消链接
```

```
#事件
//初始化
$('#summernote').on('summernote.init', function() {
     console.log('Summernote is launched');
});
//enter键
$('#summernote').on('summernote.enter', function() {
     console.log('Enter/Return key pressed');
});
//focus
$('#summernote').on('summernote.focus', function() {
     console.log('Editable area is focused');
});
//blur
$('#summernote').on('summernote.blur', function() {
     console.log('Editable area is blured');
});
//keyup
$('#summernote').on('summernote.keyup', function(we, e) {
      console.log('Key is released:', e.keyCode);
});
//keydown
$('#summernote').on('summernote.keydown', function(we, e) {
      console.log('Key is down:', e.keyCode);
});
//paste
$('#summernote').on('summernote.paste', function(e) {
      console.log('Called event paste');
});
//change
$('#summernote').on('summernote.change', function(we,contents, $editable) {
      console.log('summernote\'s content ischanged.');
});
```