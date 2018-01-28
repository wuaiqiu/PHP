# SVG

**一.svg格式**

```
<?xml version="1.0" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
  <circle cx="100" cy="50" r="40" stroke="black" stroke-width="2" fill="red" />
</svg>
```

```
<!--引用-->
<embed src="circle.svg" type="image/svg+xml" />  <!--允许使用脚本-->
<object data="circle.svg" type="image/svg+xml"></object> <!--不允许使用脚本-->
<iframe src="circle.svg"></iframe>  <!--允许使用脚本-->

<!--直接使用,注意svg默认大小为300*150-->
<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
   <circle cx="100" cy="50" r="40" stroke="black" stroke-width="2" fill="red" />
</svg>
```

<br>

**二.矩阵**

```
1.width,height:画布的高宽
2.x,y:矩阵距画布左侧与顶侧的距离
3.rx,ry:矩阵曲度
4.stroke-linecap:轮廓节点形状butt|round|square
5.troke-dasharray:虚线
<rect width="300" height="300" x="50" y="20" rx="20" ry="20" style="fill:blue;fill-opacity:0.5;
     stroke:pink;stroke-width:5;stroke-opacity:0.5"/>
```

<br>

**三.圆形**

```
1.cx,cy:定义圆点的x和y坐标
2.r:圆的半径
<circle cx="100" cy="50" r="40" stroke="black" stroke-width="2" fill="red"/>
```

<br>

**四.椭圆**

```
1.cx,cy:定义圆点的x和y坐标
2.rx,ry:椭圆的水平与垂直半径
<ellipse cx="100" cy="100" rx="20" ry="30" style="fill:yellow;stroke:purple;stroke-width:2"/>
```

<br>

**五.直线**

```
1.x1,y1:开始点的坐标
2.x2,y2:结束点的坐标
<line x1="0" y1="0" x2="200" y2="200" style="stroke:rgb(255,0,0);stroke-width:2"/>
```

<br>

**六.多边形**

```
1.points:多边形每个角的 x 和 y 坐标
2.fill-rule:填充规则(	nonzero | evenodd )
<polygon points="100,10 40,180 190,60 10,60 160,180"
    style="stroke:purple;stroke-width:1;fill:blue;fill-rule:evenodd;"/>

nonzero:按该规则，要判断一个点是否在图形内，从该点作任意方向的一条射线，然后检测射线与图形路径的交点情况。从0开始计数，路径从左向右穿过射线则计数加1，从右向左穿过射线则计数减1。得出计数结果后，如果结果是0，则认为点在图形外部，否则认为在内部
evenodd:按该规则，要判断一个点是否在图形内，从该点作任意方向的一条射线，然后检测射线与图形路径的交点的数量。如果结果是奇数则认为点在内部，是偶数则认为点在外部。
```

<br>

**七.曲线**

```
<polyline points="20,20 40,25 60,40 80,120 120,140 200,180" style="fill:none;stroke:black;stroke-width:3" />
```

<br>

**八.路径**

```
M = moveto
L = lineto
H = horizontal lineto
V = vertical lineto
C = curveto
S = smooth curveto
Q = quadratic Bézier curve
T = smooth quadratic Bézier curveto
A = elliptical Arc
Z = closepath
大写表示绝对定位，小写表示相对定位

<path d="M150 0 L75 200 L225 200 Z" />
//它开始于位置150 0，到达位置75 200，然后从那里开始到225 200，最后在150 0关闭路径。
```

<br>

**九.文本**

```
transform="translate(30, 12)"：以画布左上角为基点水平平移30，垂直平移12
transform="rotate(30,20,40)"：以坐标(20,40)旋转30
transform="scale(2,3)"：扩大倍数
transform="skewX(20)":倾斜20
transform="skewY(20)":倾斜20

<text x="0" y="15" fill="red" transform="rotate(30,20,40)">I love SVG</text>

路径上的文字
<defs>
 <path id="path1" d="M75,20 a1,1 0 0,0 100,0" />
</defs>
<text x="10" y="100" style="fill:red;">
 <textPath xlink:href="#path1">I love SVG I love SVG</textPath>
</text>

分行文字
<text x="10" y="20" style="fill:red;">Several lines:
  <tspan x="10" y="45">First line</tspan>
  <tspan x="10" y="70">Second line</tspan>
</text>

链接文字
<a xlink:href="http://www.w3schools.com/svg/" target="_blank">
   <text x="0" y="15" fill="red">I love SVG</text>
</a>
```

<br>

**十.模糊**

```
stdDeviation:定义模糊量
in:SourceGraphic（整个RGBA像素）SourceAlpha（黑色残影）

<defs>
  <filter id="f1" x="0" y="0">
     <feGaussianBlur in="SourceGraphic" stdDeviation="15" />
  </filter>
</defs>
<rect width="90" height="90" stroke="green" stroke-width="3" fill="yellow" filter="url(#f1)" />
```

<br>

**十一.阴影**

```
1.dx,dy：偏移距离
<defs>
   <filter id="f1" x="0" y="0">
       <feOffset result="offOut" in="SourceGraphic" dx="10" dy="10" />
      <feBlend in="SourceGraphic" in2="offOut" mode="normal" />
   </filter>
</defs>
<rect width="90" height="90" stroke="green" stroke-width="3" fill="yellow" filter="url(#f1)" />

模糊效果
<filter id="f1" x="0" y="0">
     <feOffset result="offOut" in="SourceGraphic" dx="20" dy="20" />
     <feGaussianBlur result="blurOut" in="offOut" stdDeviation="10" />
     <feBlend in="SourceGraphic" in2="blurOut" mode="normal" />
</filter>
```

<br>

**十二.渐变**

```
//线性
1.x1,x2,y1,y2:定义渐变开始和结束位置
2.stop:标签定义颜色的过渡
<defs>
    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
         <stop offset="0%" style="stop-color:rgb(255,255,0);stop-opacity:1" />
         <stop offset="100%" style="stop-color:rgb(255,0,0);stop-opacity:1" />
    </linearGradient>
</defs>
<ellipse cx="200" cy="70" rx="85" ry="55" fill="url(#grad1)" />

//放射性
1.cx,cy和r属性定义的最外层圆和fx和fy定义的最内层圆
<defs>
   <radialGradient id="grad1" cx="50%" cy="50%" r="50%" fx="50%" fy="50%">
        <stop offset="0%" style="stop-color:rgb(255,255,255);stop-opacity:0" />
        <stop offset="100%" style="stop-color:rgb(0,0,255);stop-opacity:1" />
   </radialGradient>
</defs>
<ellipse cx="200" cy="70" rx="85" ry="55" fill="url(#grad1)" />
```