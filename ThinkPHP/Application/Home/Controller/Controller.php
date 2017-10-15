<?php
/*
 * 控制器
 *   (1)访问控制器
 *      a.操作方法为public才能被访问
 *      b.控制器类的命名方式是：控制器名+Controller
 *      c.控制器文件的命名方式是：类名+class.php
 *      d.访问方式：http://localhost/index.php/模块/控制器/操作方法
 *   
 *   
 *   (2)实例化（或者使用A方法）
 *      #实例化Home模块的User控制器
 *      $User = new \Home\Controller\UserController();
 *      #实例化Admin模块的Blog控制器
 *      $Blog = new \Admin\Controller\BlogController();
 *     
 *      
 *   (3)操作方法名冲突
 *       'ACTION_SUFFIX'=>'Action'  #设置操作名后缀
 *       
 *       class UserController extends Controller{
 *              public function classAction(){
 *                  echo "Hello world";       
 *              }
 *       }  
 *       
 *       ==>http://localhost/index.php/Home/User/class
 *     
 *        
 *   (4)控制器分层
 *          默认Controller下的控制器称为访问控制器,其它目录下的控制器不可访问
 *       只能在访问控制器中调用使用
 *      
 *       
 *   (5)控制器分级
 *          即Controller目录下可以存在子目录
 *          
 *          'CONTROLLER_LEVEL'=>2   #配置允许二级控制器;则一级控制器失效
 *      ==>http://localhost/index.php/Home/User/SubUser/index    
 *     
 *          
 *   (6)两个特殊的操作名(在访问特定的控制器时会自动调用)
 *        a.前置操作
 *        public function _before_操作名(){
 *              echo "前置<br/>";
 *        }
 *        
 *        b.后置操作
 *        public function _after_操作名(){
 *              echo "<br/>后置";
 *         } 
 *    
 *    
 *    (7)Action参数绑定（用于URL传参）
 *        'URL_PARAMS_BIND'=>true   #配置action参数绑定，默认为true
 *        
 *        a.名字传参(不要求顺序)
 *        public function index($id){
 *              echo "id=$id";        
 *        }
 *        
 *        ==>	http://localhost/index.php/Home/User/index/id/5
 *        
 *        b.顺序传参(可以省去参数名)
 *        'URL_PARAMS_BIND_TYPE'=>1 #更改为顺序传参
 *        
 *        ==>	http://localhost/index.php/Home/User/index/5
 *        
 *         
 *    (8)请求类型常量
 *      
 *          IS_GET	        判断是否是GET方式提交
 *          IS_POST	        判断是否是POST方式提交
 *          IS_PUT	        判断是否是PUT方式提交
 *          IS_DELETE	    判断是否是DELETE方式提交
 *          IS_AJAX	        判断是否是AJAX提交
 *          REQUEST_METHOD	当前提交类型
 *                 
 * */