# videojs

一.加载

```
<script src="node_modules/video.js/dist/video.min.js"></script>
<link href="node_modules/video.js/dist/video-js.min.css" rel="stylesheet">
<script src="node_modules/videojs-flash/dist/videojs-flash.min.js"></script>
<script src="node_modules/videojs-contrib-hls/dist/videojs-contrib-hls.min.js"></script>

<video id="video" class="video-js vjs-default-skin vjs-big-play-centered" controls
     preload="auto" width="640" height="264" data-setup="{}">
   <source src="a.mp4" type='video/mp4' />
   <source src="rtmp://localhost/live/1515040842" type="rtmp/flv"/>
   <source src='http://127.0.0.1/hls/test.m3u8' type='application/x-mpegURL'/>
</video>
```

```
#样式
vjs-big-play-centered //播放键居中
vjs-fluid  //自适应
```

```
#方法
myPlayer.play();
myPlayer.pause();
myPlayer.currentTime();//获取播放进度
myPlayer.currentTime(120);//设置播放进度
myPlayer.duration();//视频持续时间
myPlayer.buffered()//缓冲
myPlayer.bufferedPercent();//百分比的缓冲
myPlayer.volume();//声音大小
myPlayer.volume(0.5);//设置声音大小(0-1)
myPlayer.currentWidth();
myPlayer.currentHeight();
myPlayer.size(640,480);//一步到位的设置大小
myPlayer.enterFullScreen();//全屏
myPlayer.enterFullScreen();//离开全屏
```

```
#事件

play.on('ready',function(){
    console.log('插件以准备');
});
player.on('play', function () {
      console.log('开始/恢复播放');
});
player.on('pause', function () {
      console.log('暂停播放');
});
player.on('ended', function () {
       console.log('结束播放');
});
player.on('timeupdate', function() {
         console.log(player.currentTime());
});
```


```
弹幕实现
server.php


//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0",9502);
//当有用户上线时
$ws->on('open', function ($ws, $request) {

});
//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    //遍历所有连接,将接到的消息广播出去
    foreach($ws->connections as $fd){
        $ws->push($fd, "{$frame->data}");
    }
});
//当有用户下线时
$ws->on('close', function ($ws, $fd) {

});
$ws->start();


index.html
<div id="navBar">
    <div id="video"><span style="position:absolute;top:45%;left:45%;">视频区域</span></div>
    <div class="dm_tool">
        <input type="text" name="dm_con" class="dm_con" />
        <button class="sendToDm">发一弹</button>
    </div>
    <div class="dmArea">
        <!--弹幕区域-->
    </div>
</div>

//弹幕区域
    var DmClass = {
        "Dm_H":0, //弹幕（视频）区域高度
        "Dm_W":0,//弹幕（视频）区域宽度
        "DmObj":"",//弹幕（视频）区对象
        //初始化方法
        init:function(){
            var _this  = this;
            _this.DmObj = $(".dmArea");
            _this.Dm_H = _this.DmObj.height();
            _this.Dm_W = _this.DmObj.width();
            //发送弹幕事件
            $(".sendToDm").click(function(){
                var sendCon = $('input[name="dm_con"]').val();
                if($.trim(sendCon) == "") {
                    return false;
                }
                //json 数据格式
                var sData = '{"data":"'+sendCon+'"}';
                //发送到sockey服务器
                SocketClass.websocket.send(sData);
            });
        },
        //往弹幕区域添加从服务器广播过来的弹幕数据
        addToDm:function(rdata){
            var _this = this;
            //json转对象
            var newObj = JSON.parse(rdata);
            //定义新的弹幕对象
            var newDom = $("<span></span>");
            //随机取一个位置
            var p = _this.randPosition();
            //放入弹幕内容
            newDom.html(newObj.data);
            _this.DmObj.append(newDom);
            //设置初始位置为弹幕区的最右边
            newDom.css({"left":_this.Dm_W+"px","top":p+"px"});
            //当前单条弹幕位置
            var tR = _this.Dm_W;
            //定时器 20毫秒执行一次
            var newTimer = setInterval(function(){
                tR -= 2;
                //当弹幕走出弹幕区将之删除，并清除当前的定时器
                if(tR <= -newDom.width()){
                    newDom.remove();
                    clearInterval(newTimer);
                }
                //新位置
                newDom.css("left",tR+"px");
            },20);
        },
        //随机获取位置
        randPosition:function(){
            var _this = this;
            var rn = Math.floor(Math.random()*(_this.Dm_H - 20));
            return rn;
        },
    };

    //sockey 服务
    var SocketClass = {
        "wsServer":"ws://127.0.0.1:9502", //服务地址
        "websocket":"", //socket 对象
        init:function(){
            var _this = this;
            _this.websocket = new WebSocket(_this.wsServer);
            //连接上socket
            _this.websocket.onopen = function (evt) {
                console.log("Connected to WebSocket server.");
            };
            //socket 服务器关闭
            _this.websocket.onclose = function (evt) {
                alert("socket server closed");
                console.log("Disconnected");
            };
            //接收socket服务器的广播数据
            _this.websocket.onmessage = function (evt) {
                console.log('Retrieved data from server: ' + evt.data);
                //将接收到的弹幕数据调用addToDm方法 添加到弹幕区域
                DmClass.addToDm(evt.data);
            };
            //连接错误
            _this.websocket.onerror = function (evt, e) {
                console.log('Error occured: ' + evt.data);
            };
        },


    };
 //初始执行方法
$(function(){
      DmClass.init();
      SocketClass.init();
});
```