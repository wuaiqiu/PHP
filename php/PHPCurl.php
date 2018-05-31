<?php
/*
 * PHP Curl
 *
 *    CURLOPT_URL(string):需要获取的URL地址
 *    CURLOPT_RETURNTRANSFER(bool):TRUE将curl_exec()获取的信息以字符串变量返回，否则直接输出
 *    CURLOPT_POST(bool):TRUE时会发送POST请求，类型为：application/x-www-form-urlencoded
 *    CURLOPT_CONNECTTIMEOUT(int):设置连接超时时间。设置为0，则无限等待
 *    CURLOPT_POSTFIELDS(string):全部数据使用HTTP协议中的"POST"操作来发送
 *    CURLOPT_HTTPHEADER(array):设置HTTP头字段的数组
 *    CURLOPT_FILE(resource):设置输出文件，默认为STDOUT (浏览器)。
 * */


//1.GET请求

#初始化cURL会话
$ch = curl_init();
#设置cURL传输选项
curl_setopt($ch, CURLOPT_URL, "https://www.baidu.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
#执行cURL会话
$output = curl_exec($ch);
#输出字符串变量
echo $output;
#关闭cURL会话
curl_close($ch);


//2.POST请求

$data=[
    "name" => "Lei",
    "msg" => "Are you OK?"
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/curl/post.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_POSTFIELDS , http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
echo $output;
curl_close($ch);


//3.JSON

$data='{"name":"Lei","msg":"Are you OK?"}';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/curl/post.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
echo $output;
curl_close($ch);


//4.上传文件

$data = array('name'=>'boy');
$ch = curl_init();
#上传文件
$data['upload']=new CURLFile("/home/wu/wifi");
curl_setopt($ch, CURLOPT_URL, "http://localhost/curl/post.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
echo $output;
curl_close($ch);


//5.下载文件

$ch = curl_init();
$fp=fopen('girl.png', 'w');
curl_setopt($ch, CURLOPT_URL, "https://www.baidu.com/img/bd_logo1.png");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_FILE, $fp);
$output = curl_exec($ch);
#获取一个cURL连接资源句柄的信息
#(url,http_code,content_type,size_upload,size_download,primary_ip,primary_port,local_ip,local_port)
$info = curl_getinfo($ch);
#获取文件大小
$size = filesize("girl.png");
if ($size != $info['size_download']) {
    echo "下载的数据不完整，请重新下载";
} else {
    echo "下载数据完整";
}
fclose($fp);
curl_close($ch);