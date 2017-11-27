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
 *   (7)空操作与空控制器
 *
 *          a.空操作指的是控制器中没有的操作
 *              public function _empty(){
 *                  echo "没有".ACTION_NAME;
 *              }
 *
 *
 *          b.空控制器
 *              class EmptyController extends Controller{
 *                  function index(){
 *                      echo "没有".CONTROLLER_NAME;
 *                   }
 *               }
 *
 *
 *    (8)Action参数绑定（用于URL传参）
 *        'URL_PARAMS_BIND'=>true   #配置action参数绑定，默认为true
 *
 *        a.名字传参(不要求顺序)
 *        public function index($id){
 *              echo "id=$id";
 *        }
 *
 *        ==> http://localhost/index.php/Home/User/index/id/5
 *
 *        b.顺序传参(可以省去参数名)
 *        'URL_PARAMS_BIND_TYPE'=>1 #更改为顺序传参
 *
 *        ==> http://localhost/index.php/Home/User/index/5
 *
 *
 *    (9)错误处理
 *
 *         #在部署模式下，提示具体的错误信息
 *         'SHOW_ERROR_MSG'        =>  true
 *
 *         #手动抛出错误（可以使用E函数）
 *         throw new \Think\Exception('新增失败')
 *
 *         #修改系统默认的异常模板文件
 *         'TMPL_EXCEPTION_FILE' => APP_PATH.'/Public/exception.html'
 *
 *         #异常模板中可以使用的异常变量有：（注意模板读取值不起作用，需要php原生代码）
 *         $e['file']异常文件名
 *         $e['line'] 异常发生的文件行数
 *         $e['message'] 异常信息
 *         $e['trace'] 异常的详细Trace信息
 *
 *         #把所有异常和错误都指向一个统一页面(没有异常变量)
 *         'ERROR_PAGE' =>'/Public/error.html'
 *
 *    (10)请求类型常量
 *
 *          IS_GET          判断是否是GET方式提交
 *          IS_POST         判断是否是POST方式提交
 *          IS_PUT          判断是否是PUT方式提交
 *          IS_DELETE     判断是否是DELETE方式提交
 *          IS_AJAX         判断是否是AJAX提交
 *          REQUEST_METHOD  当前提交类型
 *
 *
 *    (11)系统常量(在视图中不用{})
 *
 *          THINK_PATH          框架系统目录  /home/wu/workspace/day19/ThinkPHP/
 *          APP_PATH            应用目录./Application/
 *          __ROOT__            网站根目录地址  /day19
 *          __APP__             当前应用（入口文件）地址 /day19/index.php
 *          __MODULE__          当前模块的URL地址/day19/index.php/Home
 *          __CONTROLLER__      当前控制器的URL地址 /day19/index.php/Home/Contant
 *          __ACTION__          当前操作的URL地址/day19/index.php/Home/Contant/content
 *          __SELF__            当前URL地址/day19/index.php/Home/Contant/content
 *          __PUBLIC__          /day19/Public
 *          MODULE_NAME         当前模块名  Home
 *          MODULE_PATH         当前模块路径./Application/Home/
 *          CONTROLLER_NAME     当前控制器名Contant
 *          ACTION_NAME         当前操作名 content
 *
 *    (12)插件控制器
 *
 *      当访问http://localhost/index.php/Home/Index/index/addon/SystemInfo
 *      实际执行:Application/Addon/Controller/IndexController.class.php
 *
 *      #更改插件控制器的变量（默认为addon）
 *      'VAR_ADDON'    =>    'plugin'
 *      #更改插件控制器的目录
 *      define('ADDON_PATH',     APP_PATH.'Addon');
 *
 *     (13)日志记录
 *          EMERG 严重错误，导致系统崩溃无法使用
 *          ALERT 警戒性错误， 必须被立即修改的错误
 *          CRIT 临界值错误， 超过临界值的错误
 *          ERR 一般性错误
 *          WARN 警告性错误， 需要发出警告的错误
 *          NOTICE 通知，程序可以运行但是还不够完美的错误
 *
 *      'LOG_RECORD' => true, # 开启日志记录
 *      'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', #只记录EMERG ALERT CRIT ERR 错误
 *      'LOG_TYPE'  =>  'File', #日志记录类型 默认为文件方式Runtime/Logs
 * */
