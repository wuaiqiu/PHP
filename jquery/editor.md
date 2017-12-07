# editor

一.使用方式

引入依赖库

```
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script src="jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="editor.css" type="text/css" rel="stylesheet"/>
<script src="editor.js"></script>
```

具体使用

```
<div id="txtEditor"></div>
<script type="text/javascript">
  $(document).ready( function() {
    $("#txtEditor").Editor();
  });
</script>
```

```
#获取内容
$("#txtEditor").Editor("getText");

#设置内容
$("#txtEditor").Editor("setText", "Hello")
```

```
#设置属性
 $("#txtEditor").Editor({'texteffects':true});
 
'texteffects':true,
'aligneffects':true,
'textformats':true,
'fonteffects':true,
'actions' : true,
'insertoptions' : true,
'extraeffects' : true,
'advancedoptions' : true,
'screeneffects':true,
'bold': true,
'italics': true,
'underline':true,
'ol':true,
'ul':true,
'undo':true,
'redo':true,
'l_align':true,
'r_align':true,
'c_align':true,
'justify':true,
'insert_link':true,
'unlink':true,
'insert_img':true,
'hr_line':true,
'block_quote':true,
'source':true,
'strikeout':true,
'indent':true,
'outdent':true,
'fonts':fonts,
'styles':styles,
'print':true,
'rm_format':true,
'status_bar':true,
'font_size':fontsizes,
'color':colors,
'splchars':specialchars,
'insert_table':true,
'select_all':true,
'togglescreen':true
```