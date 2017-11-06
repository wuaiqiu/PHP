<?php
class SiteRestHandler{
 
   private $sites=array('Baidu','Tencent','Alibaba','Apple','Google','Micrsoft');
    
   public function getAllSites() {  
       header("HTTP/1.1 200 OK");
       header("Content-Type:application/json");
       echo  json_encode($this->sites);
    }
    
    public function getSite($id) {
        header("HTTP/1.1 200 OK");
        header("Content-Type:application/json");
        echo  json_encode(array($id=>($this->sites[$id])?($this->sites[$id]):($this->sites[0]))); 
    }
}