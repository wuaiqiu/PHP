# angular

**一.控制器**

```
1.ng-app : 告诉AngularJS，div元素是AngularJS应用程序的"所有者"
2.ng-controller : 指明了控制器,用于控制AngularJS应用
3.ng-init : 临时初始化数据
4.ng-cloak : 页面加载时防止应用闪烁
5.$scope : 他是viewModel对象，用于展示视图

<div ng-app="hd" ng-controller="ctrl" ng-init="age=12" ng-cloak>
    <h1>{{name}}</h1>
    <h1>{{age}}</h1>
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
            $scope.name="百度";
    }]);
</script>
```

<br>

**二.数据绑定**

```
1.{{ }} : AngularJS表达式，它们可以包含文字、运算符和变量
2.ng-bind : 把应用程序变量name绑定到某个段落的innerHTML
3.ng-model : 把输入域的值绑定到应用程序变量name，实现双向绑定，当绑定不存在的值(标量)，改变时则会自动创建
4.ng-value : 规定input元素的值
5.ng-true-value : 当value为true时，指定他的值
6.ng-false-value : 当value为false时，指定他的值
7.ng-model-options : 设置双向数据绑定

<div ng-app="hd" ng-controller="ctrl">
    <h1>{{name}}</h1>
    <h1 ng-bind="name"></h1>
    <input type="text" ng-model="name">
    <input type="text" ng-model="sex">
    <input type="text" ng-value="age * 20">
    <input type="checkbox" ng-model="status" ng-true-value="1" ng-false-value="0">
    <!--失去焦点触发-->
    <input type="text" ng-model="name" ng-model-options="{updateOn:'blur'}">
    <!--延迟触发-->
    <input type="text" ng-model="name" ng-model-options="{debounce:3000}">
    <!--结合-->
    <input type="text" ng-model="name" ng-model-options="{updateOn:'default blur',debounce:{default:3000,blur:0}}">
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.name="百度";
        $scope.age=20;
        $scope.status=0;
    }]);
</script>
```

<br>

**三.效果**

```
1.ng-show : 表达式为true时显示指定的HTML元素
2.ng-hide : 表达式为true时隐藏指定的HTML元素
3.ng-if : 表达式为true时移除指定的HTML元素
4.ng-disabled : 表达式为true时禁用指定的HTML元素
5.ng-readonly : 表达式为true时只读指定的HTML元素

<div ng-app="hd" ng-controller="ctrl">
    <h1 ng-show="status">Hello world</h1>
    <h1 ng-hide="status">Hello world</h1>
    <h1 ng-if="status">Hello world</h1>
    <input type="text" ng-readonly="status"/>
    <button ng-disabled="status">按钮</button>
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.status =1;
    }]);
</script>
```

<br>

**四.遍历**

```
1.ng-options : 列表循环
2.ng-repeat : 用于循环输出指定次数的HTML元素


<div ng-app="hd" ng-controller="ctrl">
    <select ng-options="v.value as v.key for v in list" ng-model="checked"></select>
    <li ng-repeat="(key,value) in data">
        索引($index) : {{key}} ==> {{value}}<br>
        是否为第一个:{{$first}}<br>
        是否为最后一个:{{$last}}<br>
        是否在中间:{{$middle}}<br>
        是否为基数:{{$odd}}<br>
        是否为偶数:{{$even}}<br>
    </li>
    <!--当有重复值时以索引唯一区别-->
    <li ng-repeat="value in datas track by $index">
        索引($index) : {{value}}
    </li>
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.checked='C';
        $scope.list=[{key:'a',value:'A'},{key:'b',value:'B'},{key:'c',value:'C'}];
        $scope.data={a:"A",b:"B",c:"C"};
        $scope.datas=[1,2,3,1];
    }]);
</script>
```

<br>

**五.工具方法**

```
<div ng-app="hd" ng-controller="ctrl">

</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        console.log(angular.lowercase('AbC'));  //将字符串转换为小写
        console.log(angular.uppercase('aBc'));  //将字符串转换为大写
        var obj={name:'zhangsan'};
        var newobj={};
        angular.copy(obj,newobj); //数组或对象深度拷贝
        angular.extend(obj,{age:12});//数组或对象合并
        var arr=['a','b','c'];
        angular.forEach(arr,function (value,key) {
            console.log(key+"=>"+value);
        }); //对象或数组的迭代函数
        console.log(angular.fromJson({"name":"lisi"})); //将json字符转换为对象
        console.log(angular.toJson({name:"lisi"}));//将对象转换成json字符串
    }]);
</script>
```

<br>

**六.组件样式**

```
1.ng-class : 指定HTML元素使用的CSS类
2.ng-class-even : 类似ng-class，但只在偶数行起作用
3.ng-class-odd : 类似ng-class，但只在奇数行起作用
4.ng-style : 指定元素的style属性

<style>
    .big{
        font-size: 20px;
    }
    .color{
        color: red;
    }
</style>

<div ng-app="hd" ng-controller="ctrl">
    <span ng-class="{big:true,color:false}">{{name}}</span>
    <span ng-style="{fontSize:'20px',color:'red'}">{{name}}</span>
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.name="百度";

    }]);
</script>
```

