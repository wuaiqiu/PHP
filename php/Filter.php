<?php
    /*
     * 过滤器函数
     *  filter_var(variable, filter,options) 函数通过指定的过滤器过滤一个变量。
     *  filter_var_array(array, args) 函数获取多个变量，并进行过滤。
     *  filter_input(input_type, variable, filter,options)获取一个输入变量，并对它进行过滤
     *              input_type:INPUT_GET INPUT_POST INPUT_COOKIE
     *  filter_input_array(input_type, filter_args)获取多个输入变量，并对它们进行过滤
     * */
    
    //filter_var
    if(!filter_var("someone@example....com", FILTER_VALIDATE_EMAIL)){
        echo("E-mail is not valid");
    }
    #E-mail is not valid
    
    
    
    //filter_var_array
    $arr = array("email" => "peter@example.com","age" => "41",);
    $filters = array(
                "age" => array("filter"=>FILTER_VALIDATE_INT),
                "email"=> FILTER_VALIDATE_EMAIL,
    );    
    print_r(filter_var_array($arr, $filters));
    #Array ( [age] => 41 [email] => peter@example.com )
    
    
?>
