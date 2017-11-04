<?php

return [
    //默认上传目录
    'default' => 'local',
    //默认上传云端
    'cloud' => 's3',
    
    'disks' => [
        //保存至storage/app下
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        
        //保存至storage/app/public下（公开）
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
