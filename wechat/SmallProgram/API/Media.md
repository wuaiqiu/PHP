# 媒体

**一.图片**

```
选择图片
wx.chooseImage({
     count: 1, // 默认9
     success: function (res) {
         console.log(res.tempFilePaths);
         console.log(res.tempFiles);
     }
})

预览图片
wx.previewImage({
    current: 'http://tmp/wx527130fbb1ddc553.o6zAJsxW0Bp4kgj06Dr7o96N-iYc.bf140203c9b802c799f1d061107b9c0d.png',
    urls: ['http://tmp/wx527130fbb1ddc553.o6zAJsxW0Bp4kgj06Dr7o96N-iYc.bf140203c9b802c799f1d061107b9c0d.png']
})

图片信息
wx.getImageInfo({
    src: 'http://tmp/wx527130fbb1ddc553.o6zAJsxW0Bp4kgj06Dr7o96N-iYc.bf140203c9b802c799f1d061107b9c0d.png',
    success: function (res) {
       console.log(res.width)
       console.log(res.height)
    }
})

保存图片到系统相册
wx.saveImageToPhotosAlbum({
   filePath: 'http://tmp/wx527130fbb1ddc553.o6zAJsxW0Bp4kgj06Dr7o96N-iYc.bf140203c9b802c799f1d061107b9c0d.png',
   success: function (res) {
      console.log(res.errMsg);
    }
})
```

<br>

**二.录音**

```
var recorderManager = wx.getRecorderManager();
recorderManager.onStart(function(){
     console.log('recorder start')
});
recorderManager.onResume(function(){
      console.log('recorder resume')
});
recorderManager.onPause(function(){
      console.log('recorder pause')
});
recorderManager.onStop(function(res){
      console.log('recorder stop');
      console.log(res);
});
var options = {
    duration: 10000,
    sampleRate: 44100,
    numberOfChannels: 1,
    encodeBitRate: 192000,
    format: 'aac'
};
recorderManager.start(options);
```

<br>

**三.音乐播放器**

```
var backgroundAudioManager = wx.getBackgroundAudioManager();
backgroundAudioManager.title = '此时此刻';
backgroundAudioManager.epname = '此时此刻';
backgroundAudioManager.singer = '汪峰';
backgroundAudioManager.coverImgUrl = 'http://y.gtimg.cn/music/photo_new/T002R300x300M000003rsKF44GyaSk.jpg?max_age=2592000';
backgroundAudioManager.src = 'http://ws.stream.qqmusic.qq.com/M500001VfvsJ21xFqb.mp3?guid=ffffffff82def4af4b12b3cd9337d5e7&uin=346897220&vkey=6292F51E1E384E061FF02C31F716658E5C81F5594D561F2E88B854E81CAAB7806D5E4F103E55D33C16F3FAC506D1AB172DE8600B37E43FAD&fromtag=46';
```

<br>

**四.内部音频**

```
var innerAudioContext = wx.createInnerAudioContext();
innerAudioContext.autoplay = true;
innerAudioContext.src = 'http://ws.stream.qqmusic.qq.com/M500001VfvsJ21xFqb.mp3?guid=ffffffff82def4af4b12b3cd9337d5e7&uin=346897220&vkey=6292F51E1E384E061FF02C31F716658E5C81F5594D561F2E88B854E81CAAB7806D5E4F103E55D33C16F3FAC506D1AB172DE8600B37E43FAD&fromtag=46';
innerAudioContext.onPlay(function(){
   console.log('开始播放');
});
innerAudioContext.onError(function(res){
   console.log(res.errMsg);
   console.log(res.errCode);
});
```

<br>

**五.视频**

```
选择视频或拍摄
wx.chooseVideo({
  maxDuration: 60,
  success: function (res) {
      console.log(res);
  }
});

保存视频到系统相册
wx.saveVideoToPhotosAlbum({
    filePath:"url"
    success:function(res) {
        console.log(res.errMsg);
    }
})
```