<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cookie</title>
</head>


    	
    <?php
    /*
     * 1.创建cookie
     * 
     *      setcookie(name, value, expire, path, domain);
     *  
     *  2.取回cookie
     *          
     *       $_COOKIE['name'] 变量用于取回 cookie 的值
     *       
     *  3.删除cookie
     *  
     *        setcookie("name", "", time()-3600);
     * */
        
    if(isset($_COOKIE["user"])){
        echo "welcome!!!".$_COOKIE['user'];
    }else{
        setcookie("user","zhangsan",time()+3600);
    }        
	?>
    </body>
</html>
