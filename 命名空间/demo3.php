<?php
namespace Foo\Bar;
include 'demo4.php';

const FOO = 2;
function foo() {
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    echo "<br/>这是Foo/Bar的foo方法";
}
class foo
{
    static function staticmethod() {
        echo "<br/>这是Foo/Bar的静态方法";
    }
}

/* 非限定名称 */
foo(); // 解析为 Foo\Bar\foo 
foo::staticmethod(); // 解析为类 Foo\Bar\foo的静态方法staticmethod。
echo FOO; //  解析为Foo\Bar\FOO

/*
这是Foo/Bar的foo方法
这是Foo/Bar的静态方法
2
*/




/* 限定名称 */
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo,
// 以及类的方法 staticmethod
echo subnamespace\FOO; // 解析为常量 Foo\Bar\subnamespace\FOO

/* 
这是Foo/Bar/sub的foo方法
这是Foo/Bar/sub的静态方法
1
 */

/* 完全限定名称 */
\Foo\Bar\foo(); // 解析为函数 Foo\Bar\foo
\Foo\Bar\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Foo\Bar\FOO; // 解析为常量 Foo\Bar\FOO


/* 
这是Foo/Bar的foo方法
这是Foo/Bar的静态方法
2
 */