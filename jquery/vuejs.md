# vuejs

(1)**文本插值**

```
<p>{{ message }}</p>

 new Vue({
        el: '#box',
        data: {
            message: 'Hello Vue.js!'
        }
});

#支持js表达式
{{5+5}}<br>
{{ message ? 'YES' : 'NO' }}<br>
{{ message.split('').reverse().join('') }}
```

<br>

(2)**v-html**

```
#用于输出 html 代码
<div id="box" v-html="message"></div>

 new Vue({
        el: '#box',
        data: {
            message: "<h1>Hello Vue.js!</h1>"
        }
});
```

<br>

(3)**v-bind**

```
#用来修改属性
<a  v-bind:href="url">菜鸟教程</a>
<a :href="url">菜鸟教程</a>

new Vue({
        el: 'a',
        data: {
            url:"http://www.baidu.com",
        }
});

#class属性
<div id="box" v-bind:class="{'class1':isUsed}"></div>
<div id="box" :class="{'class1':isUsed}"></div>
<div v-bind:class="Object"></div>
<div v-bind:class="computed"></div>
<div v-bind:class="[activeClass, errorClass]"></div>

new Vue({
    el:"#box",
    data:{
        isUsed:true,
        Object: {
            class1:true
        },
        activeClass:{
            class2:true
        },
        errorClass:{
            class3:true
        }
     },
     computed:{
        computed:function(){
            return {class1:true}
        }
     }
})

#style属性
<div v-bind:style="{ color: activeColor, fontSize: fontSize + 'px' }">菜鸟教程</div>
<div v-bind:style="[baseStyles, overridingStyles]">菜鸟教程</div>

new Vue({
       el: 'div',
       data: {
           activeColor: 'green',
           fontSize: 30,
           baseStyles:{
               color: 'green'
            },
            overridingStyles:{
                fontSize: '30px'
            }
        }
})
```

<br>


(4)**v-model**

```
#双向数据绑定
<div id="app">
    <p>{{ message }}</p>
    <!--只绑定一次-->
    <p v-once>{{message}}</p>
    <input v-model="message">
</div>

new Vue({
        el: '#app',
        data: {
           message:"sss",
        }
});

#单选框
<div id="app">
    <input type="radio"  value="Runoob" v-model="picked">Runoob
    <input type="radio"  value="Google" v-model="picked">Google
    <span>选中值为: {{ picked }}</span>
</div>

new Vue({
     el: '#app',
     data: {
         picked : 'Runoob'
     }
})

#复选框
<div id="app">
    <input type="checkbox"  value="Runoob" v-model="checkedNames">Runoob
    <input type="checkbox" value="Google" v-model="checkedNames">Google
    <span>选择的值为: {{ checkedNames }}</span>
</div>

new Vue({
      el: '#app',
      data: {
         checkedNames: []
      }
})

#下拉列表
<div id="app">
    <select v-model="selected" name="fruit">
        <option value="www.runoob.com">Runoob</option>
        <option value="www.google.com">Google</option>
    </select>
    <div id="output">选择的网站是: {{selected}}</div>
</div>

new Vue({
       el: '#app',
       data: {
           selected: ''
       }
})

#其他属性
<!--不在同步，只有改变完成后才变化-->
<input v-model.lazy="message">
<!--自动去除空格-->
<input v-model.trim="message">
```

<br>

(5)**v-on**

```
#绑定事件
<button v-on:click="fun">点击</button>
<button @click="fun">点击</button>
<button v-on:click="fun1('hello')">点击</button>
<button v-on:click="fun2('hello',$event)">点击</button>

new Vue({
      el:"button",
      data:{
          message:"apple",
      },
       methods:{
         fun:function (event) {
            console.log("ok",event);
          },
         fun1:function(str){
              console.log(str);
          },
	 fun2:function(str,event){
              console.log(str,event);
          }
       }
});

#其他类型
<!-- 阻止单击事件冒泡 -->
<a v-on:click.stop="doThis"></a>
<!-- 提交事件不再重载页面 -->
<form v-on:submit.prevent="onSubmit"></form>
<!-- 修饰符可以串联  -->
<a v-on:click.stop.prevent="doThat"></a>
<!-- click 事件只能点击一次 -->
<a v-on:click.once="doThis"></a>
<!-- 只有在 keyCode 是 13 时调用 vm.submit() -->
<input v-on:keyup.13="submit">
<!-- 同上（enter，delete，tab，esc，space，up，down，left，right，ctrl，alt，shift） -->
<input v-on:keyup.enter="submit">
```

