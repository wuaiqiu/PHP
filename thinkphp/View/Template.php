<?php
/*
 * 模板
 *    (1)赋值
 *          #设值html变量的定界符(默认为'{}')
 *          'TMPL_L_DELIM'=> '{'
 *          'TMPL_R_DELIM'=> '{'
 *
 *          #直接使用assign
 *          $this->assign('变量名','变量值');
 *          $this->display();
 *
 *
 *          #使用数组
 *          $arr['变量名']='变量值';
 *          $this->assign($arr);
 *          $this->display();
 *
 *          {$arr.变量名}		{$arr[变量名]}
 *   
 *   
 *   (2)系统变量
 *      支持输出 $_SERVER、$_ENV、 $_POST、 $_GET、 $_REQUEST、$_SESSION和 $_COOKIE变量
 *      {$Think.server.script_name}     #输出$_SERVER['SCRIPT_NAME']变量
 *      {$Think.session.user_id}        #输出$_SESSION['user_id']变量
 *      {$Think.get.pageNumber}         #输出$_GET['pageNumber']变量
 *      {$Think.cookie.name}            #输出$_COOKIE['name']变量
 *
 *      常量输出
 *      {$Think.const.APP_PATH}或{$Think.APP_PATH}
 *      
 *      配置输出
 *      {$Think.config.db_charset}
 *      {$Think.config.url_model}
 *
 *
 *   (3)使用函数
 *      a.一个参数
 *      {$data|md5}
 *      ==><?php echo (md5($data)); ?>
 *
 *      b.多个参数（如果前面输出的变量在后面定义的函数的第一个参数，则可省###）
 *      {$data|substr=###,0,3}
 *      ==><?php echo (substr($data,0,3)); ?>
 *
 *      c.多个函数(函数会按照从左到右的顺序依次调用)
 *      {$name|md5|strtoupper|substr=0,3}
 *      ==><?php echo (substr(strtoupper(md5($name)),0,3)); ?>
 *
 *      d.其它调用方式
 *      {:substr(strtoupper(md5($name)),0,3)}
 *
 *
 *   (4)设置默认值
 *   {$name|defautl="这是默认值"}
 *
 *
 *   (5)使用运算符
 *      运算符	使用示例
 *      +	{$a+$b}
 *      -	{$a-$b}
 *      *	{$a*$b}
 *      /	{$a/$b}
 *      %	{$a%$b}
 *      ++	{$a++} 或 {++$a}
 *      –	{$a–} 或 {–$a}
 *
 *     a.在使用运算符的时候，不再支持点语法和常规的函数用法
 *      {$user.score+10} //错误
 *      {$user['score']+10} //正确的
 *
 *      {$user['score']|myFun*10} //错误的
 *      {$user['score']+myFun($user['level'])} //正确的
 *
 *     b.三元运算符
 *     {$变量名 ? '有值' : '无值'}
 *
 *
 *   (6)模板继承
 *  	在子模板中，只能定义区块而不能定义其他的模板内容，否则将会直接忽略
 *      <block name="区块名">区块内容</block>
 *      <extend name="模块@主题/控制器/操作" />
 *
 *      base.html
 *
 *      ============================================================
 *      <html>
 *      <head>
 *          <title><block name="title">base页面</block></title>
 *          <meta charset='utf8'/>
 *      </head>
 *      <body>
 *      <block name="body">base主体</block>
 *      </body>
 *      </html>
 *      ============================================================
 *
 *      index.html
 *      ============================================================
 *      <extend name="./Public/base.html" />
 *      <block name="title">这是index</block>
 *      <block name="body">index主体</block>
 *      ============================================================
 *
 *    (7)模板注释
 *      {//单行注释}
 *      {/*
 *          多行注释
 *      }
 *
 *    (8)模板布局【提取出共同部分】
 *          a.全局配置
 *              如果某些页面不需要使用布局模板功能，可以在模板文件开头加上 {__NOLAYOUT__} 字符串
 *
 *          'LAYOUT_ON'=>true,
 *          'LAYOUT_NAME'=>'layout',	#Application/Home/View/[theme/]layout.html
 *          'LAYOUT_NAME'=>'Layout/layout',	#Application/Home/View/[theme/]Layout/layout.html
 *
 *          在layout.html
 *
 *         ============================================================
 *          <include file="User/head"/>
 *              {_CONTENT_}
 *          <include file="User/foot">
 *
 *          b.标签配置;不需要开启LAYOUT_ON
 *
 *              <layout name="layout" />	#Application/Home/View/[theme/]layout.html
 *              <layout name="Layout/layout">#Application/Home/View/[theme/]Layout/layout.html
 *              
 *
 * */