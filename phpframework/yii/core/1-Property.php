<?php

/*
 * 属性(Property)
 *
 *   1.由于自动调用__get()与__set()的时机仅仅发生在访问不存在的成员变量时。因此，如果
 * 定义了成员变量public $title那么，就算定义了getTitle()与setTitle()，他们也不会被
 * 调用。因为$post->title时，会直接指向该pulic $title ，__get()与__set()是不会被调
 * 用的。从根上就被切断了。
 *   2.由于PHP对于类方法不区分大小写，即大小写不敏感，$post->getTitle()和
 * $post->gettitle()是调用相同的函数。因此，$post->title和$post->Title是同一个属性。
 * 即属性名也是不区分大小写的。
 *   3.由于__get()与__set()都是public的，无论将getTitle()与setTitle()声明为public,
 * private，protected，都没有意义，外部同样都是可以访问。所以，所有的属性都是public的。
 *   4.由于__get()与__set()都不是static的，因此，没有办法使用static的属性。
 * */


class Base
{
    //getter的实现
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            trigger_error('Getting write-only property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        } else {
            trigger_error('Getting unknown property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        }
    }

    //setter的实现
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            trigger_error('Getting read-only property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        } else {
            trigger_error('Getting unknown property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        }
    }
}

class Person extends Base
{
    private $_title;

    public function getTitle()
    {
        return $this->_title;
    }


    public function setTitle($value)
    {
        $this->_title=$value;
    }
}


$p=new Person();
$p->title="sss";
var_dump($p->title);
