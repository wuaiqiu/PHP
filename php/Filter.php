<?php
    
//-------------------------------------过滤函数-----------------------------------//
   
    /*
     * 过滤器函数
     *  filter_var(variable, filter,options) 函数通过指定的过滤器过滤一个变量。
     *  filter_var_array(array, args) 函数获取多个变量，并进行过滤。
     *  filter_has_var(input_type, variable) 函数检查是否存在指定输入类型的变量。
     *  filter_input(input_type, variable, filter,options)获取一个输入变量，并对它进行过滤
     *              input_type:INPUT_GET INPUT_POST INPUT_COOKIE
     *  filter_input_array(input_type, filter_args)获取多个输入变量，并对它们进行过滤
     * */
    


    //1.filter_var
     $int = 123;
     if(!filter_var($int, FILTER_VALIDATE_INT)){
    	echo("不是一个合法的整数");
     }else{
        echo("是个合法的整数");
     }
    
	#是个合法的整数



    //2.filter_var的options附加选项
    $options=array("options"=>array("min_range"=>0,"max_range"=>100));
    if(!filter_var($int, FILTER_VALIDATE_INT,$options)){
    	echo("不是一个合法的整数");
     }else{
        echo("是个合法的整数");
    }
   
	#不是一个合法的整数	
    



    //3.filter_var_array
    $arr = array("email" => "peter@example.com","age" => "41",);
    $filters = array(
                "age" => array(
				"filter"=>FILTER_VALIDATE_INT,
				"options"=>array("min_range"=>0,"max_range"=>100)
			  ),
                "email"=> FILTER_VALIDATE_EMAIL,
    );    
    print_r(filter_var_array($arr, $filters));
    
	#Array ( [age] => 41 [email] => peter@example.com )



//--------------------------------------自定义过滤函数-------------------------------------//

	/*
	 * 自定义过滤器
	 *  FILTER_CALLBACK：调用用户自定义函数来过滤数据
	 * */

	//定义过滤函数
	function convertSpace($string){
 	   return str_replace("_", ".", $string);
	}
	$string = "www_runoob_com!";
	echo filter_var($string, FILTER_CALLBACK,array("options"=>"convertSpace"));

    
    
?>