<br>

(6)**过滤器**

```
<p> {{ message | capitalize }}</p>

new Vue({
      el:"p",
      data:{
          message:"apple",
      },
      filters: {
          capitalize: function (value) {
               return value.charAt(0).toUpperCase();
              }
      }
});


#传参
<p> {{ num | add(1) }}</p>

new Vue({
        el: "p",
        data: {
            num: 3,
        },
        filters: {
            add:function (a,b) {
                return a+b;
            }
        }
});
```

<br>

(7)**条件语句**

```
<p v-if="seen">现在你看到我了</p>
<p v-show="seen">现在你看到我了</p>

new Vue({
    el:"p",
    data:{
       seen:true,
    }
});

<div id="box">
    <div v-if="Math.random() > 0.5">Sorry</div>
    <div v-else>Not sorry</div>
</div>

new Vue({
    el:"#box"
})


<div id="box">
    <div v-if="type === 'A'">A</div>
    <div v-else-if="type === 'B'">B</div>
    <div v-else-if="type === 'C'">C</div>
    <div v-else>Not A/B/C</div>
</div>

new Vue({
       el:"#box",
       data:{
           type:'A'
       }
});

#渲染结果将不包含<template>元素,v-show不支持<template>元素
<div id="app">
    <template v-if="seen">
        <h1>Title</h1>
        <p>Paragraph 1</p>
        <p>Paragraph 2</p>
    </template>
</div>
```

<br>

(8)**循环语句**

```
#数组迭代
<ul>
    <li v-for="site in sites">{{ site.name }}</li>
</ul>

new Vue({
       el: "ul",
       data: {
           sites: [
                {name: 'Runoob'},
                {name: 'Google'},
                {name: 'Taobao'}
            ]
        }
});


#对象迭代
<ul>
   <li v-for="(value, key) in object">{{ key }} : {{ value }}</li>
</ul>

<ul>
    <li v-for="(value, key,index) in object">{{index}} {{ key }} : {{ value }}</li>
</ul>

new Vue({
        el: "ul",
        data: {
            object: {
                name: '菜鸟教程',
                url: 'http://www.runoob.com',
                slogan: '学的不仅是技术，更是梦想！'
            }
        }
});

#整数迭代
<ul>
    <li v-for="n in 10">{{ n }}</li>
</ul>

#注意事项
1.Vue不能检测以下变动的数组：
 当你利用索引直接设置一个项时，例如：vm.items[indexOfItem] = newValue
 当你修改数组的长度时，例如：vm.items.length = newLength
 vm.$set(vm.items, indexOfItem, newValue)
 vm.items.splice(newLength)

2.Vue不能检测对象属性的添加或删除：
 1.当你添加或删除某个对象属性时，例如：vm.userProfile.age = 27
 vm.$set(vm.userProfile, 'age', 27)
```

<br>

(9)**侦听属性**

```
#随着监听属性的的改变而触发
<div id="app">
    <p>小写字符串: {{ message }}</p>
    <p>大写字符串: {{ upperMessage }}</p>
</div>

var vm = new Vue({
        el: '#app',
        data: {
            message: 'abc',
            upperMessage: 'ABC'
        },
        watch: {
            message: function (val,old){
                console.log(old);
                this.upperMessage = val.toUpperCase();
            }
        }
});
```

<br>

(10)**计算属性**

```
#与methods的区别是利用缓存
<div id="app">
    <p>原始字符串: {{ message }}</p>
    <p>大写字符串: {{ upperMessage }}</p>
</div>

new Vue({
      el: '#app',
      data: {
          message: 'abc'
       },
       computed: {
           upperMessage: function () {
                return this.message.toUpperCase();
            }
        }
})

#计算属性默认只有getter,不过在需要时你也可以提供一个setter
new Vue({
        el: '#app',
        data: {
            message: 'abc'
        },
        computed: {
            upperMessage: {
                get:function () {
                    return this.message.toUpperCase();
                },
                set:function (value) {
                    this.message = value;
                }
            }
        }
});
```

<br>

(11)**组件**

