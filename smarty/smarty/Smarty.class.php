<?php
/*
 * Smarty是一款模板引擎，它的作用是组合php文件与html文件，它分开了逻辑程序和外在的表现
 * 
 * */

class Smarty{
    
    //用于存储键值对
    private $arr=array();
    
    //用于键值对赋值
    public function assign($key,$value){
        $this->arr[$key]=$value;
    }
    
    //组合php文件与html文件
    public function display($tplFile){
        $tFile="./tpl/".$tplFile;
        $comFile="./compose/".$tplFile.".php";
        if(!file_exists($comFile)||filemtime($tFile)>filemtime($comFile)){
            $content=file_get_contents($tFile);
            $reg=array(
              '/\{\$([a-zA-Z_][a-zA-Z0-9_]*)\}/'  
            );
            $rep=array(
                '<?php echo $this->arr["${1}"]?>'
            );
            $newContent=preg_replace($reg, $rep, $content);
            file_put_contents($comFile, $newContent);
        }
        
        include $comFile;
        
    }
    
}