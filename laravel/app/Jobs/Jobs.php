<?php

class Jobs implements ShouldQueue{
    
   
    
    public function __construct(){
      
    }
   
    //执行工作
    public function handle(){
       Log::info("我是一个info工作");
    }
}

/*
 * queue排队
 *   dispatch(new Jobs());
 * */
