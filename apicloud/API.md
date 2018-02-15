# API

**一.操作window与frame**

```
#打开window
api.openWin({
    name: '1',
    url: 'html/1.html',
    pageParam: {
        name: 'test'
    }
});

#关闭window
api.closeWin();

api.closeWin({
    name: '1'
});

api.closeToWin({
    name: 'root'
});
```

```
#打开frame
api.openFrame({
  name: '1',
  url: 'html/1.html',
  rect: {
    x: 0,
    y: 100,
    w: 'auto',
    h: 'auto'
  },
  pageParam: {
    name: 'test'
  }
});

#调整frame到前面（不传to参数则调到最前面）
api.bringFrameToFront({
    from: 'page1',
    to: 'page2'
});

#调整frame到后面
api.sendFrameToBack({
    from: 'page1',
    to: 'page2'
});

#打开frame组
api.openFrameGroup({
    name: 'group1',
    index: 1,
    rect: {
        x: 0,
        y: 100,
        w: 'auto',
        h: 'auto'
    },
    frames: [{
        name: 'frame1',
        url: 'html/1.html',
        bgColor: '#fff'
    }, {
        name: 'frame2',
        url: 'html/2.html',
        bgColor: '#fff'
    }]
}, function(ret, err) {
    var index = ret.index;
    alert(index);
});

#关闭frame组
api.closeFrameGroup({
    name: 'group1'
});
```

```
#打开侧滑式布局
api.openSlidLayout({
    type: 'left',
    fixedPane: {
       name: '2',
       url: 'html/2.html'
    },
    slidPane: {
       name: '1',
       url: 'html/1.html'
    }
   }, function(ret, err) {}
);

#打开侧滑
api.openSlidPane({
    type: 'left'
});

#关闭侧滑
api.closeSlidPane();
```

```
#加载HTML数据（name为window，frameName为frame）
var data = 'hello world';
api.loadData({
    name: 'winName',
    frameName: 'frmName',
    data: data
});

#执行脚本
var jsfun = 'alert("ss");';
api.execScript({
    name: 'winName',
    frameName: 'frmName',
    script: jsfun
});
```

<br>

**二.HTTP请求**

```
#AJAX请求
api.ajax({
   url: 'http://192.168.31.253/day5/index.php',
   method: 'post',
   cache:false,
   data: {
       values: {
          name: 'haha'
       }
   }
}, function(ret, err) {
   if (ret) {
      api.alert({msg:JSON.stringify(ret) });
    } else {
      api.alert({msg:JSON.stringify(err) });
    }
});

#下载文件
api.download({
    url: url,
    savePath: 'fs://test.rar',
    cache: false,
    allowResume: true
}, function(ret, err) {
    if (ret.state == 1) {
        //下载成功
    } else {
        //下载失败
    }
});
```

<br>

**三.文件操作**

```
#读取文件
//异步返回结果：
api.readFile({
    path: 'fs://a.txt'
}, function(ret, err) {
    if (ret.status) {
        var data = ret.data;
    } else {
        alert(err.msg);
    }
});

//同步返回结果：
var data = api.readFile({
    sync: true,
    path: 'fs://a.txt'
});

#写文件
api.writeFile({
    path: 'fs://a.txt',
    data: 'writeFile测试内容'
}, function(ret, err) {
    if (ret.status) {
        alert('成功');
    } else {
        alert('失败');
    }
});

#设置键值对
api.setPrefs({
    key: 'k',
    value: '1'
});

#获取键值对
//异步返回结果：
api.getPrefs({
    key: 'userName'
}, function(ret, err) {
    var userName = ret.value;
});

//同步返回结果：
var userName = api.getPrefs({
    sync: true,
    key: 'userName'
});

#移除键值对
api.removePrefs({
    key: 'k'
});

#保存图片和视频到系统相册
api.saveMediaToAlbum({
    path: 'fs://1.png'
}, function(ret, err) {
    if (ret && ret.status) {
        alert('保存成功');
    } else {
        alert('保存失败');
    }
});

#获取总存储大小
//异步返回结果：
api.getTotalSpace(function(ret, err) {
    var size = ret.size;
});

//同步返回结果：
var size = api.getTotalSpace({
    sync: true
});

#获取剩余存储大小
//异步返回结果：
api.getFreeDiskSpace(function(ret, err) {
    var size = ret.size;
});

//同步返回结果：
var size = api.getFreeDiskSpace({
    sync: true
});
```

<br>

**四.缓存操作**

```
#清除缓存
api.clearCache(function() {
   api.toast({
       msg: '清除完成'
   });
});

#获取缓存大小
//异步返回结果：
api.getCacheSize(function(ret) {
    var size = ret.size;
});

//同步返回结果：
var size = api.getCacheSize({
    sync: true
});
```

<br>

**五.事件**

```
#监听事件
api.addEventListener({
  name: 'online'
}, function(ret, err) {
  alert('已连接网络');
});

#移除事件监听
api.removeEventListener({
    name: 'online'
});

#广播事件
api.addEventListener({
    name: 'myEvent'
}, function(ret, err) {
    alert(JSON.stringify(ret.value));
});
api.sendEvent({
    name: 'myEvent',
    extra: {
        key1: 'value1',
        key2: 'value2'
    }
});
```

