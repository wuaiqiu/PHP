<?php 
//View(视图)在PHP中负责输出，处理如何调用模板、需要的资源文件。

class UserView{
    public function display($data){
       echo "<h1>$data</h1>";
    }
}
?>