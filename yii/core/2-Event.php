<?php

/*
 * 事件(Event)
 * */

class EventObject
{
    public $name;               // 事件名
    public $sender;             // 事件发布者，通常是调用了trigger()的对象或类。
    public $handled = false;    // 是否终止事件的后续处理
    public $data;               // 事件相关数据
}

class Event
{
    //这个就是handler数组
    private $_events = [];

    /**
     * 事件绑定
     * @param $name:事件名
     * @param $handler:事件处理器
     * @param null $data:事件处理器传递的数据
     * @param bool $append:事件处理器是否以追加形式添加
     */
    public function on($name, $handler, $data = null, $append = true)
    {
        if ($append || empty($this->_events[$name])) {
            $this->_events[$name][] = [$handler, $data];
        } else {
            array_unshift($this->_events[$name], [$handler, $data]);
        }
    }


    /**
     * 事件移除
     * @param $name:事件名
     * @param null $handler:事件处理器，默认null为所有处理器
     * @return bool:返回是否成功，返回false可能为事件或事件处理器不存在
     */
    public function off($name, $handler = null)
    {
        if (empty($this->_events[$name])) {
            return false;
        }
        if ($handler === null) {
            unset($this->_events[$name]);
            return true;
        } else {
            $removed = false;
            foreach ($this->_events[$name] as $i => $event) {
                if ($event[0] === $handler) {
                    unset($this->_events[$name][$i]);
                    $removed = true;
                }
            }
            if ($removed) {
                $this->_events[$name] = array_values($this->_events[$name]);
            }
            return $removed;
        }
    }

    /**
     * 事件触发
     * @param $name:事件名
     * @param null $event:EventObject对象
     */
    public function trigger($name, $event_obj = null)
    {
        if (!empty($this->_events[$name])) {
            if ($event_obj === null) {
                $event_obj = new EventObj;
            }
            if ($event_obj->sender === null) {
                $event_obj->sender = $this;
            }
            $event_obj->handled = false;
            $event_obj->name = $name;
            foreach ($this->_events[$name] as $handler) {
                $event_obj->data = $handler[1];
                call_user_func($handler[0], $event_obj);
                if ($event_obj->handled) {
                    return;
                }
            }
        }
    }
}

function a($event){
    echo $event->data."<br>";
    $event->handled=true;
}

function b($event){
    echo $event->data."<br>";
}

$p=new Person();
$p->on("hello",'a',"mmm");
$p->on("hello",'b',"nnn");
$p->trigger("hello");