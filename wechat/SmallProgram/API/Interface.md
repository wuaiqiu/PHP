# 界面

**一.弹框**

```
显示消息提示框
wx.showToast({
    title: '成功',
    icon: 'none', //success loading none
    duration: 2000
})


loading 提示框
wx.showLoading({
  title: '加载中',
})
setTimeout(function(){
  wx.hideLoading()
},2000)


​显示模态弹窗
wx.showModal({
  title: '提示',
  content: '这是一个模态弹窗',
  success: function(res) {
    if (res.confirm) {
      console.log('用户点击确定')
    } else if (res.cancel) {
      console.log('用户点击取消')
    }
  }
})


​显示操作菜单
wx.showActionSheet({
  itemList: ['A', 'B', 'C'],
  success: function(res) {
    console.log(res.tapIndex)
  },
  fail: function(res) {
    console.log(res.errMsg)
  }
})
```

<br>

**二.导航条**

```
动态设置当前页面的标题
wx.setNavigationBarTitle({
  title: '当前页面'
})
```

<br>

**三.tabBar**

```
为tabBar的右上角添加文本
wx.setTabBarBadge({
  index: 0,
  text: '1'
})


移除tabBar右上角的文本
wx.removeTabBarBadge({index:0})


为tabBar的右上角的红点
wx.showTabBarRedDot({index:0})


隐藏tabBar右上角的红点
wx.hideTabBarRedDot({index:0})


动态设置 tabBar 某一项的内容
wx.setTabBarItem({
    index: 0,
    text: 'text',
    iconPath: '/path/to/iconPath',
    selectedIconPath: '/path/to/selectedIconPath'
})
```

<br>

**四.导航**

```
保留当前页面，跳转到应用内的某个页面
wx.navigateTo({
  url: 'test?id=1'
})


关闭当前页面，返回上一页面
wx.navigateBack({
  delta: 1
})


关闭当前页面，跳转到应用内的某个页面
wx.redirectTo({
  url: 'test?id=1'
})


关闭所有页面，打开到应用内的某个页面。
wx.reLaunch({
  url: 'test?id=1'
})


跳转到tabBar页面
wx.switchTab({
  url: '/index'
})
```