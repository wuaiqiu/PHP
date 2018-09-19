<?php
if(isset($_GET['code'])){
    $code=$_GET['code'];
    $url="http://localhost/day13/Server.php";
    $grant_type="authorization_code";
    $query=[
        "code"=>$code,
        "redirect_uri"=>$url,
        "grant_type"=>$grant_type
    ];
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/day13/Oauth.php");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_exec($ch);
    curl_close($ch);
}


if(isset($_POST["access_token"])){
    $token=$_POST["access_token"];
    var_dump($token);
}