<?php
/*
 * Auth模块
 *
 * 一.设置默认
 *
 * (1).生成认证所需要的路由和视图
 *   php artisan make:auth
 *
 * (2).需要修改app/Providers/AppServiceProvider的boot方法中添加【mariadb中】
 *   Schema::defaultStringLength(191);
 *
 * (3).数据迁移
 *   php artisan migrate
 *
 * (4).修改resources/views/layouts/app.blade.php的js与css路径
 *      asset('css/app.css');
 *      asset('js/app.js');
 *
 *
 * 二.分析
 *
 * (1).RegisterController
 *
 *  a.路由
 *      $this->get('register', 'Auth\RegisterController@showRegistrationForm');
 *      $this->post('register', 'Auth\RegisterController@register');
 *
 *
 *  b.访问顺序
 *      public function showRegistrationForm(){
 *          return view('auth.register');
 *      }
 *
 *      protected function validator(array $data){
 *          return Validator::make($data, [
 *               'name' => 'required|max:255',
 *               'email' => 'required|email|max:255|unique:users',
 *               'password' => 'required|min:6|confirmed',
 *          ]);
 *      }
 *
 *      protected function create(array $data){
 *          return User::create([
 *              'name' => $data['name'],
 *              'email' => $data['email'],
 *              'password' => bcrypt($data['password']),
 *          ]);
 *      }
 *
 *       protected function guard(){
 *          return Auth::guard();
 *       }
 *
 *       protected $redirectTo = '/home';
 *
 *
 * (2).LoginController
 *
 *    a.路由
 *          $this->get('login', 'Auth\LoginController@showLoginForm');
 *          $this->post('login', 'Auth\LoginController@login');
 *          $this->post('logout', 'Auth\LoginController@logout');
 *
 *   b.访问顺序
 *          public function showLoginForm(){
 *              return view('auth.login');
 *          }
 *
 *           protected function validateLogin(Request $request){
 *              $this->validate($request,
 *                  [$this->username() => 'required', 'password' => 'required']);
 *           }
 *
 *           public function username(){
 *              return 'email';
 *           }
 *
 *            protected function attemptLogin(Request $request){
 *              return $this->guard()->attempt(
 *                   $this->credentials($request), $request->has('remember')
 *              );
 *            }
 *
 *            protected function guard(){
 *              return Auth::guard();
 *            }
 *
 *            protected function credentials(Request $request){
 *              return $request->only($this->username(), 'password');
 *            }
 *
 *            protected function sendFailedLoginResponse(Request $request){
 *              $errors = [$this->username() => trans('auth.failed')];
 *              if ($request->expectsJson()) {
 *                  return response()->json($errors, 422);
 *              }
 *              return redirect()->back()
 *                  ->withInput($request->only($this->username(), 'remember'))
 *                  ->withErrors($errors);
 *            }
 *
 *            protected $redirectTo = '/home';
 *
 *            public function logout(Request $request){
 *                  $this->guard()->logout();
 *                  $request->session()->flush();
 *                  $request->session()->regenerate();
 *                  return redirect('/');
 *            }
 *
 *
 *  (3).ForgetPasswordController,ResetPasswordController
 *
 *      a.路由
 *          $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
 *          $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
 *          $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
 *          $this->post('password/reset', 'Auth\ResetPasswordController@reset');
 *
 *
 *      b.访问顺序
 *          public function showLinkRequestForm(){
 *              return view('auth.passwords.email');
 *          }
 *
 *          public function broker(){
 *              return Password::broker();
 *          }
 *
 *           protected function sendResetLinkResponse($response){
 *              return back()->with('status', trans($response));
 *           }
 *
 *           protected function sendResetLinkFailedResponse(Request $request, $response){
 *              return back()->withErrors(['email' => trans($response)]);
 *           }
 *
 *           public function showResetForm(Request $request, $token = null){
 *              return view('auth.passwords.reset')->with(
 *                  ['token' => $token, 'email' => $request->email]);
 *            }
 *
 *            protected function rules(){
 *                  return [
 *                      'token' => 'required',
 *                      'email' => 'required|email',
 *                      'password' => 'required|confirmed|min:6',
 *                  ];
 *             }
 *
 *            public function broker(){
 *                 return Password::broker();
 *            }
 *
 *            protected function credentials(Request $request){
 *                return $request->only(
 *                  'email', 'password', 'password_confirmation', 'token'
 *              );
 *            }
 *
 *            protected function resetPassword($user, $password){
 *               $user->forceFill([
 *                  'password' => bcrypt($password),
 *                  'remember_token' => Str::random(60),
 *               ])->save();
 *               $this->guard()->login($user);
 *           }
 *
 *           protected function guard(){
 *               return Auth::guard();
 *           }
 *
 *           protected function sendResetResponse($response){
 *              return redirect($this->redirectPath())->with('status', trans($response));
 *           }
 *
 *           protected function sendResetFailedResponse(Request $request, $response){
 *               return redirect()->back()
 *                      ->withInput($request->only('email'))
 *                      ->withErrors(['email' => trans($response)]);
 *         }
 *
 *         protected $redirectTo = '/home';
 *
 *
 * 三.Auth
 *      
 *      //尝试登录(当有$boolean参数时，表必须包含remember_token字段)  
 *      $bool=Auth::guard('admin')->attempt($credentials,$boolean) 
 *      //当有user表实例，且表必须继承Illuminate\Contracts\Auth\Authenticatable
 *      $bool=Auth::guard('admin')->login($user,$bool); 
 *      //获取当前认证用户实例
 *      $user = Auth::user();
 *      //获取当前认证用户id
 *       $id = Auth::id();
 *      //判断当前用户是否通过认证
 *       $bool=Auth::check();
 *      //是否记住我
 *      $bool=Auth::viaRemember(); 
 *      //清除session
 *      Auth::logout();
 *
 */