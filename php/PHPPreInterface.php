<?php

/*
 * 预定义接口:
 *
 *   (1).Iterator迭代器
 *         abstract public mixed current ( void ) // 返回当前元素
 *         abstract public scalar key ( void ) //返回当前元素的键
 *         abstract public void next ( void ) //向前移动到下一个元素
 *         abstract public void rewind ( void ) //返回到迭代器的第一个元素
 *         abstract public bool valid ( void ) //检查当前位置是否有效
 * */

class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );

    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->array[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        $this->position++;
    }

    function valid() {
        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;

foreach($it as $key => $value) {
    var_dump($key, $value);
    echo "<br/>";
}

/*
 *  (2).IteratorAggregate聚合式迭代器接口
 *      abstract public Traversable getIterator ( void ):获取一个外部迭代器
 * */

class myData implements IteratorAggregate {
    public $property1 = "Public property one";
    public $property2 = "Public property two";
    public $property3 = "Public property three";

    public function __construct() {
        $this->property4 = "last property";
    }

    public function getIterator() {
        return new ArrayIterator($this);
    }
}

$obj = new myData;

foreach($obj as $key => $value) {
    var_dump($key, $value);
    echo "<br>";
}

/*
 *  (3).ArrayAccess数组式访问
 *      abstract public boolean offsetExists ( mixed $offset ):检查一个偏移位置是否存在
 *      abstract public mixed offsetGet ( mixed $offset ):获取一个偏移位置的值
 *      abstract public void offsetSet ( mixed $offset , mixed $value ):设置一个偏移位置的值
 *      abstract public void offsetUnset ( mixed $offset ):复位一个偏移位置的值
 * */

class obj implements arrayaccess {
    private $container = array();
    public function __construct() {
        $this->container = array(
            "one"   => 1,
            "two"   => 2,
            "three" => 3,
        );
    }
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}

$obj = new obj;
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);


/*
 * (4).Closure类
 *     public static Closure bind ( Closure $closure , object $newthis [, mixed $newscope = 'static' ] ):复制一个闭包，绑定指定的$this对象和类作用域。
 *     public Closure bindTo ( object $newthis [, mixed $newscope = 'static' ] ):复制当前闭包对象，绑定指定的$this对象和类作用域。
 * */
class A {
    private $sfoo = 1;
    private $ifoo = 2;
}

$bcl1 = Closure::bind(function (){
    return $this->sfoo;
}, new A(), 'A');

$fun = function (){
    return $this->ifoo;
};
$bcl2 = $fun->bindTo(new A(),'A');
var_dump($bcl1,$bcl2);


/*
 * (5).Generator生成器类
 *      public mixed current ( void ):返回当前产生的值(yield后面表达式的值)
 *      public mixed key ( void ):yield的键(yield 'key'=>'val';)
 *      public void next ( void ):从上一个yield之后继续执行,直到下一个yield
 *      public void rewind ( void ):重置迭代器（对于生成器并没什么卵用）
 *      public mixed send ( mixed $value ):向生成器中传入一个值，并从上一个yield之后继续执行
 *      public void throw ( Exception $exception ):向生成器中抛出一个异常，并从上一个yield之后继续执行
 *      public bool valid ( void ):检查迭代器是否被关闭(false表示已关闭)
 *      public void __wakeup ( void ):序列化回调，但是生成器不能被序列化，因此会抛出一个异常
 * */
function xrange($start, $limit, $step = 1)
{
    for ($i = $start; $i <= $limit; $i += $step) {
        //向外产出值
        yield $i;
    }
}

//xrange此时返回的是一个生成器对象
$gen = xrange(1, 9);

//对生成器进行迭代
foreach ($gen as $number) {
    echo "$number ";
}