# vuejs

(1)**文本插值**

```
<p>{{ message }}</p>
<!--原样输出-->
<p>{{{message}}}</p>

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
        classObject: {
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
     <!--数据只绑定一次-->
    <p>{{ *message }}</p>
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

(6)**v-on**

```
#绑定事件
<button v-on:click="fun">点击</button>
<button @click="fun">点击</button>
<button v-on:click="fun1('hello')">点击</button>

new Vue({
      el:"button",
      data:{
          message:"apple",
      },
       methods:{
         fun:function () {
            console.log("ok");
          },
          fun1:function(str){
                console.log(str);
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

(7)**过滤器**

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

(8)**条件语句**

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
```

<br>

(9)**循环语句**

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
```

<br>

(11)**组件**

```
#全局组件
<div id="app">
    <runoob></runoob>
</div>

// 注册
Vue.component('runoob', {
       template: '<h1>自定义组件!</h1>'
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

#定义属性
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
```