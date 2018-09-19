<?php
$code=md5("Hello World");
$access_token=sha1("Hello world");
$token=[
    "access_token"=>$access_token,
    "token_type"=>"bearer"
];

if(isset($_GET['response_type'])&&$_GET['response_type']=='code'){
    $url=$_GET['redirect_uri'];
    header("Location: $url?code=$code");
}

if(isset($_POST["grant_type"])){
    if($_POST["grant_type"]=="authorization_code"){
        if($_POST["code"]==$code){
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $_POST["redirect_uri"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $token);
            curl_exec($ch);
            curl_close($ch);
        }
    }
}