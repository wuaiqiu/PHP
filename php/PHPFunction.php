<?php

//-----------------------------函数----------------------------------------//

	/*
   	 * 1.函数定义
   	 *      function 函数名(参数, ...){
   	 *          函数体
   	 *      }
   	 *      
   	 *      
   	 * 2.函数的参数
   	 * a.默认参数【注意设置默认值的参数尽量往右移】
   	 *      function 函数名(参数=默认值,...){
   	 *            函数体
   	 *      }
   	 *      
   	 * 
   	 *      
   	 * b.参数个数【不定义形参，但又可以传不定个数的参数，var_dump($s1,$s2..)】
   	 *      $arr=func_get_args(); 返回一个参数数组
   	 *      $value=func_get_arg(n);获取第几个值（从0开始）
   	 *      $num=func_num_args();返回参数个数
   	 *      
   	 *      
   	 * 3.可变函数（与可变变量类似）
   	 *      一个函数的名称为一个变量名
   	 *      
   	 *      
   	 * 4.匿名函数
   	 * a.将一个匿名函数赋值给一个变量
   	 *      $var=function(参数列表){
   	 *          函数体
   	 *      };
   	 * 
   	 * b.将一个匿名函数当做一个实参
   	 *      fun(1,function(参数列表){
   	 *            匿名函数体
   	 *      });
   	 * */
   	   
   	
   	
   	   //普通函数
   	   function fun1($s1,$s2){
   	       echo "<br/>$s1+$s2=".($s1+$s2);
   	   }
   	    
   	   fun1(1,2);           #1+2=3
   	   
   	   
   	   
   	   
   	   
   	   
   	   //带默认参数的函数
   	   function fun2($s1,$s2=3){
   	       echo "<br/>$s1+$s2=".($s1+$s2);
   	   }
   	   
   	   fun2(1);             #1+3=4
   	   fun2(1,2);           #1+2=3
   	   
   	   
   	   
   	   
   	   
   	   //不定参数个数的函数
   	   function fun3(){
   	       $arr=func_get_args();
           $num=func_num_args();   	      
   	       echo "<br/>共有{$num}个参数".var_dump($arr);
   	   }
   	   
   	   fun3();          #array(0) { }共有0个参数
   	   fun3(1,2);       #array(2) { [0]=> int(1) [1]=> int(2) }共有2个参数
   	   fun3(1,2,3);     #array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) }共有3个参数
   	   
   	   
   	   //可变函数
   	   function fun4(){
   	       echo "<br/>这是一个可变函数";
   	   }
   	   
   	   $v="fun4";
   	   $v();        #这是一个可变函数
   	   
   	   
   	   
   	   //匿名函数（一）
   	   $v1=function($s1,$s2){
   	       echo "<br/>$s1+$s2=".($s1+$s2);
   	   };
   	   
   	   $v1(1,2); #1+2=3
   	   
   	   
   	   //匿名函数（二）
   	   function fun5($s1,$s2){
   	       echo "<br/>s1=$s1";
   	       $s2(2,3);
   	   }
   	   
   	   fun5(1,function($v1,$v2){
   	       echo "<br/>v1=$v1";
   	       echo "<br/>v2=$v2";
   	   });
   	   
   	        /*s1=1
   	         *v1=2
   	         *v2=3
   	         */



//-----------------------------类的魔术方法---------------------------------------//

    /*
     * __toString()方法
     *  将一个对象以字符串输出
     *  
     *  __invoke()方法
     *   当将对象以函数调用时会触发此方法
     * */    
   	
   	class Person{
   	    public $name="zhangsan";
   	    public $age="12";
   	    function __toString(){
   	        return "<br/>name => $this->name<br/>age => $this->age";
   	    }
   	    function __invoke(){
   	        echo "<br/>这是一个对象，不要当做函数用...";
   	    }
   	    
   	}
   	
   	$obj = new Person();
   	echo $obj;
   	
   	/* 
   	name => zhangsan
   	age => 12
   	 */
   	
   	$obj();
   	
   	/* 
   	这是一个对象，不要当做函数用...
   	 */



//---------------------------对象序列化与反序列化----------------------------//
	
	//1..对象的序列化,会自动调用类中的__sleep()【若存在】：必须返回需要序列化的属性
   	//      function __sleep(){
        //             return array('name','age');
       //  }
   	    require_once "LoadClass.php";
   	    $obj = new LoadClass();
   	    $obj->name="lisi";
   	    $obj->school="建筑学院";
   	    $str1=serialize($obj);
   	    file_put_contents("obj.txt", $str1);
	
	
	//2.对象的反序列化,另外会调用类中__wakeup()【若存在】
   	//      function __wakeup(){
        //}
   	    require_once "LoadClass.php";
   	    $str1 = file_get_contents("obj.txt");
   	    $obj = unserialize($str1);
   	    echo "<pre>";
   	    var_dump($obj);
   	    echo "</pre>";



//------------------------------操作类与对象-------------------------------------//
	
	/*一.操作类
         * class_exists("类名") :判断一个类是否存在
         * interface_exists("接口名") :判断一个接口是否存在
         * get_class($obj) : 获取$obj的类名
         * get_parent_class($obj) :获取$obj的父类名
         * get_class_methods("类名") : 返回一个类的所有方法名(数组类型)
         * get_class_vars("类名") : 返回一个类的所有属性名与属性值(数组类型)
         * $obj instanceof 类名 :判断$obj是否为"类名"的类
         * */

	/*二.操作方法
         * is_object($obj) : 判断某个变量是否为对象
         * get_object_vars($obj) : 返回该对象的所有属性名与属性值(数组类型)
         * */
	 
?>