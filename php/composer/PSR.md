 # PSR

 >PSR 是 PHP Standard Recommendations 的简写，由 PHP FIG 组织制定的 PHP 规范，是 PHP 开发的实践标准。


 #### PSR-0 自动加载规范

```
1. 一个完全合格的namespace和class必须符合这样的结构: <Vendor Name>\[<Namespace>]*\<Class Name>

2. 每个namespace必须有一个顶层的namespace("Vendor Name"提供者名字)

3. 每个namespace可以有多个子namespace

4. 当从文件系统中加载时,每个namespace的分隔符(/)要转换成DIRECTORY_SEPARATOR(操作系统路径分隔符)

5. 在类名中,每个下划线(_) 符号要转换成 DIRECTORY_SEPARATOR(操作系统路径分隔符) 。在namespace中,
下划线 _ 符号是没有(特殊)意义的。

6. 当从文件系统中载入时,合格的 namespace 和 class 一定是以 .php结尾的

7.verdor name , namespaces , class 名可以由大小写字母组合而成(大小写敏感的)
```

##### 实例：

```
"psr-0": {
      "Student\\": "src/",
      "Teacher\\": "src/"
}
```

```
include 'vendor/autoload.php';

#src/Student/StudentWork.php -->class StudentWork{}
use Student\StudentWork;
#src/Teacher/Teacher/Work.php --> class Teacher_Work{}
use Teacher\Teacher_Work;

$stu=new StudentWork();
var_dump($stu);
$tea=new Teacher_Work();
var_dump($tea);
```


#### PSR-1 基础编码规范

```
1.PHP代码文件必须以<?php 或 <?= 标签开始；

2.PHP代码文件必须以不带BOM的UTF-8编码；

3.PHP代码中应该只定义类、函数、常量等声明，或其他会产生 副作用的操作（如：生成文件输出以及修改
.ini配置文件等），二者只能选其一；

4.命名空间以及类必须符合PSR-4的自动加载规范；

5.类的命名必须遵循StudlyCaps大写开头的驼峰命名规范；

6.类中的常量所有字母都必须大写，单词间用下划线分隔；

7.方法名称必须符合camelCase式的小写开头驼峰命名规范。
```


#### PSR-2 编码风格规范

```
1.代码必须遵循PSR-1中的编码规范 。

2.代码必须使用4个空格符而不是「Tab 键」进行缩进。

3.每行的字符数应该软性保持在80个之内，理论上一定不可多于120个，但一定不可有硬性限制。

4.每个namespace命名空间声明语句和use声明语句块后面，必须插入一个空白行。

5.类的开始花括号（{）必须写在类声明后自成一行，结束花括号（}）也必须写在类主体后自成一行。

6.方法的开始花括号（{）必须写在函数声明后自成一行，结束花括号（}）也必须写在函数主体后自成一行。

7.类的属性和方法必须添加访问修饰符（private、protected 以及 public），abstract以及final必须声明在访
问修饰符之前，而static必须声明在访问修饰符之后。

8.控制结构的关键字后必须要有一个空格符。

9.控制结构的开始花括号（{）必须写在声明的同一行，而结束花括号（}）必须写在主体后自成一行。

10.控制结构的开始左括号后和结束右括号前，都一定不可有空格符。
```

##### 实例:

```
<?php
namespace Student;

use Teacher\Teacher_Work;

class StudentWork
{
    const VERSION = '1.0';
    public static function studentRun()
    {
        if (true) {

        } else {

        }
    }
    final public function studentEat()
    {

    }
}
```


#### PSR-3 日志接口规范

>制定了日志类库的通用接口规范

#### PSR-4 自动加载规范

```
1. 一个完全合格的namespace和class必须符合这样的结构: <Vendor Name>\[<Namespace>]*\<Class Name>

2. 每个namespace必须有一个顶层的namespace("Vendor Name"提供者名字)

3. 每个namespace可以有多个子namespace

4. 当从文件系统中加载时,每个namespace的分隔符(/)要转换成DIRECTORY_SEPARATOR(操作系统路径分隔符)

5. 在类名中,每个下划线(_)符号没有(特殊)意义。

6. 当从文件系统中载入时,合格的 namespace 和 class 一定是以 .php结尾的

7.verdor name , namespaces , class 名可以由大小写字母组合而成(大小写敏感的)
```

##### 实例：

```
"psr-4": {
      "Student\\": "src/",
      "Teacher\\": "src/"
}
```

```
include 'vendor/autoload.php';

#src/StudentWork.php -->class StudentWork{}
use Student\StudentWork;
#src/Teacher_Work.php --> class Teacher_Work{}
use Teacher\Teacher_Work;

$stu=new StudentWork();
var_dump($stu);
$tea=new Teacher_Work();
var_dump($tea);
```

#### PSR-6 缓存接口规范

>制定通用的缓存系统接口

#### PSR-7 HTTP消息接口规范

>制定HTTP消息传递的接口
