# requirejs

**一.基本格式**

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

**二.自定义js文件**

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