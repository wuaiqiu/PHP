<?php

class AutoLoader
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        //单例模式
        if (null !== self::$loader) {
            return self::$loader;
        }
        //获取ClassLoader对象
        spl_autoload_register(array(self::class, 'loadClassLoader'));
        self::$loader = $loader = new  ClassLoader();
        spl_autoload_unregister(array(self::class, 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION');
        //注册映射路径
        if ($useStaticLoader) {
            require_once __DIR__ . '/AStatic.php';
            call_user_func(AStatic::getInitializer($loader));
        } else {
            $map = require __DIR__ . '/A0.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/A4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/AName.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }
        //实现加载路径的映射
        $loader->register(true);
        return $loader;
    }
}
