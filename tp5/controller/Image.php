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
//返回图片的尺寸数组 0 图片宽度 1 图片高度
$size = $image->size();

//将图片裁剪为300x300并保存为crop.png
$image->crop(300, 300)->save('./crop.png');

//按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
$image->thumb(150, 150)->save('./thumb.png');

//对图像进行以x轴进行翻转操作
$image->flip()->save('./filp_image.png');
//对图像进行以y轴进行翻转操作
$image->flip(\think\image::FLIP_Y)->save('./filp_image.png');
//对图像使用默认的顺时针旋转90度操作
$image->rotate()->save('./rotate_image.png');
//给原图左上角添加水印并保存water_image.png
$image->water('./logo.png')->save('water_image.png');
//给原图左上角添加透明度为50的水印并保存alpha_image.png
$image->water('./logo.png',\think\Image::WATER_NORTHWEST,50)->save('alpha_image.png');