# 设备

```
获取系统信息
wx.getSystemInfo({
  success: function(res) {
    console.log(res.model)
    console.log(res.pixelRatio)
    console.log(res.windowWidth)
    console.log(res.windowHeight)
    console.log(res.language)
    console.log(res.version)
    console.log(res.platform)
  }
})

var res = wx.getSystemInfoSync()
console.log(res.model)
console.log(res.pixelRatio)
console.log(res.windowWidth)
console.log(res.windowHeight)
console.log(res.language)
console.log(res.version)
console.log(res.platform)
```

```
拨打电话
wx.makePhoneCall({
  phoneNumber: '1340000'
})
```

```
允许从相机和相册扫码
wx.scanCode({
  success:function(res){
    console.log(res);
  }
})

只允许从相机扫码
wx.scanCode({
  onlyFromCamera: true,
  success:function(res){
    console.log(res);
  }
})
```

```
设置系统剪贴板
wx.setClipboardData({
  data: 'data'
})

获取系统剪贴板内容
wx.getClipboardData({
  success: function(res){
    console.log(res.data)
  }
})
```

```
使手机发生较长时间的振动（400ms）
wx.vibrateLong();

使手机发生较短时间的振动（15ms）
wx.vibrateShort();
```