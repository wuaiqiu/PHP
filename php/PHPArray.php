<?php  

//-------------------------------数组------------------------------------//

   	   //1.数组定义
   	   $arr1=array(3,11,2,5,7); 		 //索引数组，常规定义，下标从0开始
   	   $arr2=array("a"=>3,"dd"=>11,"acd"=>2);//关联数组，下标为字符串
   	   $arr3=array(1=>3,5=>11,88=>2);	 //下标可以自定义的索引数组
   	   $arr4=array(1=>3,"dd"=>11,88=>2);	 //索引与关联可以混合的混合数组
   	   $arr5=array(1=>3,"dd"=>11,2);	 //含有"自动下标"的数组，
   	                                	 //"自动下标"为前面最大数字下标+1
   	                                	 //1=>3,"dd"=>11,2=>2
   	    
   	
   	   	   
   	   //2.二维数组
   	   $arr6=array(
   	        array(1,2,3),
   	        array(4,5,6,7)
   	   );
  	   
//-------------------------------方法----------------------------------------//

	  /*
   	   * 1.指针操作函数
   	   * current($arr):返回当前指针的值
   	   * key($arr):返回当前指针的键
   	   * next($arr):先将当前指针向后移动一位,在返回新指针的值
   	   * prev($arr):先将当前指针向前移动一位,在返回新指针的值
   	   * reset($arr):先将当前指针向前移动开始位置,在返回新指针的值
   	   * end($arr):先将当前指针向后移动结束位置,在返回新指针的值
   	   * each($arr):先返回当前指针的键值（返回类型为数组），指针在向后移动一位
   	   * list($var1,$var2..)=$arr:将下标0的值赋给$var1,下标1的值赋给$var2..
   	   * */
   	
   	    $arr1=array(1=>3,"dd"=>11,88=>2);
   	
   	    echo "<br/>当前指针的键:".key($arr1);
   	    echo "<br/>当前指针的值:".current($arr1);
   	    next($arr1);
   	    echo "<br/>之后指针的键:".key($arr1);
   	    echo "<br/>之后指针的值:".current($arr1);
   	    echo "<br/>";
   	    var_dump(each($arr1));

   	    $arr2=array(1,3,2,5);
   	    list($v1,$v2)=$arr2;
   	    echo "<br/>v1=$v1;v2=$v2";
   	    
   	    /* 
   	    当前指针的键:1
   	    当前指针的值:3
   	    之后指针的键:dd
   	    之后指针的值:11
   	    array(4) { 
   	        [1]=> int(11) 
   	        ["value"]=> int(11) 
   	        [0]=> string(2) "dd" 
   	        ["key"]=> string(2) "dd" 
   	    }
   	    
   	    
   	    v1=1;v2=3
   	    */
   	   
   	    
   	    
   	    
   	    
   	    
   	    
   	   /*
   	   * 2.单元操作函数
   	   * array_pop($arr):函数删除数组中的最后一个元素,并返回被删除元素的值。
   	   * array_push($arr,"value"):向数组$arr尾部插入value
   	   * array_shift($arr):删除数组中首个元素，并返回被删除元素的值。
   	   * array_unshift($arr,"value"):向数组$arr首部插入value
   	   * array_slice($arr,start,length):返回数组中被选定的部分。
   	   * */
   	  
   	    $arr3=array("a","dd","dv");
   	    array_pop($arr3);
   	    print_r($arr3);
   	    array_push($arr3,"newValue");
   	    print_r($arr3);
   	    print_r(array_slice($arr3, 1));
   	    
   	    /* 
   	    Array ( [0] => a [1] => dd ) 
   	    Array ( [0] => a [1] => dd [2] => newValue ) 
   	    Array ( [0] => dd [1] => newValue )
   	     */
   	    
   	    
   	    
   	    
   	    
   	    
   	    
   	  /* 
   	   * 3.排序函数
   	   * sort($arr):对数组排序.在原数组上操作
   	   * rsort($arr):对数组逆向排序。在原数组上操作
   	   * shuffle($arr):将数组打乱。在原数组上操作
   	   * */
   	    
   	    echo "<br/>";
   	    $arr4=array("a","fd","dv");
   	    print_r($arr4);
   	    sort($arr4);
   	    print_r($arr4);
   	    rsort($arr4);
   	    print_r($arr4);
   	    
   	    /* 
   	    Array ( [0] => a [1] => fd [2] => dv ) 
   	    Array ( [0] => a [1] => dv [2] => fd ) 
   	    Array ( [0] => fd [1] => dv [2] => a )
   	   */
   	  
   	    
   	    
   	    
   	    
   	    
   	  /* 
   	   * 4.查找函数
   	   * in_array("value",$arr)：数组中是否存在指定的值，返回boolean值
   	   * array_key_exists("key",$arr):检查指定的键名是否存在于数组中。
   	   **/
   	    
   	    
   	    echo "<br/>";
   	    $arr5=array(1=>3,"dd"=>11,88=>2);
   	    var_dump(in_array(11, $arr5));
   	    var_dump(array_search("dd", $arr5));
   	    
   	    /* 
   	    bool(true) 
   	    bool(false)
   	     */
   	    
   	    
   	    
   	    
   	    
   	    
   	   /*
   	    *  5.其他函数
   	    * count($arr):返回数组中元素的数目。
   	    * array_keys($arr):返回数组中所有的键名
   	    * array_values($arr):返回数组中所有的值。
   	    * */
   	    
   	    echo "<br/>";
   	    $arr6=array(1=>3,"dd"=>11,88=>2);
   	    echo "数组个数:".count($arr6);
   	    print_r(array_keys($arr6));
   	    print_r(array_values($arr6));
   	    
   	    /* 
   	    数组个数:3
   	    Array ( [0] => 1 [1] => dd [2] => 88 ) 
   	    Array ( [0] => 3 [1] => 11 [2] => 2 )
   	     */
  
//-------------------------------遍历----------------------------------------------// 	   

	 /*
   	   * 1.foreach遍历
   	   *    foreach($array as $key=>$value){
   	   *    
   	   *    }
   	   * */
   	
   	$arr1=array(1=>3,"dd"=>11,88=>2);
   	foreach($arr1 as $key=>$value){
        echo "<br/>{$key}=>{$value}";
   	}
   	/* 
   	1=>3
   	dd=>11
   	88=>2
   	 */
   	
   	
   	
   	
   	
   	/*
   	 * 2.for-next遍历
   	 * */
   	$arr2=array(1=>3,"dd"=>11,88=>2);
   	$len=count($arr2);
   	for($i=0;$i<$len;$i++){
   	    $key=key($arr2);
   	    $value=current($arr2);
   	    echo "<br/>{$key}=>{$value}";
   	    next($arr2);
   	}
   	/* 
   	1=>3
   	dd=>11
   	88=>2
   	 */
   	
   	
   	
   	
   	
   	/*
   	 * 3.while-each-list遍历
   	 *  foreach的内部实现方式
   	 * */
   	
   	$arr3=array(1=>3,"dd"=>11,88=>2);
   	while(  list($key,$value)=each($arr3) ){
   	    echo "<br/>{$key}=>{$value}";
   	}
   	/* 
   	1=>3
   	dd=>11
   	88=>2
   	 */
   	

//---------------------数组参数与数组返回值--------------------------//
function fun($arr){
    foreach($arr as $k=>$v){
        echo "$k==>$v";
    }
    return $arr;
}
$arr=array(1,2,3);
$arr1=fun($arr);   //$arr1=array(1,2,3)
 ?>