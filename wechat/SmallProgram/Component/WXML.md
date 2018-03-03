# WXML


```
数据绑定
1.{{false}}{{true}}表示boolean
2.可以在 {{}} 内进行简单的运算
3.可以直接进行组合，构成新的对象或者数组
    {{[zero, 1, 2, 3, 4]}} => [0, 1, 2, 3, 4]
    {{for: a, bar: b}} => {for: 1, bar: 2}
    {{foo, bar}} => {foo: 'my-foo', bar:'my-bar'} 键名相等
    {{...obj1, e: 5}} => {a: 1, b: 2, e: 5} 对象展开

<view> {{message}} </view>

Page({
  data: {
    message: 'Hello MINA!'
  }
})
```

```
列表渲染 块级（view）内联（block）

<view wx:for="{{array}}">{{index}} --> {{item}} </view>
<view wx:for="{{array}}" wx:for-index="id" wx:for-item="it">{{id}} --> {{it}} </view>

Page({
  data: {
    array: [1, 2, 3, 4, 5]
  }
})
```

```
条件渲染 块级（view）内联（block）

<view wx:if="{{view == 'WEBVIEW'}}"> WEBVIEW </view>
<view wx:elif="{{view == 'APP'}}"> APP </view>
<view wx:else="{{view == 'MINA'}}"> MINA </view>

Page({
  data: {
    view: 'MINA'
  }
})
```

```
模板

<template name="staffName">
  <view>
    FirstName: {{firstName}}, LastName: {{lastName}}
  </view>
</template>
<template is="staffName" data="{{...staffA}}"></template>
<template is="staffName" data="{{...staffB}}"></template>
<template is="staffName" data="{{...staffC}}"></template>

Page({
  data: {
    staffA: {firstName: 'Hulk', lastName: 'Hu'},
    staffB: {firstName: 'Shang', lastName: 'You'},
    staffC: {firstName: 'Gideon', lastName: 'Lin'}
  }
})
```

```
事件

<view bindtap="add"> {{count}} </view> //事件冒泡
<view catchtap="add"> {{count}} </view> //阻止事件冒泡

Page({
  data: {
    count: 1
  },
  add: function(e) {
    console.log(e.target);
    console.log(e.currentTarget);
    this.setData({
      count: this.data.count + 1
    })
  }
})
```

```
引用

<import src="item.wxml"/>
<template is="item" data="{{text: 'forbar'}}"/>

<include src="header.wxml"/>
<view> body </view>
<include src="footer.wxml"/>
```