<br>

**七.事件**

```
1.ng-click : 点击事件
2.ng-blur : 规定blur事件的行为
3.ng-focus : 规定聚焦事件的行为
4.ng-keydown : 规定按下按键事件的行为
5.ng-keyup : 规定松开按键事件的行为

<div ng-app="hd" ng-controller="ctrl">
    <button ng-click="fun()">点击</button>
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.fun=function () {
            console.log('触发点击事件');
        }
    }]);
</script>
```

<br>

**八.过滤器**

```
1.currency:货币符号；小数位数
2.number:小数位数
3.lowercase
4.uppercase
5.limitTo:长度；起点
6.date:格式
7.orderBy:排序对象；是否降序
8.filter:匹配值；是否完全匹配

<div ng-app="hd" ng-controller="ctrl">
    {{price|currency:"@":2}}<br>
    {{price|number:2}}<br>
    {{name|lowercase|uppercase}}<br>
    {{text|limitTo:5:2}}<br>
    {{time|date:'yyyy-MM-dd HH:mm:ss'}}<br>
    {{person|orderBy:"age":true}}<br>
    {{person|filter:'张三':true}}<br>
    <button ng-click="fun()">点击</button>
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope','$filter',function ($scope,$filter) {
        $scope.price=123.456;
        $scope.name="aBcD";
        $scope.text="司法局的客服解决了司法";
        $scope.time=new Date().getTime();
        $scope.person=[{name:'张三',age:12},{name:'李四',age:10},{name:"王五",age:13}];
        $scope.fun=function () {
            //在控制器中使用过滤器
            $scope.person=$filter('orderBy')($scope.person,'age',false);
        }
    }]);
</script>


1.自定义过滤器

<div ng-app="hd" ng-controller="ctrl">
   <div>{{name|myFilter}}</div>
</div>

<script>
    var m=angular.module('hd',[]);
    m.filter('myFilter',[function () {
        return function (data) {
            return data.length;
        }
    }]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.name="zhangsan";
    }]);
</script>
```

<br>

**九.监听数据**

```
<div ng-app="hd" ng-controller="ctrl">
   <input type="text" ng-model="name">
    <input type="text" ng-model="info.name">
</div>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope','$filter',function ($scope,$filter) {
       $scope.name="";
       $scope.info={name:''};
       //监听普通数据
       $scope.$watch('name',function (newValue,oldValue) {
           console.log(oldValue+" ===> "+newValue);
       });
       //监听对象
       $scope.$watch('info',function (newValue,oldValue) {
           console.log(oldValue.name+" ===> "+newValue.name);
       },true);
    }]);
</script>
```

<br>

**十.自定义组件**

```
<div ng-app="hd">
    <div hd-cms></div>
    <hd-cms></hd-cms>
    <div class="hd-cms"></div>
    <div hd-cms color="red">Hello world</div>
    <hd-cms><span>Transclude</span></hd-cms>
</div>

<script>
    var m = angular.module('hd',[]);
    m.directive('hdCms',[function () {
        return {
            restrict:'AEC', //指定组件类型（属性，元素，类）
            template:'<h1><div ng-transclude></div>百度一下</h1>', //返回内容
            templateUrl:"template.html",
            template: function (elem,attr) {
                return '<span style="color:'+attr["color"]+'">'+elem.innerHTML+'</span>';
            },
            replace:true,//true是template替换hd-cms标签，但template必须有一个根标签；false是template为hd-cms的子标签
            transclude:true,//true是将原来的子元素复制到ng-transclude中
            controller:['$scope',function ($scope) {
               $scope.data="Hello world";
            }],//定义控制器
            link:function ($scope,elem,attr) {
                //用于元素的Dom操作
            }
        }
    }]);
</script>
```

<br>

**十一.作用域**

```
1.控制器作用域
(1).当父控制器创建name变量后，子控制器会继承
(2).当子控制器input改变时，子控制器会创建name变量，则不受父控制器改变
(3).若变量为对象时，则子父控制器共用一个对象

<div ng-app="hd" >
    <div ng-controller="ctrl">
        {{name}}<input type="text" ng-model="name">
    <div ng-controller="ctrl1">
        {{name}}<input type="text" ng-model="name">
    </div>
    <div ng-controller="ctrl2">
        {{name}}
    </div>
    </div>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.name="abc";
    }]);
    m.controller('ctrl1',['$scope',function ($scope) {
    }]);
    m.controller('ctrl2',['$scope',function ($scope) {
    }]);
</script>


2.指令作用域

<div ng-app="hd" >
    <div ng-controller="ctrl">
        {{name}}<input type="text" ng-model="name"><br>
        <hd-cms></hd-cms><br>
        <hd-cms></hd-cms><br>
    </div>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.name="abc";
    }]);
    m.directive('hdCms',[function () {
        return {
            restrict:'E',
            template:'{{name}}<input type="text" ng-model="name"/>',
            scope:{},//true则与控制器原理相同，false则共用父控制器变量，{}采用完全独立作用域完全不继承父控制器
        };
    }]);
</script>
```

