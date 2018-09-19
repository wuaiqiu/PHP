<?php

class ServiceLocator
{
    //用于缓存服务、组件等的实例
    private $_components = [];
    //用于保存服务和组件的定义,通常为配置数组,用来创建具体的实例
    private $_definitions = [];

    //获取对应的服务或组件的实例
    public function get($id, $throwException = true)
    {
        //如果已经有实例化好的组件或服务,直接使用缓存
        if (isset($this->_components[$id])) {
            return $this->_components[$id];
        }
        //如果还没有实例化好,那么再看看是不是已经定义好
        if (isset($this->_definitions[$id])) {
            $definition = $this->_definitions[$id];
            //如果定义是个对象,且不是Closure对象,那么直接将这个对象返回
            if (is_object($definition) && !$definition instanceof Closure) {
                return $this->_components[$id] = $definition;
            //如果定义是个数组或者PHP callable,那么就创建一个实例
            } else {
                return $this->_components[$id] = new $definition['class'];
            }
        //如果还没有实例化好,也没有定义
        } elseif ($throwException) {
            trigger_error("Unknown component ID: $id");
        } else {
            return null;
        }
    }
    //注册一个组件或服务
    public function set($id, $definition)
    {
        //当定义为null时,表示要从Service Locator中删除一个服务或组件
        if ($definition === null) {
            unset($this->_components[$id], $this->_definitions[$id]);
            return;
        }
        //确保服务或组件ID的唯一性
        unset($this->_components[$id]);
        //定义如果是个对象或PHP callable或类名,直接作为定义保存
        if (is_object($definition) || is_callable($definition, true)) {
            //写入$_definitions数组
            $this->_definitions[$id] = $definition;
        //定义如果是个数组,要确保数组中具有class元素
        } elseif (is_array($definition)) {
            if (isset($definition['class'])) {
                //写入$_definitions数组
                $this->_definitions[$id] = $definition;
            } else {
                trigger_error(
                    "The configuration for the \"$id\" component must contain a \"class\" element."
                ,E_USER_ERROR);
            }
        //定义如果是其他就抛出异常
        } else {
            trigger_error("Unexpected configuration type for the \"$id\" component: "
             . gettype($definition),E_USER_ERROR);
        }
    }
    //删除一个服务或组件
    public function clear($id)
    {
        unset($this->_definitions[$id], $this->_components[$id]);
    }
}

class Person
{
    public function getName()
    {
        return 'Person';
    }
}

$locator=new ServiceLocator();
$locator->set('p',['class'=>'Person']);
$locator->get('p')->getName();