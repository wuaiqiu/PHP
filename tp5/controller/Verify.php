<?php
/*
 * 验证码
 *
 *  composer require topthink/think-captcha:1.*
 * */

#生成
$config =    [
    //验证码字体大小
    'fontSize'=>30,
    //验证码位数
    'length' =>4,
    //关闭验证码杂点
    'useNoise' =>false,
    //验证码图片高度
    'imageH' => 60,
    //验证码图片宽度
    'imageW'=>200
];
$captcha = new Captcha($config);
return $captcha->entry();


#验证
$captcha = new Captcha();
return $captcha->check($code, $id);
