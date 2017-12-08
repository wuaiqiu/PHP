<?php
//1.创建画布(width,height)
$image=imagecreatetruecolor(500,500);


//2.创建颜色($image,red,green,blue)
$red=imagecolorallocate($image,255,0,0);
$randColor=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
#指定透明度(0 表示完全不透明，127 表示完全透明)
$alpha=imagecolorallocatealpha($image,255,0,0,5);


//3.开始绘画(font 0-5 数字越大字体越大)
#a.填充矩形($image,x,y,width,height,$red);
imagefilledrectangle($image,0,0,500,500,$white);
#b.水平绘制一个字符($image,font,x,y,'K',$red);
imagechar($image,5,50,50,'K',$red);
#c.垂直绘制一个字符($image,font,x,y,'K',$red);
imagecharup($image,5,50,100,'S',$red);
#d.水平绘制一个字符串($image,font,x,y,'string',$red);
imagestring($image,5,50,150,'Hello',$red);
#e.指定字体($image,size,angle,x,y,$randColor,fontfile,'string');
imagettftext($image,5,0,100,100,$randColor,'CourierNew.ttf','Hello');
#f.单个干扰像素($image,x,y,$red);
imagesetpixel($image,0,0,$red);
#g.单条干扰线($image,sx,sy,dx,dy,$red);
imageline($image,0,0,500,500,$red);
#h.干扰圆弧($image,center-x,center-y,width,height,s度,d度)
imagearc($image,100,100,50,50,0,360,$red);


//4.告诉浏览器以图片形式显示
header('Content-type:image/jpeg');
header('Content-type:image/png');
header('Content-type:image/git');


//5.输出图片
imagejpeg($image);
imagegif($image);
imagepng($image);
#保存图片
imagejpeg($image,'a.jpeg');



//6.销毁画布
imagedestroy($image);


//7.操作图片
$file='images/a.jpeg';
#a.得到图片相关信息array
list($width,$height)=getimagesize($file);
#b.创建目标画布
$des_image=imagecreatetruecolor(500,500);
#c.通过图片获取画布
$src_image=imagecreatefromjpeg($file);
#d.拷贝部分图像并调整大小($des_image,$src_image,dst_x,dst_y,src_x,src_y,dst_width,dst_height,src_width,src_height);
imagecopyresampled($des_image,$src_image,0,0,0,0,500,500,$width,$height);
#e.保存图片
imagejpeg($des_image,'a.jpeg');
#f.销毁图片
imagedestroy($des_image);
imagedestroy($src_image);