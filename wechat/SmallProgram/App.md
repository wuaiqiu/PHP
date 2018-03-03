# App函数

**一.App**

```
App({
  onLaunch: function() {
    //当小程序初始化完成时
  },
  onShow: function() {
   //当小程序启动，或从后台进入前台显示
  },
  onHide: function() {
   //当小程序从前台进入后台
  },
  onError: function(msg) {
    console.log(msg)
  },
  globalData:  {
    userInfo: null
  }
})
```

```
var appInstance = getApp();
console.log(appInstance.globalData.userInfo);
```

<br>

**二.page**

```
Page({
  data: {
    text: "This is page data."
  },
  onLoad: function(options) {
    //监听页面加载
    console.log(option.query);
  },
  onShow: function() {
    //监听页面显示
  },
  onHide: function() {
    //监听页面隐藏
  },
  onUnload: function() {
    //监听页面卸载
  },
  onPullDownRefresh: function() {
      wx.stopPullDownRefresh();
    //监听用户下拉动作
  },
  onReachBottom: function() {
    //页面上拉触底事件的处理函数
  },
  onShareAppMessage: function () {
   //用户点击右上角转发
  },
  onTabItemTap(item) {
    console.log(item.index)
    console.log(item.pagePath)
    console.log(item.text)
  },
  //事件处理函数
  viewTap: function() {
    this.setData({
      text: 'Set some data for updating view.'
    }, function() {
      //设置成功后
    })
  }
})
```