<br>

**十二.组件数据绑定**

```
1.单向数据绑定

<div ng-app="hd" ng-controller="ctrl">
    <input type="text" ng-model="color">
    <hd-cms color="{{color}}"></hd-cms>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.color="red";
    }]);
    m.directive('hdCms',[function () {
        return {
            restrict:'E',
            template:'<span style="color:{{color}}">Hello World</span>',
            scope:{color:'@color'}, //color变量为读取hd-cms的color属性值，若属性与变量同名则可以直接使用'@'
        };
    }]);
</script>


2.双向数据绑定

<div ng-app="hd" ng-controller="ctrl">
    <input type="text" ng-model="color">
    <hd-cms color="color"></hd-cms>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.color="red";
    }]);
    m.directive('hdCms',[function () {
        return {
            restrict:'E',
            template:'<span style="color:{{color}}">Hello World</span><input type="text" ng-model="color">',
            scope:{color:'=color'},//'=' 表示将color值视为变量
        };
    }]);
</script>


3.回调方法数据绑定

<div ng-app="hd" ng-controller="ctrl">
    <hd-cms color="color()"></hd-cms>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.color=function () {
            return 'red';
        };
    }]);
    m.directive('hdCms',[function () {
        return {
            restrict:'E',
            template:'<span style="color:{{color()}}">Hello World</span>',
            scope:{color:'&color'},//'&' 表示将color值视为函数
        };
    }]);
</script>
```

<br>

**十三.服务**

```
1.$apply:处理非angular方法更新问题

<div ng-app="hd" ng-controller="ctrl">
    {{name}}<button id="bt">点击改变</button><br>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope',function ($scope) {
        $scope.name="zhangsan";
        $("#bt").click(function () {
           $scope.name="lisi";
           $scope.$apply();
        });
    }]);
</script>


2.$timeout 与 $interval

<div ng-app="hd" ng-controller="ctrl">
    {{name}}
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope','$timeout',function ($scope,$timeout) {
        $scope.name="zhangsan";
        var tid=$timeout(function () {
           $scope.name="lisi";
        },2000);
        $timeout.cancel(tid);
        var iid=$interval(function () {
            $scope.name="lisi";
        },2000);
        $interval.cancel(iid);
    }]);
</script>


3.$sce(不需要安全处理)

<div ng-app="hd" ng-controller="ctrl">
   <div ng-bind-html="text"></div>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope','$sce',function ($scope,$sce) {
        $scope.text=$sce.trustAsHtml("<h1>Hello</h1>");
    }]);
</script>


4.$cacheFactory:session级别缓存

<div ng-app="hd" ng-controller="ctrl">
   <div>{{name}}</div>
</div>

<script>
    var m=angular.module('hd',[]);
    m.controller('ctrl',['$scope','$cacheFactory',function ($scope,$cacheFactory) {
        var obj=$cacheFactory('hd');
        obj.put('a','A');
        $scope.name=obj.get('a');
        obj.remove('a');
        obj.removeAll();
        obj.destroy();
    }]);
</script>


5.$http:后台异步请求

#get请求
$http({
     method:'get',
     url:'2.php'，
     cache:true,//当有多次相同请求，可以使用缓存
}).then(function (response) {
     //请求成功时
     console.log(response.data);
},function (response) {
      //请求失败时
     console.log(response.statusText);
});

#get请求简写

$http.get('1.php',{cache:true}).then(function (response) {
     console.log(response.data);
},function (response) {
     console.log(response.statusText);
});


#post请求
$http({
     method:'post',
     url:'1.php',
     data:{id:1}
}).then(function (response) {
     console.log(response.data);
},function (response) {
      console.log(response.statusText);
})

1.php

$con=file_get_contents('php://input');
print_r($con);


#post请求
$http({
    method:'post',
    url:'1.php',
    data:$.param({id:1}),
    headers:{'Content-type':'application/x-www-form-urlencoded'}
}).then(function (response) {
    console.log(response.data);
},function (response) {
    console.log(response.statusText);
})
```

<br>

**十四.自定义服务**

```
#factory方式
var m=angular.module('hd',[]);
m.factory('myService',[function () {
   return {
       get: function () {
          console.log('get');
        }
    }
}]);
m.controller('ctrl',['$scope','myService',function ($scope,myService) {
      myService.get();
}]);


#service方式
var m=angular.module('hd',[]);
m.service('myService',[function () {
    this.get=function () {
        console.log('get');
    }
}]);
m.controller('ctrl',['$scope','myService',function ($scope,myService) {
        myService.get();
}]);
```