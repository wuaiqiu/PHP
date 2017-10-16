<?php
/*
 * 模板
 *   (1)系统变量
 *      支持输出 $_SERVER、$_ENV、 $_POST、 $_GET、 $_REQUEST、$_SESSION和 $_COOKIE变量
 *      {$Think.server.script_name}     #输出$_SERVER['SCRIPT_NAME']变量
 *      {$Think.session.user_id}        #输出$_SESSION['user_id']变量
 *      {$Think.get.pageNumber}         #输出$_GET['pageNumber']变量
 *      {$Think.cookie.name}            #输出$_COOKIE['name']变量
 *      
 *    
 *   (2)使用函数
 *      a.一个参数
 *      {$data|md5}
 *      ==><?php echo (md5($data)); ?>
 *      
 *      b.多个参数
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
 *   (3)设置默认值
 *   {$name|defautl="这是默认值"}
 *   
 *   
 *   (4)使用运算符
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
 *   (5)模板继承 
 *  
 *      <block name="区块名">区块内容</block>
 *      <extend name="模块@主题/控制器/操作">
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
 *      <extend name="User/base" />
 *      <block name="title">这是index</block>
 *      <block name="body">index主体</block>
 *      ============================================================
 *    
 *    (6)模板注释
 *      {//单行注释}
 *      {/*
 *          多行注释
 *      }
 *      
 *    (7)模板布局【提取出共同部分】
 *          a.全局配置
 *              如果某些页面不需要使用布局模板功能，可以在模板文件开头加上 {__NOLAYOUT__} 字符串
 *         
 *          'LAYOUT_ON'=>true,
 *          'LAYOUT_NAME'=>'User/layout',	#Application/Home/View/Layout/layout.html
 *          
 *          在layout.html
 *         
 *         ============================================================
 *          <include file="User/head"/>
 *              {_CONTENT_}
 *          <include file="User/foot">
 *          
 *          b.标签配置	<layout />
 *          
 *              <layout name="模块@主题/控制器/操作" />
 *         
 * */