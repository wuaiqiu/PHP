# sass


(1)**使用变量**（变量名用中划线和下划线分隔，变量值与css熟悉值一样）

```
$nav-color: #F90;
nav {
  $width: 100px;
  width: $width;
  color: $nav-color;
}

-------------------

nav {
  width: 100px;
  color: #F90;
}
```
<br>

(2)**嵌套CSS**

```
#content {
  article {
    h1 { color: #333 }
    p { margin-bottom: 1.4em }
  }
  aside { background-color: #EEE }
}

----------------------------------------

#content article h1 { color: #333 }
#content article p { margin-bottom: 1.4em }
#content aside { background-color: #EEE }
```

<br>

(3)**父选择器的标识符&**

```
article a {
  color: blue;
  &:hover { color: red }
}

#content aside {
  color: red;
  body.ie & { color: green }
}

------------------------

article a { color: blue }
article a:hover { color: red }

#content aside {color: red};
body.ie #content aside { color: green }
```

<br>

(4)**群组选择器的嵌套**

```
.container {
  h1, h2, h3 {margin-bottom: .8em}
}

---------------------------------

.container h1, .container h2, .container h3 { margin-bottom: .8em }
```

<br>

(5)**子组合选择器和同层组合选择器**

```
article {
  ~ article { border-top: 1px dashed #ccc }
  > section { background: #eee }
  dl > {
    dt { color: #333 }
    dd { color: #555 }
  }
  nav + & { margin-top: 0 }
}

--------------------------------------------

article ~ article { border-top: 1px dashed #ccc }
article > section { background: #eee }
article dl > dt { color: #333 }
article dl > dd { color: #555 }
nav + article { margin-top: 0 }
```

<br>

(6)**嵌套属性**

```
nav {
  border: {
  style: solid;
  width: 1px;
  color: #ccc;
  }
}

nav {
  border: 1px solid #ccc {
  left: 0px;
  right: 0px;
  }
}

---------------------------

nav {
  border-style: solid;
  border-width: 1px;
  border-color: #ccc;
}

nav {
  border: 1px solid #ccc;
  border-left: 0px;
  border-right: 0px;
}
```

<br>

(7)**sass导入**

```
_demo1.scss(不会编译为css文件,称为局部文件)

demo2.scss (合并scss内容，生成css文件)
@import 'demo1'
```

<br>

(8)**默认变量值**

```
#如果用户在导入你的sass局部文件之前声明了一个$fancybox-width变量，那么你的局部文件中对$fancybox-width赋值400px的操作就无效。如果用户没有做这样的声明，则$fancybox-width将默认为400px。
$fancybox-width: 400px !default;
.fancybox {
width: $fancybox-width;
}
```

<br>

(9)**静默注释**

```
body {
  color: #333; // 这种注释内容不会出现在生成的css文件中
  padding: 0; /* 这种注释内容会出现在生成的css文件中 */
}
```

<br>

(10)**混合器**

```
@mixin rounded-corners {
  border-radius: 5px;
}

notice {
  background-color: green;
  @include rounded-corners;
}

-----------------------------

notice {
  background-color: green;
  border-radius: 5px; 
}
```

<br>




(11)**混合器传参**

```
@mixin link-colors(
  $normal,
  $hover: $normal,
  $visited: $normal
) {
  color: $normal;
  &:hover { color: $hover; }
  &:visited { color: $visited; }
}

a {
  @include link-colors(
          $normal: blue,
          $visited: green,
          $hover: red
  );
}

----------------------------------

a {color: blue; }
a:hover {color: red; }
a:visited {color: green; }
```

<br>

(12)**选择器继承**

```
.error {
  border: 1px red;
  background-color: #fdd;
}
.error a{  //应用到.seriousError a
  color: red;
  font-weight: 100;
}
h1.error { //应用到hl.seriousError
  font-size: 1.2rem;
}
.seriousError {
  @extend .error;
  border-width: 3px;
}

----------------------------------

.error, .seriousError {
  border: 1px red;
  background-color: #fdd; }

.error a, .seriousError a {
  color: red;
  font-weight: 100; }

h1.error, h1.seriousError {
  font-size: 1.2rem; }

.seriousError {
  border-width: 3px; }
```

<br>

(13)**if判断**

```
$type: monster;
p {
  @if $type == ocean {
    color: blue;
  } @else if $type == matador {
    color: red;
  } @else if $type == monster {
    color: green;
  } @else {
    color: black;
  }
}

------------------------

p {color: green; }
```

<br>

(14)**for循环**

```
@for $i from 1 through 3 {
  .item-#{$i} { width: 2em * $i; }
}

@for $i from 1 to 3 {
  .item-#{$i} { width: 2em * $i; }
}

----------------------------------
.item-1 {
  width: 2em; }
.item-2 {
  width: 4em; }
.item-3 {
  width: 6em; }

.item-1 {
  width: 2em; }
.item-2 {
  width: 4em; }
```

<br>

(15)**each循环**

```
#单个list
$animal-list: puma, sea-slug, egret, salamander;
@each $animal in $animal-list {
  .#{$animal}-icon {
    background-image: url('/images/#{$animal}.png');
  }
}

--------------------------------------

.puma-icon {
  background-image: url('/images/puma.png'); 
}
.sea-slug-icon {
  background-image: url('/images/sea-slug.png'); 
}
.egret-icon {
  background-image: url('/images/egret.png'); 
}
.salamander-icon {
  background-image: url('/images/salamander.png'); 
}
```

```
#多个list
$animal-data: (puma, black, default),(sea-slug, blue, pointer),(egret, white, move);
@each $animal, $color, $cursor in $animal-data {
  .#{$animal}-icon {
    background-image: url('/images/#{$animal}.png');
    border: 2px solid $color;
    cursor: $cursor;
  }
}

-------------------------------

.puma-icon {
  background-image: url('/images/puma.png');
  border: 2px solid black;
  cursor: default; 
}
.sea-slug-icon {
  background-image: url('/images/sea-slug.png');
  border: 2px solid blue;
  cursor: pointer; 
}
.egret-icon {
  background-image: url('/images/egret.png');
  border: 2px solid white;
  cursor: move; 
}
```

```
#map循环
$headings: (h1: 2em, h2: 1.5em, h3: 1.2em);
@each $header, $size in $headings {
  #{$header} {
    font-size: $size;
  }
}


-------------------------------

h1 {
  font-size: 2em; 
}
h2 {
  font-size: 1.5em; 
}
h3 {
  font-size: 1.2em; 
}
```

<br>

(16)**while循环**

```
$i: 6;
@while $i > 0 {
  .item-#{$i} { width: 2em * $i; }
  $i: $i - 2;
}

-----------------------------------
.item-6 {
  width: 12em; }
.item-4 {
  width: 8em; }
.item-2 {
  width: 4em; }
```

<br>

(17)**函数**

```
@function hello($px){
  @return $px*2;
}

div{
  height: hello(3px);
}

--------------------
div {height: 6px; }
```