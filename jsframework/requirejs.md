# requirejs与seajs

>CommonJS:一种服务器端模块化的规范，Nodejs实现了这种规范，所以就说Nodejs支持CommonJS（webpack）

>AMD(Asynchronous Module Definition,异步模块定义):主要用于浏览器端的JS加载，为了不造成网络阻塞。只有当依赖的模块加载完毕，才会执行回调。（requirejs）

>CMD(Common Module Definition，公共模块定义):在前端使用commonjs的规范,（seajs）

>UMD(Universal Module Definition,通用模块定义):UMD是AMD和CommonJS的一个糅合（umd）

>ES6 Module:es6模块化格式


**一.基本格式（requirejs）**

config.js

```
require.config({
    baseUrl:'lib', //全局路径
    //各个js引用路径
    paths:{
        'jquery':'jquery.min',
        'bootstrap':'bootstrap.min'
    },
    //依赖关系
    shim:{
        'bootstrap':{
            'deps':['jquery']
        }
    }
});
```

index.html

```
<script src="https://cdn.bootcss.com/require.js/2.3.5/require.min.js"></script>
<script src="config.js"></script>
require(['bootstrap'],function () {})
```

**二.自定义js文件（requirejs）**

***标准***

app.js

```
define(['jquery'],function ($) {
   return {
      show:function () {
          console.log($);
      }
   } ;
});
```

index.html

```
require(['app'],function (app) {
    app.show();
})
```

***非标准***

app.js

```
function  show() {
    console.log('show')
}
```

config.js

```
shim:{
    'app':{
        'init':function () {
            return {
                show:show
             };
         }
     }
}
```

index.html

```
require(['app'],function (app) {
     app.show()
})
```