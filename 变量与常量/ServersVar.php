<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>servers变量</title>
	</head>
<body>
	<?php
    
	   //servers变量:携带浏览器与服务器的一些信息
         print_r($_SERVER);       
	
     /*
      * [HTTP_USER_AGENT] => Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36 
      * [HTTP_REFERER] => http://localhost/day1/ 
      * [HTTP_COOKIE] => _gat=1; hibext_instdsigdip=1; _ga=GA1.1.1865895448.1499836846; _gid=GA1.1.518164521.1503292854 
      * [PATH] => /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin 
      * [SERVER_SIGNATURE] => [SERVER_SOFTWARE] => Apache/2.4.27 (Unix) PHP/5.3.29 with Suhosin-Patch 
      * [SERVER_NAME] => localhost 
      * [SERVER_ADDR] => ::1 
      * [SERVER_PORT] => 80 
      * [REMOTE_ADDR] => ::1 [
      * [DOCUMENT_ROOT] => /home/wu/workspace
      * [SCRIPT_FILENAME] => /home/wu/workspace/day1/ServersVar.php 
      * [REQUEST_METHOD] => GET
      * */
     
    ?>
  
</body>
</html>