```
#全局组件
<div id="app">
    <runoob></runoob>
</div>

//注册:component中可以拥有vue实例的所有选项(除了el)
Vue.component('runoob', {
       template: '<h1>{{message}}自定义组件!</h1>',
       #一个组件的data选项必须是一个函数,因此每个实例可以维护一份被返回对象的独立的拷贝
       data:function () {
   	 return {
      	   message: 'Hello'
	 }
       }
})
new Vue({
        el: '#app'
})

#局部组件
<div id="app">
    <runoob></runoob>
</div>

var Child =
new Vue({
       el: '#app',
       components: {
            'runoob':  {
                template: '<h1>自定义组件!</h1>'
            }
       }
})

#定义属性(prop 是单向绑定的：当父组件的属性变化时，将传导给子组件，但是不会反过来)
<div id="app">
    <child value="hello"></child>
</div>

Vue.component('child', {
       props: ['value'],
       template: '<span>{{ value }}</span>'
})
new Vue({
       el: '#app'
})

#属性验证
<div id="app">
    <child value="hello"></child>
    <child></child>
</div>

Vue.component('child', {
     props: {
         value: {
             type: String,   #(String Number Boolean Function Object Array)
             default: 'ss',
             required: true,
          },
          // 自定义验证函数
          propF: {
                validator: function (value) {
                    return value > 10
                }
           }
      },
      template: '<span>{{ value }}</span>'
});
new Vue({
       el: '#app'
});

#通过事件向父级组件发送消息(注意$event是访问被抛出的这个值)
<div id="app" :style="{color: font}">
    <runoob @change-color="change($event)"></runoob>
</div>

Vue.component('runoob', {
    template: `<h1>自定义组件!<button @click="$emit('change-color','blue')">green</button></h1>`
});
new Vue({
     el: '#app',
     data:{
         font:'red'
      },
      methods:{
          'change':function (event) {
          this.font=event;
        }
     }
});

#slot插槽
1.slot插槽内可以包含任何模板代码,包括HTML;如果没有包含一个<slot>元素,则任何传入它的内容都会被抛弃
<div id="app">
    <runoob>Hello Vue</runoob>
</div>

Vue.component('runoob', {
    template: `<h1><slot>默认内容</slot></h1>`
});

new Vue({
    el: '#app'
});

2.slot命名:保留一个未命名插槽,这个插槽是默认插槽,它会作为所有未匹配到插槽的内容的slot
<div id="app">
    <runoob>
        <h1 slot="header">Here might be a page title</h1>
        <p>A paragraph for the main content.</p>
        <p>And another one.</p>
        <p slot="footer">Here's some contact info</p>
    </runoob>
</div>

Vue.component('runoob', {
    template: `<div class="container">
                    <header>
                        <slot name="header"></slot>
                    </header>
                    <main>
                        <slot></slot>
                    </main>
                    <footer>
                        <slot name="footer"></slot>
                    </footer>
                </div>`
});
new Vue({
    el: '#app'
});
```

<br>

**(12).自定义指令**

```
<div id="app">
	<p v-color>页面载入时，input 元素自动获取焦点：</p>
</div>
<div id="app1">
	<p v-color>页面载入时，input 元素自动获取焦点：</p>
</div>

#注册一个全局自定义指令v-color
Vue.directive('color', {
  bind: function (el) {
 	el.style.color="red";
  }
})
new Vue({
  el: '#app'
})
new Vue({
  el: '#app1'
})

#注册一个局部的自定义指令v-color
new Vue({
  el: '#app',
  directives: {
    color: {
      bind: function (el) {
       el.style.color="red";
      }
    }
  }
})

#钩子函数(bind:第一次绑定到元素时调用;update:在bind之后立即以初始值为参数第一次调用，之后绑定值变化的时候，参数为新值与旧值;unbind:指令与元素解绑时调用)
<div id="app">
    <p v-color:red="message">Hello</p>
</div>
<script>
    Vue.directive('color', {
        bind: function (el,binding) {
            console.log("bind");
            console.log(el); //<p>Hello</p>
            console.log(binding.name); //color
            console.log(binding.arg); //red
            console.log(binding.value); //#ff0000
        },
        update:function (el,binding) {
            console.log("update");
            console.log(el); //<p>Hello</p>
            console.log(binding.name); //color
            console.log(binding.arg); //red
            console.log(binding.value); //#000000
            console.log(binding.oldValue);//#ff0000
        },
        unbind:function (el,binding) {
            console.log("unbind");
            console.log(el); //<p>Hello</p>
            console.log(binding.name); //color
            console.log(binding.arg); //red
            console.log(binding.value); //#000000
        }
    });
    var vm= new Vue({
        el: '#app',
        data:{
            message:"#ff0000"
        }
    });
</script>


//bind,update简写方法
Vue.directive('color', function (el,binding) {
            console.log(el); //<p>Hello</p>
            console.log(binding.name); //color
            console.log(binding.arg); //red
            console.log(binding.value); //#000000
            console.log(binding.oldValue);//#ff0000

});
```

