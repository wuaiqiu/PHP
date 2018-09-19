<?php

/*
 * 行为(Behavior)
 *
 * */

class Behavior
{
    //指向行为本身所绑定的Component对象
    public $owner;

    //绑定行为到 $owner
    public function attach($owner)
    {
        $this->owner = $owner;
    }
    //解除绑定
    public function detach()
    {
        if ($this->owner) {
            $this->owner = null;
        }
    }
    //$name属性是否可读
    public function canGetProperty($name, $checkVars = true)
    {
        return method_exists($this, 'get' . $name) || $checkVars &&
            property_exists($this, $name);
    }
    //$name属性是否可写
    public function canSetProperty($name, $checkVars = true)
    {
        return method_exists($this, 'set' . $name) || $checkVars &&
            property_exists($this, $name);
    }
    //$name方法是否存在
    public function hasMethod($name)
    {
        return method_exists($this, $name);
    }
}

class Component
{
    //Behavior子类的实例数组
    private $_behaviors;

    //需要绑定的行为
    public function behaviors()
    {
        return [];
    }
    //绑定行为
    public function ensureBehaviors()
    {
        if ($this->_behaviors === null) {
            $this->_behaviors = [];
        }
        foreach ($this->behaviors() as $name => $behavior) {
            $this->attachBehaviorInternal($name, $behavior);
        }
    }
    private function attachBehaviorInternal($name, $behavior)
    {
        if (!($behavior instanceof Behavior)) {
            $behavior = new $behavior();
        }
        //匿名行为
        if (is_int($name)) {
            $behavior->attach($this);
            $this->_behaviors[] = $behavior;
        //命名行为
        } else {
            //已经有一个同名的行为，要先解除，再将新的行为绑定上去。
            if (isset($this->_behaviors[$name])) {
                $this->_behaviors[$name]->detach();
            }
            $behavior->attach($this);
            $this->_behaviors[$name] = $behavior;
        }
        return $behavior;
    }
    //解除行为
    public function detachBehavior($name)
    {
        $this->ensureBehaviors();
        if (isset($this->_behaviors[$name])) {
            $behavior = $this->_behaviors[$name];
            unset($this->_behaviors[$name]);
            $behavior->detach();
            return $behavior;
        } else {
            return null;
        }
    }
    //解除所有行为
    public function detachBehaviors()
    {
        $this->ensureBehaviors();
        foreach ($this->_behaviors as $name => $behavior) {
            $this->detachBehavior($name);
        }
    }
    //注入Behavior属性
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } else {
            $this->ensureBehaviors();
            foreach ($this->_behaviors as $behavior) {
                if ($behavior->canGetProperty($name)) {
                    return $behavior->$name;
                }
            }
        }
        if (method_exists($this, 'set' . $name)) {
            trigger_error('Getting write-only property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        } else {
            trigger_error('Getting unknown property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        }
    }
    //注入Behavior属性
    public function __set($name,$value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
                $this->$setter($value);
        } else {
            $this->ensureBehaviors();
            foreach ($this->_behaviors as $behavior) {
                if ($behavior->canSetProperty($name)) {
                    $behavior->$name=$value;
                }
            }
        }
        if (method_exists($this, 'get' . $name)) {
            trigger_error('Getting read-only property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        } else {
            trigger_error('Getting unknown property: '
                . get_class($this) . '::' . $name,E_USER_ERROR);
        }
    }
    //注入Behavior方法
    public function __call($name, $params)
    {
        $this->ensureBehaviors();
        foreach ($this->_behaviors as $object) {
            if ($object->hasMethod($name)) {
                return call_user_func_array([$object, $name], $params);
            }
        }
        trigger_error('Calling unknown method: '
            . get_class($this) . "::$name()",E_USER_ERROR);
    }
}


//Step 1:定义一个行为类
class MyBehavior extends Behavior
{
    // 行为的一个属性
    public $property1 = 'This is property in MyBehavior.<br>';
    // 行为的一个方法
    public function method1()
    {
        return 'Method in MyBehavior is called.<br>';
    }
}
//Step 2:定义一个将绑定行为的类
class MyClass extends Component
{
    public function behaviors()
    {
        return ["MyBehavior"];
    }
}
//Step 3:访问行为中的属性和方法
$myClass = new MyClass();
echo $myClass->property1;
echo $myClass->method1();