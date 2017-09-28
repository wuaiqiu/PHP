<!--第一种默认格式 -->
	<?php

	  //php是解释性语言，动态语言
          echo "this is a php<br/>";
        ?>
    
    
<!--第二种脚本格式	 -->
	<script language="php">	
          echo "this is a php";
        </script>


	<?php
         echo "this is a php comment<br/>";
         #单行注释
         //单行注释
        
        /*
         * 多行注释
         * */
        ?>

	<?php
	//采用php设置http报头。
	header(string,replace)
		#string:规定要发送的报头字符串
		#replace指示该报头是否替换之前的报头;默认是 true（替换）。false（允许相同类型的多个报头）。
	
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header("Content-type: text/html; charset=utf-8"); 
	
	
	?>

</body>
</html>