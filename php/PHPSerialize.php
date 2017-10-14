<?php
/*
 * 1.对象的序列化,会自动调用类中的__sleep()【若存在】：必须返回需要序列化的属性
 *      function __sleep(){
 *           return array('name','age');
 *      }
 *      
 * 2.对象的反序列化,另外会调用类中__wakeup()【若存在】
 *      function __wakeup(){
 *      }
 * */

        class PersonA{}
        //序列化   	 
   	    $obj = new PersonA();
   	    $str1=serialize($obj);
   	    file_put_contents("obj.txt", $str1);
	    //反序列化
   	    $str1 = file_get_contents("obj.txt");
   	    $obj = unserialize($str1);
   	    var_dump($obj);
?>