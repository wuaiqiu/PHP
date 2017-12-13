<?php
#生成Controller控制器
#php artisan make:controller PhotoController

class Controller extends Controller{

    #Route::get('info1/{name}','Controller@info1')->where('name','[a-zA-Z]+');
    public function info1($name){
        //普通操作
    }

    #Route::get('info','Controller');
    public function __invoke(){
        //单动作操作
    }

    #使用中间件
    public function __construct(){
        /*
         * $this->middleware('中间件');
         * $this->middleware('中间件')->only('方法');
         * $this->middleware('中间件')->except('方法');
         * */
    }

    #Request
    public function info2(Request $request){
        /*
         * $request->input("参数"):取特定的值
         * $request->input("参数","默认值"):取特定的值
         * $request->has('参数'):是否有参数
         * $request->all():获取所有参数
         * $request->Method():获取请求类型
         * $request->isMethod('GET'):是否为GET请求类型
         * $request->url():请求路径
         * $request->fullUrl():包含请求参数的路径
         * $request->path():相对于public目录
         * $request->flash():将输入存储到一次性Session(不是session，只是一个input暂存区)
         * $request->flashOnly(['username', 'email'])：将指定输入存储到一次性 Session
         * $request->flashExcept(['password'])：排除输入
         * $request->old('username'):取出上次输入数据
         * return redirect('form')->withInput():将输入存储到一次性 Session 然后重定向
         * return redirect('form')->withInput($request->except('password')):过滤后重定向
         * */
    }

    #Response
    public function info3(){
        /*
         * response($content)->header('Content-Type', $type):返回响应头
         * response($content)->withHeaders(['Content-Type' => $type])：返回响应头数组
         * response()->json(['id'=>2,'name'=>'zhangsan'])：发送json数据
         * redirect('User/info3')->with('name','ss'):带一次性 Session 数据的重定向
         * redirect()->action('UserController@info3')：重定向到控制器动作
         * redirect()->route('info3')：重定向到命名路由
         * */
    }

    #操作view
    public function info4(){
        /*
         * 显示视图（resources/views/greeting.blade.php）
         *return view('greeting', ['name' => 'James'])：带参数
         *return view('admin.profile'):resources/views/admin/profile.blade.php
         *return view()->exists('greeting')：判断视图是否存在
         * */
    }
}

#2.使用路由缓存（只对控制器路由有作用）
#php artisan route:cache
#php artisan route:clear