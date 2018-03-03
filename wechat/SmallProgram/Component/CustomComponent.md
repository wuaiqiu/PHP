# 自定义组件


**一.定义组件**

component.json

```
{
  "component": true
}
```

component.js

```
Component({
 options: {
    //多slot
    multipleSlots: true
  },
  //组件的属性
  properties: {
    innerText: {
      type: String, //String, Number, Boolean, Object, Array, null（表示任意类型）
      value: this.data.key
    }
  },
  //组件的初始数据
  data: {
    key:"value"
  },
  //组件的方法列表
  methods: {
    customMethod: function(){
        this.setData({key:"value2"},function(){
            //设置成功后回调
        });
    }
  }
})
```

component.wxml

```
<view class="inner">
  <slot name="before"></slot>
  {{innerText}}
  <slot name="after"></slot>
</view>
```

component.wxss

```
//只能用class选择器
.inner {
  color: red;
}
:host{
  color:yellow;
}
```

<br>

**二.使用组件**

demo.json

```
{
  "usingComponents": {
    "component-tag-name": "../component/component"
  }
}
```

demo.wxml

```
<component-tag-name inner-text="Some text">
    <view slot="before">Before</view>
    <view slot="after">After</view>
</component-tag-name>
```