<?php
/*
 * 图片操作
 *
 * composer require topthink/think-image
 * */

$image = Image::open('./image.png');
//返回图片的宽度
$width = $image->width();
//返回图片的高度
$height = $image->height();
//返回图片的类型
$type = $image->type();
//返回图片的mime类型
$mime = $image->mime();


//将图片裁剪为300x300并保存为crop.png；从坐标(0,0)开始
$image->crop(300, 300)->save('./crop.png','png');
//将图片裁剪为300x300并保存为crop.png；从坐标(100,30)开始
$image->crop(300, 300,100,30)->save('./crop.png','png');


//按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
$image->thumb(150, 150)->save('./thumb.png','png');


//对图像进行以x轴进行翻转操作
$image->flip()->save('./filp_image.png','png');
//对图像进行以y轴进行翻转操作
$image->flip(\think\image::FLIP_Y)->save('./filp_image.png','png');


//对图像使用默认的顺时针旋转90度操作
$image->rotate()->save('./rotate_image.png','png');
//对图像使用默认的顺时针旋转180度操作
$image->rotate(180)->save('./rotate_image.png','png');


//给原图右下角添加水印并保存water_image.png
$image->water('./logo.png')->save('water_image.png','png');
//给原图左上角(1-左上,2-中上,3-右上,4-左中,5-中中,6-右中,7-左下,8-中下,9-左下)添加透明度为50(1-100,越大越清)的水印并保存alpha_image.png
$image->water('./logo.png',1,50)->save('alpha_image.png','png');
//给原图左上角添加水印（font-size:20,font-color:#ffffff）并保存water_image.png
$image->text('十年磨一剑','./a.ttf',20,'#ffffff',1)->save('text_image.png','png');