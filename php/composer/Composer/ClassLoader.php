<?php
class ClassLoader
{
    // PSR-4
    private $prefixLengthsPsr4 = array();
    private $prefixDirsPsr4 = array();

    // PSR-0
    private $prefixesPsr0 = array();

    //classmap
    private $classMap = array();

    //添加psr-0
    public function set($prefix, $paths)
    {
        if ($prefix) {
            $this->prefixesPsr0[$prefix[0]][$prefix] = (array) $paths;
        }
    }

    //添加psr-4
    public function setPsr4($prefix, $paths)
    {
        if ($prefix) {
            $length = strlen($prefix);
            if ('\\' !== $prefix[$length - 1]) {
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator.");
            }
            $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
            $this->prefixDirsPsr4[$prefix] = (array) $paths;
        }
    }

    //添加classmap
    public function addClassMap(array $classMap)
    {
        if ($this->classMap) {
            $this->classMap = array_merge($this->classMap, $classMap);
        } else {
            $this->classMap = $classMap;
        }
    }

    //注册spl函数
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }


    //自定义spl函数
    public function loadClass($class)
    {
        if ($file = $this->findFile($class)) {
            includeFile($file);
            return true;
        }
    }

    //寻找文件
    public function findFile($class)
    {
        //classmap
        if (isset($this->classMap[$class])) {
            return $this->classMap[$class];
        }
        //psr-0与psr-4
        $file = $this->findFileWithExtension($class, '.php');

        return $file;
    }


    private function findFileWithExtension($class, $ext)
    {
        //PSR-4
        $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . $ext;
        $first = $class[0];
        if (isset($this->prefixLengthsPsr4[$first])) {
            $subPath = $class;
            while (false !== $lastPos = strrpos($subPath, '\\')) {
                $subPath = substr($subPath, 0, $lastPos);
                $search = $subPath.'\\';
                if (isset($this->prefixDirsPsr4[$search])) {
                    $pathEnd = DIRECTORY_SEPARATOR . substr($logicalPathPsr4, $lastPos + 1);
                    foreach ($this->prefixDirsPsr4[$search] as $dir) {
                        if (file_exists($file = $dir . $pathEnd)) {
                            return $file;
                        }
                    }
                }
            }
        }

        //PSR-0
        if (false !== $pos = strrpos($class, '\\')) {
            $logicalPathPsr0 = substr($logicalPathPsr4, 0, $pos + 1)
                . strtr(substr($logicalPathPsr4, $pos + 1), '_', DIRECTORY_SEPARATOR);
        } else {
            $logicalPathPsr0 = strtr($class, '_', DIRECTORY_SEPARATOR) . $ext;
        }
        if (isset($this->prefixesPsr0[$first])) {
            foreach ($this->prefixesPsr0[$first] as $prefix => $dirs) {
                if (0 === strpos($class, $prefix)) {
                    foreach ($dirs as $dir) {
                        if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr0)) {
                            return $file;
                        }
                    }
                }
            }
        }

        return false;
    }
}

function includeFile($file)
{
    include $file;
}
