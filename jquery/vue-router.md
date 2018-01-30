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
    // 1. 定义（路由）组件。
    const Foo = { template: '<div>foo</div>' }
    const Bar = { template: '<div>bar</div>' }

    // 2. 定义路由,每个路由应该映射一个组件
    const routes = [
        { path: '/foo', component: Foo },
        { path: '/bar', component: Bar }
    ]

    // 3. 创建 router 实例
    const router = new VueRouter({routes:routes})

    // 4. 创建和挂载根实例。
    const app = new Vue({
        router
    }).$mount('#app')
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
    const User = { template: '<div>Hello {{$route.params.name}}</div>' }
    const routes = [
        { path: '/User/:name', component: User },
    ]
    const router = new VueRouter({routes:routes})
    const app = new Vue({
        router
    }).$mount('#app')
</script>
```

<br>

**三.嵌套路由**

```
<div id="app">
    <!-- 使用 router-link 组件来导航. -->
    <router-link to="/User/foo">Go to Foo</router-link>
    <router-link to="/User/foo/profile">Profile</router-link>
    <router-link to="/User/foo/posts">Posts</router-link>
    <!-- 路由出口:路由匹配到的组件将渲染在这里 -->
    <router-view></router-view>
</div>
<script>
    const User = { template: '<div><div>Hello {{$route.params.name}}</div><router-view></router-view></div>'};
    const UserProfile={template :'<p>Profile</p>'};
    const UserPosts={template:'<p>Posts</p>'};
    const UserHome = { template: '<p>Home</p>'};
    const routes = [
        {
            path: '/User/:name',
            component: User,
            children: [
                { path:'', component: UserHome },
                { path: 'profile', component: UserProfile },
                { path: 'posts', component: UserPosts }
            ],
        }
    ];
    const router = new VueRouter({routes:routes});
    const app = new Vue({
        router
    }).$mount('#app')
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
    const User = { template: '<div>Hello {{$route.params.name}}</div>' };
    const routes = [
        { path: '/User/:name', component: User ,name:'user'}
    ];
    const router = new VueRouter({routes:routes});
    const app = new Vue({
        router
    }).$mount('#app');
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
    const User = { template: '<div>Hello {{$route.params.name}}</div>' };
    const Person = { template: '<div>Hi {{$route.params.name}}</div>' };
    const routes = [
        {   path: '/User/:name',
            components: {
                default: User,
                a: Person,
            }
        },
    ]
    const router = new VueRouter({routes:routes})
    const app = new Vue({
        router
    }).$mount('#app')
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
    const foo = { template: '<div>Foo</div>' };
    const bar={template:'<div>Bar</div>'};
    const routes = [
        { path: '/foo', component: foo, redirect:'/bar'},
        { path:'/bar',  component:bar},
    ]
    const router = new VueRouter({routes:routes})
    const app = new Vue({
        router
    }).$mount('#app')
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
    const foo = { template: '<div>Foo</div>' };
    const bar={template:'<div>Bar</div>'};
    const routes = [
        { path: '/foo', component: foo, redirect:'/ssr'},
        { path:'/bar',  component:bar,alias:'/ssr'},
    ]
    const router = new VueRouter({routes:routes})
    const app = new Vue({
        router
    }).$mount('#app')
</script>
```

<br>

**七.编程式的导航**

```
#向history 栈添加一个新的记录
//字符串
router.push('/User/bar')
//对象
router.push({ path: '/User/bar' })
//命名的路由
router.push({ name: 'user', params: { userId: 123 }})
//带查询参数，变成 /register?plan=private
router.push({ path: '/User/bar', query: { plan: 'private' }})
//跳转
router.go(n)
```