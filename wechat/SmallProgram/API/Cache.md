# 缓存

```
设置缓存
wx.setStorage({
  key:"key",
  data:"value"
})

wx.setStorageSync('key', 'value')


获取缓存
wx.getStorage({
  key: 'key',
  success: function(res) {
      console.log(res.data)
  }
})

var value = wx.getStorageSync('key')


缓存信息
wx.getStorageInfo({
  success:function(res) {
    console.log(res.keys)
    console.log(res.currentSize)
    console.log(res.limitSize)
  }
})

var res = wx.getStorageInfoSync()
console.log(res.keys)
console.log(res.currentSize)
console.log(res.limitSize)


移除缓存
wx.removeStorage({
  key: 'key',
  success: function(res) {
    console.log(res.data)
  }
})

wx.removeStorageSync('key');


清理所有缓存
wx.clearStorage();

wx.clearStorageSync();
```