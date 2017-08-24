<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>字符串函数</title>
</head>
	<body>
   
   	<?php  
   	     /*
   	      * 1.输出
   	      * echo("string","string"):能够输出一个以上的字符串,有无括号均可使用
   	      * print("string"):只能输出一个字符串,有无括号均可使用
   	      * print_r($var):显示调试信息
   	      * var_dump($var):显示调试信息
   	      * */
   	
    	echo "hello"," world"," php";
   	    print "<br/>hello world php";
   	
        /*    	    
   	    hello world php
   	    hello world php
   	 */
   	    
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 2.字符串去除与填充
   	     * trim($str):移除字符串两侧的空格
   	     * str_pad($str,num,$str):用$str从左填充字符串$arr至长度为num
   	     * */
   	    
   	    echo "<br/>".trim(" hello world php  ");
   	    echo "<br/>".str_pad("101", 10,0);
   	
   	    /* 
   	    hello world php
   	    1010000000
   	 */
   	    
   	    
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 3.字符串链接与分割
   	     * join/implode("字符分割符",$arr):将数组元素组合成的字符串。
         * explode("字符分隔符",$str):把字符串打散为数组
   	     * */
   	    
   	    $arr = array('Hello','World!','I','love','Shanghai!');
   	    echo "<br/>".implode(" ",$arr);
   	    
   	    $str = "Hello world. I love Shanghai!";
   	    print_r (explode(" ",$str));
   	    
   	    /* 
   	    Hello World! I love Shanghai!
   	    
   	    Array ( [0] => Hello [1] => world. [2] => I [3] => love [4] => Shanghai! )
   	     */
   	    
   	    
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 4.字符串截取
   	     * substr($str,start,length):返回字符串的一部分
   	     * */
   	
   	    echo "<br/>".substr("Hello world",6);
   	    
   	    /* 
   	    world
   	     */
   	    
   	    
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 5.字符串替换
   	     * str_replace("findStr","replaceStr","str"):以其他字符替换字符串中的一些字符（区分大小写）
   	     * */
   	
   	    echo "<br/>".str_replace("world","Shanghai","Hello world!");
   	    
   	    /* 
   	    Hello Shanghai!
   	     */
   	    
   	    
   	    
   	    
   	    
   	    
   	    /*
   	     * 6.字符串长度与位置
   	     * strlen($str):返回字符串的长度
   	     * */
   	
   	       echo strlen("hello world");
   	  
   	  
   	  /* 
   	       11
   	 */
	?>
   

    </body>
</html>