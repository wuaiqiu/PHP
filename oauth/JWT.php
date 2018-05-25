<?php

//JWT加密
function JWTEncode($header,$payload,$salt){
    $Eheader=base64_encode(json_encode($header));
    $Epayload=base64_encode(json_encode($payload));
    $Esignature=hash_hmac($header["alg"],$Eheader.".".$Epayload,$salt);
    return $Eheader.".".$Epayload.".".$Esignature;
}

//JWT解密
function JWTDecode($jwt,$salt){
        list($Eheader,$Epayload,$signature)=explode(".",$jwt);
        $header=json_decode(base64_decode($Eheader),true);
        $Esignature=hash_hmac($header["alg"],$Eheader.".".$Epayload,$salt);
        if($Esignature===$signature){
            $payload=json_decode(base64_decode($Epayload),true);
            return $payload;
        }else{
            return false;
        }
}

//header字段
$header=[
    "typ"=>"JWT",
    "alg"=>"SHA256"
];
//payload字段
$payload=[
    "name"=>"Free",
    "age"=>28,
    "iss"=>"Tencent"
];

//salt
$salt="123456";

$jwt=JWTEncode($header,$payload,$salt);

JWTDecode($jwt);