<?php
        $arr=array("abc","bcd","def");
        
        //从请求URL地址中获取 q 参数
        $q=$_GET["q"];
        
        //查找是否由匹配值， 如果 q>0
        if (strlen($q) > 0){
                $hint="";
                for($i=0; $i<count($arr); $i++){
                 if ($q==substr($arr[$i],0,strlen($q))){
                        $hint=$arr[$i];
                 }
                }
        }
        
        // 如果没有匹配值设置输出为 "no suggestion"
        if ($hint == "")
        {
            $response="no suggestion";
        }
        else
        {
            $response=$hint;
        }
        
        //输出返回值
        echo $response;
        
?>