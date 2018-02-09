# angular-router


**一.基本路由**

```
<script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
<script src="https://cdn.bootcss.com/angular-ui-router/1.0.3/angular-ui-router.min.js"></script>

<div ng-app="hd" ng-controller="ctrl">
    <!--显示路由相对应的模板-->
    <div ui-view></div>
</div>

<script>
    var m=angular.module('hd',['ui.router']);
    //配置路由
    m.config(['$stateProvider','$urlRouterProvider',function ($stateProvider,$urlRouterProvider) {
        //设置默认路由
        $urlRouterProvider.otherwise('/home');
        //设置路由
        $stateProvider.state('home',{
            url:'/home',
            template:"<h1>Home</h1>"
        })
    }]);
    m.controller('ctrl',['$scope',function ($scope) {

    }]);
</script>
```

<br>

**二.多个路由**

```
<div ng-app="hd" ng-controller="ctrl">
    <a href="" ui-sref="video">视频</a>
    <a href="#/home">主页</a>
    <a href="" ng-click="go('login')">登录</a>
    <a href="" ui-sref="info({id:1})">信息</a>
    <!--显示路由相对应的模板-->
    <div ui-view></div>
</div>

<script>
    var m=angular.module('hd',['ui.router']);
    //配置路由
    m.config(['$stateProvider','$urlRouterProvider',function ($stateProvider,$urlRouterProvider) {
        //设置默认路由
        $urlRouterProvider.otherwise('/home');
        //设置路由
        $stateProvider.state('home',{
            url:'/home',
            template:"<h1>{{name}}</h1>",
            controller:'ctrl'
        }).state('video',{
            url:'/video',
            template:"<h1>{{name}}</h1>",
            controller:['$scope',function ($scope) {
               $scope.name="Video";
            }]
        }).state('login',{
            url:'/login',
            template:"<h1>Login</h1>",
            controller:'ctrl'
        }).state('info',{
            url:'/info/{id}',
            template:"<h1>Info</h1>",
            controller:'ctrl'
        })
    }]);
    m.controller('ctrl',['$scope','$state','$stateParams',function ($scope,$state,$stateParams) {
        $scope.name="Home";
        $scope.go=function (url) {
            //用于验证切换页面
           $state.go(url);
        };
        console.log($stateParams.id);
    }]);
</script>
```

<br>

**三.嵌套路由**

```
<div ng-app="hd" ng-controller="ctrl">
    <a href="" ui-sref="video">视频</a>
    <a href="" ui-sref="home">主页</a>
    <!--显示路由相对应的模板-->
    <div ui-view></div>
</div>

<script>
    var m=angular.module('hd',['ui.router']);
    //配置路由
    m.config(['$stateProvider','$urlRouterProvider',function ($stateProvider,$urlRouterProvider) {
        //设置默认路由
        $urlRouterProvider.otherwise('/home');
        //设置路由
        $stateProvider.state('home',{
            url:'/home',
            template:"<h1>Home</h1>"
        }).state('video',{
            url:'/video',
            template:"<div><h1>Video</h1><a href='' ui-sref='name'>名字</a><a href='' ui-sref='year'>年份</a><div ui-view></div></div>"
        }).state('name',{
            url:'/name',
            parent:'video',
            template:"<h1>name</h1>"
        }).state('year',{
            url:'/year',
            parent:'video',
            template:"<h1>year</h1>"
        })
    }]);
    m.controller('ctrl',['$scope',function ($scope) {

    }]);
</script>
```

<br>

**四.多视图路由**

```
<div ng-app="hd" ng-controller="ctrl">
    <div ui-view="top"></div>
    <div ui-view="middle"></div>
    <div ui-view="bottom"></div>
</div>

<script>
    var m=angular.module('hd',['ui.router']);
    //配置路由
    m.config(['$stateProvider','$urlRouterProvider',function ($stateProvider,$urlRouterProvider) {
        //设置默认路由
        $urlRouterProvider.otherwise('/home');
        //设置路由
        $stateProvider.state('home',{
            url:'/home',
            views:{
                top:{template:'<h1>Top</h1>'},
                middle:{template:'<h1>Middle</h1>'},
                bottom:{template:'<h1>Bottom</h1>'}
            }
        })
    }]);
    m.controller('ctrl',['$scope',function ($scope) {

    }]);
</script>
```