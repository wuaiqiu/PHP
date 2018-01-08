<?php
/*
 * PHPFFmpeg
 *
 * x264编码出的视频(一般是mkv或者mp4格式)
 * 比特率:比特率是指每秒传送的比特(bit)数;视频中的比特率是指由模拟信号转换为数字信号的采样率，采样率
 * 越高，还原后的音质就越好。但编码后的文件就越大
 * */

#实例化
$ffmpeg = FFMpeg\FFMpeg::create();
#打开资源（video与audio）
$video=$ffmpeg->open('Daydream.mp4');
$audio=$ffmpeg->open("a.mp3");


#转码
$format = new FFMpeg\Format\Video\X264(); //X264,Ogg,WebM,WMV,WMV3
$format = new FFMpeg\Format\Audio\Mp3();  //Aac,Flac,Wac,Mp3,Vorbis
$format->on('progress', function ($video, $format, $percentage) {
    echo "$percentage % transcoded";//实时监视
});
//设置视频或音频的比特率
$format->setKiloBitrate(1000)->setAudioChannels(2)->setAudioKiloBitrate(256);
//输出视频
$video->save($format, 'video.avi');


#截图(42秒处)
$frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(42));
$frame->save('image.jpg');


#生成声波图片(只能png格式)
$audio_format = new FFMpeg\Format\Audio\Mp3();
$video->save($audio_format, 'audio.mp3');
$audio = $ffmpeg->open( 'audio.mp3' );
$waveform = $audio->waveform();
$waveform->save( 'waveform.png' );


#过滤器
//(1)旋转
$angle=FFMpeg\Filters\Video\RotateFilter::ROTATE_180;//(90,180,270)
$video->filters()->rotate($angle);
$video->save(new FFMpeg\Format\Video\Ogg(), 'a.ogg');

//(2)调整尺寸
$dimension=new FFMpeg\Coordinate\Dimension(500,500);//设置长和宽；
$mode=FFMpeg\Filters\Video\ResizeFilter::RESIZEMODE_FIT;//设置模式；FIT,INSET,SCALE_HEIGHT,SCALE_WIDTH
$useStandards=false;//是否强制使用最新的比率标准
$video->filters()->resize($dimension, $mode, $useStandards);
//或者直接使用非标准
$video->filters()->pad($dimension);
$video->save(new FFMpeg\Format\Video\Ogg(), 'a.ogg');

//(3)水印
$watermarkPath="waveform.png";//水印位置
$video
    ->filters()
    ->watermark($watermarkPath, array(
        'position' => 'relative',
        'bottom' => 50,
        'right' => 50,
    ));
$video->save(new FFMpeg\Format\Video\Ogg(), 'a.ogg');

//(4)帧频
//改变帧频
$framerate= new FFMpeg\Coordinate\FrameRate(1);
$gop=1;
$video->filters()->framerate($framerate, $gop);
//同步音频和视频
$video->filters()->synchronize();
$video->save(new FFMpeg\Format\Video\Ogg(), 'a.ogg');

//(5)裁剪
//从30秒开始往后15秒
$start=FFMpeg\Coordinate\TimeCode::fromSeconds(30);
$duration=FFMpeg\Coordinate\TimeCode::fromSeconds(15);
$video->filters()->clip($start,$duration);
$video->save(new FFMpeg\Format\Video\Ogg(), 'a.ogg');


#gif生成
$start=FFMpeg\Coordinate\TimeCode::fromSeconds(2);
$dimension=new FFMpeg\Coordinate\Dimension(640, 480);
$duration=3;
$video->gif($start,$dimension , $duration)->save("a.gif");