<br>

**(13).生命周期**

```
<div>
<p>{{message}}</p>
</div>
<script>
   var vm= new Vue({
       el:"div",
       data:{
           message:"Hello world"
       },
        beforeCreate: function() {
            console.group('------beforeCreate创建前状态------');
            console.log(this.$el); //undefined
            console.log(this.message);//undefined
        },
        /*
        *data属性进行绑定,初始化事件
        * */
        created: function() {
            console.group('------created创建完毕状态------');
            console.log(this.$el); //undefined
            console.log(this.message); //Hello world
        },
        /*
        * el元素进行绑定,如果没有el选项，则停止编译，也就意味着停止了生命周期
        * */
        beforeMount: function() {
            console.group('------beforeMount挂载前状态------');
            console.log(this.$el);//<div><p>{{message}}</p></div>
            console.log(this.message); //Hello world
        },
        /*
        *检查template参数选项,如果有template则代替el，否则完成数据绑定
        * */
        mounted: function() {
            console.group('------mounted 挂载结束状态------');
            console.log(this.$el); //<div><p>Hello world</p></div>
            console.log(this.message); //Hello world
        },
        /*
        *发现data中的数据发生了改变
        * */
        beforeUpdate: function () {
            console.group('beforeUpdate 更新前状态===============》');
            console.log(this.$el.innerHTML); //<p>Hello world</p>
            console.log(this.message); //Hello worlds
        },
        /*
        * view层重新渲染，数据更新
        * */
        updated: function () {
            console.group('updated 更新完成状态===============》');
            console.log(this.$el.innerHTML); //<p>Hello worlds</p>
            console.log(this.message); //Hello world
        },
        /*
        *vue实例销毁时触发(vm.$destroy())
        * */
        beforeDestroy: function () {
            console.group('beforeDestroy 销毁前状态===============》');
            console.log(this.$el); //<div><p>Hello world</p></div>
            console.log(this.message); //Hello world
        },
       /*
       * Vue 实例指示的所有东西都会解绑定，所有的事件监听器会被移除，所有的子实例也会被销毁
       * */
        destroyed: function () {
            console.group('destroyed 销毁完成状态===============》');
            console.log(this.$el); //<div><p>Hello world</p></div>
            console.log(this.message); //Hello world
        }
    });
</script>
```

<br>

**(14).mixin**

```
#1.选项合并:数据对象在内部会进行浅合并 (一层属性深度)，在和组件的数据发生冲突时以组件数据优先
var mixin = {
  data: function () {
    return {
      message: 'hello',
      foo: 'abc'
    }
  }
}

new Vue({
  mixins: [mixin],
  data: function () {
    return {
      message: 'goodbye',
      bar: 'def'
    }
  },
  created: function () {
    console.log(this.$data)
    //{ message: "goodbye", foo: "abc", bar: "def" }
  }
})

#2.钩子函数合并:同名钩子函数将混合为一个数组,因此都将被调用。另外,混入对象的钩子将在组件自身钩子之前调用。
var mixin = {
  created: function () {
    console.log('混入对象的钩子被调用')
  }
}

new Vue({
  mixins: [mixin],
  created: function () {
    console.log('组件钩子被调用')
  }
})
// "混入对象的钩子被调用"
// "组件钩子被调用"

#3.特殊选项合并:值为对象的选项,例如 methods,components和directives,将被混合为同一个对象。
#两个对象键名冲突时，取组件对象的键值对。
var mixin = {
  methods: {
    foo: function () {
      console.log('foo')
    },
    conflicting: function () {
      console.log('from mixin')
    }
  }
}

var vm = new Vue({
  mixins: [mixin],
  methods: {
    bar: function () {
      console.log('bar')
    },
    conflicting: function () {
      console.log('from self')
    }
  }
})

vm.foo() //"foo"
vm.bar() //"bar"
vm.conflicting() //"from self"

#4.全局混入
Vue.mixin({
  created: function () {
    var myOption = this.$options.myOption
    if (myOption) {
      console.log(myOption)
    }
  }
})

new Vue({
  myOption: 'hello!'
})
//"hello!"
```
