<?php 
//Model(模型)在PHP中负责数据管理，数据生成。

class UserModel{
    private $data=array(
        't'=>'Hello , This is Title',
        'w'=>'Hello , This is Welcome',
    );
    
    public function getData($param){
        return (isset($this->data[$param]))?$this->data[$param]:$this->data['t'];
    }
    
}
?>