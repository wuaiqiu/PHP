<?php
 class LoadClass{
     
     public $name="zhangsan";
     protected $age="12";
     private $sex="男";
     static $class="3班";
     public $school="信息学院";
     function move(){
         echo "<br/>这是LoadClass的move方法";
     }
     function showProps(){
         foreach($this as $name=>$value){
             echo "<br/>$name => $value";
         }
     }
     
     function __sleep(){
         echo "<br/>我要被序列化...";
         return array('name','school');
     }
     function __wakeup(){
         echo "<br/>我要被反序列化...";
     }
     
 }