<?php

class AStatic
{
    //psr-4
    public static $prefixLengthsPsr4 = array (
        'S' =>
            array (
                'Student\\' => 8,
            )
    );
    public static $prefixDirsPsr4 = array (
        'Student\\' =>
            array (
                0 => __DIR__ . '/..' . '/src',
            )
    );

    //psr-0
    public static $prefixesPsr0 = array (
        'T' =>
            array (
                'Teacher\\' =>
                    array (
                        0 => __DIR__ . '/..' . '/src',
                    )
            )
    );

    //classmap
    public static $classMap = array (
        'Hello' => __DIR__ . '/..' . '/demo/Hello.php'
    );

    public static function getInitializer($loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = AStatic::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = AStatic::$prefixDirsPsr4;
            $loader->prefixesPsr0 = AStatic::$prefixesPsr0;
            $loader->classMap = AStatic::$classMap;
        }, null, ClassLoader::class);
    }
}