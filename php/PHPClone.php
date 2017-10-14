<?php
/*
 * 对象克隆
 *   将一个已有对象复制一份（新对象），但数据空间与原有的对象数据空间相同
 * */
class Person{}
$obj=new Person();//原对象
$obj1 = $obj;//值传递
$obj2 = &$obj;//引用传递
$obj3 = clone $obj;//对象克隆


var_dump($obj);
var_dump($obj1);
var_dump($obj2);
var_dump($obj3);


/*
 原对象object(Person)#1 (0) {
 }
 值传递object(Person)#1 (0) {
 }
 引用传递object(Person)#1 (0) {
 }
 对象克隆object(Person)#2 (0) {
 }
 */
?>