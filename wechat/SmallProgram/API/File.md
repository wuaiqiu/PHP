# 文件

```
保存文件到本地
wx.saveFile({
    tempFilePath:"url",
    success: function(res) {
      console.log(res.savedFilePath);
    }
})

获取本地已保存的文件列表
wx.getSavedFileList({
  success: function(res) {
    console.log(res.fileList);
  }
})

获取本地文件的文件信息
wx.getSavedFileInfo({
  filePath: 'wxfile://somefile',
  success: function(res) {
    console.log(res.size)
    console.log(res.createTime)
  }
})

获取临时文件信息
wx.getFileInfo({
  filePath: 'url',
  success: function(res) {
    console.log(res.size)
    console.log(res.digest)
  }
})

删除本地存储的文件
wx.removeSavedFile({
    filePath: 'wxfile://somefile'
})

新开页面打开文档
wx.openDocument({
   filePath: "url"
})
```