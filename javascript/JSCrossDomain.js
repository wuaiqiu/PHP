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
 *
 *  (4)CORS（Cross-origin resource sharing，跨域资源共享）是一个W3C标准。它允许浏览器向跨源服务器，发出XMLHttpRequest请求，
 * 从而克服了AJAX只能同源使用的限制。
 *
 *  A.简单请求(HEAD,GET,POST;application/x-www-form-urlencoded,multipart/form-data,text/plain)
 *  index.html
 *  <script>
 *   $.get("https://github.com/search", {q : "react"}, function(data) {
 *       console.log(data);
 *   });
 *   $.ajax({
 *        url: "https://github.com/search?q=react",
 *        xhrFields: {
 *            withCredentials: true //当需要携带cookies时
 *          }
 *   });
 *  </script>
 *
 *  search.php
 *   header("Access-Control-Allow-Origin: *");//接受任意域名的请求，当需要传送cookies时必须明确
 *   header("Access-Control-Allow-Credentials: true");//表示是否允许发送Cookie，用于验证
 *   header("Access-Control-Expose-Headers: Status");//获取其他响应字段
 *   //默认可以获取:Cache-Control;Content-Language;Content-Type;Expires;Last-Modified;Pragma
 *
 *  B.非简单请求(PUT,DELETE;application/json)
 *   index.html
 *   <script>
 *        var url = 'http://api.alice.com/cors';
 *        var xhr = new XMLHttpRequest();
 *        xhr.open('PUT', url, true);
 *        xhr.setRequestHeader('X-Custom-Header', 'value');
 *        xhr.send();
 *   </script>
 *
 *   search.php
 *   header("Access-Control-Allow-Origin: http://api.bob.com"); //指定域名跨域
 *   header("Access-Control-Allow-Methods: PUT,DELETE,POST,GET"); //服务器支持的所有跨域请求的方法
 *   header("Access-Control-Allow-Headers: X-customer-name");//表明服务器支持的所有头信息字段
* */