# 配置

**一.app**

```
{
  "pages": [
    "pages/index/index",
    "pages/logs/index"
  ],
  "window": {
    "navigationBarBackgroundColor": "#ffffff",
    "navigationBarTextStyle": "black/white",
    "navigationBarTitleText": "微信接口功能演示",
    "enablePullDownRefresh":false
  },
  "tabBar": {
    "color":"#ffffff",
    "selectedColor":"#000000",
    "backgroundColor":"#ffffff",
    "borderStyle":"white",
    "list": [{
      "pagePath": "pages/index/index",
      "text": "首页",
      "iconPath":"images/a.png",
      "selectedIconPath":"imgaes/a.png"
    }, {
      "pagePath": "pages/logs/logs",
      "text": "日志",
      "iconPath":"images/b.png",
      "selectedIconPath":"images/a.png"
    }]
  },
  "debug": true
}
```

<br>

**二.page**

```
{
  "navigationBarBackgroundColor": "#ffffff",
  "navigationBarTextStyle": "black",
  "navigationBarTitleText": "微信接口功能演示",
  "enablePullDownRefresh":false
}
```