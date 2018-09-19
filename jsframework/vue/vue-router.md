# vue-router

>实现多视图的单页Web应用

```
<script src="https://cdn.bootcss.com/vue/2.5.13/vue.min.js"></script>
<script src="https://cdn.bootcss.com/vue-router/3.0.1/vue-router.min.js"></script>
```

**一.简单路由**

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/foo">Go to Foo</router-link>
    <router-link to="/bar">Go to Bar</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
const router = new VueRouter({
   routes:[
       {
           path:'/foo',
           component:{
              template: `<div>Hello Foo</div>`
           }
        },
        {
            path:'/bar',
            component:{
                template: `<div>Hello Bar</div>`
            }
        }
   ]
});
   
new Vue({
   el: '#app',
   router
})
</script>
```

<br>

**二.动态路由**

```
#$route.query（查询参数）$route.hash（锚点）
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/User/foo">Go to Foo</router-link>
    <router-link to="/User/bar">Go to Bar</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
//通过$route实例
const router = new VueRouter({
      routes:[
            {
                path: '/User/:name',
                component: {
                    template:'<div>Hello {{$route.params.name}}</div>'
                }
            }
        ]
});

new Vue({
     el: '#app',
     router
})


//通过组件属性
const router = new VueRouter({
    routes:[
        {
            path: '/User/:name',
            component: {
                props:['name'],
                template:'<div>Hello {{name}}</div>'
             },
             props:true
         }
    ]
});

new Vue({
     el: '#app',
     router
})

//对于包含命名视图的路由，你必须分别为每个命名视图添加props选项
props: { default: true, a: false }
</script>
```

<br>

**三.嵌套路由**

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/User">Default</router-link>
    <router-link to="/User/profile">Profile</router-link>
    <router-link to="/User/posts">Posts</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
const router = new VueRouter({
    routes:[
        {
           path: '/User',
           component: {
                template:`<router-view></router-view>`
            },
            children:[
                {
                    path:'',
                    component:{
                         template:`<h1>This is Default</h1>`
                    }
                 },
                 {
                     path:'profile',
                     component:{
                          template:`<h1>This is Profile</h1>`
                     }
                 },
                 {
                      path:'posts',
                      component:{
                          template:`<h1>This is Post</h1>`
                      }
                 }
             ]
        }
    ]
})

new Vue({
    el: '#app',
    router
})
</script>
```

<br>

**四.命名路由**

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link :to="{ name: 'user', params: { name: 'foo' }}">Go to Foo</router-link>
    <router-link :to="{ name: 'user', params: { name: 'bar' }}">Go to Bar</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
 const router = new VueRouter({
    routes:[
        {
            path: '/:name',
            name: 'user',
            component:{
                template:`<h1>Hello {{$route.params.name}}</h1>`
             }
         }
     ]
})

new Vue({
     el: "#app",
     router
})
</script>
```

<br>

**五.命名视图**

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/User/foo">Go to Foo</router-link>
    <router-link to="/User/bar">Go to Bar</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
    <router-view name="a"></router-view>
</div>
<script>
const router = new VueRouter({
      routes:[
         {
            path:'/User/:name',
            components:{
                 default : {
                     template:`<h1>This is Default,{{$route.params.name}}</h1>`
                  },
                  a:{
                      template:`<h1>This is A,{{$route.params.name}}</h1>`
                  }
            }
         }
     ]
});

new Vue({
   el:'#app',
    router
})
</script>
```

<br>

**六.重定向和别名**

***重命名***

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/foo">Go to Bar</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
const router = new VueRouter({
   routes:[
       {
          path:'/foo',
          redirect:'/bar'
       },
       {
          path:'/bar',
          component:{
             template:`<h1>This is Bar</h1>`
          }
        }
   ]
})
    
 new Vue({
   el:'#app',
   router
})
</script>
```

***别名***

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/foo">Go to Bar</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
const router = new VueRouter({
   routes:[
       {
         path:'/foo',
         alias:'/bar',
         component:{
           template:`<h1>This is Bar</h1>`
         }
       }
    ]
})

new Vue({
  el:'#app',
  router
})
</script>
```

<br>

**七.编程式的导航**

```
#1.手动导向路径,并推向history
    //字符串
    router.push('/User/bar')
    //对象(注意不要和params一同使用)
    router.push({ path: '/User/bar',query: { plan: 'private' }})
    //命名的路由
    router.push({ name: 'user',params: { userId }})
    //回调Complete(跳转成功),Abort(跳转终止)
    router.push('/User/bar',onComplete,onAbort)
#2.手动导向路径,但不推向history
    router.replace('/User/bar',onComplete,onAbort)
#3.history跳转
    router.go(n)
```

<br>

**八.导航守卫**

```
#1.全局守卫
router.beforeEach((to, from, next) => {
    console.log("===before===");
    console.log(from.path+"===>"+to.path);
    console.log("===before===");
    next(true);
});
router.afterEach((to, from) => {
    console.log("===after===");
    console.log(from.path+"===>"+to.path);
    console.log("===after===");
})

#2.路由独享的守卫
const router = new VueRouter({
    routes:[
     {
       beforeEnter:(to,from,next)=>{
        console.log("===before===");
        console.log(from.path+"===>"+to.path);
        console.log("===before===");
        next(true);
       }
     }
    ]
});
            
            
#3.组件内的守卫
const Foo = {
      template: `...`,
      beforeRouteEnter (to, from, next) {
        // 在渲染该组件的对应路由被 confirm 前调用
        // 不能获取组件实例 `this`
        // 因为当守卫执行前，组件实例还没被创建
      },
      beforeRouteUpdate (to, from, next) {
        // 在当前路由改变，但是该组件被复用时调用
        // 举例来说，对于一个带有动态参数的路径 /foo/:id，在 /foo/1 和 /foo/2 之间跳转的时候，
        // 由于会渲染同样的 Foo 组件，因此组件实例会被复用。而这个钩子就会在这个情况下被调用。
        // 可以访问组件实例 `this`
      },
      beforeRouteLeave (to, from, next) {
        // 导航离开该组件的对应路由时调用
        // 可以访问组件实例 `this`
      }
}
```
