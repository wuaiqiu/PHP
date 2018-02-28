<?php
#上传

#1.单文件上传
//获取表单上传文件
$file = request()->file('file');
if($file){
    //移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
        //获取文件后缀
        echo $info->getExtension();
        //获取保存名
        echo $info->getSaveName();
        //获取文件名
        echo $info->getFilename();
    }else{
        //上传失败获取错误信息
        echo $file->getError();
    }
}


#2.多文件上传
//获取表单上传文件
$files = request()->file('image');
foreach($files as $file){
    //移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
        //获取文件后缀
        echo $info->getExtension();
        //获取保存名
        echo $info->getFilename();
    }else{
        //上传失败获取错误信息
        echo $file->getError();
    }
}


#3.上传验证
//获取表单上传文件
$file = request()->file('file');
//移动到框架应用根目录/public/uploads/ 目录下
$info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
if($file){
    //移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
        //获取文件后缀
        echo $info->getExtension();
        //获取保存名
        echo $info->getSaveName();
        //获取文件名
        echo $info->getFilename();
    }else{
        //上传失败获取错误信息
        echo $file->getError();
    }
}


#4.上传规则
//获取表单上传文件
$file = request()->file('file');
//移动到服务器的上传目录,并且使用md5|date|sha1规则命名文件名
$file->rule('md5')->move(ROOT_PATH . 'public' . DS . 'uploads');
// 移动到服务器的上传目录 并且使用原文件名
$file->move(ROOT_PATH . 'public' . DS . 'uploads','');