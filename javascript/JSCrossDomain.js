/*
* JavaScript跨域
*
*       只要协议、域名、端口有任何一个不同，都被当作是不同的域
*
* (1).通过jsonp跨域,它只支持GET请求而不支持POST等其它类型的HTTP请求
*   cross.php
*
*   $callback=$_GET['callback'];
*   $arr=array('a','b','c');
*   echo $callback.'('.json_encode($arr).')';
*
*   index.html
*   <script>
*       function dosomething(data){
*           console.log(data);
*       }
*   </script>
*   <script src="http://localhost/day2/cross.php?callback=dosomething"></script>
*
*   $.getJSON('http://localhost/day2/cross.php?callback=?',function(data){
*       console.log(data);
*   });
*
*
* (2).通过修改document.domain来跨子域
* 
*   我们只要把http://www.example.com/a.html 和 http://example.com/b.html这两个页面的document.domain都设成相同的域
*   名就可以了。但要注意的是，document.domain的设置是有限制的，我们只能把document.domain设置成自身或更高一级的父域，
*   且主域必须相同。
*
*
* (3).使用HTML5中新引进的window.postMessage方法来跨域传送数据
*
*   window.postMessage(message,targetOrigin):第一个参数message为要发送的消息，类型只能为字符串；第二个参数targetOrigin
* 用来限定接收消息的那个window对象所在的域，如果不想限定域，可以使用通配符 *
*
*
*   index.html
*   <script>
*       function onLoad(){
*           var iframe=document.getElementById('iframe');
*           var win=iframe.contentWindow;//获取window对象
*           win.postMessage('sss',"*");
*        }
*  </script>
*  <iframe id="iframe" src="http://localhost/day2/cross.html" onload="onLoad()"></iframe>
*
*  cross.html
*  <script>
*      window.onmessage=function (ev) {
*           alert(ev.data);
*      }
* </script>
* */