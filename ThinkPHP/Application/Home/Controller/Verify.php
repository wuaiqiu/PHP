<?php
/*
 * 验证码
 *  (1)生成的验证码信息会保存到session中，包含的数据有：默认最近3条
 *      array('verify_code'=>'当前验证码的值','verify_time'=>'验证码生成的时间戳')
 *      
 *  (2)verfiy.html
 *      <p>Verify</p>
 *      <img src='__CONTROLLER__/img' />  
 * */

function verify(){
    $this->display();
}

//生成验证码
function img(){
      $config =    array(
          'fontSize'=>30,               #验证码字体大小
          'length'=>3,                  #验证码位数
          'useNoise'=>false,            #关闭验证码杂点
          'codeSet'=>array('a','b','c'),#验证码字符集合,默认是随机字母
          'imageW'=>0,                  #验证码宽度,设置为0为自动计算
          'imageH'=>0,                  #验证码高度,设置为0为自动计算
          'useCurve'=>true             #是否使用混淆曲线,默认为true
    );
    
     $Verify = new \Think\Verify($config);
     $Verify->entry();
}



//检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    dump($verify->check($code, $id));
}

?>