<?php
       
	   /*
         *1.if语句
         * 
         * if(条件一){
         *      ....
         * }else if(条件二){
         *      ....
         * }else{
         *      ....
         * }
         * */   
	
	
	
	
	
	
	   /*
	    * 2.switch语句
	    * 
	    * switch(表达式){
	    *     
	    *      case 值1:
	    *          ....
	    *      break;
	    *      
	    *      case 值2:
	    *          ....
	    *      break;
	    *     
	    *      default：
	    *          ....
	    * }
	    * */
	   
	
	
	   
	
	
	
	   /*
	    * 3.while语句
	    * 
	    * while(条件){
	    *      .....
	    * }
	    * 
	    * 
	    * do{
	    *     ....
	    * }while(条件)
	    * */
	
	
	
	
	
	
	
	
	   /*
	    * 4.for语句
	    * 
	    * for(初始值 ; 条件 ; 增量){
	    *  ....
	    * }
	    * 
	    * 
	    * foreach( $arr as $value){
	    *      ...
	    * }
	    * */
	    
	    
	    
	    
	    /*
	     * 5.循环中断语句
	     * 
	     * break:
	     *     完全退出循环
	     * 
	     * continue:
	     *     退出本次循环，进入下一次循环
	     * */
	    
	    
	    
	    
	 
	    /*
	     * 6.脚本控制语句
	     * 
	     * die("mesg")/exit("mesg"):退出程序,后面的【php代码】与【html代码】不在执行
	     * 
	     * sleep(n):暂停n秒后执行
	     * */
	
	       echo "<br/>执行开始...";
	       die("<br/>执行中断...");
	       echo "<br/>执行结束...";
	       
	       #执行开始...
	       #执行中断...
	       
	      
	       echo "<br/>现在时间:".date("H : i : s");
	       sleep(5);
	       echo "<br/>结束时间:".date("H : i : s");
	
	       #现在时间:10 : 19 : 02
	       #结束时间:10 : 19 : 07
?>
