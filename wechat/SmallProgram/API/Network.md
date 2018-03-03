# 网络

**一.发起请求**

```
wx.request({
      url: 'http://localhost/day8/index.php', 
      data: {
        key1:"value1",
        key2:"value2"
      },
      method: "POST", //GET,POST, PUT, DELETE
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        console.log(res.data)
      }
 })
```

<br>

**二.上传文件**

```
var uploadTask=wx.uploadFile({
     url: 'http://localhost/day8/index.php',
     filePath: tempFilePaths[0],
     name: 'file',
     formData: {
         'data': 'test'
     },
     success: function (res) {
          console.log(res.data)
     }
});
uploadTask.onProgressUpdate((res) => {
      console.log('上传进度', res.progress)
      console.log('已经上传的数据长度', res.totalBytesSent)
      console.log('预期需要上传的数据总长度', res.totalBytesExpectedToSend)
});
```

<br>

**三.下载文件**

```
var downloadTask= wx.downloadFile({
      url: 'http://localhost/day8/index.php',
      success: function (res) {
        console.log(res.tempFilePath);
      }
});
downloadTask.onProgressUpdate((res) => {
      console.log('下载进度', res.progress)
      console.log('已经下载的数据长度', res.totalBytesWritten)
      console.log('预期需要下载的数据总长度', res.totalBytesExpectedToWrite)
})
```