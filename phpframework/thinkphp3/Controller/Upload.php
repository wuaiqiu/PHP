<?php
/*
 * 文件上传
 * Upload方法支持多文件上传
 *  (1)如果上传成功，就返回成功上传的文件信息数组。
 *         savepath	上传文件的保存路径
 *         name	上传文件的原始名称
 *         savename	上传文件的保存名称
 *         size	上传文件的大小
 *         type	上传文件的MIME类型
 *         ext	上传文件的后缀类型
 *  
 *  (2)其他属性 
 *      #采用时间戳命名
 *      'saveName' => 'time';
 *      #采用uniqid函数生成一个唯一的字符串序列(默认)
 *      'saveName' => 'uniqid';
 *      #保持上传文件名不变
 *      'saveName => '';
 *      
 *      #开启子目录保存 并以日期（格式为Ymd）为子目录(默认)
 *      'autoSub' => true;
 *      'subName' => array('date','Y-m-d');
 *      
 *  (3)多文件上传表单       
 * <form action="__URL__/upload" enctype="multipart/form-data" method="post" >
 *      <input type='file'  name='photo1'>
 *      <input type='file'  name='photo2'>
 *      <input type='file'  name='photo3'>
 *      <input type="submit" value="提交" >
 *  </form>
 * */

function upload(){
    $upload=new \Think\Upload();                      #实例化上传类
    $upload->maxSize=3145728 ;                        #设置附件上传大小;（以字节为单位），0为不限大小
    $upload->exts= array('jpg', 'gif', 'png', 'jpeg');# 设置附件上传类型
    $upload->rootPath='./Upload/';                    #(相对于入口文件）设置附件上传根目录
    $upload->savePath='';                             #设置附件上传（子）目录
    #上传文件
    $info=$upload->upload();
    if(!$info) {    #上传错误提示错误信息
        $this->error($upload->getError());
    }else{  #上传成功
        $this->success('上传成功！');
        foreach($info as $file){
            echo $file['savepath'].$file['savename'];
        }
    }
?>