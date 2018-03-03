# 位置


```
获取位置
wx.getLocation({
   success: function (res) {
      console.log(res.latitude);
      console.log(res.longitude);
      console.log(res.speed);
      console.log(res.accuracy);
   }
})


打开地图选择位置
wx.chooseLocation({
   success: function (res) {
      console.log(res.latitude);
      console.log(res.longitude);
      console.log(res.name);
      console.log(res.address);
   }
})
```