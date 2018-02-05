<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Index</title>
</head>

<script>
	function showHint(str){

			if (str.length==0){ 
				document.getElementById("txtHint").innerHTML="";
				return;
			}

			//1.创建 XMLHttpRequest 对象
			if (window.XMLHttpRequest){
				//IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
				xmlhttp=new XMLHttpRequest();
			}else{	
				//IE6, IE5 浏览器执行的代码
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			
			/*
			 * 	2.向服务器发送请求
			 *		open(method,url,async)
			 *			method：请求的类型；GET 或 POST
			 *			url：文件在服务器上的位置
			 *			async：true（异步）或 false（同步）
			 *		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
			 *			仅用于 POST 请求,如果需要像 HTML 表单那样 POST 数据
			 *		send(string)
			 *			string：仅用于 POST 请求
			 *
			 **/
			xmlhttp.open("GET","Ajax.php?q="+str,true);
			xmlhttp.send();

			
			/*
			 *	3.接受响应
			 *		responseText	:获得字符串形式的响应数据。
			 *	    	responseXML:获得 XML 形式的响应数据。利用DOM解析
			 **/
			
			xmlhttp.onreadystatechange=function(){

					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
					}
			}
			
			
	}
</script>

    <body>
			<form> 
				姓名: <input type="text" onkeyup="showHint(this.value)">
			</form>
			<p>返回值: <span id="txtHint"></span></p>
    </body>
   
</html>