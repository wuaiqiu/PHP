# Config

```
<widget id="A6061066647813"  version="0.0.1">
    <!--Widget的名称-->
    <name>Hello APP</name>
    <!--Widget的简单描述信息-->
    <description>
        Example For APICloud.
    </description>
    <!--	Widget的作者信息-->
    <author email="developer@apicloud.com" href="http://www.apicloud.com">
        Developer
    </author>
    <!--Widget运行的起始页-->
    <content src="index.html" />
    <!--	在哪些页面里面可以访问APICloud的扩展API-->
    <access origin="*" />
    <!--配置页面是否弹动，用于刷新-->
    <preference name="pageBounce" value="true"/>
     <!--配置App全局背景-->
	<preference name="appBackground" value="#FFF"/>
     <!--配置Window默认背景-->
	<preference name="windowBackground" value="#FFF"/>
     <!--配置Frame默认背景-->
	<preference name="frameBackgroundColor" value="#FFF"/>
     <!--配置页面默认是否显示滚动条-->
	<preference name="hScrollBarEnabled" value="true"/>
	<preference name="vScrollBarEnabled" value="true"/>
     <!--配置启动页是否自动隐藏-->
	<preference name="autoLaunch" value="true"/>
     <!--配置应用是否全屏运行-->
	<preference name="fullScreen" value="false"/>
     <!--配置应用是否自动检测更新-->
	<preference name="autoUpdate" value="true" />
    <!--配置应用是否支持增量更新、云修复-->
	<preference name="smartUpdate" value="true" />
    <!--配置应用开启/关闭调试模式-->
	<preference name="debug" value="false"/>
     <!--配置状态栏和页面是否重合-->
	<preference name="iOS7StatusBarAppearance" value="true"/>
    <!--读取手机状态和身份-->
	<permission name="readPhoneState" />
	<!--直接拨打电话-->
    <permission name="call" />
    <!--直接发送短信-->
	<permission name="sms" />
    <!--使用拍照和视频-->
	<permission name="camera" />
    <!--使用录音-->
	<permission name="record" />
    <!--访问地理位置信息-->
	<permission name="location" />
    <!--访问文件系统-->
	<permission name="fileSystem" />
    <!--完全的访问网络权限-->
	<permission name="internet" />
    <!--开机启动-->
	<permission name="bootCompleted" />
    <!--控制振动/闪光灯/屏幕休眠等硬件设备-->
	<permission name="hardware" />
    <!--访问设备通讯录-->
	<permission name="contact" />
</widget>
``` 