事件名|描述
---|---
apiready|api对象准备完毕后产生
keyback|设备back键被点击
keymenu|设备menu键被点击
volumeup|设备音量加键被点击
volumedown设备音量减键被点击
offline|监听设备断开网络
online|监听设备连接到网络
scrolltobottom|Window或者Frame页面滑动到底部事件
shake|设备摇动事件
tap|Window或者Frame的页面全局单击事件
longpress|Window或者Frame的页面全局长按事件
noticeclicked|状态栏通知被用户点击后的回调，字符串类型


<br>

**六.操作设备****

```
#开启提示
api.notification({
  notify: {
     content: '一条新的消息'
  },
  alarm: {
      time: new Date().getTime() + 3000
  }
  }, function(ret, err) {
     var id = ret.id;
     alert(id+"设置成功");
});

#清除提示
api.cancelNotification({
    id: 1
});

#图标数字
api.setAppIconBadge({
      badge: 1
});
```

```
#开始定位
api.startLocation({
    accuracy: '100m',
    filter: 1,
    autoStop: true
}, function(ret, err){
    if(ret && ret.status){
        alert(JSON.stringify(ret));
    }else{
        alert(JSON.stringify(err));
    }
});

#结束定位
api.stopLocation();

#返回上次位置信息
api.getLocation(function(ret, err) {
    if (ret && ret.status) {
       alert(JSON.stringify(ret));
    } else {
       alert(JSON.stringify(err));
    }
});
```

```
#拨打电话
api.call({
    type: 'tel_prompt',
    number: '10086'
});

#打开系统通讯录
api.openContacts();

#发送消息
api.sms({
  numbers: ['10086'],
  text: '测试短信'
}, function(ret, err) {
  if (ret && ret.status) {
    alert('发送成功');
  } else {
    alert('发送失败');
  }
});

#发送邮件
api.mail({
    recipients: ['test@163.com'],
    subject: '邮件测试',
    body: '这是一封测试用的邮件',
    attachments: ['fs://test.jpg']
}, function(ret, err) {
    if (ret && ret.status) {
        alert('发送成功');
    } else {
      alert('发送失败');
    }
});

#调用系统默认相机或者图库
api.getPicture({
  sourceType: 'camera',
  encodingType: 'jpg',
  mediaValue: 'pic',
  destinationType: 'url',
  allowEdit: true,
  quality: 50,
  targetWidth: 100,
  targetHeight: 100,
  saveToPhotoAlbum: false
}, function(ret, err) {
  if (ret) {
      alert(JSON.stringify(ret));
  } else {
      alert(JSON.stringify(err));
  }
});

#录制amr格式音频
api.startRecord({
    path: 'fs://a.amr'
});

#停止录音
api.stopRecord(function(ret, err) {
    if (ret) {
        var path = ret.path;
        var duration = ret.duration;
    }
});

#打开系统视频播放器
api.openVideo({
    url: 'fs://res/1.mp4'
});

#开始播放音频
api.startPlay({
    path: 'widget://res/1.mp3'
}, function(ret, err) {
    if (ret) {
        alert('播放完成');
    } else {
        alert(JSON.stringify(err));
    }
});

#停止播放音频
api.stopPlay();

#回到系统桌面
api.toLauncher();
```

<br>

**七.弹框**

```
#alert弹框
api.alert({
  title: 'testtitle',
  msg: 'testmsg',
}, function(ret, err) {

});

#confirm
api.confirm({
    title: 'testtitle',
    msg: 'testmsg',
    buttons: ['确定', '取消']
}, function(ret, err) {
    var index = ret.buttonIndex;
    alert(index);
});

#prompt
api.prompt({
    title:"输入",
    buttons: ['确定', '取消']
}, function(ret, err) {
    var index = ret.buttonIndex;
    var text = ret.text;
});

#actionSheet
api.actionSheet({
    title: '底部弹出框测试',
    cancelTitle: '这里是取消按钮',
    destructiveTitle: '红色警告按钮',
    buttons: ['1', '2', '3']
}, function(ret, err) {
    var index = ret.buttonIndex;
    alert(index);
});

#加载框
api.showProgress({
    title: '努力加载中...',
    text: '先喝杯茶...',
    modal: false
});

api.hideProgress();

#提示框
api.toast({
    msg: '网络错误',
    duration: 2000,
    location: 'bottom'
});

#打开时间选择器
api.openPicker({
    type: 'date_time',
    date: '2014-05-01 12:30',
    title: '选择时间'
}, function(ret, err) {
    if (ret) {
      alert(JSON.stringify(ret));
    } else {
      alert(JSON.stringify(err));
    }
});

#刷新
api.setRefreshHeaderInfo({
    bgColor: '#ccc',
    textColor: '#fff',
    textDown: '下拉刷新...',
    textUp: '松开刷新...'
    }, function(ret, err) {
    api.loadData({
        data: "<h1>ss</h1>"
    });
    api.refreshHeaderLoadDone();
});

#开启刷新
api.refreshHeaderLoading();
```

<br>

**八.属性**

属性名|描述
---|---
deviceId|设备唯一标识，字符串类型
winName|当前window名称，字符串类型
winWidth|当前window宽度，数字类型
winHeight|当前window高度，数字类型
frameName|frame名称，字符串类型
frameWidth|frame宽度，数字类型
frameHeight|frame高度，数字类型
pageParam|页面参数，JSON 对象类型
fsDir|fs: //协议对应地真实目录，字符串类型
cacheDir|cache://协议对应的真实目录，字符串类型