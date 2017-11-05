<?php

class Jobs implements ShouldQueue{
    
    protected  $str;
    
    public function __construct($str){
       $this->str=$str;
    }
   
    //执行工作
    public function handle(){
       Log::info($str);
    }
}

/*
 * queue排队
 *   dispatch(new Jobs("我是一个info工作"));
 * */
