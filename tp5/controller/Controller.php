<?php
#控制器


#1.控制器初始化，控制器初始化方法_initialize，在该控制器的方法调用之前首先执行。
public function _initialize(){
    echo '控制器初始化';
}


#2.前置操作,可以为某个或者某些操作指定前置执行的操作方法,无值的话为当前控制器下所有方法的前置方法
protected $beforeActionList = [
    'before1',
    'before2' =>  ['except'=>'fun1'],
    'before3'  =>  ['only'=>'fun1,fun2'],
];


#3.页面跳转
//设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
$this->success('新增成功', 'User/list');
//错误页面的默认跳转页面是返回前一页，通常不需要设置
$this->error('新增失败');


#4.重定向
//重定向到News模块的Category操作
$this->redirect('News/category', ['cate_id' => 2]);
//重定向到指定的URL地址 并且使用302
$this->redirect('http://thinkphp.cn/blog/2',302);
//在重定向的时候通过session闪存数据传值data
$this->redirect('News/category', ['cate_id' => 2], 302, ['data' => 'hello']);
//记住当前的URL后跳转
redirect('News/category')->remember();
//跳转到上次记住的URL
redirect()->restore();


#5.空操作(系统在找不到指定的操作方法)
public function _empty(){
    return 'empty action';
}


#6.空控制器(系统找不到指定的控制器)
class Error{
    public  function index(){
        echo 'empty controller';
    }
}


#7.分层控制器(application/index/event/Blog)
$event=Loader::controller('Blog', 'event'); //$event=controller('Blog', 'event');
//支持跨模块调用
$event = controller('Admin/Blog', 'event'); //表示实例化Admin模块的Blog控制器类
//调用Blog控制器的update方法并传参
Loader::action('Blog/update', ['id' => 5], 'event'); //action('Blog/update', ['id' => 5], 'event');
//实现Widget
action('Blog/menu', ['name'=>'think'], 'widget'); //widget('Blog/menu', ['name' => 'think'])


#8.多级控制器(application/index/controller/one/Blog.php  ==> http://localhost/index.php/index/one.blog/index)
//自动定位控制器 ('controller_auto_search' => true  ==> http://localhost/index.php/index/one/blog/index)


#9.预定义常量
EXT           类库文件后缀（.php）
DS            当前系统的目录分隔符(/)
THINK_PATH    框架系统目录(/thinkphp/)
ROOT_PATH     框架应用根目录(/)
APP_PATH      应用目录(/application/）
CONF_PATH     配置目录（/appliction/）
IS_WIN        是否属于Windows 环境
ENV_PREFIX    环境变量配置前缀(PHP_)