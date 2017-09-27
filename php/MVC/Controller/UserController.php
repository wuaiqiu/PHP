<?php 
//Controller(控制器)在PHP中根据请求决定调用的视图及使用的数据

require 'View/UserView.php';
require 'Model/UserModel.php';
class UserController{
       
        public  function index($param){
            $model=new UserModel();
            $view=new UserView();
            $data=$model->getData($param);
            $view->display($data);
           
        }
        
    }
?>