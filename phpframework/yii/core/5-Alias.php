<?php

/*
 * 别名(Alias)
 *
 * 1.别名必然以@打头
 * 2.别名的定义可以使用之前已经定义过的别名
 * 3.别名解析时,优先匹配较长的别名(ksort)
 * */

class Yii
{
    //存放别名
    private static $aliases;
    //注册别名
    public static function setAlias($alias, $path)
    {
        //如果拟定义的别名并非以@打头,则在前面加上@
        if (strncmp($alias, '@', 1)) {
            $alias = '@' . $alias;
        }
        //找到别名的第一段,即@到第一个/之间的内容,如@foo/bar/qux的@foo
        $pos = strpos($alias, '/');
        $root = $pos === false ? $alias : substr($alias, 0, $pos);
        if ($path !== null) {
            //去除路径末尾的\/.如果路径本身就是一个别名,直接解析出来
            $path = strncmp($path, '@', 1) ? rtrim($path, '/')
                : static::getAlias($path);
            //检查是否有$aliases[$root],看看是否已经定义好了根别名.如果没有,则以$root为键,保存这个别名
            if (!isset(static::$aliases[$root])) {
                if ($pos === false) {
                    static::$aliases[$root] = $path;
                } else {
                    static::$aliases[$root] = [$alias => $path];
                }
            //如果$aliases[$root]已经存在,则替换成新的路径,或增加新的路径
            } elseif (is_string(static::$aliases[$root])) {
                if ($pos === false) {
                    static::$aliases[$root] = $path;
                } else {
                    static::$aliases[$root] = [
                        $alias => $path,
                        $root => static::$aliases[$root],
                    ];
                }
            } else {
                static::$aliases[$root][$alias] = $path;
                krsort(static::$aliases[$root]);
            }
         //当传入的$path为null时,表示要删除这个别名
        } elseif (isset(static::$aliases[$root])) {
            if (is_array(static::$aliases[$root])) {
                unset(static::$aliases[$root][$alias]);
            } elseif ($pos === false) {
                unset(static::$aliases[$root]);
            }
        }
    }
    //解析别名
    public static function getAlias($alias,  $throwException = true)
    {
        //一切不以@打头的别名都是无效的
        if (strncmp($alias, '@', 1)) {
            return $alias;
        }
        //先确定根别名$root
        $pos = strpos($alias, '/');
        $root = $pos === false ? $alias : substr($alias, 0, $pos);
        //从根别名开始找起,如果根别名没找到,一切免谈
        if (isset(static::$aliases[$root])) {
            if (is_string(static::$aliases[$root])) {
                return $pos === false ? static::$aliases[$root] :
                    static::$aliases[$root] . substr($alias, $pos);
            } else {
                //由于写入前使用了krsort()所以,较长的别名会被先遍历到
                foreach (static::$aliases[$root] as $name => $path) {
                    if (strpos($alias . '/', $name . '/') === 0) {
                        return $path . substr($alias, strlen($name));
                    }
                }
            }
        }
        if ($throwException) {
            trigger_error("Invalid path alias: $alias");
        } else {
            return false;
        }
    }
}


Yii::setAlias('@foo', 'path/to/foo');
Yii::setAlias('@foo/bar', '@foo/2/bar');
Yii::setAlias('@foo/bar/qux', 'path/to/qux');

print_r(Yii::getAlias('@foo/bar'));
print_r(Yii::getAlias('@foo/bar/exe'));